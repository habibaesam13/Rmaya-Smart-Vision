<?php

namespace App\Services;


use Mpdf\Image\Svg;
use App\Models\Sv_report;
use Illuminate\Http\Request;
use App\Models\Sv_initial_results;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Sv_initial_results_players;
use App\Models\Sv_member;

class ResultsService
{
    /**
     * Create a new class instance.
     */
    protected WeaponService $weaponService;
    public function __construct(WeaponService $weaponService)
    {
        $this->weaponService = $weaponService;
    }
    //check the player found by relation key (primary key for sv_initial_results_players)
    public function getPlayerByRowId($id)
    {
        return Sv_initial_results_players::where('id', $id);
    }
    public function createReport($data)
    {

        return DB::transaction(function () use ($data) {

            $report = SV_initial_results::create($data);


            foreach ($data['checkedMembers'] as $mid) {
                $report->players_results()->create([
                    'player_id' => $mid,
                    'goal'      => 0,
                    'notes'     => null,
                ]);
            }

            return $report;
        });
    }

    public function getReportDetails($reportId)
    {
        $Players = sv_initial_results_players::where('Rid', $reportId)->get();
        return $Players;
    }
    public function getReport($rid)
    {
        return SV_initial_results::findOrfail($rid);
    }
    public function confirmReport($rid)
    {
        $report = $this->getReport($rid);
        $report->confirmed = !$report->confirmed;
        return $report->save();
    }
    public function deletePlayerFromReport($player_id)
    {
        $player = sv_initial_results_players::findOrfail($player_id);
        return $player->delete();
    }
    public function saveReport(Request $request, $playersData, $rid)
    {
        $report = $this->getReport($rid);


        if ($request->hasFile('attached_file')) {
            $validated = $request->validate([
                'attached_file' => 'mimes:pdf,doc,docx,xlsx,xls|max:2048',
            ]);

            // Get the validated file
            $file = $validated['attached_file'];

            // Delete the old file if exists
            if ($report->attached_file && Storage::disk('public')->exists($report->attached_file)) {
                Storage::disk('public')->delete($report->attached_file);
            }

            // Store new file
            $path = $file->store('reports_attachments', 'public');
            $report->update(['attached_file' => $path]);
        }

        // Update player results
        foreach ($playersData as $playerId => $values) {
            $cleanedValues = collect($values)->map(function ($v, $k) {
                if ($k === 'notes') {
                    return $v === '' ? null : $v;
                }
                return ($v === '' || is_null($v)) ? null : $v;
            })->toArray();

            $report->players_results()
                ->where('id', $playerId)
                ->update([
                    'goal'   => $cleanedValues['goal'] ?? 0,
                    'R1'     => $cleanedValues['R1'] ?? null,
                    'R2'     => $cleanedValues['R2'] ?? null,
                    'R3'     => $cleanedValues['R3'] ?? null,
                    'R4'     => $cleanedValues['R4'] ?? null,
                    'R5'     => $cleanedValues['R5'] ?? null,
                    'R6'     => $cleanedValues['R6'] ?? null,
                    'R7'     => $cleanedValues['R7'] ?? null,
                    'R8'     => $cleanedValues['R8'] ?? null,
                    'R9'     => $cleanedValues['R9'] ?? null,
                    'R10'    => $cleanedValues['R10'] ?? null,
                    'total'  => $cleanedValues['total'] ?? null,
                    'notes'  => $cleanedValues['notes'] ?? null,
                ]);
        }

        return $report;
    }



    public function getAvailablePlayers($report)
    {
        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        return Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
            ->orderBy('mid')
            ->get();
    }
    public function GetAllAvailablePlayers(Request $request)
    {
        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])
            ->where('reg_type', 'personal')
            ->whereNotIn('mid', $addedPlayers)
            ->when(
                $request->hasAny([
                    'mgid',
                    'reg',
                    'nat',
                    'club_id',
                    'weapon_id',
                    'q',
                    'gender',
                    'active',
                    'date_from',
                    'date_to',
                    'reg_club'
                ]),
                fn($q) => $q->filter($request)
            )
            ->orderBy('mid')
            ->cursorPaginate(config('app.admin_pagination_number'));
    }


    /**Preliminary results reports - clubs - details */


    public function getReportsDetails(Request $request, $pag)
    {
        $query = SV_initial_results::query()->where('confirmed', true)
            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('Rid');
        if ($pag == 1) {
            return $query->cursorPaginate(config('app.admin_pagination_number'));
        } else {
            return $query->get();
        }
    }


    //البحث فى النتائج الأولية اليومية
    public function searchInitialResultsReports(Request $request)
    {

        $query = Sv_initial_results_players::query()
            ->with(['player.club', 'player.weapon', 'report.weapon']);
        $query->whereHas('report', function ($sub) use ($request) {
            $sub->where('confirmed', true);
            if ($request->filled('date')) {
                $sub->whereDate('date', $request->date);
            }
        });
        if ($request->filled('q')) {
            $query->whereHas('player', function ($sub) use ($request) {
                $sub->where('name', 'like', "%{$request->q}%")
                    ->orWhere('ID', 'like', "%{$request->q}%")
                    ->orWhere('phone1', 'like', "%{$request->q}%");
            });
        }
        $results = $query->orderBy('Rid')
            ->cursorPaginate(config('app.admin_pagination_number'));

        return $results;
    }

    //قائمة النتائج الاولية
    public function listOfInitialResults(Request $request)
    {

        // weapon_id is required
        if (!$request->weapon_id) {
            return 'required';
        }

        $weapon = $this->weaponService->getWeaponById($request->weapon_id);

        if (!$weapon) {
            return 'not_found';
        }
        $query = Sv_initial_results_players::query()
            ->with(['player.club', 'player.weapon', 'report.weapon'])
            ->whereHas('report', function ($sub) use ($request) {
                $sub->where('confirmed', true)
                    ->where('weapon_id', $request->weapon_id);
                if ($request->filled('date')) {
                    $sub->whereDate('date', $request->date);
                }
            });
        // Filter by club
        if ($request->filled('club_id')) {
            $query->whereHas('player', function ($sub) use ($request) {
                $sub->where('club_id', $request->club_id);
            });
        }

        // Filter by total score
        if ($request->filled('total')) {
            $query->where('total', '>=', $request->total);
        }
        // Apply ordering
        $query->orderByDesc('total');
        // Apply limit if selected
        if ($request->filled('limit')) {
            $limit = (int) $request->input('limit');
            return $query->take($limit)->get();
        } else {
            return $query->paginate(config('app.admin_pagination_number'));
        }
    }

    //update players total
    public function updateTotalForPlayer($player, $total)
    {
        return $player->update($total);
    }
    //قائمة الافراد المتغيبين فى النتائج الاولية
    public function getAbsentPlayersInitialResults($request)
    {
        if (!$request->weapon_id) {
            return 'required';
        }

        $weapon = $this->weaponService->getWeaponById($request->weapon_id);
        if (!$weapon) {
            return 'not_found';
        }

        return Sv_initial_results_players::query()
            ->with(['player.club', 'player.weapon', 'report.weapon'])
            ->whereNull('total')
            ->whereHas('report', fn($q) => $q->where('confirmed', true)->where('weapon_id', $request->weapon_id))

            ->when(
                $request->club_id,
                fn($q) =>
                $q->whereHas(
                    'player.club',
                    fn($sub) =>
                    $sub->where('cid', $request->club_id)
                )
            )
            ->when(
                $request->nat,
                fn($q) =>
                $q->whereHas(
                    'player.nationality',
                    fn($sub) =>
                    $sub->where('id', $request->nat)
                )
            )
            ->when(
                $request->gender,
                fn($q) =>
                $q->whereHas(
                    'player',
                    fn($sub) =>
                    $sub->where('gender', $request->gender)
                )
            )
            ->when(
                $request->date_from,
                fn($q) =>
                $q->whereHas(
                    'report',
                    fn($sub) =>
                    $sub->whereDate('date', '>=', $request->date_from)
                )
            )
            ->when(
                $request->date_to,
                fn($q) =>
                $q->whereHas(
                    'report',
                    fn($sub) =>
                    $sub->whereDate('date', '<=', $request->date_to)
                )
            )
            ->when(
                $request->q,
                fn($q) =>
                $q->whereHas(
                    'player',
                    fn($sub) => $sub
                        ->where(function ($query) use ($request) {
                            $search = $request->q;
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('ID', 'like', "%{$search}%")
                                ->orWhere('phone1', 'like', "%{$search}%")
                                ->orWhere('phone2', 'like', "%{$search}%");
                        })
                )
            )
            ->paginate(config('app.admin_pagination_number'));
    }
}

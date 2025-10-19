<?php

namespace App\Services;


use App\Http\Traits\ImageTrait;
use App\Models\SVFianlResultsPlayer;
use Mpdf\Image\Svg;
use App\Models\Sv_report;
use Illuminate\Http\Request;
use App\Models\SVFianlResults;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\sv_initial_results_players;
use App\Models\Sv_member;

class AbsentFinalResultsService
{
    use ImageTrait;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createReport($data)
    {

        return DB::transaction(function () use ($data) {

            $report = SVFianlResults::create($data);


            foreach ($data['checkedMembers'] as $mid) {
                $report->players_results()->create([
                    'player_id' => $mid,
                    'goal' => 0,
                    'total' => 0,
                    'notes' => null,
                ]);
            }

            return $report;
        });
    }


    public function findReport($id)
    {
                    return SVFianlResults::with('players_results')->find($id);
    }


    public function getReportDetails($reportId)
    {
        $Players = SVFianlResultsPlayer::where('Rid', $reportId)->get();
        return $Players;
    }

    public function getReport($rid)
    {
        return SVFianlResults::findOrfail($rid);
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

            $report->file = $path;
            $report->save();

        }


        // Update player results
        foreach ($playersData as $playerId => $values) {
            $cleanedValues = collect($values)->map(function ($v, $k) {
                if ($k === 'notes') {
                    return $v === '' ? null : $v;
                }
                return ($v === '' || is_null($v)) ? 0 : $v;
            })->toArray();

            $report->players_results()
                ->where('id', $playerId)
                ->update([
                    'goal' => $cleanedValues['goal'] ?? 0,
                    'R1' => $cleanedValues['R1'] ?? 0,
                    'R2' => $cleanedValues['R2'] ?? 0,
                    'R3' => $cleanedValues['R3'] ?? 0,
                    'R4' => $cleanedValues['R4'] ?? 0,
                    'R5' => $cleanedValues['R5'] ?? 0,
                    'R6' => $cleanedValues['R6'] ?? 0,
                    'R7' => $cleanedValues['R7'] ?? 0,
                    'R8' => $cleanedValues['R8'] ?? 0,
                    'R9' => $cleanedValues['R9'] ?? 0,
                    'R10' => $cleanedValues['R10'] ?? 0,
                    'total' => $cleanedValues['total'] ?? 0,
                    'notes' => $cleanedValues['notes'] ?? null,
                ]);
        }

        return $report;
    }


    public function getAvailablePlayers($report  ,$request)
    {
        if($report) {
            $addedPlayers = SVFianlResultsPlayer::where('total', '<>', null)->OrWhere('Rid', $report->id)->pluck('player_id')->toArray();

            //            Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
//            ->orderBy('mid')
//            ->get();
            $data = DB::table('sv_members')
                ->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
                ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
                ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
                ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
//            ->join('sv_fianl_results_players', 'sv_fianl_results_players.player_id', '=', 'sv_members.mid')
//            ->join('sv_fianl_results', 'sv_fianl_results.id', '=', 'sv_fianl_results_players.Rid')
//
                ->select('sv_initial_results_players.*',
                    'sv_members.name',
                    'sv_members.phone1',
                    'sv_members.phone2',
                    'sv_members.mid',
                    'sv_members.ID',
                    'sv_weapons.name as weapon_name',
                    'sv_members.registration_date',
                    'sv_clubs.name as club_name'

                )
                ->where(['sv_initial_results_players.total'=> null , 'sv_initial_results.confirmed'=> 1])
                ->where('sv_members.weapon_id', $report->weapon_id)
                ->where('sv_members.reg_type', 'personal')
                ->whereNotIn('sv_members.mid', $addedPlayers)
//            ->whereNot('gfg' , $report->finalPlayers()->pluck('mid'))
//            ->where('sv_fianl_results.id' , $report->id)
//            ->where('reg_type', 'personal')
//            ->when(
//                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
//                fn($q) => $q->filter($request)
//            )
                ->orderBy('sv_initial_results_players.total', 'desc')
                ->get();
//            ->get();

            return $data;
        }
        return collect();
    }

    public function GetAllAvailablePlayers(Request $request)
    {
//        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        $addedPlayers = SVFianlResultsPlayer::where('total', '<>', null)->pluck('player_id')->toArray();

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
                fn ($q) => $q->filter($request)
            )
            ->orderBy('mid')
            ->cursorPaginate(config('app.admin_pagination_number'));
    }


    /**Preliminary results reports - clubs - details */


    public function getReportsDetails(Request $request)
    {
        return SVFianlResults::query()
//            ->where('confirmed', true)
                ->whereHas('finalPlayers' , function ($q){
                    $q->where('total' , null);
            })
            ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn ($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('id')
            ->cursorPaginate(config('app.admin_pagination_number'));

    }

    public function getReportsDetailsWithWeapons(Request $request, $withPaging = 'yes')
    {
        $query = SVFianlResults::query()->with('weapon')->where('confirmed', true)
            ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn ($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('id');
        if ($withPaging == 'yes') {
            return $query->cursorPaginate(config('app.admin_pagination_number'));
        }
        return $query->get();
    }


    public function getReportsPlayersDetails(Request $request, $pagination = 'yes')
    {

        $query = SVFianlResults::query();

        $query
            ->
            join('sv_fianl_results_players', 'sv_fianl_results_players.Rid', '=', 'sv_fianl_results.id')
            ->join('sv_members', 'sv_members.mid', '=', 'sv_fianl_results_players.player_id')
            ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
            ->select('sv_fianl_results_players.id as result_player_id', 'sv_fianl_results_players.second_total', 'sv_fianl_results_players.total', 'sv_fianl_results.*', 'sv_members.name as player_name', 'sv_members.mid as player_id', 'sv_members.club_id', 'sv_members.ID as ID', 'sv_weapons.name as weapon_name')
            ->where('sv_fianl_results.confirmed', 1);
//        dd( $query->get());

        if (!empty($request->club_id)) {
            $query = $query->where('sv_members.club_id', $request->club_id);
        }

        if (!empty($request->weapon_id)) {
            $query = $query->where('sv_fianl_results.weapon_id', $request->weapon_id);
        }
        if (!empty($request->details_date)) {
            $query = $query->whereDate('sv_fianl_results.date', $request->details_date);
        }
//        if (!empty($request->to_date)) {
//            $query = $query->whereDate('sv_fianl_results.date', '=<', $request->to_date);
//        }

        if (!empty($request->search)) {
            $query = $query->where('sv_members.name', 'like', "%" . $request->search . "%")
                ->orWhere('sv_members.ID', 'like', "%" . $request->search . "%")
                ->orWhere('sv_members.phone1', $request->search)
                ->orWhere('sv_members.phone2', $request->search);


        }

        if (!empty($request->total)) {
            $query = $query->where('sv_fianl_results_players.total', '<=', $request->total);
        }
        $query->orderBy('sv_fianl_results_players.total', 'desc')->orderBy('sv_fianl_results_players.second_total', 'desc');

        if ($pagination === 'yes') {
            if (!empty($request->rate_limiting)) {
                $data = $query->limit($request->rate_limiting)->cursorPaginate($request->rate_limiting);
            } else {
                $data = $query->cursorPaginate(config('app.admin_pagination_number'));
            }
        } else {
            if (!empty($request->rate_limiting)) {
                $data = $query->limit($request->rate_limiting)->get();
            } else {
                $data = $query->get();
            }
        }
        return $data;
    }

//    public function getConfirmedPlayers(Request $request)
//    {
////        return SVFianlResults::query()->where('confirmed',true)
////            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
////            ->when($request->details, fn($q, $details) => $q->where('details', $details))
////            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
////            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
////            ->with ('players_results')->orderBy('Rid')
////            ->cursorPaginate(config('app.admin_pagination_number'));
//        return
//
//            Sv_member::query()
//                ->whereHas('SVFianlResults' , function ($query){
//                    $query->where('total' , '>' , 0);
//                })
//                ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//                ->when($request->details, fn($q, $details) => $q->where('details', $details))
//                ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//                ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//                ->orderBy('mid')
//                ->cursorPaginate(config('app.admin_pagination_number'));
//
//    }


    public function getConfirmedAvailablePlayers($report)
    {

        $addedPlayers = sv_initial_results_players::pluck('player_id')->toArray();
        return Sv_member::where('reg_type', 'personal')->where('weapon_id', $report->weapon_id)->whereNotIn('mid', $addedPlayers)
            ->orderBy('mid')
            ->get();
    }


    /**********************/
    public function getConfirmedPlayers(Request $request)
    {
//        return SV_initial_results::query()->where('confirmed',true)
//            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//            ->when($request->details, fn($q, $details) => $q->where('details', $details))
//            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//            ->with ('players_results')->orderBy('Rid')
//            ->cursorPaginate(config('app.admin_pagination_number'));

//            Sv_member::query()
//                ->whereHas('sv_initial_results' , function ($query){
//                    $query->where('total' , '>' , 0);
//                })
//                ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
//                ->when($request->details, fn($q, $details) => $q->where('details', $details))
//                ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
//                ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
//                ->orderBy('mid')
//            ->cursorPaginate(config('app.admin_pagination_number'));

        return

            DB::table('sv_members')->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
                ->join('sv_weapons', 'sv_weapons.wid', '=', 'sv_members.weapon_id')
                ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
                ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
                ->join('sv_fianl_results_players', 'sv_fianl_results_players.player_id', '=', 'sv_members.mid')
                ->join('sv_fianl_results', 'sv_fianl_results.id', '=', 'sv_fianl_results_players.Rid')

                ->select('sv_initial_results_players.*',
                    'sv_members.name',
                    'sv_members.phone1',
                    'sv_members.phone2',
                    'sv_members.mid',
                    'sv_members.ID',
                    'sv_weapons.name as weapon_name',
                    'sv_members.registration_date',
                    'sv_clubs.name as club_name',
                    'sv_initial_results_players.total as player_total',
                    'sv_fianl_results_players.total'

                )
                ->where(['sv_initial_results_players.total'=>null , 'sv_initial_results.confirmed'=> 1  , 'sv_fianl_results_players.total' => null])
                ->orWhere('sv_fianl_results_players.total' , null)
                ->when($request->weapon_id, fn ($q, $weapon) => $q->where('weapon_id', $weapon))
                ->when($request->club_id, fn ($q, $club) => $q->where('cid', $club))
                ->when($request->nat, fn ($q, $nat) => $q->where('nat', $nat))


                //                ->when($request->details, fn($q, $details) => $q->where('details', $details))
                ->when($request->date_from, fn ($q, $from) => $q->whereDate('date', '>=', $from))
                ->when($request->date_to, fn ($q, $to) => $q->whereDate('date', '<=', $to))



                ->orderBy('sv_initial_results_players.total', 'desc')->get();

    }


    public function getSortedRatings()
    {
        $arr = [0 => 'الاول',
            1 => 'الثاني',
            2 => 'الثالت',
            3 => 'الرابع',
            4 => 'الخامس',
            5 => 'السادس',
            6 => 'السابع',
            7 => 'الثامن',
            8 => 'التاسع',
            9 => 'العاشر',
            10 => 'الاحدي عشر',
            11 => 'الثاني عشر',
            12 => 'الثالت عشر',
            13 => 'الرابع عشر',
            14 => 'الخامس عشر',
            15 => 'السادس عشر',
        ];

        return $arr;
    }


    public function updateSecondTotalOfResultPlayer($id, $val)
    {
        return SVFianlResultsPlayer::where('id', $id)->update(['second_total' => $val]);

    }


    public function deleteReport($id)
    {
        $report = SVFianlResults::with('finalPlayers')->find($id);
        if ($report) {
            if (count($report->finalPlayers))
                $report->finalPlayers()->delete();
            $this->deleteImage($report, 'file');
            $report->delete();
            return true;
        }
        return false;
    }
}

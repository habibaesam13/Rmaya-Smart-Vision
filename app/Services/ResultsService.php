<?php

namespace App\Services;


use Mpdf\Image\Svg;
use App\Models\Sv_report;
use Illuminate\Http\Request;
use App\Models\SV_initial_results;
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
    public function __construct()
    {
        //
    }
    public function createReport($data)
    {

        return DB::transaction(function () use ($data) {

            $report = SV_initial_results::create($data);


            foreach ($data['checkedMembers'] as $mid) {
                $report->players_results()->create([
                    'player_id' => $mid,
                    'goal'      => 0,
                    'total'     => 0,
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
            return ($v === '' || is_null($v)) ? 0 : $v;
        })->toArray();

        $report->players_results()
            ->where('id', $playerId)
            ->update([
                'goal'   => $cleanedValues['goal'] ?? 0,
                'R1'     => $cleanedValues['R1'] ?? 0,
                'R2'     => $cleanedValues['R2'] ?? 0,
                'R3'     => $cleanedValues['R3'] ?? 0,
                'R4'     => $cleanedValues['R4'] ?? 0,
                'R5'     => $cleanedValues['R5'] ?? 0,
                'R6'     => $cleanedValues['R6'] ?? 0,
                'R7'     => $cleanedValues['R7'] ?? 0,
                'R8'     => $cleanedValues['R8'] ?? 0,
                'R9'     => $cleanedValues['R9'] ?? 0,
                'R10'    => $cleanedValues['R10'] ?? 0,
                'total'  => $cleanedValues['total'] ?? 0,
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


    public function getReportsDetails(Request $request)
    {
        return SV_initial_results::query()->where('confirmed',true)
            ->when($request->weapon_id, fn($q, $weapon) => $q->where('weapon_id', $weapon))
            ->when($request->details, fn($q, $details) => $q->where('details', $details))
            ->when($request->date_from, fn($q, $from) => $q->whereDate('date', '>=', $from))
            ->when($request->date_to, fn($q, $to) => $q->whereDate('date', '<=', $to))
            ->orderBy('Rid')
            ->cursorPaginate(config('app.admin_pagination_number'));
    }
}

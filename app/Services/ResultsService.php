<?php

namespace App\Services;


use Mpdf\Image\Svg;
use App\Models\Sv_report;
use Illuminate\Http\Request;
use App\Models\SV_initial_results;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\sv_initial_results_players;

class ResultsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createReport($data, $reports = [])
    {
        return DB::transaction(function () use ($data) {

            $report = SV_initial_results::create($data);


            foreach ($data['checkedreports'] as $mid) {
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
        $reports = sv_initial_results_players::where('Rid', $reportId)->get();
        return $reports;
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
            if ($report->attached_file && Storage::disk('public')->exists($report->attached_file)) {
                Storage::disk('public')->delete($report->attached_file);
            }

            $path = $request->file('attached_file')->store('reports_attachments', 'public');
            $report->update(['attached_file' => $path]);
        }
        foreach ($playersData as $playerId => $values) {
            $report->players_results()
                ->where('id', $playerId)
                ->update([
                    'goal'   => $values['goal'] ?? 0,
                    'R1'     => $values['R1'] ?? 0,
                    'R2'     => $values['R2'] ?? 0,
                    'R3'     => $values['R3'] ?? 0,
                    'R4'     => $values['R4'] ?? 0,
                    'R5'     => $values['R5'] ?? 0,
                    'R6'     => $values['R6'] ?? 0,
                    'R7'     => $values['R7'] ?? 0,
                    'R8'     => $values['R8'] ?? 0,
                    'R9'     => $values['R9'] ?? 0,
                    'R10'    => $values['R10'] ?? 0,
                    'total'  => $values['total'] ?? 0,
                    'notes'  => $values['notes'] ?? null,
                ]);
        }
        return $report;
    }
}

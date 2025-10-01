<?php

namespace App\Services;


use Mpdf\Image\Svg;
use App\Models\Sv_member;
use App\Models\sv_initial_results_players;
use App\Models\SV_initial_results;
use Illuminate\Support\Facades\DB;

class ResultsService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function createReport($data, $members = [])
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
    public function getReportDetails($reportId){
        $members= sv_initial_results_players::where('Rid',$reportId)->get();
        return $members;
    }
    public function getReport($rid){
        return SV_initial_results::where('Rid',$rid)->first();
    }
}

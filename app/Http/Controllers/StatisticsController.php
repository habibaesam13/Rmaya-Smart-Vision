<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Illuminate\Database\Query\distinct;

class StatisticsController extends Controller
{
    public function index()
    {
        $generalReportForClubsAndWeapons = DB::table('sv_clubs')
            ->join('sv_clubs_weapons', 'sv_clubs_weapons.cid', 'sv_clubs.cid')
            ->join('sv_weapons', 'sv_weapons.wid', 'sv_clubs_weapons.wid')
            ->join('sv_members', function ($join) {
                $join->on('sv_members.club_id', '=', 'sv_clubs.cid')
                    ->on('sv_members.weapon_id', '=', 'sv_weapons.wid');
            })
            ->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->select(
                'sv_clubs.cid as club_id',
                'sv_clubs.name as club_name',
                DB::raw("ANY_VALUE(  sv_weapons.wid) as weapon_id"),
                DB::raw("ANY_VALUE(  sv_weapons.name) as weapon_name"),
                DB::raw("COUNT(DISTINCT  sv_clubs.cid) as clubs_count"),
                DB::raw("COUNT(DISTINCT  sv_members.mid) as all_members_count"),
                DB::raw("COUNT(DISTINCT  CASE WHEN sv_members.active = 1 THEN  sv_members.mid  END)  as active_members_count"),
                DB::raw("COUNT(  CASE WHEN (sv_initial_results_players.total > -1 && sv_members.active = 1 )  THEN  sv_members.mid  END)  as qualified"),
                DB::raw("GROUP_CONCAT(DISTINCT sv_members.mid ORDER BY sv_members.mid SEPARATOR ', ') as all_member_name")

            )
            ->groupBy('sv_clubs.cid', 'sv_clubs.name' , 'sv_weapons.wid')
            ->get();
//        ->groupBy('club_name');
//        dd($generalReportForClubsAndWeapons);
          return view('statistics', compact('generalReportForClubsAndWeapons' ));
    }

}

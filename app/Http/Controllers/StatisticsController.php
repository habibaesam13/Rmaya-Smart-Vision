<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $clubs = Sv_clubs::select('cid' , 'name')->get();
        $generalReportForClubsAndWeapons = DB::table('sv_clubs')
            ->join('sv_clubs_weapons', 'sv_clubs_weapons.cid', 'sv_clubs.cid')
            ->join('sv_weapons', 'sv_weapons.wid', 'sv_clubs_weapons.wid')
            ->join('sv_members', function ($join) {
                $join->on('sv_members.club_id', '=', 'sv_clubs.cid')
                    ->on('sv_members.weapon_id', '=', 'sv_weapons.wid');
            })
//            ->join('sv_fianl_results_players' , 'sv_fianl_results_players.player_id' , '=' , 'sv_members.mid' )
//            ->join('sv_fianl_results' ,'sv_fianl_results.id' , '=' , 'sv_fianl_results_players.Rid' )
            ->join('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->join('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->select(
                'sv_clubs.cid',
                'sv_weapons.wid',

                'sv_clubs.name as club_name',
                'sv_weapons.name as weapon_name',
                "sv_initial_results_players.id  as pid",

//                DB::raw("COUNT(sv_members.name) as all_member_name"),
//                DB::raw("COUNT(CASE WHEN sv_members.active = 1 THEN  sv_members.name  END)  as active_member_name"),
//                DB::raw(" count(sv_members.name)  as all_member_name"),
                DB::raw("sv_members.name  as all_member_name"),
                DB::raw(" CASE WHEN sv_members.active = 1 THEN  sv_members.name  END   as active_member_name"),
            )
//            ->groupBy('sv_clubs.cid')
//             ->groupBy( 'sv_weapons.name' , 'sv_clubs.name')
            ->get();
          return view('statistics', compact('generalReportForClubsAndWeapons' , 'clubs'));
    }

}

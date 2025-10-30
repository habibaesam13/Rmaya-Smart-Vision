<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use App\Models\Sv_member;
use App\Models\Sv_weapons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Illuminate\Database\Query\distinct;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        /*******************************first section****************************/
        $generalReportForClubsAndWeapons = DB::table('sv_clubs')
            ->leftjoin('sv_clubs_weapons', 'sv_clubs_weapons.cid', 'sv_clubs.cid')
            ->leftjoin('sv_weapons', 'sv_weapons.wid', 'sv_clubs_weapons.wid')
            ->leftjoin('sv_members', function ($join) {
                $join->on('sv_members.club_id', '=', 'sv_clubs.cid')
                    ->on('sv_members.weapon_id', '=', 'sv_weapons.wid');
            })
            ->leftjoin('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->leftjoin('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->groupBy('sv_clubs.cid', 'sv_clubs.name', 'sv_weapons.wid')
            ->select(
                'sv_clubs.cid as club_id',
                'sv_clubs.name as club_name',
                DB::raw("ANY_VALUE(  sv_weapons.wid) as weapon_id"),
                DB::raw("ANY_VALUE(  sv_weapons.name) as weapon_name"),
                DB::raw("COUNT(DISTINCT  sv_clubs.cid) as clubs_count"),
                DB::raw("COUNT(DISTINCT  sv_members.mid) as all_members_count"),
                DB::raw("COUNT(DISTINCT  CASE WHEN sv_members.active = 1 THEN  sv_members.mid  END)  as active_members_count"),
                DB::raw("COUNT( DISTINCT CASE WHEN (sv_initial_results_players.total > -1 && sv_members.active = 1 )  THEN  sv_members.mid  END)  as qualified"),
                DB::raw("GROUP_CONCAT(DISTINCT sv_members.mid ORDER BY sv_members.mid SEPARATOR ', ') as all_member_name")

            )
            ->get();
//        ->groupBy('club_name');
//        dd($generalReportForClubsAndWeapons);
        /******************************end first section*****************************/


        /**************************second section*********************************/
//        $allCometetionsWithAllClubs = DB::table('sv_members')
//            ->rightJoin('sv_clubs', 'sv_clubs.cid', '=', 'sv_members.club_id')
//            ->leftJoin('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
//            ->select(
//                DB::raw("ANY_VALUE(sv_clubs.name ) as   club_name"),
//                DB::raw("COUNT(DISTINCT  sv_members.mid) as all_members_count"),
//                DB::raw("COUNT(DISTINCT  CASE WHEN sv_members.active = 1 THEN  sv_members.mid  END)  as active_members_count"),
//                DB::raw("COUNT(  CASE WHEN (sv_initial_results_players.total > -1 && sv_members.active = 1 )  THEN  sv_members.mid  END)  as qualified")
//            )
//            ->groupBy('sv_clubs.cid', 'sv_clubs.name')
//            ->get();
//

        $allCometetionsWithAllClubs = DB::table('sv_clubs')
            ->leftjoin('sv_members', 'sv_members.club_id', '=', 'sv_clubs.cid')
            ->leftjoin('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->groupBy('sv_clubs.cid', 'sv_clubs.name')
            ->select(
                DB::raw("ANY_VALUE(sv_clubs.name ) as   club_name"),
                DB::raw("COUNT(DISTINCT  sv_members.mid) as all_members_count"),
                DB::raw("COUNT(DISTINCT  CASE WHEN sv_members.active = 1 THEN  sv_members.mid  END)  as active_members_count"),
                DB::raw("COUNT(DISTINCT  CASE WHEN (sv_initial_results_players.total > -1 && sv_members.active = 1 )  THEN  sv_members.mid  END)  as qualified")
            )
            ->get();


        /*****************************end second section******************************/


        /**************************third section*********************************/
        /******************with age choices********************/
        $teams = DB::table('sv_weapons')
            ->leftJoin('sv_teams', 'sv_teams.weapon_id', '=', 'sv_weapons.wid')
            ->leftjoin('sv_members', 'sv_members.team_id', '=', 'sv_teams.tid')
            ->join('sv_clubs_weapons', 'sv_clubs_weapons.wid', '=', 'sv_weapons.wid')
            ->groupBy('sv_weapons.wid', 'sv_weapons.name')
            ->whereRaw('sv_weapons.wid   IN       (11,12,13,14)')
            ->select(
                DB::raw('ANY_VALUE(   sv_teams.tid) as teams_id'),
                'sv_weapons.name as weapon_name',
                'sv_weapons.wid as weapon_wid',

                DB::raw('ANY_VALUE(sv_clubs_weapons.age_from) as age_from'),
                DB::raw('ANY_VALUE(sv_clubs_weapons.age_to) as age_to'),
                DB::raw('COUNT(DISTINCT  sv_teams.tid) as teams_count'),
                DB::raw('COUNT(DISTINCT  sv_members.mid) as  members_count')
            )
            ->get();
        /***************************without age choices********************************/
        $teams_with_no_age = DB::table('sv_weapons')
            ->leftjoin('sv_teams', 'sv_teams.weapon_id', '=', 'sv_weapons.wid')
            ->leftjoin('sv_members', 'sv_members.team_id', '=', 'sv_teams.tid')
            ->whereRaw('sv_weapons.wid   IN       (15,16,17,18)')
            ->groupBy('sv_weapons.wid', 'sv_weapons.name')
            ->select(
                DB::raw('COUNT(sv_members.mid) as members_count'),
                DB::raw('COUNT(sv_teams.tid) as teams_count'),
                'sv_weapons.name as weapon_name'
            )
            ->get();
        /**************************end third section*********************************/


        /**************************fourth section*********************************/
        $groups = DB::table('member_groups')
            ->leftJoin('sv_members', 'sv_members.mgid', '=', 'member_groups.mgid')
            ->leftJoin('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
            ->leftJoin('sv_initial_results', 'sv_initial_results.Rid', '=', 'sv_initial_results_players.Rid')
            ->groupBy('member_groups.mgid', 'member_groups.name')
            ->select(
                'member_groups.mgid',
                'member_groups.name',
                DB::raw('COUNT(DISTINCT sv_members.mid) AS players_count'),
                DB::raw('COUNT(DISTINCT CASE WHEN (sv_initial_results_players.total > -1)   THEN sv_members.mid END) AS qualified_count')
            )
            ->get();

        /**************************fifth section*********************************/
        $weapons_partcicipents_for_club = collect();
        $clubs = Sv_clubs::select('cid' , 'name')->get();
        if (!empty($request->cid)) {
            $weapons_partcicipents_for_club = DB::table('sv_weapons')
                ->leftJoin('sv_clubs_weapons', 'sv_clubs_weapons.wid', '=', 'sv_weapons.wid')
                ->join('sv_clubs', 'sv_clubs.cid', '=', 'sv_clubs_weapons.cid')
                ->join('sv_members', function ($join) {
                    $join->on('sv_members.club_id', 'sv_clubs.cid');
                    $join->on('sv_members.weapon_id', 'sv_weapons.wid');
                })
                //            ->join('sv_members' , 'sv_members.club_id' , '=' , 'sv_clubs.cid')
                ->leftJoin('sv_initial_results_players', 'sv_initial_results_players.player_id', '=', 'sv_members.mid')
                ->groupBy('sv_weapons.wid', 'sv_weapons.name')
                ->where('sv_clubs_weapons.cid', (int)$request->cid)
                ->select(
                    DB::raw('ANY_VALUE(sv_weapons.name) as weapon_name'),
                    DB::raw('ANY_VALUE(sv_clubs.name) as club_name'),
                    DB::raw('COUNT(sv_members.mid) as members_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN  sv_members.gender = "male"  THEN sv_members.mid END) AS male_count'),
                    DB::raw('COUNT(DISTINCT CASE WHEN sv_members.gender = "female" THEN sv_members.mid END)  AS  female_count'),
                    DB::raw('COUNT( CASE WHEN CAST(sv_initial_results_players.total AS SIGNED) >= sv_clubs_weapons.success_degree  THEN sv_members.mid END) AS qualified_count')
                )
                ->DISTINCT()
                ->get();
        }
        return view('statistics', compact('generalReportForClubsAndWeapons', 'allCometetionsWithAllClubs', 'teams', 'teams_with_no_age', 'groups', 'weapons_partcicipents_for_club' , 'clubs'));
    }

}

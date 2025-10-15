<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use App\Models\Sv_weapons;
use App\Models\SVFianlResultsPlayer;
use App\Services\FinalResultsService;
use App\Services\WeaponService;
use Illuminate\Http\Request;
use App\Services\ClubService;
use Illuminate\Support\Facades\DB;

class FinalResultReportController extends Controller
{
    protected $clubsService;
    protected $weaponsService;
    protected $finalResultsService;

    public function __construct(ClubService $clubService, WeaponService $weaponsService, FinalResultsService $finalResultsService)
    {
        $this->clubsService = $clubService;
        $this->weaponsService = $weaponsService;
        $this->finalResultsService = $finalResultsService;
    }

    public function index(Request $request)
    {
         $clubs = $this->clubsService->getAllClubs();
        $weapons = null;
        if(  !empty($request->weapon_id)  ) {
            $res = $this->finalResultsService->getReportsPlayersDetails($request);
        }else{
            $res = collect();
        }
        $sortedRatings =  $this->finalResultsService->getSortedRatings();
         return view('personalReports/final_results/final_report', compact('res', 'clubs' , 'sortedRatings'));
    }





    public function getWeaponsByClub(Request $request, $clubId)
    {
        $weapons = DB::table('sv_weapons')->join('sv_clubs_weapons', 'sv_clubs_weapons.wid', '=', 'sv_weapons.wid')->whereRaw('sv_clubs_weapons.cid = ?', [$clubId])->get();
        return response()->json(array('weapons' => $weapons), 200);
    }

    public function updateSecondTotal($id , Request $request )
    {
       $m = $this->finalResultsService->updateSecondTotalOfResultPlayer($id , $request->second_total);
         return redirect()->back();
    }
}

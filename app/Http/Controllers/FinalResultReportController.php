<?php

namespace App\Http\Controllers;

use App\Models\Sv_clubs;
use App\Models\Sv_weapons;
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
        $res = $this->finalResultsService->getReportsDetails($request);
        return view('personalReports/final_results/final_report', compact('res' , 'clubs'));
    }

    public function getWeaponsByClub(Request $request , $clubId)
    {
//        $weapons = Sv_weapons::has( 'clubs' , function ($q)use ($clubId){
//            $q->where('cid' , $clubId);
//        } )->get();
        $weapons = DB::table('sv_weapons'    ) ->join('sv_clubs_weapons', 'sv_clubs_weapons.wid' , '=' , 'sv_weapons.wid')->whereRaw('sv_clubs_weapons.cid = ?' ,[$clubId] )->get();

        return response()->json(array('weapons'=> $weapons), 200);

     }
}

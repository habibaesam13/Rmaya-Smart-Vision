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
    protected  $resultService;

    public function __construct(ClubService $clubService, WeaponService $weaponsService, FinalResultsService $finalResultsService , FinalResultsService $resultService)
    {
        $this->clubsService = $clubService;
        $this->weaponsService = $weaponsService;
        $this->finalResultsService = $finalResultsService;
        $this->resultService = $resultService;
    }

    public function index(Request $request)
    {
        $clubs = $this->clubsService->getAllClubs();
        $weapons = $this->weaponsService->getAllWeapons();
        if (!empty($request->weapon_id)) {
            $res = $this->finalResultsService->getReportsPlayersDetails($request, 'yes');
            $res_without_pag = $this->finalResultsService->getReportsPlayersDetails($request, 'no');
        } else {
            $res = collect();
            $res_without_pag = collect();
        }


        $sortedRatings = $this->finalResultsService->getSortedRatings();
        return view('personalReports/final_results/final_report', compact('res', 'clubs', 'sortedRatings', 'weapons', 'res_without_pag'));
    }


    public function getWeaponsByClub(Request $request, $clubId)
    {
        $weapons = DB::table('sv_weapons')->join('sv_clubs_weapons', 'sv_clubs_weapons.wid', '=', 'sv_weapons.wid')->whereRaw('sv_clubs_weapons.cid = ?', [$clubId])->get();
        return response()->json(array('weapons' => $weapons), 200);
    }

    public function updateSecondTotal($id, Request $request)
    {
        $m = $this->finalResultsService->updateSecondTotalOfResultPlayer($id, $request->second_total);
        return redirect()->back();
    }

    /************************************start first list page**************************************************/
    public function firstList(Request $request)
    {
        $weapons = $this->weaponsService->getAllWeapons();
        $items = $this->finalResultsService->getReportsDetailsWithWeapons($request, 'yes');
        $data_without_pag = $this->finalResultsService->getReportsDetailsWithWeapons($request, 'no');

        return view('personalReports/final_results/final_list', compact('weapons', 'items', 'data_without_pag'));

    }

    /************************************************/
    public function deleteReport($id)
    {
        $action = $this->finalResultsService->deleteReport($id);
        if ($action) {
            return redirect()->back()->with('success', 'لقد تم الغاء التقرير بنجاح');
        } else {
            return redirect()->back()->with('error', 'لم تتم عملية الالغاء بنجاح حاول مرة اخري');
        }
    }

 //    public function showReportMembersByPrint($id, Request $request)
//    {
//        $members = $this->resultService->getReportDetails($id);
//        return view('personalReports/final_results/show_members_of_final_reports_print', compact('members'));
//    }

        public function showReportMembersByPrint($rid)
    {
        $report = $this->resultService->getReport($rid);
        if (!$report) {
            return redirect()->route('results-registered-members');
        }
        $members = $this->resultService->getReportDetails($rid);
        $confirmed = $report->confirmed;
        return view('personalReports.final_results.personal_report_members', ['report' => $report, 'members' => $members, 'confirmed' => $confirmed]);
    }





     public function getResportsAll(Request $request)
    {
        session()->forget('absents');
        $weapons = $this->weaponsService->getAllPersonalWeapons();
        $ReportsDetails = $this->resultService->getReportsDetails($request);
        return view('personalReports/final_results/preliminary_results_reports_clubs_details', compact('ReportsDetails', 'weapons'));
    }

}

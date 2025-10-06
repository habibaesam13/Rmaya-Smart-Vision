<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveMembersReportRequest;
use App\Models\Sv_member;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\ResultsService;
use App\Services\PersonalService;
use App\Services\CountriesService;
use App\Http\Requests\StoreReportForMembers;

class ResultsController extends Controller
{
    protected PersonalService $personalService;
    protected CountriesService $countryService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    protected ResultsService $resultService;
    public function __construct(PersonalService $personal_service, CountriesService $countryService, WeaponService $weaponService, ClubService $clubService, ResultsService $resultService)
    {
        $this->personalService = $personal_service;
        $this->countryService = $countryService;
        $this->weaponService = $weaponService;
        $this->clubService = $clubService;
        $this->resultService = $resultService;
    }

    //functions for members index page to generate the report
    public function index(Request $request)
    {
        $Edit_report = null;
        if ($request->filled('addMembertoReportRid')) {
            $Edit_report = $this->resultService->getReport($request->addMembertoReportRid);
            $available_players = $this->resultService->getAvailablePlayers($Edit_report);
            $reportSection = true;
        } else {
            $available_players = $this->resultService->GetAllAvailablePlayers($request);
            $reportSection = false;
        }

        $memberGroups = $this->personalService->get_members_data()['Membergroups'];
        $countries = $this->personalService->get_members_data()['countries'];
        $clubs = $this->personalService->get_members_data()['clubs'];
        $weapons = $this->personalService->get_members_data()['weapons'];
        $membersCount = Sv_member::where('reg_type', 'personal')->count();
        $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->orderBy('mid')->cursorPaginate(config('app.admin_pagination_number'));
        $reportSection = true;

        return view('members.index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members', 'membersCount', 'reportSection', 'Edit_report', 'available_players'));
    }
    public function store(StoreReportForMembers $request)
    {
        $data = $request->validated();
        $data['weapon_id'] = $request->getWeaponId();
        $report = $this->resultService->createReport($data);
        $members = $this->resultService->getReportDetails($report->Rid);

        if ($report) {
            return view('personalReports.personal_report_members', ['members' => $members, 'report' => $report, 'confirmed' => false]);
        }

        return redirect()->back()->with('error', 'حدث خطأ أثناء الانشاء');
    }

    //functions for members for specific report
    public function show($rid)
    {
        $report = $this->resultService->getReport($rid);
        if (!$report) {
            return redirect()->route('results-registered-members');
        }
        $members = $this->resultService->getReportDetails($rid);
        $confirmed = $report->confirmed;
        return view('personalReports.personal_report_members', ['report' => $report, 'members' => $members, 'confirmed' => $confirmed]);
    }
    public function confirmReport($rid)
    {
        $confirmed = $this->resultService->confirmReport($rid);
        if ($confirmed) {
            return redirect()
                ->route('report-members', $rid)
                ->with(['success' => 'تم تأكيد التقرير']);
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء التأكيد');
    }

    public function deletePlayerFromReport($rid, $player_id)
    {
        $player = $this->resultService->deleteplayerFromReport($player_id);

        if ($player) {
            return redirect()->route('report-members', $rid)->with(['success' => 'تم حذف الرامي بنجاح']);
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء حذف الرامي');
    }

    public function saveReport(Request $request, $rid)
    {
        if ($request->has('players_data')) {
            $playersData = json_decode($request->input('players_data'), true);

            if (!$playersData) {
                return back()->withErrors(['players_data' => 'Invalid players data format']);
            }

            $report = $this->resultService->saveReport($request, $playersData, $rid);

            if ($report) {
                return redirect()->back()->with('success', 'تم حفظ التقرير بنجاح');
            }

            return redirect()->back()->with('error', 'حدث خطأ أثناء الحفظ');
        }
        return redirect()->route('report-members', $rid)
            ->with('info', 'تم الرجوع إلى التقرير.');
    }


    public function calculateTotal(Request $request)
    {
        try {
            $scores = $request->input('scores', []);
            $total = array_sum($scores);

            return response()->json(['total' => $total]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function addPlayer($rid)
    {

        return redirect()->route('results-registered-members', ['addMembertoReportRid' => $rid]);
    }
    public function updateReport(StoreReportForMembers $request, $rid)
    {
        $report = $this->resultService->getReport($rid);

        if (!$report) {
            return redirect()->back()->with('error', 'لم يتم العثور على التقرير');
        }
        $validated = $request->validated();
        foreach ($validated['checkedMembers'] as $mid) {
            $report->players_results()->create([
                'player_id' => $mid,
                'goal'      => 0,
                'total'     => 0,
                'notes'     => null,
            ]);
        }
        return redirect()
            ->route('report-members', $report->Rid)
            ->with('success', 'تم تحديث بيانات التقرير بنجاح');
    }

    /**Preliminary results reports - clubs - details */
    public function getResportsDetails(Request $request){
        $weapons=$this->weaponService->getAllWeapons();
        $ReportsDetails=$this->resultService->getReportsDetails($request);
        return view('personalReports.preliminary_results_reports_clubs_details',compact('ReportsDetails','weapons'));
    }
}

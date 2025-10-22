<?php

namespace App\Http\Controllers;

use App\Http\Requests\FinalResultStoreReportForMembers;
use App\Http\Requests\StoreReportForMembers;
use App\Models\SiteSettings;
use App\Models\Sv_member;
use App\Models\SVFianlResults;
use App\Services\ClubService;
use App\Services\CountriesService;
use App\Services\FinalResultsService;
use App\Services\PersonalService;
use App\Services\ResultsService;
use App\Services\WeaponService;
use Illuminate\Http\Request;


class FinalResultsController extends Controller
{
    protected PersonalService $personalService;
    protected CountriesService $countryService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    protected FinalResultsService $resultService;

    public function __construct(PersonalService $personal_service, CountriesService $countryService, WeaponService $weaponService, ClubService $clubService, FinalResultsService $resultService)
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
        $validated = $request->validate(
            [
                'date_from' => ['nullable', 'date'],
                'date_to' => ['nullable', 'date', 'after_or_equal:date_from'],
            ],
            [
                'date_from.date' => 'تاريخ البداية يجب أن يكون تاريخاً صالحاً.',
                'date_to.date' => 'تاريخ النهاية يجب أن يكون تاريخاً صالحاً.',
                'date_to.after_or_equal' => 'يجب أن يكون تاريخ النهاية بعد أو يساوي تاريخ البداية.',
            ]
        );
        $Edit_report = null;

        if ($request->filled('addMembertoReportRid')) {
            $Edit_report = SVFianlResults::find($request->addMembertoReportRid);
            $available_players = $this->resultService->getAvailablePlayers($Edit_report, $request);
            $reportSection = true;
            $allavailable_players = collect();
            $count = 0;
        } else {
            $available_players = $this->resultService->getConfirmedPlayers($request, 'yes');
            $allavailable_players = $this->resultService->getConfirmedPlayers($request, 'no');
            $count = count($allavailable_players);
            $reportSection = false;
        }

        if (empty($request->weapon_id) && !$request->filled('addMembertoReportRid')) {
            $available_players = collect();
            $allavailable_players = collect();
        }

        $memberGroups = $this->personalService->get_members_data()['Membergroups'];
        $countries = $this->personalService->get_members_data()['countries'];
        $clubs = $this->personalService->get_members_data()['clubs'];
        $weapons = $this->personalService->get_members_data()['weapons'];
//        $membersCount = Sv_member::where('reg_type', 'personal')->count();
        $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality', 'sv_final_results'])->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn ($q) => $q->filter($request)
            )
            ->orderBy('mid', 'desc')->cursorPaginate(config('app.admin_pagination_number'));
        $reportSection = true;
        request()->session()->forget('absents');
        $arranging_arr = ['' => '', 0 => 'الاول', 1 => 'الثاني', 2 => 'الثالت', 3 => 'الرابع', 4 => 'الخامس', 5 => 'الاول', 6 => 'السادس', 7 => 'السابع', 8 => 'الثامن', 9 => 'التاسع', 10 => 'العاشر', 11 => 'الاحدي عشر', 12 => 'الاثنا عشر', 13 => 'الثالث عشر'];
        return view('personalReports/final_results/index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members', 'reportSection', 'Edit_report', 'available_players', 'arranging_arr', 'allavailable_players', 'count'));
    }

//    public function store(StoreReportForMembers $request)
    public function store(FinalResultStoreReportForMembers $request)
    {
        $data = $request->validated();
        $data['weapon_id'] = $request->getWeaponId();
        $report = $this->resultService->createReport($data);
        $members = $this->resultService->getReportDetails($report->id);

        if ($report) {
            return view('personalReports/final_results/personal_report_members', ['members' => $members, 'report' => $report, 'confirmed' => false]);
        }
        return redirect()->back()->with('error', 'حدث خطأ أثناء الانشاء');
    }

    //functions for members for specific report
    public function show($rid)
    {
        $report = $this->resultService->getReport($rid);
        if (!$report) {
            return redirect()->back();
//            return redirect()->route('results-registered-members');
        }
        $members = $this->resultService->getReportDetails($rid);
        $confirmed = $report->confirmed;
        return view('personalReports.final_results.personal_report_members', ['report' => $report, 'members' => $members, 'confirmed' => $confirmed]);
    }

    public function confirmReport($rid)
    {
        $confirmed = $this->resultService->confirmReport($rid);
        if ($confirmed) {
            return redirect()
                ->route('report-members_final', $rid)
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
                return redirect()->route('report-members_final', $rid)->with('success', 'تم حفظ التقرير بنجاح');
            }

            return redirect()->back()->with('error', 'حدث خطأ أثناء الحفظ');
        }
        return redirect()->route('report-members_final', $rid)
            ->with('info', 'تم الرجوع إلى التقرير.');

//        return redirect()->route('report-members_final', $rid)
//            ->with('info', 'تم الرجوع إلى التقرير.');
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
        if (request()->session()->get('absents') && request()->session()->get('absents') === 'yes') {
            return redirect()->route('final_results.absents.reports', ['addMembertoReportRid' => $rid]);
        }
        return redirect()->route('results-registered-members_final', ['addMembertoReportRid' => $rid]);
    }

    public function updateReport(FinalResultStoreReportForMembers $request, $rid)
    {
        $report = $this->resultService->getReport($rid);

        if (!$report) {
            return redirect()->back()->with('error', 'لم يتم العثور على التقرير');
        }
        $validated = $request->validated();
        foreach ($validated['checkedMembers'] as $mid) {
            $report->players_results()->create([
                'player_id' => $mid,
                'goal' => 0,
                'total' => 0,
                'notes' => null,
            ]);
        }
//          dd($report);
        return redirect()
            ->route('report-members_final', $report->id)
            ->with('success', 'تم تحديث بيانات التقرير بنجاح');
    }

    /**Preliminary results reports - clubs - details */
    public function getResportsDetails(Request $request)
    {
        $weapons = $this->weaponService->getAllWeapons();
        $ReportsDetails = $this->resultService->getReportsDetails($request);
        return view('personalReports.preliminary_results_reports_clubs_details', compact('ReportsDetails', 'weapons'));
    }


    public function printData($rid)
    {
        $report = $this->resultService->getReport($rid);
//        dd($report);
        if (!$report) {
            return redirect()->route('results-registered-members_final');
        }
        $siteSettings = SiteSettings::first();
        $members = $this->resultService->getReportDetails($rid);
        return view('personalReports.print', ['report' => $report, 'members' => $members, 'siteSettings' => $siteSettings]);
    }

}

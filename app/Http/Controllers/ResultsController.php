<?php

namespace App\Http\Controllers;

use App\Models\Sv_member;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\ResultsService;
use App\Services\PersonalService;
use App\Services\CountriesService;
use App\Http\Requests\StoreReportForMembers;
use App\Http\Requests\SaveMembersReportRequest;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $validated = $request->validate(
            [
                'date_from' => ['nullable', 'date'],
                'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
            ],
            [
                'date_from.date'        => 'تاريخ البداية يجب أن يكون تاريخاً صالحاً.',
                'date_to.date'          => 'تاريخ النهاية يجب أن يكون تاريخاً صالحاً.',
                'date_to.after_or_equal' => 'يجب أن يكون تاريخ النهاية بعد أو يساوي تاريخ البداية.',
            ]
        );
        $Edit_report = null;
        if ($request->filled('addMembertoReportRid')) {
            $Edit_report = $this->resultService->getReport($request->addMembertoReportRid);
            $available_players = $this->resultService->getAvailablePlayers($Edit_report);
            $reportSection = true;
        } else {
            $available_players_without_pag = $this->resultService->GetAllAvailablePlayers($request, 0);
            $available_players = $this->resultService->GetAllAvailablePlayers($request, 1);
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

        return view('members.index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members', 'membersCount', 'reportSection', 'Edit_report', 'available_players', 'available_players_without_pag'));
    }
    public function store(StoreReportForMembers $request)
    {

        $data = $request->validated();
        $data['weapon_id'] = $request->getWeaponId();
        $report = $this->resultService->createReport($data);
        $members = $this->resultService->getReportDetails($report->Rid);

        if ($report) {
            return view('personalReports/initial_results/personal_report_members', ['members' => $members, 'report' => $report, 'confirmed' => false]);
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
        return view('personalReports/initial_results/personal_report_members', ['report' => $report, 'members' => $members, 'confirmed' => $confirmed]);
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
                return redirect()->route('report-members', $rid)->with('success', 'تم حفظ التقرير بنجاح');
            }

            return redirect()->back()->with('error', 'حدث خطأ أثناء الحفظ');
        }
        return redirect()->route('report-members', $rid)
            ->with('info', 'تم الرجوع إلى التقرير.');
    }


    public function calculateTotal(Request $request)
    {
        try {
            // Get scores and replace null or empty values with 0
            $scores = $request->input('scores', []);
            $scores = array_map(function ($value) {
                return is_numeric($value) ? (int)$value : 0;
            }, $scores);

            // Calculate total safely
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
                'notes'     => null,
            ]);
        }
        return redirect()
            ->route('report-members', $report->Rid)
            ->with('success', 'تم تحديث بيانات التقرير بنجاح');
    }

    /**Preliminary results reports - clubs - details */
    public function getResportsDetails(Request $request)
    {
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $ReportsDetails = $this->resultService->getReportsDetails($request, 1);
        return view('personalReports/initial_results/preliminary_results_reports_clubs_details', compact('ReportsDetails', 'weapons'));
    }

    public function getResportsDetails_print(Request $request)
    {
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $ReportsDetails_without_pag = $this->resultService->getReportsDetails($request, 0);
        return view('personalReports/initial_results/preliminary_results_reports_clubs_details_print', compact('weapons', 'ReportsDetails_without_pag'));
    }
    //search initial results reports  {{البحث فى النتائج الأولية اليومية}}
    public function searchInitialResultsReports(Request $request)
    {
        $results = $this->resultService->searchInitialResultsReports($request);


        if (empty($results)) {
            $results = new LengthAwarePaginator([], 0, config('app.admin_pagination_number'));
        }

        return view('personalReports.initial_results.search_reports', compact('results'));
    }

    //قائمة النتائج الاولية
    public function listOfInitialResults()
    {

        $clubs = $this->clubService->getAllClubs();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $results = false;
        $results_without_pag = collect();
        return view('personalReports.initial_results.list_of_initial_results_reports', compact('results', 'weapons', 'clubs', 'results_without_pag'));
    }
    public function searchInListOfInitialResults(Request $request)
    {
        $clubs = $this->clubService->getAllClubs();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $results = $this->resultService->listOfInitialResults($request, 1);
        $results_without_pag = $this->resultService->listOfInitialResults($request, 0);
        if ($results === 'required') {
            return redirect()->back()->withErrors(['weapon' => 'السلاح مطلوب']);
        }

        if ($results === 'not_found') {
            return redirect()->back()->withErrors(['weapon' => 'السلاح غير موجود']);
        }

        // If empty array, make a dummy paginator
        if ($results instanceof \Illuminate\Support\Collection && $results->isEmpty()) {
            $results = new \Illuminate\Pagination\LengthAwarePaginator([], 0, config('app.admin_pagination_number'));
        }

        return view('personalReports.initial_results.list_of_initial_results_reports', compact('results', 'weapons', 'clubs', 'results_without_pag'));
    }
    public function updateTotalForPlayer(Request $request, $player_id)
    {
        $player = $this->resultService->getPlayerByRowId($player_id);
        if (!$player) {
            return redirect()->back()->with('error', 'الرامي غير موجود');
        }
        $total = $request->validate(
            [
                'total' => 'integer|min:0|max:100',
            ],
            [
                'total.min' => 'لا يجب ان يقل المجموع عن 0',
                'total.max' => 'لا يجب ان يزيد المجموع عن 100',
                'total.integer' => 'يجب ان يكون المجموع رقم',
            ]
        );

        $player = $this->resultService->updateTotalForPlayer($player, $total);
        return redirect()->back()->with('success', 'تم تحديث بيانات الرامي بنجاح');
    }


    //قائمة الافراد المتغيبين فى النتائج الاولية
    public function IndividualsAbsentPreliminaryResults(Request $request)
    {
        $absentPlayers = false;
        $clubs = $this->clubService->getAllClubs();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $countries = $this->countryService->getAllCountries();
        $absentPlayers_without_pag = $this->resultService->getAbsentPlayersInitialResults($request, 0);
        if (!is_array($absentPlayers_without_pag) && !$absentPlayers_without_pag instanceof \Illuminate\Support\Collection) {
            $absentPlayers_without_pag = collect();
        }

        return view('personalReports.initial_results.absentPlayers', compact(['absentPlayers', 'clubs', 'weapons', 'countries', 'absentPlayers_without_pag']));
    }
    public function searchIndividualsAbsentInitialResults(Request $request)
    {
        $clubs = $this->clubService->getAllClubs();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $countries = $this->countryService->getAllCountries();
        $absentPlayers = $this->resultService->getAbsentPlayersInitialResults($request, 1);
        $absentPlayers_without_pag = $this->resultService->getAbsentPlayersInitialResults($request, 0);
        if ($absentPlayers === 'required') {
            return redirect()->back()->withErrors(['weapon' => 'السلاح مطلوب']);
        }

        if ($absentPlayers === 'not_found') {
            return redirect()->back()->withErrors(['weapon' => 'السلاح غير موجود']);
        }

        // If empty array, make a dummy paginator
        if ($absentPlayers instanceof \Illuminate\Support\Collection && $absentPlayers->isEmpty()) {
            $results = new \Illuminate\Pagination\LengthAwarePaginator([], 0, config('app.admin_pagination_number'));
        }
        if (!is_array($absentPlayers_without_pag) && !$absentPlayers_without_pag instanceof \Illuminate\Support\Collection) {
            $absentPlayers_without_pag = collect();
        }

        return view('personalReports.initial_results.absentPlayers', compact(['absentPlayers', 'clubs', 'weapons', 'countries', 'absentPlayers_without_pag']));
    }




}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReportForMembers;
use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\PersonalService;
use App\Services\CountriesService;
use App\Models\Sv_member;
use App\Services\ResultsService;

class ResultsCotroller extends Controller
{
    protected PersonalService $personalService;
    protected CountriesService $countryService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    protected ResultsService $resultService;
    public function __construct(PersonalService $personal_service,CountriesService $countryService,WeaponService $weaponService,ClubService $clubService,ResultsService $resultService)
    {
        $this->personalService = $personal_service;
        $this->countryService=$countryService;
        $this->weaponService=$weaponService;
        $this->clubService=$clubService;
        $this->resultService=$resultService;
    }
    public function index(Request $request)
    {

        $memberGroups = $this->personalService->get_members_data()['Membergroups'];
        $countries = $this->personalService->get_members_data()['countries'];
        $clubs = $this->personalService->get_members_data()['clubs'];
        $weapons = $this->personalService->get_members_data()['weapons'];
        $membersCount=Sv_member::where('reg_type','personal')->count();
        $members =  $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])->where('reg_type', 'personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->orderBy('mid')->cursorPaginate(config('app.admin_pagination_number'));
        $reportSection=true;
        return view('members.index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members', 'membersCount','reportSection'));
    }
    public function store(StoreReportForMembers $request){
        $data=$request->validate();
        dd($data);
        $this->resultService->createReport();
    }
}

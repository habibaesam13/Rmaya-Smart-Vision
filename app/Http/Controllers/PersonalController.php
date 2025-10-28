<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Sv_clubs;
use App\Models\Sv_member;
use App\Models\Sv_weapons;
use App\Models\Member_group;
use Illuminate\Http\Request;
use App\Services\PersonalService;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\StorePersonalRequest;
use App\Http\Requests\PersonalUpdateRequest;
use App\Services\ClubService;
use App\Services\CountriesService;
use App\Services\WeaponService;

class PersonalController extends Controller
{
    protected PersonalService $personalService;
    protected CountriesService $countryService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    public function __construct(PersonalService $personal_service,CountriesService $countryService,WeaponService $weaponService,ClubService $clubService)
    {
        $this->personalService = $personal_service;
        $this->countryService=$countryService;
        $this->weaponService=$weaponService;
        $this->clubService=$clubService;
    }
    public function index(Request $request)
    {

        if(!checkModulePermission('members', 'view')) {   return redirect()->route('access_denied');  }
         $validated=$request->validate(
            [
                'date_from' => ['nullable', 'date'],
                'date_to'   => ['nullable', 'date', 'after_or_equal:date_from'],
            ],
            [
            'date_from.date'        => 'تاريخ البداية يجب أن يكون تاريخاً صالحاً.',
            'date_to.date'          => 'تاريخ النهاية يجب أن يكون تاريخاً صالحاً.',
            'date_to.after_or_equal'=> 'يجب أن يكون تاريخ النهاية بعد أو يساوي تاريخ البداية.',
            ]
        );
        $club_id=auth()->user()->clubid ?? null;
        $memberGroups = $this->personalService->get_members_data()['Membergroups'];
        $countries = $this->personalService->get_members_data()['countries'];
        $clubs = $this->personalService->get_members_data()['clubs'];
        $weapons = $this->personalService->get_members_data()['weapons'];

        $members_without_pag = $this->personalService->getMembers($request,0,$club_id);
        $members = $this->personalService->getMembers($request,1,$club_id);
        $membersCount=$members_without_pag->count()??0;
        $reportSection=false;
        return view('members.index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members', 'membersCount','reportSection','members_without_pag'));
    }
    public function destroy(Request $request)
    {
        if(!checkModulePermission('members', 'delete')) {   return redirect()->route('access_denied');  }
        $id = $request->input('mid');
        $this->personalService->delete($id);
        return redirect()->route('personal-registration')
            ->with('success', 'تم حذف الشخص من النادي');
    }
    public function toggleAcivationStatus(Request $request)
    {
        if(!checkModulePermission('members', 'active')) {   return redirect()->route('access_denied');  }
        $id = $request->input('mid');
        $this->personalService->toggleActivation($id);
        return redirect()->route('personal-registration')
            ->with('success', 'تم تحديث حالة الشخص');
    }

    public function edit(Request $request)
    {
        if(!checkModulePermission('members', 'edit')) {   return redirect()->route('access_denied');  }
        $countries = $this->countryService->getAllCountries();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $clubs = $this->clubService->getAllClubs();
        $memberGroups = Member_group::all();
        $id = $request->input('mid');
        $member = $this->personalService->getMemberByID($id);
        return view('members.edit', compact('countries', 'weapons', 'clubs', 'memberGroups', 'member'));
    }
    public function update(PersonalUpdateRequest $request, $mid)
    {
         if(!checkModulePermission('members', 'edit')) {   return redirect()->route('access_denied');  }
        $data = $request->validated();
        $this->personalService->updatePersonalData($data, $mid, $request);
        return redirect()->route('personal-registration')
            ->with('success', 'تم تعديل البيانات بنجاح');
    }


    public function create(){
        if(!checkModulePermission('members', 'add') and !checkModulePermission('club_panel', 'reg')  ) {   return redirect()->route('access_denied');  }
        $countries = $this->countryService->getAllCountries();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $clubs = $this->clubService->getAllClubs();
        $memberGroups = Member_group::all();
        return view('members.store',compact('countries', 'weapons', 'clubs', 'memberGroups'));
    }
    public function store(StorePersonalRequest $request){
        if(!checkModulePermission('members', 'add') and !checkModulePermission('club_panel', 'reg')  ) {   return redirect()->route('access_denied');  }
        $data=$request->validated();
        $member=$this->personalService->RegisterNewMember($data,$request);
        if (!$member){
        return redirect()->route('personal-create')->with('error','حدث خطأ أثناء التسجيل');
        }
        return redirect()->route('personal-create')->with('success','تم التسجيل بنجاح');
    }


    public function show($id)
    {
        if(!checkModulePermission('members', 'view')) {   return redirect()->route('access_denied');  }
        $countries = $this->countryService->getAllCountries();
         $memberGroups = Member_group::all();
        $member = $this->personalService->getMemberByID($id);
        return view('members.show', compact('countries',  'memberGroups', 'member'));
    }
}

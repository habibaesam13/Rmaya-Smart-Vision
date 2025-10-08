<?php

namespace App\Http\Controllers\PublicRegistration;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StorePersonalRequest;
use App\Models\Country;
use App\Models\SiteSettings;
use App\Services\ClubService;
use App\Services\CountriesService;
use App\Services\PersonalService;
use App\Services\WeaponService;
use Illuminate\Http\Request;

class PersonalRegistration extends Controller
{
    protected CountriesService $countryService;
    protected ClubService $clubService;
    protected WeaponService $weaponService;
    protected PersonalService $personalService;
    public function __construct(CountriesService $countryService,ClubService $clubService,WeaponService $weaponService,PersonalService $personalService)
    {
        $this->countryService=$countryService;
        $this->clubService=$clubService;
        $this->weaponService=$weaponService;
        $this->personalService=$personalService;
        
    }
    public function index(){
        $countries=$this->countryService->getAllCountries();
        $clubs=$this->clubService->getAllClubs();
        $weapons=$this->weaponService->getAllWeapons();
        return view('PublicRegistration.regForm',compact('countries','clubs','weapons'));
    }
    public function store(StorePersonalRequest $request){
        $data=$request->validated();
        $member=$this->personalService->RegisterNewMember($data,$request);
        if (!$member){
        return redirect()->back()->with('error','حدث خطأ أثناء التسجيل');
        }
        return redirect()->back()->with('success','تم التسجيل بنجاح');
        
    }
}

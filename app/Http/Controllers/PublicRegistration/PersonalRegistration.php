<?php

namespace App\Http\Controllers\PublicRegistration;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\SiteSettings;
use App\Services\ClubService;
use App\Services\CountriesService;
use App\Services\WeaponService;
use Illuminate\Http\Request;

class PersonalRegistration extends Controller
{
    protected CountriesService $countryService;
    protected ClubService $clubService;
    protected WeaponService $weaponService;
    public function __construct(CountriesService $countryService,ClubService $clubService,WeaponService $weaponService)
    {
        $this->countryService=$countryService;
        $this->clubService=$clubService;
        $this->weaponService=$weaponService;
        
    }
    public function index(){
        $countries=$this->countryService->getAllCountries();
        $clubs=$this->clubService->getAllClubs();
        $weapons=$this->weaponService->getAllWeapons();
        return view('PublicRegistration.regForm',compact('countries','clubs','weapons'));
    }
    public function store(){

    }
}

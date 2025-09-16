<?php

namespace App\Services;

use App\Models\Member_group;
use App\Services\ClubService;
use App\Services\WeaponService;
use App\Services\CountriesService;



class PersonalService
{
    /**
     * Create a new class instance.
     */
    protected CountriesService $countriesService;
    protected ClubService $clubsService;
    protected WeaponService $weaponsService;
    public function __construct(CountriesService $countriesService,ClubService $clubsService,WeaponService $weaponsService)
    {
        $this->countriesService=$countriesService;
        $this->clubsService=$clubsService;
        $this->weaponsService=$weaponsService;

    }
    public function get_members_data(){
        $Membergroups=Member_group::all();
        $countries=$this->countriesService->get_all_countries();
        $clubs=$this->clubsService->getAllClubs();
        $weapons=$this->weaponsService->getAllWeapons();
         return [
        'Membergroups' => $Membergroups,
        'countries' => $countries,
        'clubs'=>$clubs,
        'weapons'=>$weapons
    ];
    }
}

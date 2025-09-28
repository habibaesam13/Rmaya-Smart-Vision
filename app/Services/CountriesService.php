<?php

namespace App\Services;

use App\Models\Country;

class CountriesService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllCountries(){
        return Country::all();
    }
}

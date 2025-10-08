<?php

namespace App\Http\Controllers\PublicRegistration;

use App\Http\Controllers\Controller;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class PersonalRegistration extends Controller
{
    public function index(){
        
        return view('PublicRegistration.regForm');
    }
}

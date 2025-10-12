<?php

namespace App\Http\Controllers\PublicRegistration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupRegistration extends Controller
{
    public function index(){
        return view('PublicRegistration.GroupRegForm');
    }
}

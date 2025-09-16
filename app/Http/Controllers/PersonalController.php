<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PersonalService;


class PersonalController extends Controller
{
    protected PersonalService $personalService;
    public function __construct(PersonalService $personal_service)
    {
        $this->personalService=$personal_service;
        
    }
    public function index(){
        $memberGroups=$this->personalService->get_members_data();
        return view('members.index',compact('memberGroups'));
    }

}

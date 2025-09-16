<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sv_member;
use App\Services\PersonalService;


class PersonalController extends Controller
{
    protected PersonalService $personalService;
    public function __construct(PersonalService $personal_service)
    {
        $this->personalService=$personal_service;
        
    }
    public function index(Request $request){
        $memberGroups=$this->personalService->get_members_data()['Membergroups'];
        $countries=$this->personalService->get_members_data()['countries'];
        $clubs=$this->personalService->get_members_data()['clubs'];
        $weapons=$this->personalService->get_members_data()['weapons'];
        $members = Sv_member::with(['club', 'registrationClub', 'weapon','nationality'])->filter($request)->get();
        return view('members.index',compact('memberGroups','countries','clubs','weapons','members'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Member_group;
use App\Models\Sv_clubs;
use Illuminate\Http\Request;
use App\Models\Sv_member;
use App\Models\Sv_weapons;
use App\Services\PersonalService;
use Illuminate\Support\Facades\Redis;

class PersonalController extends Controller
{
    protected PersonalService $personalService;
    public function __construct(PersonalService $personal_service)
    {
        $this->personalService = $personal_service;
    }
    public function index(Request $request)
    {

        $memberGroups = $this->personalService->get_members_data()['Membergroups'];
        $countries = $this->personalService->get_members_data()['countries'];
        $clubs = $this->personalService->get_members_data()['clubs'];
        $weapons = $this->personalService->get_members_data()['weapons'];
        $members =  $members = Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])->where('reg_type','personal')
            ->when(
                $request->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']),
                fn($q) => $q->filter($request)
            )
            ->orderBy('mid')->cursorPaginate(1);
        return view('members.index', compact('memberGroups', 'countries', 'clubs', 'weapons', 'members'));
    }
    public function destroy(Request $request)
    {
        $id = $request->input('mid');
        $this->personalService->delete($id);
        return redirect()->route('personal-registration')
            ->with('success', 'تم حذف الشخص من النادي');
    }
    public function toggleAcivationStatus(Request $request)
    {
        $id = $request->input('mid');
        $this->personalService->toggleActivation($id);
        return redirect()->route('personal-registration')
            ->with('success', 'تم تحديث حالة الشخص');
    }



    public function edit(Request $request){
        $countries=Country::all();
        $weapons=Sv_weapons::all();
        $clubs=Sv_clubs::all();
        $memberGroups=Member_group::all();
        $id=$request->input('nid');
        return view('members.edit',compact('countries','weapons','clubs','memberGroups','id'));
    }
}

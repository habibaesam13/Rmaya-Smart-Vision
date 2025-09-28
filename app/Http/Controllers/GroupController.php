<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\GroupService;
use App\Services\WeaponService;
use App\Services\PersonalService;
use App\Http\Requests\EditGroupRequest;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Http\Requests\EditGroupMemberDataRequest;

class GroupController extends Controller
{
    protected GroupService $groupService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    protected PersonalService $personalService;
    public function __construct(GroupService $groupService, WeaponService $weaponService,ClubService $clubService,PersonalService $personalService)
    {
        $this->groupService = $groupService;
        $this->weaponService = $weaponService;
        $this->clubService=$clubService;
        $this->personalService=$personalService;
    }
    public function index()
    {
        $groups = $this->groupService->getGroups()['groups'];
        $groupsCount= $this->groupService->getGroups()['groupsCount'];
        $weapons = $this->weaponService->getAllWeapons();

        return view('groups.registered_groups', ['groups' => $groups, 'weapons' => $weapons,'groupsCount'=>$groupsCount]);
    }
    public function search(Request $request)
    {
        $groups = $this->groupService->search($request);
        $weapons = $this->weaponService->getAllWeapons();

        return view('groups.registered_groups', [
            'groups'  => $groups,
            'weapons' => $weapons
        ]);
    }
    public function delete(Request $request){
        $tid=$request->input('tid');
        $this->groupService->deleteGroup($tid);
        return redirect()->route('group-registration')
            ->with('success', 'تم حذف الفريق بنجاح ');
    }
    public function show(Request $request){
        $tid=intval($request->input('tid'));
        $group=$this->groupService->getGroupById($tid);
        $TeamMembers=$this->groupService->viewGroupMembers($tid);
        if(!$TeamMembers){
            return redirect()->route('group-registration')->with('error', '  الفريق غير مسجل');
        }
        return view('groups.group_members',compact('TeamMembers','group'));
    }
    public function edit(Request $request){
        $tid=intval($request->input('tid'));
        $clubs=$this->clubService->getAllClubs();
        $weapons=$this->weaponService->getAllWeapons();
        $group=$this->groupService->getGroupById($tid);
        return view('groups.group_edit',compact(['group','clubs','weapons']));
    }
    public function update(EditGroupRequest $request,$tid){
        $data=$request->validated();
        $group=$this->groupService->updateGroupData($data,$tid);
        if(!$group){
            return redirect()->route('group-registration')->with('error','حدث خطأ أثناء التحديث');
        }
        return redirect()->route('group-registration')->with('success','تم تحديث بيانات الفريق بنجاح');
    }

    public function getMembersWithGroups(){
        $members=$this->groupService->getMembersWithGroups();
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllWeapons();
        return view('groups.groups_members',compact(['members','groups','weapons']));
    }
    public function membersByGroupSearch(Request $request){
        $members=$this->groupService->membersByGroupSearch($request);
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllWeapons();
        return view('groups.groups_members',compact(['members','groups','weapons']));
    }

    //edit group member personal data
    public function editMemberData(Request $request){
        $mid=$request->input('mid');
        $member=$this->personalService->getMemberByID($mid);
        return view('groups.member_group_edit',compact('member'));
    }
    public function updateMemberData(EditGroupMemberDataRequest $editGroupMemberRequest,$mid){
        $data=$editGroupMemberRequest->validated();
        $this->groupService->updateMemberData($data,$mid,$editGroupMemberRequest);
        $member=$this->personalService->getMemberByID($mid);
       return redirect()->route('group-members', ['tid' => $member->team_id])
    ->with('success', 'تم تعديل البيانات بنجاح');


    }
}

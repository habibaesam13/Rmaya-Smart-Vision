<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditGroupRequest;
use App\Services\ClubService;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\WeaponService;
use Maatwebsite\Excel\Concerns\ToArray;

class GroupController extends Controller
{
    protected GroupService $groupService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    public function __construct(GroupService $groupService, WeaponService $weaponService,ClubService $clubService)
    {
        $this->groupService = $groupService;
        $this->weaponService = $weaponService;
        $this->clubService=$clubService;
    }
    public function index()
    {
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllWeapons();

        return view('groups.registered_groups', ['groups' => $groups, 'weapons' => $weapons]);
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
        $this->groupService->daleteGroup($tid);
        return redirect()->route('group-registration')
            ->with('success', 'تم حذف الفريق بنجاح ');
    }
    public function show(Request $request){
        $tid=intval($request->input('tid'));
        $groupName=$this->groupService->getGroupName($tid);
        $TeamMembers=$this->groupService->viewGroupMembers($tid);
        if(!$TeamMembers){
            return redirect()->route('group-registration')->with('error', '  الفريق غير مسجل');
        }
        return view('groups.group_members',compact('TeamMembers','groupName'));
    }
    public function edit(Request $request){
        $tid=intval($request->input('tid'));
        $clubs=$this->clubService->getAllClubs();
        $weapons=$this->weaponService->getAllWeapons();
        $group=$this->groupService->getGroupById($tid);
        return view('groups.group_edit',compact(['group','clubs','group']));
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
}

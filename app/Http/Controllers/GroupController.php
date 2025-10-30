<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClubService;
use App\Services\GroupService;
use App\Services\WeaponService;
use App\Services\PersonalService;
use App\Http\Requests\EditGroupRequest;
use Maatwebsite\Excel\Concerns\ToArray;
use App\Models\Sv_member;
use App\Http\Requests\EditGroupMemberDataRequest;
use App\Models\Sv_team;

class GroupController extends Controller
{
    protected GroupService $groupService;
    protected WeaponService $weaponService;
    protected ClubService $clubService;
    protected PersonalService $personalService;
    public function __construct(GroupService $groupService, WeaponService $weaponService, ClubService $clubService, PersonalService $personalService)
    {
        $this->groupService = $groupService;
        $this->weaponService = $weaponService;
        $this->clubService = $clubService;
        $this->personalService = $personalService;
    }
    public function index()
    {
        if (!checkModulePermission('members_groups', 'view')) {
            return redirect()->route('access_denied');
        }

        $groups_without_pag = $this->groupService->getGroups()['groups_without_pag'];

        $groups = $this->groupService->getGroups()['groups'];

        $groupsCount = $groups_without_pag->count()??0;

        $weapons = $this->weaponService->getAllGroupWeapons();
        return view('groups.registered_groups', ['groups' => $groups, 'weapons' => $weapons, 'groupsCount' => $groupsCount, 'groups_without_pag' => $groups_without_pag]);
    }
    public function search(Request $request)
    {
        $groups = $this->groupService->search($request, 1);
        $groups_without_pag = $this->groupService->search($request, 0);
        $weapons = $this->weaponService->getAllGroupWeapons();
        $groupsCount = $groups_without_pag->count()??0;
        return view('groups.registered_groups', [
            'groups'  => $groups,
            'weapons' => $weapons,
            'groupsCount' => $groupsCount,
            'groups_without_pag' => $groups_without_pag,
        ]);
    }
    public function delete(Request $request)
    {
        if (!checkModulePermission('members_groups', 'delete')) {
            return redirect()->route('access_denied');
        }
        $tid = $request->input('tid');
        $this->groupService->deleteGroup($tid);
        return redirect()->route('group-registration')
            ->with('success', 'تم حذف الفريق بنجاح ');
    }
    public function show(Request $request)
    {
        if (!checkModulePermission('members_groups', 'show_mems')) {
            return redirect()->route('access_denied');
        }
        $tid = intval($request->input('tid'));
        $group = $this->groupService->getGroupById($tid);
        $TeamMembers = $this->groupService->viewGroupMembers($tid);
        if (!$TeamMembers) {
            return redirect()->route('group-registration')->with('error', '  الفريق غير مسجل');
        }
        return view('groups.group_members', compact('TeamMembers', 'group'));
    }
    public function edit(Request $request)
    {
        if (!checkModulePermission('members_groups', 'edit')) {
            return redirect()->route('access_denied');
        }
        $tid = intval($request->input('tid'));
        $clubs = $this->clubService->getAllClubs();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $group = $this->groupService->getGroupById($tid);
        return view('groups.group_edit', compact(['group', 'clubs', 'weapons']));
    }
    public function update(EditGroupRequest $request, $tid)
    {
        if (!checkModulePermission('members_groups', 'edit')) {
            return redirect()->route('access_denied');
        }
        $data = $request->validated();
        $group = $this->groupService->updateGroupData($data, $tid);
        if (!$group) {
            return redirect()->route('group-registration')->with('error', 'حدث خطأ أثناء التحديث');
        }
        return redirect()->route('group-registration')->with('success', 'تم تحديث بيانات الفريق بنجاح');
    }

    public function getMembersWithGroups()
    {
        if (!checkModulePermission('members_groups', 'rpt')) {
            return redirect()->route('access_denied');
        }
        $members = $this->groupService->getMembersWithGroups()['members'];

        $members_without_pag=$this->groupService->getMembersWithGroups()['members_without_pag'];
        $members_count = $members_without_pag->count()??0;
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllGroupWeapons();
        return view('groups.groups_members', compact(['members', 'groups', 'weapons', 'members_count','members_without_pag']));
    }
    public function membersByGroupSearch(Request $request)
    {
        $members = $this->groupService->membersByGroupSearch($request,1);
        $members_without_pag= $this->groupService->membersByGroupSearch($request,0);
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllPersonalWeapons();
        $members_count = $members_without_pag->count()??0;
        return view('groups.groups_members', compact(['members', 'groups', 'weapons', 'members_count','members_without_pag']));
    }

    //edit group member personal data
    public function editMemberData(Request $request)
    {
        $mid = $request->input('mid');
        $member = $this->personalService->getMemberByID($mid);
        return view('groups.member_group_edit', compact('member'));
    }
    public function updateMemberData(EditGroupMemberDataRequest $editGroupMemberRequest, $mid)
    {
        $data = $editGroupMemberRequest->validated();
        $this->groupService->updateMemberData($data, $mid, $editGroupMemberRequest);
        $member = $this->personalService->getMemberByID($mid);
        return redirect()->route('group-members', ['tid' => $member->team_id])
            ->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function showMemberData($mid , Request $request  )
    {
        $member = $this->personalService->getMemberByID($mid);
        return view('groups.member_group_show', compact('member'));
    }
}

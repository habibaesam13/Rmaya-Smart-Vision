<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\WeaponService;

class GroupController extends Controller
{
    protected GroupService $groupService;
    protected WeaponService $weaponService;
    public function __construct(GroupService $groupService, WeaponService $weaponService)
    {
        $this->groupService = $groupService;
        $this->weaponService = $weaponService;
    }
    public function index()
    {
        $groups = $this->groupService->getGroups();
        $weapons = $this->weaponService->getAllWeapons();

        return view('groups.registered_groups', ['groups' => $groups, 'weapons' => $weapons]);
    }
    public function search(Request $request)
    {
        $groups = $this->groupService->search($request);  // paginated groups
        $weapons = $this->weaponService->getAllWeapons(); // for the dropdown

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
}

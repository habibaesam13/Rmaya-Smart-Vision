<?php

namespace App\Services;

use App\Models\Sv_team;
use App\Models\Sv_member;
use App\Models\Sv_weapons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupService
{
    protected PersonalService $personalService;
    /**
     * Create a new class instance.
     */
    
    public function __construct(PersonalService $personalService)
    {
        $this->personalService=$personalService;
    }

    //Helpers
    public function getGroupById($tid)
    {
        return Sv_team::findOrfail($tid);
    }
    public function getGroupName($tid)
    {
        $group = $this->getGroupById($tid);
        return $group->name;
    }


    //المسجلين فرق
    public function getGroups()
    {
        $groups=Sv_team::with(['club', 'weapon']);
        $groupsCount=$groups->count();
        $groups = $groups->orderBy('tid')->cursorPaginate(20);
        return ['groups'=>$groups,'groupsCount'=>$groupsCount];
    }
    //تقرير الفرق
    public function getMembersWithGroups()
    {
        $query = Sv_member::with(['team', 'club', 'weapon'])
            ->where('reg_type', 'group');

        $members_count = $query->count(); // total count

        $members = $query->orderBy('mid')->cursorPaginate(20); // actual data

        return [
            'members' => $members,
            'members_count' => $members_count,
        ];
    }


    public function searchQuery(Request $request)
    {
        return Sv_team::with(['club', 'weapon'])
            ->when($request->team_name, fn($q) => $q->where('name', 'like', "%{$request->team_name}%"))
            ->when($request->weapon_id, fn($q) => $q->where('weapon_id', $request->weapon_id))
            ->when(
                $request->date_from,
                fn($q) =>
                $q->whereDate('created_at', '>=', $request->date_from)
            )
            ->when(
                $request->date_to,
                fn($q) =>
                $q->whereDate('created_at', '<=', $request->date_to)
            )
            ->orderBy('tid');
    }

    public function search(Request $request)
    {
        return $this->searchQuery($request)
            ->cursorPaginate(20)
            ->appends($request->query());
    }

    //المسجلين فرق
    public function membersByGroupSearch(Request $request)
    {
        return Sv_member::query()
            ->where('sv_members.reg_type', 'group')
            ->join('sv_teams as t', 'sv_members.team_id', '=', 't.tid')
            ->when(
                $request->weapon_id,
                fn($q) =>
                $q->where('sv_members.weapon_id', $request->weapon_id)
            )
            ->when(
                $request->team_name,
                fn($q) =>
                $q->where('t.name', 'LIKE', "%{$request->team_name}%")
            )
            ->select('sv_members.*', 't.name as team_name') 
            ->orderBy('sv_members.mid')
            ->cursorPaginate(5);
    }


    
    public function deleteGroup($tid)
    {
        $group = $this->getGroupById($tid);
        return $group->delete();
    }
    public function viewGroupMembers($tid)
    {
        $group = $this->getGroupById($tid);

        if ($group) {
            return Sv_member::where('reg_type', 'group')->where('team_id', $tid)->get();
        }
        return false;
    }
    public function updateGroupData($data, $tid)
    {
        $group = $this->getGroupById($tid);
        if ($group) {
            return $group->update($data);
        }
        return false;
    }


    //update member group data
    public function updateMemberData($data, $mid, Request $request)
    {
    
        $member = $this->personalService->getMemberByID($mid);
        if ($request->hasFile('front_id_pic')) {
            if ($member->front_id_pic && Storage::disk('public')->exists($member->front_id_pic)) {
                Storage::disk('public')->delete($member->front_id_pic);
            }

            $data['front_id_pic'] = $request->file('front_id_pic')->store('national_ids', 'public');
        }

        if ($request->hasFile('back_id_pic')) {
            if ($member->back_id_pic && Storage::disk('public')->exists($member->back_id_pic)) {
                Storage::disk('public')->delete($member->back_id_pic);
            }

            $data['back_id_pic'] = $request->file('back_id_pic')->store('national_ids', 'public');
        }
        $member->update($data);
        return $member;
    }
}
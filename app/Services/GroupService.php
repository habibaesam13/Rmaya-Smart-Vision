<?php

namespace App\Services;

use App\Models\Sv_member;
use App\Models\Sv_team;
use App\Models\Sv_weapons;
use Illuminate\Http\Request;

class GroupService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
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
        
        $groups = Sv_team::with(['club', 'weapon'])->orderBy('tid')->cursorPaginate(20);
        return $groups;
    }
    //تقرير الفرق
    public function getMembersWithGroups()
    {
        return Sv_member::with(['team', 'club', 'weapon'])
            ->where('reg_type', 'group')->orderBy('mid')->cursorPaginate(10);
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
}

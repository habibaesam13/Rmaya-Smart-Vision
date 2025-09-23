<?php

namespace App\Services;

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
    public function getGroups(){
        $weapons=Sv_weapons::all();
        $groups=Sv_team::with(['club','weapon'])->orderBy('tid')->cursorPaginate(2);
        return $groups;
    }
    public function searchQuery(Request $request)
    {
        return Sv_team::with(['club', 'weapon'])
            ->when($request->team_name, fn($q) => $q->where('name', 'like', "%{$request->team_name}%"))
            ->when($request->weapon_id, fn($q) => $q->where('weapon_id', $request->weapon_id))
            ->when($request->date_from, fn($q) =>
                $q->whereDate('created_at', '>=', $request->date_from)
            )
            ->when($request->date_to, fn($q) =>
                $q->whereDate('created_at', '<=', $request->date_to)
            )
            ->orderBy('tid');
    }

    public function search(Request $request)
    {
        return $this->searchQuery($request)
            ->cursorPaginate(3)
            ->appends($request->query());
    }
    public function daleteGroup($tid){
        $group=Sv_team::findOrfail($tid);
        return $group->delete();
    }
}

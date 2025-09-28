<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\GroupsExport;
use App\Exports\GroupsMembers;
use App\Services\GroupService;
use Maatwebsite\Excel\Facades\Excel;


class GroupExportController extends Controller
{
    public function export(Request $request, GroupService $groupService)
    {
        return Excel::download(new GroupsExport($request, $groupService), 'groups.xlsx');
    }
    public function exportGroupsMembers(Request $request, GroupService $groupService){
         return Excel::download(new GroupsMembers($request, $groupService), 'groups-Members.xlsx');
    }
}

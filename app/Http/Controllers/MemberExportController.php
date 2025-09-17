<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\MembersExport;
use Maatwebsite\Excel\Facades\Excel;

class MemberExportController extends Controller
{
    public function export(Request $request)
    {
        
        return Excel::download(new MembersExport($request), 'members.xlsx');
    }
}

<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Services\GroupService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsExport implements FromCollection, WithHeadings
{
    protected Request $request;
    protected GroupService $groupService;

    public function __construct(Request $request, GroupService $groupService)
    {
        $this->request = $request;
        $this->groupService = $groupService;
    }

    public function collection()
    {
        return $this->groupService->searchQuery($this->request)
            ->get()
            ->map(function($group){
                return [
                    'اسم الفريق'   => $group->name,
                    'اسم النادي'   => $group->club?->name,
                    'اسم السلاح'   => $group->weapon?->name,
                    'تاريخ التسجيل'=> $group->created_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'اسم الفريق',
            'اسم النادي',
            'اسم السلاح',
            'تاريخ التسجيل',
        ];
    }
}

<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Contracts\ExcelProviderInterface;
use Maatwebsite\Excel\Concerns\FromCollection;

class GroupsExportProvider implements FromCollection, ExcelProviderInterface
{
    /**
     * Create a new class instance.
     */
    protected $request;
    protected $groupService;

    public function __construct(Request $request, GroupService $groupService)
    {
        $this->request = $request;
        $this->groupService = $groupService;
    }

    public function collection()
    {
        return $this->getData($this->request);
    }

    public function getData(Request $request)
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

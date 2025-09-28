<?php

namespace App\Exports;


use App\Models\Sv_member;
use Illuminate\Http\Request;
use App\Services\GroupService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GroupsMembers implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected Request $request;
    protected GroupService $groupService;

    public function __construct(Request $request, GroupService $groupService)
    {
        $this->request = $request;
        $this->groupService = $groupService;
    }

    public function collection()
    {
        return Sv_member::with(['team', 'club', 'weapon'])
        ->where('reg_type', 'group')
        ->when($this->request->weapon_id, fn($q) =>
            $q->where('sv_members.weapon_id', $this->request->weapon_id)
        )
        ->when($this->request->team_name, fn($q) =>
            $q->whereHas('team', fn($t) =>
                $t->where('name', 'LIKE', "%{$this->request->team_name}%")
            )
        )
        ->orderBy('mid')
        ->get()
            ->map(function($member){
                return [
                    'رقم الهوية'   => $member->ID,
                    'الأسم'   => $member->name,
                    'الهاتف'   => $member->phone1,
                    'العمر'=> $member->age_calculation(),
                    'الفريق'=>$member->club?->name,
                    'السلاح'=>$member->weapon?->name,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'رقم الهوية',
            'الأسم',
            'الهاتف',
            'العمر',
            'الفريق',
            'السلاح',
        ];
    }
}

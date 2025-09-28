<?php

namespace App\Exports;

use App\Models\Country;
use App\Models\Member_group;
use App\Models\Sv_clubs;
use App\Models\Sv_member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

   public function collection()
    {
        return Sv_member::with(['club', 'registrationClub','weapon', 'nationality', 'member_group'])
            ->filter($this->request)
            ->get()
            ->map(function ($member) {
                return [
                    'name'              => $member->name,
                    'ID'                => $member->ID,
                    'phone1'            => $member->phone1,
                    'dob'               => $member->dob,
                    'weapon_id'         => $member->weapon?->name,
                    'club_id'           => $member->club?->name,
                    'reg_club'          => $member->registrationClub?->name,
                    'nat'               => $member->nationality?->name,
                    'mgid'              => $member->member_group?->name,
                    'registration_date' => $member->registration_date,
                ];
            });
    }


    public function headings(): array
    {
        return [
            'الاسم',
            'رقم الهوية',
            'الهاتف',
            'تاريخ الميلاد',
            'السلاح',
            'النادي',
            'مكان التسجيل',
            'الجنسية',
            'المجموعة',
            'تاريخ التسجيل',
        ];
    }
}

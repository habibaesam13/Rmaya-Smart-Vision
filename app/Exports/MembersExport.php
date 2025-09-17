<?php

namespace App\Exports;

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
        return Sv_member::filter($this->request)->get([
            'name',
            'ID',
            'phone1',
            'dob',
            'weapon_id',
            'club_id',
            'reg_club',
            'nat',
            'mgid',
            'registration_date',
        ]);
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

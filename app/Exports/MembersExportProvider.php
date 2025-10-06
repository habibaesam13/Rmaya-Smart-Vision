<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Contracts\ExcelProviderInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Sv_member;
class MembersExportProvider implements FromCollection, ExcelProviderInterface
{
    /**
     * Create a new class instance.
     */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return $this->getData($this->request);
    }
    public function getData(Request $request){
        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality', 'member_group'])
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
                    'nat'               => $member->nationality && trim($member->nationality->country_name_ar ?? '') !== ''
                        ? $member->nationality->country_name_ar
                        : (trim($member->nationality->country_name ?? '') !== ''
                            ? $member->nationality->country_name
                            : '---'),
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

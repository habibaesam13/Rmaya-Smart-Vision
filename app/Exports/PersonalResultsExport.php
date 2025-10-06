<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Contracts\ExcelProviderInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Sv_initial_results_players;
use App\Models\Sv_member;

class PersonalResultsExport implements FromCollection, ExcelProviderInterface
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        return $this->getData($this->request);
    }

    public function getData(Request $request)
    {
        $addedPlayers = Sv_initial_results_players::pluck('player_id')->toArray();

        return Sv_member::with(['club', 'registrationClub', 'weapon', 'nationality'])
            ->where('reg_type', 'personal')
            ->whereNotIn('mid', $addedPlayers)
            ->when(
                $request->hasAny([
                    'mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q',
                    'gender', 'active', 'date_from', 'date_to', 'reg_club'
                ]),
                fn($q) => $q->filter($this->request)
            )
            ->orderBy('mid')
            ->get()
            ->map(function ($player) {
                return [
                    'الاسم' => $player->name,
                    'رقم الهوية' => $player->ID,
                    'الهاتف' => $player?->phone1 ?: $player?->phone2,
                    'تاريخ الميلاد' => $player->created_at,
                    'السلاح' => $player?->weapon?->name,
                    'النادي' => $player?->club?->name,
                    'مكان التسجيل' => $player?->registrationClub?->name,
                    'الجنسية' => $player->nationality && trim($player->nationality->country_name_ar ?? '') !== ''
                        ? $player->nationality->country_name_ar
                        : (trim($player->nationality->country_name ?? '') !== ''
                            ? $player->nationality->country_name
                            : '---'),
                    'المجموعة' => $player?->member_group?->name,
                    'تاريخ التسجيل' => $player?->registration_date,
                ];
            });
    }

    public function headings()
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

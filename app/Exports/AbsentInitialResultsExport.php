<?php

namespace App\Exports;

use Illuminate\Http\Request;
use App\Contracts\ExcelProviderInterface;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Sv_initial_results_players;
class AbsentInitialResultsExport implements FromCollection, ExcelProviderInterface
{
    /**
    * @return \Illuminate\Support\Collection
    */
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

        return Sv_initial_results_players::query()
            ->with(['player.club', 'player.weapon', 'report.weapon'])
            ->whereNull('total')
            ->whereHas('report', fn($q) => $q->where('confirmed', true)->where('weapon_id', $request->weapon_id))
            
            ->when(
                $request->club_id,
                fn($q) =>
                $q->whereHas(
                    'player.club',
                    fn($sub) =>
                    $sub->where('cid', $request->club_id)
                )
            )
            ->when(
                $request->nat,
                fn($q) =>
                $q->whereHas(
                    'player.nationality',
                    fn($sub) =>
                    $sub->where('id', $request->nat)
                )
            )
            ->when(
                $request->gender,
                fn($q) =>
                $q->whereHas(
                    'player',
                    fn($sub) =>
                    $sub->where('gender', $request->gender)
                )
            )
            ->when(
                $request->date_from,
                fn($q) =>
                $q->whereHas(
                    'report',
                    fn($sub) =>
                    $sub->whereDate('date', '>=', $request->date_from)
                )
            )
            ->when(
                $request->date_to,
                fn($q) =>
                $q->whereHas(
                    'report',
                    fn($sub) =>
                    $sub->whereDate('date', '<=', $request->date_to)
                )
            )
            ->when(
                $request->q,
                fn($q) =>
                $q->whereHas(
                    'player',
                    fn($sub) => $sub
                        ->where(function ($query) use ($request) {
                            $search = $request->q;
                            $query->where('name', 'like', "%{$search}%")
                                ->orWhere('ID', 'like', "%{$search}%")
                                ->orWhere('phone1', 'like', "%{$search}%")
                                ->orWhere('phone2', 'like', "%{$search}%");
                        })
                )
            )
            ->get()
            ->map(function ($player) {
                return [
                    'الاسم' => $player?->player?->name ?? '---',
                    'رقم الهوية' => $player?->player?->ID,
                    'الهاتف' => $player?->player?->phone1,
                    'السلاح' => $player?->report?->weapon?->name ,
                    'تاريخ الرماية' => $player?->report?->date,
                    ' رقم الديتيل' =>  $player?->report?->details,
                    'تاريخ التسجيل' => $player?->player?->created_at->format('d-m-Y'),
                    'ملاحظات' => $player?->notes ?? 'لا يوجد ملاحظات',
                    
                ];
            });
    }

    public function headings()
    {
        return [
            'الاسم',
            'رقم الهوية',
            'الهاتف',
            'السلاح',
            'تاريخ الرماية',
            'رقم الديتيل',
            'تاريخ التسجيل',
            'ملاحظات',
        ];
    }
}

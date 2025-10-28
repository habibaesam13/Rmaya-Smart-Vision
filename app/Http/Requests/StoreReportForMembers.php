<?php

namespace App\Http\Requests;

use App\Models\Sv_initial_results_players;
use App\Models\SV_initial_results;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sv_member;

class StoreReportForMembers extends FormRequest
{
    private ?int $weaponId = null;

    public function authorize(): bool
    {
        //dd($this->absent_report);

        return true;
    }

    protected function prepareForValidation()
    {
        //dd($this->absent_report==="1"? 1: 0);
        if ($this->has('checkedMembers') && is_string($this->checkedMembers)) {
            $this->merge([
                'checkedMembers' => explode(',', $this->checkedMembers),

            ]);
        }

        $this->merge([
            'date' => $this->input('date', now()->toDateString()),

        ]);
    }

    public function rules(): array
    {
        return [
            'checkedMembers'   => 'required|array',
            'checkedMembers.*' => 'exists:sv_members,mid',
            'date'             => 'date|required',
            'details'          => 'integer|required|unique:sv_initial_results,details',
            'absents'          =>  'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'checkedMembers.required' => 'يجب اختيار عضو واحد على الأقل.',
            'checkedMembers.array'    => 'يجب إرسال الأعضاء المحددين كمصفوفة.',
            'checkedMembers.*.exists' => 'عضو أو أكثر من الأعضاء المحددين غير موجودين في النظام.',
            'date.date'               => 'يجب أن يكون  التاريخ تاريخاً صحيحاً.',
            'details.integer'         => 'يجب أن يكون الديتيل قيمة رقمية صحيحة.',
            'details.unique'          =>'رقم الديتيل موجود بالفعل',
        ];
    }



    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $memberIds = $this->input('checkedMembers', []);
            $reportId = $this->route('rid') ?? $this->input('Rid');

            if (!empty($memberIds)) {

                //  Check if selected members already exist in this SAME report
                if ($reportId) {
                    $alreadyInThisReport = Sv_initial_results_players::where('Rid', $reportId)
                        ->whereIn('player_id', $memberIds)
                        ->pluck('player_id')
                        ->toArray();

                    if (!empty($alreadyInThisReport)) {
                        $players = \App\Models\Sv_member::whereIn('mid', $alreadyInThisReport)->pluck('name')->toArray();
                        $names = implode(', ', $players);
                        $validator->errors()->add('checkedMembers', "اللاعب/اللاعبين التاليين مسجلين بالفعل في نفس التقرير: $names");
                    }
                }

                // Check weapon consistency
                $weaponId = \App\Models\Sv_member::where('reg_type', 'personal')
                    ->whereIn('mid', $memberIds)
                    ->distinct('weapon_id')
                    ->pluck('weapon_id');

                if ($weaponId->count() > 1) {
                    $validator->errors()->add('checkedMembers', 'يجب أن يكون نفس السلاح لجميع الأفراد');
                } elseif ($weaponId->count() === 1) {
                    $this->weaponId = $weaponId->first();
                }

                //  Check if any player already registered in another confirmed report
                $alreadyRegistered = \App\Models\Sv_initial_results_players::whereIn('player_id', $memberIds)
                    ->where('total', '>=', 0)
                    ->whereNotIn('Rid', [$reportId]) // ignore current report
                    ->groupBy('player_id')
                    ->pluck('player_id')
                    ->toArray();

                if (!empty($alreadyRegistered)) {
                    $players = \App\Models\Sv_member::whereIn('mid', $alreadyRegistered)->pluck('name')->toArray();
                    $names = implode(', ', $players);
                    $validator->errors()->add('checkedMembers', "اللاعب/اللاعبين التاليين مسجلين بالفعل في تقرير آخر: $names");
                }
            }
        });
    }



    /**
     * Get weapon id after validation passes
     */
    public function getWeaponId(): ?int
    {
        return $this->weaponId;
    }
}

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
        //dd($_REQUEST);
        return true;
    }

    protected function prepareForValidation()
    {
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
            'details'          => 'integer|required',
        ];
    }

    public function messages(): array
    {
        return [
            'checkedMembers.required' => 'يجب اختيار عضو واحد على الأقل.',
            'checkedMembers.array'    => 'يجب إرسال الأعضاء المحددين كمصفوفة.',
            'checkedMembers.*.exists' => 'عضو أو أكثر من الأعضاء المحددين غير موجودين في النظام.',
            'date.date'               => 'يجب أن يكون حقل التاريخ تاريخاً صحيحاً.',
            'details.integer'         => 'يجب أن يكون حقل التفاصيل قيمة رقمية صحيحة.',
        ];
    }



    public function withValidator($validator)
{
    $validator->after(function ($validator) {
        $memberIds = $this->input('checkedMembers', []);

        if (!empty($memberIds)) {
            // Check weapon consistency
            $weaponId = Sv_member::where('reg_type', 'personal')
                ->whereIn('mid', $memberIds)
                ->distinct('weapon_id')
                ->pluck('weapon_id');

            if ($weaponId->count() > 1) {
                $validator->errors()->add('checkedMembers', 'يجب أن يكون نفس السلاح لجميع الأفراد');
            } elseif ($weaponId->count() === 1) {
                $this->weaponId = $weaponId->first();
            }

            // Check if any player already registered with total >= 0
            $alreadyRegistered = Sv_initial_results_players::whereIn('player_id', $memberIds)
                ->where('total', '>=', 0)
                ->pluck('player_id')
                ->toArray();

            if (!empty($alreadyRegistered)) {
                // Get player names for clearer message
                $players = Sv_member::whereIn('mid', $alreadyRegistered)->pluck('name')->toArray();
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

<?php

namespace App\Http\Requests;

use App\Models\Sv_member;
use App\Models\SVFianlResultsPlayer;
use Illuminate\Foundation\Http\FormRequest;

class FinalResultStoreReportForMembers extends FormRequest
{
    private ?int $weaponId = null;

    public function authorize(): bool
    {
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
//        dd(request()->method() );
        $arr = [
            'checkedMembers' => 'required|array',
            'checkedMembers.*' => 'exists:sv_members,mid',
            'date' => 'date|required',
            'details' => 'integer|required|unique:sv_fianl_results',
        ];

        if (request()->method() === 'PUT') {
            $arr['details'] =    'integer|required' ;
        }
        return  $arr;
    }

    public function messages(): array
    {
        return [
            'checkedMembers.required' => 'يجب اختيار عضو واحد على الأقل.',
            'checkedMembers.array' => 'يجب إرسال الأعضاء المحددين كمصفوفة.',
            'checkedMembers.*.exists' => 'عضو أو أكثر من الأعضاء المحددين غير موجودين في النظام.',
            'date.date' => 'يجب أن يكون حقل التاريخ تاريخاً صحيحاً.',
            'details.integer' => 'يجب أن يكون حقل التفاصيل قيمة رقمية صحيحة.',
        ];
    }


    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $memberIds = $this->input('checkedMembers', []);

            if (!empty($memberIds)) {
                $weaponId = Sv_member::where('reg_type', 'personal')
                    ->whereIn('mid', $memberIds)
                    ->distinct('weapon_id')
                    ->pluck('weapon_id');

                if ($weaponId->count() > 1) {
                    $validator->errors()->add('checkedMembers', 'يجب أن يكون نفس السلاح لجميع الأفراد');
                } elseif ($weaponId->count() === 1) {

                    $this->weaponId = $weaponId->first();
                }


                //                if(!($this->addMembertoReportRid > 0)) {
//                    $alreadyExists = SVFianlResultsPlayer::whereIn('player_id', $memberIds)->exists();
//                    if ($alreadyExists) {
//                        $validator->errors()->add('checkedMembers', 'اللاعب مسجل بالفعل في تقرير آخر');
//                    }
//                }
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

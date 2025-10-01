<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sv_member;

class StoreReportForMembers extends FormRequest
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
            'checkedMembers.required' => 'You must select at least one member.',
            'checkedMembers.array'    => 'The selected members must be sent as an array.',
            'checkedMembers.*.exists' => 'One or more selected members do not exist in the system.',
            'date.date'               => 'The date field must be a valid date.',
            'details.integer'         => 'The details field must be an integer value.',
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
                    // store weapon id for later usage
                    $this->weaponId = $weaponId->first();
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

<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Sv_member;

class StoreReportForMembers extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'date' => $this->input('date', now()->toDateString()),
        ]);
    }
    public function rules(): array
    {
        return [
            'checkedMembers' => 'required|array',
            'checkedMembers.*' => 'exists:Sv_member,mid',
            'date' => 'date|required',
            'details' => 'integer|required',
        ];
    }
    public function messages(): array
    {
        return [
            'checkedMembers.required'   => 'You must select at least one member.',
            'checkedMembers.array'      => 'The selected members must be sent as an array.',
            'checkedMembers.*.exists'   => 'One or more selected members do not exist in the system.',

            'date.date'                 => 'The date field must be a valid date.',

            'details.integer'           => 'The details field must be an integer value.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $memberIds = $this->input('checkedMembers', []);

            if (!empty($memberIds)) {
                $weaponsCount = Sv_member::where('reg_type','personal')->whereIn('mid', $memberIds)
                    ->distinct('weapon_id')
                    ->count('weapon_id');

                if ($weaponsCount > 1) {
                    $validator->errors()->add('checkedMembers', 'يجب أن يكون نفس السلاح لجميع الأفراد');
                }
            }
        });
    }
}

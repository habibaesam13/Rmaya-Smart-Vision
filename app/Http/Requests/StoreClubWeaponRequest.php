<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class StoreClubWeaponRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'wid' => 'required|exists:sv_weapons,wid',
            'cid' => 'required|exists:sv_clubs,cid',
            "gender" => "required|string|in:male,female",
            "age_from" => "required|integer|min:1",
            "age_to" => "nullable|integer|min:0|gte:age_from",
            "success_degree" => "required|integer|between:0,100"
        ];
    }
    public function messages(): array
    {
        return [
            'wid.required' => 'حقل السلاح مطلوب.',
            'wid.exists' => 'السلاح المحدد غير صحيح.',
            'cid.required' => 'حقل النادي مطلوب.',
            'cid.exists' => 'النادي المحدد غير صحيح.',
            'gender.required' => 'حقل الجنس مطلوب.',
            'age_from.required' => 'حقل العمر من مطلوب.',
            'success_degree.required' => 'حقل درجة النجاح مطلوب.',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $exists = DB::table('sv_clubs_weapons')
                ->where('cid', $this->club_id)
                ->where('wid', $this->weapon_id)
                ->exists();

            if ($exists) {
                $validator->errors()->add('club_id', 'This club already has this weapon assigned.');
            }
        });
    }
}

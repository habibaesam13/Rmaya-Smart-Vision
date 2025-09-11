<?php

namespace App\Http\Requests;

use DB;
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
            'wid.required' => 'The weapon field is required.',
            'wid.exists' => 'The selected weapon is invalid.',
            'cid.required' => 'The club field is required.',
            'cid.exists' => 'The selected club is invalid.',
            'gender.required' => 'The gender field is required.',
            'age_from.required' => 'The age from field is required.',
            'success_degree.required' => 'The success degree field is required.',
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
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalUpdateRequest extends FormRequest
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
            'ID' => 'string|exists:sv_members',
            'dob' => 'date',
            'name' => 'string',
            'Id_expire_date' => 'date|after:today',
            'nat' => 'exists:countries,id',
            'gender' => 'in:male,female',
            'club_id' => 'exists:sv_clubs,id',
            'weapon_id' => 'exists:sv_weapons,id',
            'phone1' => 'string',
            'phone2' =>'string',

        ];
    }
}

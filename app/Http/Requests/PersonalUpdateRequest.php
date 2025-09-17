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
            'ID'=>'string|Sv_member:exist|unique:Sv_member',
            'bod'=>'date',
            'name'=>'string',
            'Id_expire_date'=>'date|boe:now',
            'nat'=>'countries:exist',
            'gender'=>'in:male,female',
            'club_id'=>'Sv_clubs:exist',
            'weapon_id'=>'Sv_weapons:exist',
            'phone1'=>'unique:Sv_members',
        ];
    }
}

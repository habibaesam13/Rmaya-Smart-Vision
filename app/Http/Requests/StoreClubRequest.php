<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class StoreClubRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:sv_clubs,name',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Club name is required.',
            'name.string' => 'Club name must be a string.',
            'name.max' => 'Club name must not exceed 255 characters.',
            'name.unique' => 'This club name is already exists.',
        ];
    }   
}

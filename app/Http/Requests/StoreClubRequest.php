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
            'name.required' => 'اسم النادي مطلوب.',
            'name.string' => 'يجب أن يكون اسم النادي نصاً.',
            'name.max' => 'يجب ألا يتجاوز اسم النادي 255 حرفاً.',
            'name.unique' => 'اسم النادي هذا موجود بالفعل.',
        ];
    }
}

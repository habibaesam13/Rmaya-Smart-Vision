<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditGroupMemberDataRequest extends FormRequest
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
            'ID'             => 'required|string|exists:sv_members,ID',
            'dob'            => 'nullable|date|before_or_equal:' . now()->subYear(16)->toDateString(),
            'name'           => 'nullable|string',
            'Id_expire_date' => 'nullable|date|after:today',
            'phone1'         => 'nullable|string',
            'front_id_pic'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'back_id_pic'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

 public function messages(): array
    {
        return [
            'ID.required' => 'رقم الهوية مطلوب.',
            'ID.string'   => 'رقم الهوية يجب أن يكون نصياً.',
            'ID.exists'   => 'رقم الهوية غير موجود في قاعدة البيانات.',

            'dob.date'   => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'dob.before' => 'يجب ان لا يقل السن عن 16 سنه',

            'name.string' => 'الاسم يجب أن يكون نصياً.',

            'Id_expire_date.date'  => 'تاريخ انتهاء الهوية يجب أن يكون تاريخاً صحيحاً.',
            'Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد تاريخ اليوم.',

            'phone1.string' => 'رقم الهاتف الأول يجب أن يكون نصياً.',

            'front_id_pic.file'  => 'ملف الوجه الأمامي للهوية غير صالح.',
            'front_id_pic.mimes' => 'ملف الوجه الأمامي يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'front_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجا.',

            'back_id_pic.file'  => 'ملف الوجه الخلفي للهوية غير صالح.',
            'back_id_pic.mimes' => 'ملف الوجه الخلفي يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'back_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجا.',
        ];
    }
}
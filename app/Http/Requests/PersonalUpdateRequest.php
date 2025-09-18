<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ID'             => 'required|string|exists:sv_members,ID',
            'dob'            => 'nullable|date|before:today',
            'name'           => 'nullable|string',
            'Id_expire_date' => 'nullable|date|after:today',
            'nat'            => 'nullable|exists:countries,id',
            'gender'         => 'nullable|in:male,female',
            'club_id'        => 'nullable|exists:sv_clubs,cid',
            'weapon_id'      => 'nullable|exists:sv_weapons,wid',
            'phone1'         => 'nullable|string',
            'phone2'         => 'nullable|string',
            'front_id_pic'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'back_id_pic'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'mgid'           => 'nullable|exists:member_groups,mgid',
            'reg_club'       => 'nullable|exists:sv_clubs,cid',
        ];
    }
    public function messages(): array
    {
        return [
            'ID.required' => 'رقم الهوية مطلوب.',
            'ID.string'   => 'رقم الهوية يجب أن يكون نصياً.',
            'ID.exists'   => 'رقم الهوية غير موجود في قاعدة البيانات.',

            'dob.date'   => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'dob.before' => 'يجب ان لا يقل السن عن سنه',

            'name.string' => 'الاسم يجب أن يكون نصياً.',

            'Id_expire_date.date'  => 'تاريخ انتهاء الهوية يجب أن يكون تاريخاً صحيحاً.',
            'Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد تاريخ اليوم.',

            'nat.exists' => 'الجنسية المختارة غير صحيحة.',

            'gender.in' => 'الجنس يجب أن يكون ذكر أو أنثى فقط.',

            'club_id.exists'   => 'النادي غير موجود.',
            'weapon_id.exists' => 'السلاح غير موجود.',
            'reg_club.exists'  => 'نادي التسجيل غير موجود.',

            'phone1.string' => 'رقم الهاتف الأول يجب أن يكون نصياً.',
            'phone2.string' => 'رقم الهاتف الثاني يجب أن يكون نصياً.',

            'front_id_pic.file'  => 'ملف الوجه الأمامي للهوية غير صالح.',
            'front_id_pic.mimes' => 'ملف الوجه الأمامي يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'front_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجا.',

            'back_id_pic.file'  => 'ملف الوجه الخلفي للهوية غير صالح.',
            'back_id_pic.mimes' => 'ملف الوجه الخلفي يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'back_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجا.',

            'mgid.exists' => 'المجموعة غير موجودة.',
        ];
    }
}

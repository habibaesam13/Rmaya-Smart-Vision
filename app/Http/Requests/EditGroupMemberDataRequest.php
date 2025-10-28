<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EditGroupMemberDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ID' => [
                'sometimes',
                'string',
                'size:15', // same as min:15 & max:15
                Rule::unique('sv_members', 'ID')
                    ->where(function ($query) {
                        // Uniqueness scoped to group_id only
                        return $query->where('team_id', $this->group_id)
                            ->where('reg_type', 'group');
                    })
                    ->ignore($this->member_id), // Allow editing the same member
            ],

            'name' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    // Remove extra spaces and split by whitespace
                    $words = preg_split('/\s+/u', trim($value), -1, PREG_SPLIT_NO_EMPTY);

                    if (count($words) < 3) {
                        $fail('الاسم يجب أن يتكون من ثلاث كلمات على الأقل.');
                    }
                },
            ],


            'dob'            => 'nullable|date|before_or_equal:' . now()->subYears(16)->toDateString(),
            'Id_expire_date' => 'nullable|date|after:today',
            'phone1'         => 'nullable|digits:10|regex:/^05\d{8}$/',
            'front_id_pic'   => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'back_id_pic'    => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'ID.required' => 'رقم الهوية مطلوب.',
            'ID.unique'   => 'رقم الهوية مسجل بالفعل في نفس الفريق.',
            'ID.size'     => 'رقم الهوية يجب أن يكون مكوناً من 15 رقماً.',

            'dob.date'   => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'dob.before_or_equal' => 'العمر يجب ألا يقل عن 16 سنة.',

            'name.string' => 'الاسم يجب أن يكون نصياً.',

            'Id_expire_date.date'  => 'تاريخ انتهاء الهوية يجب أن يكون تاريخاً صحيحاً.',
            'Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد اليوم.',

            'phone1.digits' => 'رقم الهاتف يجب أن يكون مكوناً من 10 أرقام.',
            'phone1.regex'  => 'رقم الهاتف يجب أن يبدأ بـ 05.',

            'front_id_pic.file'  => 'ملف الوجه الأمامي للهوية غير صالح.',
            'front_id_pic.mimes' => 'الملف يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'front_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجابايت.',

            'back_id_pic.file'  => 'ملف الوجه الخلفي للهوية غير صالح.',
            'back_id_pic.mimes' => 'الملف يجب أن يكون بصيغة: jpg, jpeg, png, pdf.',
            'back_id_pic.max'   => 'الحد الأقصى لحجم الملف هو 2 ميجابايت.',
        ];
    }
}

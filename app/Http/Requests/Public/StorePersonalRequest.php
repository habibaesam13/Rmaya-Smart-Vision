<?php

namespace App\Http\Requests\Public;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'reg_type' => $this->input('reg_type', 'personal'),
            
            'reg_club' => $this->input('club_id'),
            'registration_date' => $this->input('registration_date', now()->toDateString()),
        ]);
    }

    public function rules(): array
    {
        return [
            'reg_type' => 'required|in:personal',
            'name' => [
                'required',
                'string',
                'regex:/^[\p{Arabic}\s]+$/u',
            ],

            'Id_expire_date' => 'required|date|after:today',
            'dob' => 'required|date|before_or_equal:' . now()->subYear(16)->toDateString(),
            'nat' => 'required|exists:countries,id',
            'gender' => 'required|in:female,male',
            'club_id' => 'required|exists:sv_clubs,cid',
            'weapon_id' => 'required|exists:sv_weapons,wid',
            'phone1' => [
                'required',
                'regex:/^055\d{7}$/',
            ],
            'phone2' => [
                'nullable',
                'regex:/^055\d{7}$/',
            ],

            'front_id_pic' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'back_id_pic' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'registration_date' => 'required|date',

            'ID' => [
                'required',
                'regex:/^\d{15}$/',
                Rule::unique('sv_members')->where(function ($query) {
                    if ($this->reg_type === 'personal') {
                        return $query->where('reg_type', 'personal');
                    }
                    return $query;
                }),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'name.regex' => 'الاسم يجب أن يحتوي على أحرف عربية ومسافات فقط.',

            'reg_type.in' => 'نوع التسجيل يجب أن يكون personal فقط.',

            'Id_expire_date.required' => 'تاريخ انتهاء الهوية مطلوب.',
            'Id_expire_date.date' => 'تاريخ انتهاء الهوية يجب أن يكون تاريخاً صحيحاً.',
            'Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد اليوم.',

            'dob.required' => 'تاريخ الميلاد مطلوب.',
            'dob.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'dob.before_or_equal' => 'تاريخ الميلاد يجب أن يكون قبل 16 سنة على الأقل.',

            'nat.required' => 'الجنسية مطلوبة.',
            'nat.exists' => 'الجنسية المحددة غير موجودة.',

            'gender.required' => 'النوع مطلوب.',
            'gender.in' => 'النوع يجب أن يكون ذكر أو أنثى.',

            'club_id.required' => 'النادي مطلوب.',
            'club_id.exists' => 'النادي المحدد غير موجود.',

            'weapon_id.required' => 'السلاح مطلوب.',
            'weapon_id.exists' => 'السلاح المحدد غير موجود.',

            'phone1.required' => 'رقم الهاتف الأول مطلوب.',
            'phone1.regex' => 'رقم الهاتف الأول يجب أن يبدأ بـ 055 ويتكون من 10 أرقام فقط.',

            'phone2.regex' => 'رقم الهاتف الثاني يجب أن يبدأ بـ 055 ويتكون من 10 أرقام فقط.',

            'front_id_pic.required' => 'صورة البطاقة الأمامية مطلوبة.',
            'front_id_pic.mimes' => 'الصورة الأمامية يجب أن تكون بصيغة jpg أو jpeg أو png أو pdf.',
            'front_id_pic.max' => 'حجم الصورة الأمامية يجب ألا يتجاوز 2 ميجا.',

            'back_id_pic.required' => 'صورة البطاقة الخلفية مطلوبة.',
            'back_id_pic.mimes' => 'الصورة الخلفية يجب أن تكون بصيغة jpg أو jpeg أو png أو pdf.',
            'back_id_pic.max' => 'حجم الصورة الخلفية يجب ألا يتجاوز 2 ميجا.',

            'registration_date.required' => 'تاريخ التسجيل مطلوب.',
            'registration_date.date' => 'تاريخ التسجيل يجب أن يكون تاريخاً صحيحاً.',

            'ID.required' => 'رقم الهوية مطلوب.',
            'ID.regex' => 'رقم الهوية يجب أن يحتوي على 15 رقم فقط دون حروف أو رموز.',
            'ID.unique' => 'هذا الرقم مسجل بالفعل.',
        ];
    }
}

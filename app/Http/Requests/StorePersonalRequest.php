<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonalRequest extends FormRequest
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
    protected function prepareForValidation()
    {
        $this->merge([
            'reg_type' => $this->input('reg_type', 'personal'),
            'registration_date' => $this->input('registration_date', now()->toDateString()),
        ]);
    }
    public function rules(): array
    {
        return [
            'reg_type' => 'required|in:personal,group',
            'group_id' => 'nullable|exists:sv_teams,tid',
            'name' => 'required|string',//حروف عربي فقط ولا يقبل ارقام
            'Id_expire_date' => 'required|date|after:today',
            'dob' => 'required|date|before_or_equal:' . now()->subYear(16)->toDateString(),
            'nat' => 'required|exists:countries,id',
            'gender' => 'required|in:female,male',
            'club_id' => 'required|exists:sv_clubs,cid',
            'weapon_id' => 'required|exists:sv_weapons,wid',
            'phone1' => 'required|string|max:10|min:10',//055xxxxxxx no letters
            'phone2' => 'nullable|string|max:10|min:10',
            'front_id_pic' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'back_id_pic' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'mgid' => 'required|exists:member_groups,mgid',//for admin only
            'reg_club' => 'nullable|exists:sv_clubs,cid',
            'registration_date' => 'required|date',
            'ID' => [
                'required',
                'string',
                'min:15',
                'max:15',
                Rule::unique('sv_members')->where(function ($query) {
                    if ($this->reg_type === 'personal') {
                        return $query->where('reg_type', 'personal');
                    }

                    if ($this->reg_type === 'group') {
                        return $query->where('reg_type', 'group')
                            ->where('group_id', $this->group_id);
                    }

                    return $query;
                }),
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'reg_type.required' => 'نوع التسجيل مطلوب.',
            'reg_type.in' => 'نوع التسجيل يجب أن يكون personal أو group فقط.',

            'group_id.exists' => 'المجموعة المحددة غير موجودة.',

            'Id_expire_date.required' => 'تاريخ انتهاء الهوية مطلوب.',
            'Id_expire_date.date' => 'تاريخ انتهاء الهوية يجب أن يكون تاريخاً صحيحاً.',
            'Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد اليوم.',

            'dob.required' => 'تاريخ الميلاد مطلوب.',
            'dob.date' => 'تاريخ الميلاد يجب أن يكون تاريخاً صحيحاً.',
            'dob.before_or_equal' => 'تاريخ الميلاد يجب أن يكون قبل سنة على الأقل.',

            'nat.required' => 'الجنسية مطلوبة.',
            'nat.exists' => 'الجنسية المحددة غير موجودة.',

            'gender.required' => 'النوع مطلوب.',
            'gender.in' => 'النوع يجب أن يكون ذكر أو أنثى.',

            'club_id.required' => 'النادي مطلوب.',
            'club_id.exists' => 'النادي المحدد غير موجود.',

            'weapon_id.required' => 'السلاح مطلوب.',
            'weapon_id.exists' => 'السلاح المحدد غير موجود.',

            'phone1.required' => 'رقم الهاتف الأول مطلوب.',
            'phone1.min' => 'رقم الهاتف الأول يجب أن يحتوي على 10 أرقام على الأقل.',
            'phone1.max' => 'رقم الهاتف الأول يجب ألا يزيد عن 20 رقم.',

            'phone2.min' => 'رقم الهاتف الثاني يجب أن يحتوي على 10 أرقام على الأقل.',
            'phone2.max' => 'رقم الهاتف الثاني يجب ألا يزيد عن 20 رقم.',

            'front_id_pic.required' => 'صورة البطاقة الأمامية مطلوبة.',
            'front_id_pic.mimes' => 'الصورة الأمامية يجب أن تكون jpg أو jpeg أو png أو pdf.',
            'front_id_pic.max' => 'حجم الصورة الأمامية يجب ألا يتجاوز 2 ميجا.',

            'back_id_pic.required' => 'صورة البطاقة الخلفية مطلوبة.',
            'back_id_pic.mimes' => 'الصورة الخلفية يجب أن تكون jpg أو jpeg أو png أو pdf.',
            'back_id_pic.max' => 'حجم الصورة الخلفية يجب ألا يتجاوز 2 ميجا.',

            'mgid.required' => 'المجموعة مطلوبة.',
            'mgid.exists' => 'المجموعة المحددة غير موجودة.',

            'reg_club.exists' => 'النادي المسجل المحدد غير موجود.',

            'registration_date.required' => 'تاريخ التسجيل مطلوب.',
            'registration_date.date' => 'تاريخ التسجيل يجب أن يكون تاريخاً صحيحاً.',

            'ID.required' => 'رقم الهوية مطلوب.',
            'ID.unique' => 'هذا الرقم مسجل بالفعل.',
            'ID.min' => 'رقم الهوية يجب ان يكون 15 رقم ',
            'ID.max' => 'رقم الهوية يجب ان يكون 15 رقم ',
        ];
    }
}

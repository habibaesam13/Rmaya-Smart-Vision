<?php

namespace App\Http\Requests\Public;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Sv_weapons;

class GroupRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'reg_type' => $this->input('reg_type', 'group'),
            'registration_date' => $this->input('registration_date', now()->toDateString()),
        ]);
    }

    public function rules(): array
    {
        return [
            'team_name' => ['required', 'string', 'max:255',
              Rule::unique('sv_teams', 'name'),
            ],

            'weapon_id' => [
                'required',
                Rule::exists('sv_weapons', 'wid')->where('reg_type', 'group'),
            ],

            'registration_date' => ['required', 'date'],

            // --- Members array ---
            'members' => ['required', 'array', 'min:1'],

            'members.*.ID' => [
                'required',
                'size:15',
                'regex:/^\d{15}$/',
                'distinct', // prevents duplicates within same request (team)
            ],
            'members.*.Id_expire_date' => ['required', 'date', 'after:today'],
            'members.*.name' => ['required', 'string', 'regex:/^[\p{Arabic}\s]+$/u'],
            'members.*.phone1' => ['required', 'regex:/^05\d{8}$/'],
            'members.*.dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(16)->toDateString(),
            ],
            'members.*.age' => ['nullable', 'numeric', 'min:16'],
            'members.*.front_id_pic' => [
                'nullable', // allow null if already in session
                function ($attribute, $value, $fail) {
                    $key = str_replace(['.', 'members'], ['[', 'members['], $attribute) . ']';
                    $tempFiles = session('temp_files', []);
                    if (
                        !$value &&  // not an uploaded file
                        !isset($tempFiles[$key]) // not in session
                    ) {
                        $fail('صورة الهوية الأمامية مطلوبة.');
                    }
                },
            ],
            'members.*.back_id_pic' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    $key = str_replace(['.', 'members'], ['[', 'members['], $attribute) . ']';
                    $tempFiles = session('temp_files', []);
                    if (
                        !$value &&
                        !isset($tempFiles[$key])
                    ) {
                        $fail('صورة الهوية الخلفية مطلوبة.');
                    }
                },
            ],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Only validate if team_name and members exist
            if ($this->filled('weapon_id') && is_array($this->members)) {
                $weapon = Sv_weapons::where('wid', $this->weapon_id)->first();

                if ($weapon && $weapon->number_of_members !== count($this->members)) {
                    $validator->errors()->add(
                        'members',
                        'عدد الأعضاء لا يطابق العدد المحدد للفريق (' . $weapon->number_of_members . ').'
                    );
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'team_name.required' => 'اسم الفريق مطلوب.',
            'team_name.unique' => 'يوجد اسم فريق اخر بنفس الأسم',
            'weapon_id.required' => 'السلاح مطلوب.',
            'weapon_id.exists' => 'السلاح المحدد غير موجود.',
            'registration_date.required' => 'تاريخ التسجيل مطلوب.',

            'members.required' => 'يجب إدخال بيانات الأعضاء.',
            'members.array' => 'بيانات الأعضاء غير صحيحة.',

            // Member-specific
            'members.*.ID.required' => 'رقم الهوية مطلوب.',
            'members.*.ID.regex' => 'رقم الهوية يجب أن يحتوي على 15 رقم فقط دون حروف أو رموز.',
            'members.*.ID.size' => 'رقم الهوية يجب أن يحتوي على 15 رقم فقط دون حروف أو رموز.',
            'members.*.ID.distinct' => 'لا يمكن تكرار رقم الهوية داخل نفس الفريق.',

            'members.*.Id_expire_date.required' => 'تاريخ انتهاء الهوية مطلوب.',
            'members.*.Id_expire_date.after' => 'تاريخ انتهاء الهوية يجب أن يكون بعد اليوم.',

            'members.*.name.required' => 'الاسم مطلوب.',
            'members.*.name.regex' => 'الاسم يجب أن يحتوي على أحرف عربية ومسافات فقط.',

            'members.*.phone1.required' => 'رقم الهاتف مطلوب.',
            'members.*.phone1.regex' => 'رقم الهاتف يجب أن يبدأ بـ 05 ويتكون من 10 أرقام فقط.',

            'members.*.dob.required' => 'تاريخ الميلاد مطلوب.',
            'members.*.dob.date' => 'تاريخ الميلاد غير صحيح.',
            'members.*.dob.before_or_equal' =>'العمر يجب ان يكون 16 سنة على الاقل',

            'members.*.front_id_pic.mimes' => 'الملف يجب أن يكون بصيغة jpg أو jpeg أو png أو pdf.',
            'members.*.front_id_pic.max' => 'حجم الملف لا يجب أن يزيد عن 2 ميجا.',
            'members.*.back_id_pic.mimes' => 'الملف يجب أن يكون بصيغة jpg أو jpeg أو png أو pdf.',
            'members.*.back_id_pic.max' => 'حجم الملف لا يجب أن يزيد عن 2 ميجا.',
        ];
    }
}

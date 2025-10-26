@extends('admin.master')
@php
use Carbon\Carbon;
@endphp
@section('content')
<div class="page-container">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-12">
            <h4 class="header-title"> تعديل بيانات {{$member->name}}
            </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif

            <form action="{{ route('personal.update',$member->mid) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <label for="ID" class="col-form-label">رقم بطاقة الهوية</label>
                        <input type="number" class="form-control text-center" name="ID" id="ID" value="{{ old('ID', $member->ID) }}">
                        @error('ID')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="expire-date" class="col-form-label">تاريخ انتهاء الهوية</label>
                        <input type="date" class="form-control" id="expire-date" name="Id_expire_date" value="{{ old('Id_expire_date', $member->Id_expire_date ? Carbon::parse($member->Id_expire_date)->format('Y-m-d') : '') }}">
                        @error('Id_expire_date')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="full-name" class="col-form-label">الاسم بالكامل</label>
                        <input type="text" class="form-control" id="full-name" name="name" value="{{ old('name', $member->name) }}">
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- تاريخ الميلاد + تاريخ انتهاء --}}
                    <div class="col-md-6">
                        <label for="birth-date" class="col-form-label">تاريخ الميلاد</label>
                        <input type="date" class="form-control" id="birth-date" name="dob" value="{{ old('dob', $member->dob ? Carbon::parse($member->dob)->format('Y-m-d') : '') }}">
                        @error('dob')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- الجنسية --}}
                    <div class="col-md-6">
                        <label for="nat" class="form-label">الجنسية</label>
                        <select name="nat" id="nat" class="form-select form-select-lg">
                            <option value="" disabled {{ old('nat') ? '' : 'selected' }}>اختر الجنسية</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ old('nat', $member->nat) == $country->id ? 'selected' : '' }}>
                                {{ $country?->country_name_ar ? $country->country_name_ar : $country->country_name }}
                            </option>
                            @endforeach
                        </select>
                        @error('nat')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- الجنس --}}
                    <div class="col-md-3 d-flex align-items-center gap-4">
                        <div>
                            <input id="male" type="radio" name="gender" value="male" {{ old('gender', $member->gender) == 'male' ? 'checked' : '' }}>
                            <label for="male">ذكر</label>
                        </div>
                        <div>
                            <input id="female" type="radio" name="gender" value="female" {{ old('gender', $member->gender) == 'female' ? 'checked' : '' }}>
                            <label for="female">أنثى</label>
                        </div>
                        @error('gender')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- العمر --}}
                    <div class="col-md-3">
                        <label for="age">العمر</label>
                        <input type="text" class="form-control" readonly id="age" value="{{ $member->dob ? Carbon::parse($member->dob)->age : '' }}">
                    </div>

                    {{-- Clubs --}}
                    <div class="col-md-6">
                        <label for="club_id" class="form-label">النادي</label>
                        <select name="club_id" id="club_id" class="form-select form-select-lg">
                            <option value="" disabled {{ old('club_id') ? '' : 'selected' }}>اختر النادي</option>
                            @foreach($clubs as $club)
                            <option value="{{ $club->cid }}" {{ old('club_id', $member->club_id) == $club->cid ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('club_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Weapons --}}
                    <div class="col-md-3">
                        <label for="weapon_id" class="form-label">السلاح</label>
                        <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                            <option value="" disabled selected>اختر النادي أولاً</option>
                            @if($member->weapon_id && $member->weapon)
                            <option value="{{ $member->weapon_id }}" selected>{{ $member->weapon->name }}</option>
                            @endif
                        </select>
                        @error('weapon_id')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="mgid" class="form-label">المجموعات</label>
                        <select name="mgid" id="mgid" class="form-select form-select-lg">
                            <option value="" >اختر المجموعة</option>
                            @foreach($memberGroups as $memberGroup)
                            <option value="{{ $memberGroup->mgid }}"
                                {{ old('mgid', $member->mgid) == $memberGroup->mgid ? 'selected' : '' }}>
                                {{ $memberGroup->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('mgid')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>


                    {{-- الهاتف --}}
                    <div class="col-md-6">
                        <label for="phone1" class="form-label">رقم الهاتف 1</label>
                        <input type="number" name="phone1" class="form-control" id="phone1" value="{{ old('phone1', $member->phone1) }}">
                        @error('phone1')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone2" class="form-label">رقم الهاتف 2</label>
                        <input type="number" name="phone2" class="form-control" id="phone2" value="{{ old('phone2', $member->phone2) }}">
                        @error('phone2')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- الصور --}}
                    <div class="col-md-6 position-relative">
                        <label for="front-id" class="form-label d-flex align-items-center justify-content-between">
                            <span>صورة الهوية الأمامية</span>

                            @if(!empty($member?->front_id_pic))
                            <a href="{{ asset('storage/' . $member->front_id_pic) }}"
                                target="_blank"
                                class="eye-icon"
                                title="عرض الصورة">
                                <i class="ri-eye-line"></i>
                            </a>
                            @endif
                        </label>

                        <input type="file" class="form-control" id="front-id" name="front_id_pic" accept=".jpg, .jpeg, .png">
                        @error('front_id_pic')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 position-relative">
                        <label for="back-id" class="form-label d-flex align-items-center justify-content-between">
                            <span>صورة الهوية الخلفية</span>

                            @if(!empty($member?->back_id_pic))
                            <a href="{{ asset('storage/' . $member->back_id_pic) }}"
                                target="_blank"
                                class="eye-icon"
                                title="عرض الصورة">
                                <i class="ri-eye-line"></i>
                            </a>
                            @endif
                        </label>

                        <input type="file" class="form-control" id="back-id" name="back_id_pic" accept=".jpg, .jpeg, .png">
                        @error('back_id_pic')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3">
                        <button type="submit" class="btn btn-primary rounded-pill px-3">
                            <i class="ri-save-line"></i> &nbsp;&nbsp;تعديل </button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .eye-icon {
        color: #bf1e2f;
        font-size: 1.3rem;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
    }

    .eye-icon:hover {
        color: #888;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clubSelect = document.getElementById('club_id');
        const weaponSelect = document.getElementById('weapon_id');
        const dobInput = document.getElementById('birth-date');
        const genderInputs = document.querySelectorAll('input[name="gender"]');
        const ageInput = document.getElementById('age');

        function loadWeapons() {
            const clubId = clubSelect.value;
            const dob = dobInput.value;
            const gender = [...genderInputs].find(input => input.checked)?.value;

            if (clubId && dob && gender) {
                weaponSelect.innerHTML = '<option value="" disabled selected>جاري التحميل...</option>';

                fetch(`/admin/clubs/${clubId}/weapons-by-age?dob=${dob}&gender=${gender}`)
                    .then(response => response.json())
                    .then(data => {
                        weaponSelect.innerHTML = '<option value="" disabled selected>اختر السلاح</option>';
                        data.weapons.forEach(weapon => {
                            const option = document.createElement('option');
                            option.value = weapon.wid;
                            option.textContent = weapon.name;
                            weaponSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        weaponSelect.innerHTML =
                            '<option value="" disabled selected>حدث خطأ في التحميل</option>';
                    });
            } else {
                weaponSelect.innerHTML = '<option value="" disabled selected>اختر النادي أولاً</option>';
            }
        }

        // Events
        clubSelect.addEventListener('change', loadWeapons);
        dobInput.addEventListener('change', loadWeapons);
        genderInputs.forEach(input => input.addEventListener('change', loadWeapons));

        // حساب العمر عند اختيار تاريخ الميلاد
        dobInput.addEventListener('change', function() {
            const dob = this.value;
            if (dob) {
                fetch(`{{ route('calculate.age') }}?dob=${dob}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.age !== null) {
                            ageInput.value = data.age;
                        } else {
                            ageInput.value = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        ageInput.value = '';
                    });
            } else {
                ageInput.value = '';
            }
        });
    });
</script>
@endsection
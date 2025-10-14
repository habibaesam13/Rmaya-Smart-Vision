@extends('admin.master') 
@section('content')
<div class="page-container">
  <div class="col-12 d-flex justify-content-between align-items-center my-3">
    <div class="col-md-12">
      <h4 class="header-title">التسجيل الفردى فى المسابقات
 </h4>
    </div>
  </div>
  <div class="card">
    <div class="card-body"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif 
    
        <form action="{{ route('personal-store') }}" method="POST" enctype="multipart/form-data"> 
    @csrf 
  
          <div class="row">
                        <div class="col-md-6">
                            <label for="ID" class="col-form-label">رقم بطاقة الهوية</label>
                            <input type="number" class="form-control text-center" name="ID" id="ID" value="{{ old('ID') }}">
                            @error('ID')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-6">
                            <label for="expire-date" class="col-form-label">تاريخ انتهاء الهوية</label>
                            <input type="date" class="form-control" id="expire-date" name="Id_expire_date" value="{{ old('Id_expire_date') }}">
                            @error('Id_expire_date')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-6">
                            <label for="full-name" class="col-form-label">الاسم بالكامل</label>
                            <input type="text" class="form-control" id="full-name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- تاريخ الميلاد + تاريخ انتهاء --}}
                        <div class="col-md-6">
                            <label for="birth-date" class="col-form-label">تاريخ الميلاد</label>
                            <input type="date" class="form-control" id="birth-date" name="dob" value="{{ old('dob') }}">
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
                                <option value="{{ $country->id }}" {{ old('nat') == $country->id ? 'selected' : '' }}>
                                    {{ $country?->country_name_ar ?: $country->country_name }}
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
                                <input id="male" type="radio" name="gender" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label for="male">ذكر</label>
                            </div>
                            <div>
                                <input id="female" type="radio" name="gender" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label for="female">أنثى</label>
                            </div>
                            @error('gender')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- العمر --}}
                        <div class="col-md-3">
                            <label for="age">العمر</label>
                            <input type="text" class="form-control" readonly id="age" value="{{ old('age') }}">
                        </div>
                        
                        {{-- Clubs --}}
                        <div class="col-md-6">
                            <label for="club_id" class="form-label">النادي</label>
                            <select name="club_id" id="club_id" class="form-select form-select-lg">
                                <option value="" disabled {{ old('club_id') ? '' : 'selected' }}>اختر النادي</option>
                                @foreach($clubs as $club)
                                <option value="{{ $club->cid }}" {{ old('club_id') == $club->cid ? 'selected' : '' }}>
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
                            </select>
                            @error('weapon_id')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                         <div class="col-md-3">
                            <label for="mgid" class="form-label">المجموعات</label>
                            <select name="mgid" id="mgid" class="form-select form-select-lg">
                                <option value="" disabled>اختر المجموعة</option>
                                @foreach($memberGroups as $memberGroup)
                                <option value="{{ $memberGroup->mgid }}" {{ old('mgid') == $memberGroup->mgid ? 'selected' : '' }}>
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
                            <input type="number" name="phone1" class="form-control" id="phone1" value="{{ old('phone1') }}">
                            @error('phone1')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone2" class="form-label">رقم الهاتف 2</label>
                            <input type="number" name="phone2" class="form-control" id="phone2" value="{{ old('phone2') }}">
                            @error('phone2')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- الصور --}}
                        <div class="col-md-6">
                            <label for="front-id" class="form-label">صورة الهوية الأمامية</label>
                            <input type="file" class="form-control" id="front-id" name="front_id_pic">
                            @error('front_id_pic')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="back-id" class="form-label">صورة الهوية الخلفية</label>
                            <input type="file" class="form-control" id="back-id" name="back_id_pic">
                            @error('back_id_pic')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                      <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3">
                          <button type="submit" class="btn btn-primary rounded-pill px-3">
               <i class="ri-save-line"></i> &nbsp;&nbsp;حفـــــــظ </button>
</div>


        </div>
      </form>
    </div>
  </div>
</div> @endsection
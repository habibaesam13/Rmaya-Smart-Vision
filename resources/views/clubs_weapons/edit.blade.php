@extends('admin.master')
@php
use Carbon\Carbon;
@endphp
@section('content')
<div class="page-container">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-12">
            <h4 class="header-title"> تعديل سلاح {{$club->name}} - {{$clubWeapon->weapon->name}}
            </h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif

            <form action="{{ route('clubs-weapons.update',  $clubWeapon->cwid) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- Hidden Club ID --}}
                <input type="hidden" name="cid" value="{{ $club->cid }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="name" class="form-label fw-bold">اختر السلاح </label>
                        <select name="wid" id="weapon_id" class="form-select form-select-lg" required>
                            <option value="" disabled {{ old('wid') ? '' : 'selected' }}>اختر السلاح</option>

                            @foreach($weapons as $weapon)
                            <option value="{{ $weapon->wid }}" {{ old('wid', $clubWeapon->wid) == $weapon->wid ? 'selected' : '' }}>
                                {{ $weapon->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('wid')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div>
                            <input id="male" type="radio" name="gender" value="male"
                                {{ old('gender', $clubWeapon->gender) == 'male' ? 'checked' : '' }}>
                            <label for="male">ذكر</label>
                        </div>
                        <div>
                            <input id="female" type="radio" name="gender" value="female"
                                {{ old('gender', $clubWeapon->gender) == 'female' ? 'checked' : '' }}>
                            <label for="female">أنثى</label>
                        </div>

                        @error('gender')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="age_from" class="form-label ">العمر من</label>
                        <input type="number" name="age_from" id="age_from" class="form-control text-center "
                            value="{{ old('age_from', $clubWeapon->age_from) }}" min="1" required placeholder="العمر من ">
                        @error('age_from')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="age_to" class="form-label">العمر إلى</label>
                        <input type="number" name="age_to" id="age_to" class="form-control text-center"
                            value="{{ old('age_to', $clubWeapon->age_to) }}" min="0" placeholder="العمر الي ">
                        @error('age_to')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="success_degree" class="form-label">العلامة المؤهلة</label>
                        <input type="number" name="success_degree" id="success_degree"
                            class="form-control text-center" value="{{ old('success_degree', $clubWeapon->success_degree) }}" min="0" max="100"
                            required placeholder="العلامه المؤهلة للتصفيات الاولية">
                        @error('success_degree')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-12 d-flex justify-content-start gap-2 my-2">
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                <i class="ri-search-2-line "></i>&nbsp;&nbsp;تعديل
                            </button>
                        </div>
                        <div class="col-md-1">
                            <a href="{{ route('clubs-weapons.index', ['cid' => $club->cid]) }}" class="btn btn-sm btn-warning w-100">
                                الغاء
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
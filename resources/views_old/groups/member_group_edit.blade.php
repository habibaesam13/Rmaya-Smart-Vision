@extends('admin.master')
@php
use Carbon\Carbon;
@endphp
@section('content')

<div class="page-container my-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-2">
                <i class="fas fa-edit text-success me-2" style="font-size:2rem !important"></i>
                تعديل بيانات {{$member->name}}
            </h2>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="form">
                <form action="{{ route('memeber-update',$member->mid) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        {{-- رقم الهوية + الاسم --}}
                        <div class="col-md-6">
                            <label for="ID" class="col-form-label">رقم بطاقة الهوية</label>
                            <input type="number" class="form-control text-center" name="ID" id="ID"
                                value="{{ old('ID', $member->ID) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="full-name" class="col-form-label">الاسم بالكامل</label>
                            <input type="text" class="form-control" id="full-name" name="name"
                                value="{{ old('name', $member->name) }}">
                        </div>

                        {{-- تاريخ الميلاد + تاريخ انتهاء --}}
                        <div class="col-md-6">
                            <label for="birth-date" class="col-form-label">تاريخ الميلاد</label>
                            <input type="date" class="form-control" id="birth-date" name="dob"
                                value="{{ old('dob', $member->dob ? Carbon::parse($member->dob)->format('Y-m-d') : '') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="expire-date" class="col-form-label">تاريخ انتهاء الهوية</label>
                            <input type="date" class="form-control" id="expire-date" name="Id_expire_date"
                                value="{{ old('Id_expire_date', $member->Id_expire_date ? Carbon::parse($member->Id_expire_date)->format('Y-m-d') : '') }}">
                        </div>


                        {{-- العمر --}}
                        <div class="col-md-12">
                            <label for="age">العمر</label>
                            <input type="text" class="form-control" readonly id="age"
                                value="{{ $member->dob ? Carbon::parse($member->dob)->age : '' }}">
                        </div>

                        {{-- الهاتف --}}
                        <div class="col-md-6">
                            <label for="phone1" class="form-label">رقم الهاتف 1</label>
                            <input type="number" name="phone1" class="form-control" id="phone1"
                                value="{{ old('phone1', $member->phone1) }}">
                        </div>
                        {{-- الصور --}}
                        <div class="col-md-6">
                            <label for="front-id" class="form-label">صورة الهوية الأمامية</label>
                            <input type="file" class="form-control" id="front-id" name="front_id_pic">
                        </div>
                        <div class="col-md-6">
                            <label for="back-id" class="form-label">صورة الهوية الخلفية</label>
                            <input type="file" class="form-control" id="back-id" name="back_id_pic">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">تعديل</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dobInput = document.getElementById('birth-date');
        const ageInput = document.getElementById('age');
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
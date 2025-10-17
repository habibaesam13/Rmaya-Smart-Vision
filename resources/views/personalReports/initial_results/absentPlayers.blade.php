@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">قائمة الافراد المتغيبين فى النتائج الاولية</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">
                <div class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">
                    <span class="badge badge-outline-primary"> عدد المتغيبين : {{ isset($absentPlayers)&&$absentPlayers ? $absentPlayers->total() : 0 }}</span>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
                    </p>
                    <div class="card bg-search ">
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <form action="{{ route('individuals-absent-preliminary-results') }}" method="get" class="card-body">
                            <div class="row g-3">
                                {{-- Clubs --}}
                                <div class="col-md-4">
                                    <!--<label for="club_id" class="form-label">النادي</label>-->
                                    <select name="club_id" id="club_id" class="form-select form-select-lg">
                                        <option value="" disabled {{ !request('club_id') ? 'selected' : '' }}>اختر النادي</option>
                                        @foreach($clubs as $club)
                                        <option value="{{ $club->cid }}" {{ request('club_id') == $club->cid ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- Weapons --}}
                                <div class="col-md-4">
                                    <!--<label for="weapon_id" class="form-label">السلاح</label>-->
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                                        <option value="" disabled selected>اختر السلاح </option>
                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}" {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}>
                                            {{ $weapon->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- nationality --}}
                                <div class="col-md-4">
                                    <!--<label for="nat" class="form-label">الجنسية</label>-->
                                    <select name="nat" id="nat" class="form-select form-select-lg">
                                        <option value="" disabled {{ !request('nat') ? 'selected' : '' }}>اختر الجنسية</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country?->country_name_ar ? $country->country_name_ar : $country->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- name --}}
                                <div class="col-md-4">
                                    <input class="form-control form-control-lg" type="text" name="q"
                                        placeholder="الاسم / رقم الهوية / رقم الهاتف" value="{{ request('q') }}">
                                </div>
                                <div class="col-md-3">
                                    <!--<label for="date-from" class="form-label">من</label>-->
                                    <input id="date-from" type="date" name="date_from" class="form-control form-control-lg"
                                        value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-3">
                                    <!--<label for="date-to" class="form-label">إلى</label>-->
                                    <input id="date-to" type="date" name="date_to" class="form-control form-control-lg"
                                        value="{{ request('date_to') }}">
                                </div>
                                {{-- Gender --}}
                                <div class="col-md-2 d-flex align-items-center justify-content-center gap-3">
                                    <div>
                                        <input id="male" type="radio" name="gender" value="male"
                                            {{ request('gender') == 'male' ? 'checked' : '' }}>
                                        <label for="male">ذكر</label>
                                    </div>
                                    <div>
                                        <input id="female" type="radio" name="gender" value="female"
                                            {{ request('gender') == 'female' ? 'checked' : '' }}>
                                        <label for="female">أنثى</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-12 mb-2" style="padding-top:8px">
                                <div class="g-1 row justify-content-center">
                                    <div class="col-12 col-lg-5 col-md-6 ">
                                        <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                            <i class="ri-search-2-line "></i>&nbsp;&nbsp;بحث
                                        </button>
                                    </div>
                                    <div class="col-12 col-lg-7 col-md-6">
                                        <a href="{{ url()->current() }}" class="btn btn-sm btn-warning w-100">
                                            اعادة ضبط
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>



                    {{-- Filtered Data --}}

                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <table class="table table-bordered mb-3">
                                <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>رقم الهوية</th>
                                        <th>الهاتف</th>
                                        <th>السلاح </th>
                                        <th>تاريخ الرماية</th>
                                        <th>رقم الديتيل</th>
                                        <th>تاريخ التسجيل</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                </thead>
                                {{-- table body --}}
                                <tbody>
                                    @forelse ($absentPlayers as $player)
                                    <tr>
                                        <td>{{ $player?->player?->name ?? '---' }}</td>
                                        <td>{{ $player?->player?->ID }}</td>
                                        <td>{{ $player?->player?->phone1 }}</td>
                                        <td>{{ $player?->report?->weapon?->name }}</td>
                                        <td>{{ $player?->report?->date}}</td>
                                        <td>{{ $player?->report?->details }}</td>
                                        <td>{{ $player?->player?->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $player?->notes ?? 'لا يوجد ملاحظات' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-3">
                                            @if(request()->has('search'))
                                            لا يوجد نتائج مطابقة للبحث
                                            @else
                                            لا يوجد رماة متغيبين
                                            @endif
                                        </td>
                                    </tr>
                                    @endforelse

                            </table>
                            {{-- Pagination --}}
                            @if ($absentPlayers->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $absentPlayers->links() }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">تقرير النتائج اليومية</h4>
            </div>
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card bg-search">
                        {{-- Search Form --}}
                        <form action="{{route('reports-details')}}" method="get" class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="weapons" class="form-label">الأسلحة</label>
                                    <select name="weapon_id" id="weapons" class="form-select form-select-lg">
                                        <option value="">اختر السلاح</option>
                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}"
                                            {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}>
                                            {{ $weapon->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="detail" class="form-label">رقم الديتيل</label>
                                    <input type="number" name="details" id="detail"
                                        value="{{ request('details') }}"
                                        class="form-control form-control-lg text-center" placeholder="أدخل رقم الديتيل">
                                </div>
                                <div class="col-md-3">
                                    <label for="date-from" class="form-label">من</label>
                                    <input id="date-from" type="date" name="date_from"
                                        class="form-control form-control-lg"
                                        value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="date-to" class="form-label">إلى</label>
                                    <input id="date-to" type="date" name="date_to"
                                        class="form-control form-control-lg"
                                        value="{{ request('date_to') }}">
                                </div>

                            </div>
                            <div class="col-md-12 d-flex justify-content-start gap-2 my-2">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                        <i class="fas fa-search me-2"></i>&nbsp;&nbsp;بحث
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-warning w-100">
                                        اعادة تعيين
                                    </a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>

                {{-- Registered Teams --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>التاريخ</th>
                                    <th>السلاح</th>
                                    <th>رقم الديتيل</th>
                                    <th>أدوات تحكم</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($ReportsDetails as $report)
                                <tr>
                                    <!-- <td>{{$report?->Rid}}</td> -->
                                    <td>{{ $report->date?->format('d-m-Y') }}</td>
                                    <td>{{ $report->weapon?->name ?? '-' }}</td>
                                    <td>{{ $report->details }}</td>
                                    <td class="text-center">
                                        <a href="{{route('report-members',$report->Rid)}}"
                                            class="icon-btn me-2"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="طباعة التقرير">
                                            <i class="ri-printer-line"></i>
                                        </a>

                                        {{-- Attached File Icon (shown only if exists) --}}
                                        <a href="{{ $report->attached_file ? asset('storage/' . $report->attached_file) : '#' }}"
                                            target="_blank"
                                            class="icon-btn {{ $report->attached_file ? '' : 'disabled' }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="عرض الملف المرفق">
                                            <i class="ri-attachment-line"></i>
                                        </a>
                                    </td>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-3">
                                        <i class="fas fa-info-circle me-2"></i> لا توجد نتائج مطابقة للبحث.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{-- Pagination --}}
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $ReportsDetails->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>

                <style>
                    .icon-btn {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 38px;
                        height: 38px;
                        border-radius: 8px;
                        background-color: #f8f9fa;
                        color: #0d6efd;
                        transition: all 0.2s ease-in-out;
                        text-decoration: none;
                    }

                    .icon-btn:hover {
                        background-color: #e9ecef;
                        color: #0a58ca;
                    }

                    .icon-btn.disabled {
                        opacity: 0.4;
                        pointer-events: none;
                    }
                </style>

                @endsection
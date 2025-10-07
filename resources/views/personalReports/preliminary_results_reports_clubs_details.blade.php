@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')

<div class="page-container my-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-0">
                <i class="ri-file-list-3-line text-primary me-2" style="font-size:2rem !important"></i>
                تقرير النتائج اليومية
            </h2>
            <hr>

            <form action="{{route('reports-details')}}" method="GET">
                <div class="row g-3 align-items-end">

                    {{-- Weapon + Details in same row --}}
                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <label for="detail" class="form-label">رقم الديتيل</label>
                        <input type="number" name="details" id="detail"
                            value="{{ request('details') }}"
                            class="form-control form-control-lg text-center" placeholder="أدخل رقم الديتيل">
                    </div>

                    {{-- Date From + To + Buttons in same row --}}
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

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-search me-2"></i>بحث
                        </button>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <a href="{{ url()->current() }}" class="btn btn-danger btn-lg w-100">
                            <i class="fas fa-undo me-2"></i>إعادة تعيين
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
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
                                <i class="fa-solid fa-print"></i>
                            </a>

                            {{-- Attached File Icon (shown only if exists) --}}
                            <a href="{{ $report->attached_file ? asset('storage/' . $report->attached_file) : '#' }}"
                                target="_blank"
                                class="icon-btn {{ $report->attached_file ? '' : 'disabled' }}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="عرض الملف المرفق">
                                <i class="fa-solid fa-file"></i>
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
        </div>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-4 d-flex justify-content-center">
    {{ $ReportsDetails->appends(request()->query())->links() }}
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
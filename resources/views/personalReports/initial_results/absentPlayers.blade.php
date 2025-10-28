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
                    <span class="badge badge-outline-primary">
                        عدد المتغيبين :
                        {{ $absentPlayers ? (method_exists($absentPlayers, 'total') ? $absentPlayers->total() : $absentPlayers->count()) : 0 }}

                    </span>

                    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  "><i class="ri-printer-line"></i> </a>
                    <!-- Excel Download Form -->
                    <form
                        action="{{ route('absent-personal-results-export-excel') }}"
                        method="post"
                        class="mb-0">
                        @csrf
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach

                        <button type="submit" class="btn btn-sm btn-success d-flex align-items-center justify-content-center" title="تحميل Excel">
                            <i class="ri-file-excel-line fs-5"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
                    </p>
                    <div class="card bg-search ">

                        <form action="{{ route('search-individuals-absent-preliminary-results') }}" method="get" class="card-body">
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
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg" required>
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
                                        <button type="submit" class="btn btn-sm btn-success mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                            <i class="ri-search-2-line "></i>&nbsp;&nbsp;بحث
                                        </button>
                                    </div>
                                    <div class="col-12 col-lg-7 col-md-6">
                                        <a href="{{ route('individuals-absent-preliminary-results') }}" class="btn btn-sm btn-primary w-100">
                                            <i class="ri-arrow-go-back-line me-1"></i>
                                            اعادة تعيين
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- Filtered Data --}}
                    <div class="card border-success mb-3 rounded-3 overflow-hidden">
                        @if(auth()->user()->clubid)
                        <div class="card-header">
                            <h5 class="mb-0 header-title">
                                <i class="ri-file-line me-2"></i>
                                إضافة تقرير يومي
                            </h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ isset($Edit_report) 
                                        ? route('update-report-registered-members', $Edit_report->Rid)
                                        : route('generate-report-registered-members') }}" method="POST" id="reportForm">

                                @csrf
                                <input type="text" hidden name='absent_report' value="1">
                                <div class="row g-3 align-items-end mb-3">
                                    <div class="col-md-4">
                                        <label for="date" class="form-label">التاريخ</label>
                                        <input type="date" name="date" id="report_date" class="form-control form-control-lg"
                                            required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="detail_number" class="form-label">رقم الديتيل</label>
                                        <input type="text" name="details" id="detail_number"
                                            class="form-control form-control-lg" placeholder="أدخل رقم الديتيل" required
                                            value="{{isset($Edit_report)?$Edit_report->details:''}}">
                                    </div>

                                    <div id="checkedMembersContainer" style="display:none;"></div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success btn-lg w-100" style="margin-bottom:20px">
                                            <i class="fas fa-save me-2"></i>
                                            {{ isset($Edit_report->Rid) ? 'تحديث التقرير' : 'حفظ التقرير' }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                            @if(isset($Edit_report))
                            <form action="{{ route('detailed-members-report-save', $Edit_report->Rid) }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg px-5">
                                    الرجوع للتقرير
                                </button>
                            </form>
                            @endif
                            @endif
                            <hr>
                            <table class="table table-bordered mb-3">
                                <thead class="bg-soft-primary">

                                    <tr>
                                        <th></th>
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
                                <tbody>
                                    @if(isset($absentPlayers) && $absentPlayers)
                                    @foreach ($absentPlayers as $player)

                                    <tr>
                                        <td>
                                            <input type="checkbox" class="member-checkbox" name="checkedMembers[]"
                                                value="{{ $player?->player?->mid }}">
                                        </td>
                                        <td>{{ $player?->player?->name ?? '---' }}</td>
                                        <td>{{ $player?->player?->ID }}</td>
                                        <td>{{ $player?->player?->phone1 }}</td>
                                        <td>{{ $player?->report?->weapon?->name }}</td>
                                        <td>{{ $player?->report?->date}}</td>
                                        <td>{{ $player?->report?->details }}</td>
                                        <td>{{ $player?->player?->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $player?->notes ?? 'لا يوجد ملاحظات' }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-3">
                                            @if(request()->has('search'))
                                            لا يوجد نتائج مطابقة للبحث
                                            @else
                                            لا يوجد رماة متغيبين
                                            @endif
                                        </td>
                                    </tr>
                                    @if(isset($Edit_report))
                                    <form action="{{ route('detailed-members-report-save', $Edit_report->Rid) }}" method="POST" class="mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-lg px-5">
                                            الرجوع للتقرير
                                        </button>
                                    </form>
                                    @endif
                                    @endif

                                </tbody>

                            </table>
                            <div id="pr" style="display:none">
                                @include('personalReports/initial_results/absentPlayers_print', ['members'=>@$absentPlayers_without_pag])
                            </div>
                            {{-- Pagination --}}
                            @if ($absentPlayers&&$absentPlayers->hasPages())
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
<script>
    document.getElementById("reportForm").addEventListener("submit", function(e) {
        const container = document.getElementById("checkedMembersContainer");
        container.innerHTML = "";

        document.querySelectorAll(".member-checkbox:checked").forEach(cb => {
            let hidden = document.createElement("input");
            hidden.type = "hidden";
            hidden.name = "checkedMembers[]";
            hidden.value = cb.value;
            container.appendChild(hidden);
        });
    });
</script>

<script>
    //date
    // Get the current date
    const today = new Date();

    // Format the date to 'YYYY-MM-DD' for the input type="date"
    const year = today.getFullYear();
    const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-indexed
    const day = today.getDate().toString().padStart(2, '0');

    const formattedDate = `${year}-${month}-${day}`;

    // Set the value of the input field
    document.getElementById('report_date').value = formattedDate;
</script>
@endsection
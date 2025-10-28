@extends('admin.master')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

    <div class="page-container my-4">
        {{-- Success Message --}}
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
        {{-- Header with Title and Export Buttons --}}
        {{--    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">--}}
        {{--        <h2 class="card-title mb-0">--}}
        {{--            <i class="ri-filter-line text-success me-2" style="font-size:2rem !important"></i>--}}
        {{--            قائمة الافراد المتأهلين للتصفيات النهائية--}}
        {{--        </h2>--}}

        {{--        --}}{{-- Export Buttons --}}
        {{--        <div class="documents d-flex gap-2">--}}
        {{--                    <span class="badge bg-light text-success d-flex align-items-center gap-2 px-3"--}}
        {{--                          style="height: 48px; font-size: 1rem;">--}}
        {{--                        عدد الأفراد المسجلين : {{$membersCount}}--}}
        {{--                    </span>--}}
        {{--            <form action="{{ isset($reportSection) && $reportSection--}}
        {{--                        ? route('personal.results.export.excel')--}}
        {{--                        : route('members.export.excel') }}" method="post" class="mb-0">--}}
        {{--                @csrf--}}
        {{--                @foreach(request()->query() as $key => $value)--}}
        {{--                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
        {{--                @endforeach--}}
        {{--                <button type="submit" class="btn btn-success btn-lg d-flex align-items-center gap-2">--}}
        {{--                    <i class="fa-solid fa-file-excel"></i>--}}
        {{--                    <span>طباعة اكسيل</span>--}}
        {{--                </button>--}}
        {{--            </form>--}}

        {{--            <form action="{{ isset($reportSection) && $reportSection--}}
        {{--                        ? route('personal-results-download-pdf')--}}
        {{--                        : route('members-download-pdf') }}" method="get" class="mb-0">--}}
        {{--                @foreach(request()->query() as $key => $value)--}}
        {{--                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
        {{--                @endforeach--}}
        {{--                <button type="submit" class="btn btn-danger btn-lg d-flex align-items-center gap-2">--}}
        {{--                    <i class="fa-solid fa-file-pdf"></i>--}}
        {{--                    <span>تحميل PDF</span>--}}
        {{--                </button>--}}
        {{--            </form>--}}
        {{--        </div>--}}
        {{--    </div>--}}

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title"> قائمة الافراد المتأهلين للتصفيات النهائية </h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">


                <div class="">

                <span class="badge badge-outline-primary">
                           عدد الأفراد المسجلين : {{$count}}  </span>


                    {{--                    <form title="Excel" action="{{ isset($reportSection) && $reportSection--}}
                    {{--                        ? route('personal.results.export.excel')--}}
                    {{--                        : route('members.export.excel') }}" method="post">--}}

                    {{--                        @csrf--}}
                    {{--                        @foreach(request()->query() as $key => $value)--}}
                    {{--                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
                    {{--                        @endforeach--}}
                    {{--                        <button type="submit" class="btn btn-sm btn-primary">--}}
                    {{--                            <i class="ri-file-excel-line"></i>--}}
                    {{--                        </button>--}}
                    {{--                    </form>--}}

                    {{--                    <form class="" action="{{ isset($reportSection) && $reportSection--}}
                    {{--                        ? route('personal-results-download-pdf')--}}
                    {{--                        : route('members-download-pdf') }}" method="get" class="mb-0">--}}
                    {{--                        @foreach(request()->query() as $key => $value)--}}
                    {{--                            <input type="hidden" name="{{ $key }}" value="{{ $value }}">--}}
                    {{--                        @endforeach--}}
                    {{--                        <button type="submit" class="btn btn-sm btn-primary  ">--}}
                    {{--                            <i class="ri-file-pdf-2-line"></i>--}}
                    {{--                        </button>--}}
                    {{--                    </form>--}}

                    {{--/**********excel btn**********/--}}
                    <span title="اكسيل" onclick="exportDivToExcel('pr', 'final_report.xlsx')"
                          target="_blank"
                          class="btn btn-sm btn-success  ">
                        <i class="ri-file-excel-line"></i>
                    </span>

                    {{--/*********excel brn**********/--}}

                    <span title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                </div>
                <!--
             <form action="http://127.0.0.1:8000/admin/results/personal/results/export-excel" method="post" class="mb-0">
                        <input type="hidden" name="_token" value="UW9MrfPWui5aQgJphReSi9VGYtVUVRVkimhRhJOE" autocomplete="off">                                                <button type="submit"  class="btn btn-sm btn-primary">
                           <i class="ri-file-excel-line"></i>

                        </button>
                    </form>

                     <form action="http://127.0.0.1:8000/admin/results/personal/results/download-pdf" method="get" class="mb-0">
                                                <button type="submit" class="btn btn-sm btn-primary ">
                            <i class="ri-file-pdf-2-line"></i>
                            <!--<span>تحميل PDF</span>-->
                <!--   </button>
                    </form>-->


                <!--<a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  ">
            <i class="ri-printer-line"></i>&nbsp;&nbsp;طباعة
          </a>-->
            </div>
        </div>


        {{-- Filter Form Section --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="card bg-search">
                    {{--                    <form action="{{ isset($reportSection) && $reportSection--}}
                    {{--                        ? route('search-results-registered-members')--}}
                    {{--                        : route('personal-registration') }}" method="get" class="card-body">--}}
                    <form action="{{ route('final_results.reports')}}" method="get" class="card-body">
                        @csrf
                        <div class="row g-3">

                            <!-------------start -->
                            @if( request()->addMembertoReportRid  > 0)   <input type='number' class='d-none'
                                                                                name='addMembertoReportRid'
                                                                                value='{{(int)request()->addMembertoReportRid}}'/> @endif
                        <!---end -->


                            <div class="col-md-4">
                                <!--<label for="club_id" class="form-label"> اختر النادي </label>-->
                                <select name="club_id" class="form-select">
                                    <option value="" {{ !request('club_id') ? 'selected' : '' }}>اختر النادي

                                    </option>
                                    @foreach($clubs as $club)
                                        <option value="{{ $club->cid }}"
                                            {{ request('reg_club') == $club->cid ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @if($reportSection)
                                {{-- Weapons --}}
                                <div class="col-md-4">
                                    <!--<label for="weapon_id" class="form-label">السلاح</label>-->
                                    <select name="weapon_id" required id="weapon_id" class="form-select">
                                        <option value="" selected>اختر السلاح</option>
                                        @foreach($weapons as $weapon)
                                            <option
                                                value="{{ $weapon->wid }}" {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}>
                                                {{ $weapon->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                {{-- Clubs --}}
                                <div class="col-md-4">
                                    <!--<label for="club_id" class="form-label">النادي</label>-->
                                    <select name="club_id" class="form-select">
                                        <option value="" disabled {{ !request('club_id') ? 'selected' : '' }}>اختر
                                            النادي
                                        </option>
                                        @foreach($clubs as $club)
                                            <option
                                                value="{{ $club->cid }}" {{ request('club_id') == $club->cid ? 'selected' : '' }}>
                                                {{ $club->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Weapons --}}
                                <div class="col-md-4">
                                    <!--<label for="weapon_id" class="form-label">السلاح</label>-->
                                    <select name="weapon_id" id="weapon_id" class="form-select">
                                        <option value="" disabled selected>اختر النادي أولاً</option>
                                    </select>
                                </div>
                            @endif


                            {{-- Countries --}}
                            <div class="col-md-4">
                                <!--<label for="nat" class="form-label">الجنسية</label>-->
                                <select name="nat" id="nat" class="form-select">
                                    <option value="" {{ !request('nat') ? 'selected' : '' }}>اختر الجنسية
                                    </option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">
                                            {{ $country?->country_name_ar ? $country->country_name_ar : $country->country_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Search Input --}}
                            <div class="col-md-4">
                                <input class="form-control" type="text" name="q"
                                       placeholder="الاسم / رقم الهوية / رقم الهاتف" value="{{ request('q') }}">
                            </div>


                            {{-- Member Groups --}}
{{--                            <div class="col-md-4">--}}
{{--                                --}}{{--                        <label for="mgid" class="form-label">المجموعات</label>--}}
{{--                                <select name="mgid" id="mgid" class="form-select">--}}
{{--                                    <option value="" selected>اختر المجموعة</option>--}}
{{--                                    @foreach($memberGroups as $memberGroup)--}}
{{--                                        <option value="{{ $memberGroup->mgid }}"--}}
{{--                                            {{ request('mgid') == $memberGroup->mgid ? 'selected' : '' }}>--}}
{{--                                            {{ $memberGroup->name }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            {{-- Gender --}}
                            <div class="col-md-4 d-flex align-items-center justify-content-center gap-3">
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

                            {{-- Dates + Registration Place in same row --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <!--<label for="date-from" class="form-label">من</label>-->
                                    <input id="date-from" type="date" name="date_from" class="form-control "
                                           value="{{ request('date_from') }}">
                                </div>
                                <div class="col-md-4">
                                    <!--<label for="date-to" class="form-label">إلى</label>-->
                                    <input id="date-to" type="date" name="date_to" class="form-control "
                                           value="{{ request('date_to') }}">
                                </div>
                            </div>


                            {{-- Search + Gender + Active on one row --}}
                            <div class="col-md-4">
                                <div class="row g-3 align-items-center">

                                    @if(!$reportSection)
                                        {{-- Active --}}
                                        <div class="col-md-4 d-flex align-items-center justify-content-center gap-3">
                                            <div>
                                                <input id="active" type="radio" name="active" value="true"
                                                    {{ request('active') == 'true' ? 'checked' : '' }}>
                                                <label for="active">مفعل</label>
                                            </div>
                                            <div>
                                                <input id="not-active" type="radio" name="active" value="false"
                                                    {{ request('active') == 'false' ? 'checked' : '' }}>
                                                <label for="not-active">غير مفعل</label>
                                            </div>
                                            <div>
                                                <input id="all" type="radio" name="active" value="all"
                                                    {{ request('active') == 'all' ? 'checked' : '' }}>
                                                <label for="all">الكل</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2 mb-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-search me-2"></i>بحث
                            </button>
                            <a href="{{ (request()->addMembertoReportRid  && request()->addMembertoReportRid > 0 ) ?  url()->current() . '?addMembertoReportRid=' . request()->addMembertoReportRid :   url()->current()  }}"
                               class="btn btn-primary"> <i class="fas fa-undo me-2"></i>إعادة ضبط </a>

                        </div>
                    </form>
                </div>


            </div>
        </div>


        {{-- Filtered Data --}}
        <div class="card shadow-sm border-0">
            <div class="card-body">
            <!-- @isset($addMembertoReportRid)
                <p>{{ $addMembertoReportRid}}</p>
            @endisset -->
                @if($reportSection)
                    <div class="card border-success mb-3 rounded-3 overflow-hidden">
                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                اضافة المتأهلين من التصفيات الاولية الى التصفيات النهائية
                            </h5>
                        </div>
                        <div class="card-body">
                            {{-- Success Message --}}
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

                            {{--                             <form action="{{ isset($Edit_report)--}}
                            {{--                        ? route('update-report-registered-members_final', $Edit_report->id)--}}
                            {{--                        : route('generate-report-registered-members_final') }}" method="POST" id="reportForm">--}}

                            @isset($Edit_report)
                                <form action="{{route('update-report-registered-members_final', $Edit_report->id)}}"
                                      method="post" id="reportForm">
                                    @csrf
                                    @method('put')

                                    @else
                                        <form action="{{  route('generate-report-registered-members_final') }}"
                                              method="POST" id="reportForm">
                                            @csrf
                            @endisset


                                            <div class="row g-3 align-items-end mb-3">
                                                <div class="col-md-4">
                                                    <label for="date" class="form-label">التاريخ</label>
                                                    <input type="date" name="date" id="report_date" class="form-control"
                                                           required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="detail_number" class="form-label">رقم الديتيل</label>
                                                    <input type="text" name="details" id="detail_number"
                                                           class="form-control" placeholder="أدخل رقم الديتيل" required
                                                           value="{{isset($Edit_report)?$Edit_report->details:''}}">
                                                </div>

                                                <div id="checkedMembersContainer" style="display:none;"></div>

                                                <div class="col-md-4">
                                                    <button type="submit" class="btn btn-success w-100"
                                                            style="margin-bottom: 20px;">
                                                        <i class="fas fa-save me-2"></i>
                                                        {{ isset($Edit_report->Rid) ? 'تحديث التقرير' : 'حفظ التقرير' }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>

                                        <hr>
                                        @isset($available_players)
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>الاسم</th>
                                                    <th>السلاح</th>

                                                    <th>رقم الهوية</th>
                                                    <th>الهاتف</th>
                                                    {{--                                <th>العمر</th>--}}
                                                    <th>نادي الرماية</th>
                                                    {{--                                <th>مكان التسجيل</th>--}}
                                                    {{--                                <th>الجنسية</th>--}}
                                                    {{--                                <th>المجموعات</th>--}}
                                                    <th>العلامة المكتسبة</th>
                                                    <th>الترتيب</th>

                                                    <th>تاريخ التسجيل</th>
                                                    {{--                                <th>ادوات تحكم</th>--}}
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @forelse($available_players  as  $key => $player)
                                                    <tr>
                                                        <td>

                                                            <input type="checkbox" class="member-checkbox"
                                                                   name="checkedMembers[]"
                                                                   value="{{ $player->mid }}">
                                                        </td>
                                                        <td>{{ $player->name }}</td>
                                                        <td>{{ $player->weapon_name }}</td>

                                                        <td>{{ $player->ID }}</td>
                                                        <td>{{ $player->phone1 ?? $player->phone2 }}</td>
                                                        {{--                                <td>{{ $player->age_calculation() }}</td>--}}
                                                        <td>{{ $player->club_name ?? '---' }}</td>
                                                        {{--                                <td>{{ $player->registrationClub?->name ?? '---' }}</td>--}}
                                                        {{--                                <td>--}}
                                                        {{--                                    {{ $player->nationality && trim($player->nationality->country_name_ar ?? '') !== ''--}}
                                                        {{--                                ? $player->nationality->country_name_ar--}}
                                                        {{--                                : (trim($player->nationality->country_name ?? '') !== ''--}}
                                                        {{--                                    ? $player->nationality->country_name--}}
                                                        {{--                                    : '---')--}}
                                                        {{--                            }}--}}
                                                        {{--                                </td>--}}
                                                        {{--                                <td>{{ $player->member_group?->name ?? '---' }}</td>--}}
                                                        <td>  {{  $player->total ?? 0}}</td>
                                                        <td>{{$arranging_arr[$key]}}</td>

                                                        <td>{{ $player->registration_date }}</td>

                                                        {{--                                <td>--}}
                                                        {{--                                    <div class="d-flex justify-content-center gap-3">--}}
                                                        {{--                                        --}}{{-- Edit Button --}}
                                                        {{--                                        <form action="{{route('personal.edit')}}" method="GET" class="d-inline">--}}
                                                        {{--                                            @csrf--}}
                                                        {{--                                            <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
                                                        {{--                                            <button type="submit" class="icon-btn text-warning" title="تعديل">--}}
                                                        {{--                                                <i class="fas fa-edit"></i>--}}
                                                        {{--                                            </button>--}}
                                                        {{--                                        </form>--}}
                                                        {{--                                        --}}{{-- Delete Button --}}
                                                        {{--                                        <form action="{{route('personal-registration-delete')}}" method="POST"--}}
                                                        {{--                                            class="d-inline"--}}
                                                        {{--                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">--}}

                                                        {{--                                            @csrf--}}
                                                        {{--                                            <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
                                                        {{--                                            @method('DELETE')--}}
                                                        {{--                                            <button type="submit" class="icon-btn text-danger" title="حذف">--}}
                                                        {{--                                                <i class="fas fa-trash-alt"></i>--}}
                                                        {{--                                            </button>--}}
                                                        {{--                                        </form>--}}

                                                        {{--                                        --}}{{-- Toggle Status Button --}}
                                                        {{--                                        <form action="{{route('personal-registration-toggle')}}" method="POST"--}}
                                                        {{--                                            class="d-inline">--}}
                                                        {{--                                            @csrf--}}
                                                        {{--                                            <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
                                                        {{--                                            <button type="submit" class="icon-btn text-success"--}}
                                                        {{--                                                title="{{ $player->active ? 'تعطيل' : 'تفعيل' }}">--}}
                                                        {{--                                                <i class="fas fa-{{ $player->active ? 'pause' : 'play' }}"></i>--}}
                                                        {{--                                            </button>--}}
                                                        {{--                                        </form>--}}
                                                        {{--                                    </div>--}}
                                                        {{--                                </td>--}}
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="12" class="text-center text-muted mt-3">
                                                            @if(request()->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']))
                                                                <p class="mt-3 w-100">لا توجد نتائج مطابقة لبحثك.</p>
                                                            @elseif(isset($Edit_report))
                                                                <p class="mt-3 w-100 m-auto">لا يوجد رماه لهم نفس السلاح
                                                                    - {{ $Edit_report?->weapon?->name ?? '---' }}</p>
                                                                {{--                                                @else--}}
                                                                {{--                                                    <p class="mt-3 w-100">لا يوجد رماة غير مضافين في تقارير.</p>--}}
                                                            @endif

                                                        </td>
                                                    </tr>
                                                @endempty

                                                </tbody>
                                            </table>
                                        @endisset
                                        @if( (request()->addMembertoReportRid  && request()->addMembertoReportRid > 0 )  || isset($Edit_report))
                                            <form
                                                action="{{ route('detailed-members-report-save_final', $Edit_report->id) }}"
                                                method="POST" class="mt-3 text-center">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-lg px-5">
                                                    الرجوع للتقرير
                                                </button>
                                            </form>
                                    @endif



                                    <!---------------start print part ----------------->
                                        <div id="pr" style="display:none">
                                            @include('personalReports.final_results.index_print' ,  ['available_players' => @$allavailable_players])
                                        </div>
                                        <!--------end print part ------>

                        </div>
                    </div>
                @else

                <!--<table class="table table-bordered">-->
                    <!--    <thead>-->
                    <!--    <tr>-->

                    <!--        <th>الاسم</th>-->
                    <!--        <th>رقم الهوية</th>-->
                    <!--        <th>الهاتف</th>-->
                    <!--        <th>العمر</th>-->
                    <!--        <th>السلاح</th>-->
                    <!--        <th>نادي الرماية</th>-->
                <!--        {{--                        <th>مكان التسجيل</th>--}}-->
                <!--        {{--                        <th>الجنسية</th>--}}-->
                    <!--        <th>المجموعات</th>-->
                    <!--        <th>تاريخ التسجيل</th>-->
                    <!--        <th>ادوات تحكم</th>-->
                    <!--    </tr>-->
                    <!--    </thead>-->

                    <!--    <tbody>-->

                <!--    @forelse($members as $member)-->
                    <!--        <tr>-->
                <!--            <td>{{ $member->name }}</td>-->
                <!--            <td>{{ $member->ID}}</td>-->
                <!--            <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>-->
                <!--            <td>{{ $member->age_calculation()}}</td>-->
                <!--            <td>{{ $member->weapon->name}}</td>-->
                <!--            <td>{{ $member->club?->name ?? '---' }}</td>-->
                <!--            {{--                        <td>{{ $member->registrationClub?->name ?? '---' }}</td>--}}-->
                <!--            {{--                        <td>--}}-->
                <!--            {{--                            {{ $member->nationality && trim($member->nationality->country_name_ar ?? '') !== ''--}}-->
                <!--            {{--                            ? $member->nationality->country_name_ar--}}-->
                <!--            {{--                            : (trim($member->nationality->country_name ?? '') !== ''--}}-->
                <!--            {{--                                ? $member->nationality->country_name--}}-->
                <!--            {{--                                : '---')--}}-->
                <!--            {{--                            }}--}}-->
                <!--            {{--                        </td>--}}-->


                <!--            {{--                        </td>--}}-->
                <!--            <td>{{ $member->member_group?->name ?? '---' }}</td>-->
                <!--            <td>{{ $member->registration_date}}</td>-->
                    <!--            <td>-->
                    <!--                <div class="d-flex justify-content-center gap-3">-->
                <!--                    {{-- Edit Button --}}-->
                <!--                    <form action="{{route('personal.edit')}}" method="GET" class="d-inline">-->
                    <!--                        @csrf-->
                <!--                        <input type="hidden" name="mid" value="{{ $member->mid }}">-->
                    <!--                        <button type="submit" class="icon-btn text-warning" title="تعديل">-->
                    <!--                            <i class="fas fa-edit"></i>-->
                    <!--                        </button>-->
                    <!--                    </form>-->
                <!--                    {{-- Delete Button --}}-->
                <!--                    <form action="{{route('personal-registration-delete')}}" method="POST"-->
                    <!--                          class="d-inline"-->
                    <!--                          onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">-->

                    <!--                        @csrf-->
                <!--                        <input type="hidden" name="mid" value="{{ $member->mid }}">-->
                <!--                        @method('DELETE')-->
                    <!--                        <button type="submit" class="icon-btn text-danger" title="حذف">-->
                    <!--                            <i class="fas fa-trash-alt"></i>-->
                    <!--                        </button>-->
                    <!--                    </form>-->

                <!--                    {{-- Toggle Status Button --}}-->
                <!--                    <form action="{{route('personal-registration-toggle')}}" method="POST"-->
                    <!--                          class="d-inline">-->
                    <!--                        @csrf-->
                <!--                        <input type="hidden" name="mid" value="{{ $member->mid }}">-->
                    <!--                        <button type="submit" class="icon-btn text-success"-->
                <!--                                title="{{ $member->active ? 'تعطيل' : 'تفعيل' }}">-->
                <!--                            <i class="fas fa-{{ $member->active ? 'pause' : 'play' }}"></i>-->
                    <!--                        </button>-->
                    <!--                    </form>-->
                    <!--                </div>-->
                    <!--            </td>-->
                    <!--        </tr>-->
                    <!--    @empty-->
                    <!--        <tr>-->
                    <!--            <td colspan="11" class="text-center text-muted">-->
                    <!--                لا توجد نتائج مطابقة للبحث-->
                    <!--            </td>-->
                    <!--        </tr>-->
                    <!--    @endforelse-->
                    <!--    </tbody>-->
                    <!--</table>-->
                    @endif
                    <div class="mt-4 d-flex justify-content-center">
                        {{--  <!--{{ $members->appends(request()->query())->links() }}-->   --}}
                    </div>

            </div>
        </div>
    </div>
    <style>
        .documents {
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        .documents .btn {
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .documents .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .documents .btn i {
            font-size: 1rem;
        }


        @media (max-width: 768px) {
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .documents {
                width: 100%;
                justify-content: flex-end;
            }

            .documents .btn {
                flex: 1;
                justify-content: center;
            }
        }

        .icon-btn {
            background: none;
            border: none;
            padding: 0;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .icon-btn:hover {
            opacity: 0.8;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clubSelect = document.getElementById('club_id');
            const weaponSelect = document.getElementById('weapon_id');

            clubSelect.addEventListener('change', function () {
                const clubId = this.value;

                // Clear weapons dropdown
                weaponSelect.innerHTML = '<option value="" disabled selected>جاري التحميل...</option>';

                if (clubId) {
                    // Fetch weapons for selected club
                    fetch(`{{ url('') }}/admin/clubs/${clubId}/weapons`)
                        .then(response => response.json())
                        .then(data => {
                            weaponSelect.innerHTML =
                                '<option value="" disabled selected>اختر السلاح</option>';

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
            });
        });
    </script>
    <script>
        document.getElementById("reportForm").addEventListener("submit", function (e) {
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

    <script>
        function printDiv(divId) {
            const content = document.getElementById(divId).innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write("<style> .hide_print{display:none !important;}@page { size: auto;  margin: 5mm; }.hide_print{display:none !important}.show_print{display:block !important}@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:5px;font-size:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}</style><style>@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}.table td th{border: 1px solid #ccc !important;} th{background:#cccccc69 !important; -webkit-print-color-adjust: exact !important;} h4,h3,h2,h1,h5 {text-align:right;}</style>");
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

    </script>

@endsection

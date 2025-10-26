@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">المسجلين افراد</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">
                <div class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">

                    <span class="badge badge-outline-primary"> عدد المسجلين : {{$membersCount}}</span>
                    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  " target="blank"><i class="ri-printer-line"></i> </a>
                    <!-- Excel Download Form -->
                    <form
                        action="{{ isset($reportSection) && $reportSection
                        ? route('personal.results.export.excel')
                        : route('members.export.excel') }}"
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

                    <!-- PDF Download Form -->
                    <form
                        action="{{ isset($reportSection) && $reportSection
                        ? route('personal-results-download-pdf')
                        : route('members-download-pdf') }}"
                        method="get"
                        class="mb-0">

                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" title="تحميل PDF">
                            <i class="ri-file-pdf-2-line fs-5"></i>
                        </button>
                    </form>

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
                        <form action="{{ isset($reportSection) && $reportSection
                        ? route('search-results-registered-members')
                        : route('personal-registration') }}" method="get" class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input class="form-control form-control-lg" type="text" name="q"
                                        placeholder="الاسم / رقم الهوية / رقم الهاتف" value="{{ request('q') }}">
                                </div>
                                {{-- Member Groups --}}
                                <div class="col-md-3">
                                    <!--<label for="mgid" class="form-label">المجموعات</label>-->
                                    <select name="mgid" id="mgid" class="form-select form-select-lg">
                                        <option value="" disabled selected>اختر المجموعة</option>
                                        @foreach($memberGroups as $memberGroup)
                                        <option value="{{ $memberGroup->mgid }}"
                                            {{ request('mgid') == $memberGroup->mgid ? 'selected' : '' }}>
                                            {{ $memberGroup->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($reportSection)
                                {{-- Weapons --}}
                                <div class="col-md-3">
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
                                @else
                                {{-- Clubs --}}
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <!--<label for="weapon_id" class="form-label">السلاح</label>-->
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                                        <option value="" disabled selected>اختر النادي أولاً</option>
                                    </select>
                                </div>
                                @endif
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <!--<label for="reg_club" class="form-label">مكان التسجيل</label>-->
                                    <select name="reg_club" id="reg_club" class="form-select form-select-lg">
                                        <option value="" disabled {{ !request('reg_club') ? 'selected' : '' }}>اختر مكان التسجيل
                                        </option>
                                        @foreach($clubs as $club)
                                        <option value="{{ $club->cid }}"
                                            {{ request('reg_club') == $club->cid ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                        @endforeach
                                    </select>
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
                                {{-- Registration Status --}}
                                <div class="col-md-4">
                                    <!--<label class="form-label">حالة التسجيل</label>-->
                                    <div class="d-flex align-items-center gap-4 mt-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="registered" name="reg"
                                                value="registered" {{ request('reg') == 'registered' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="registered">
                                                المسجلين المشاركين
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="not-registered" name="reg"
                                                value="not-registered" {{ request('reg') == 'not-registered' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="not-registered">
                                                المسجلين غير المشاركين
                                            </label>
                                        </div>
                                    </div>
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

                                @if(!$reportSection)
                                {{-- Active --}}
                                <div class="col-md-3 d-flex align-items-center justify-content-center gap-3">
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

                            {{-- Action Buttons --}}
                            <!--<div class="d-flex gap-2 mt-4"> <button type="submit" class="btn btn-success">
                                <i class="fas fa-search me-2"></i>بحث </button> <a href="{{ url()->current() }}"
                                class="btn btn-danger"> <i class="fas fa-undo me-2"></i>إعادة تعيين </a>
                            </div>-->
                        </form>



                    </div>



                    {{-- Filtered Data --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <!-- @isset($addMembertoReportRid)
                                <p>{{ $addMembertoReportRid}}</p>
                            @endisset -->
                            @if($reportSection)
                            <div class="card border-success mb-3 rounded-3 overflow-hidden">
                                <div class="card-header  text-white" style="background-color: #bf1e2f;">
                                    <h5 class="mb-0">
                                        <i class="fas fa-file-alt me-2"></i>
                                        إضافة تقرير يومي
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


                                    <form action="{{ isset($Edit_report)
                                        ? route('update-report-registered-members', $Edit_report->Rid)
                                        : route('generate-report-registered-members') }}" method="POST" id="reportForm">

                                        @csrf

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
                                                <button type="submit" class="btn btn-success btn-lg w-100">
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

                                    <hr>
                                    @isset($available_players)

                                    <table class="table table-bordered mb-3">
                                        <thead class="bg-soft-primary">

                                            <tr>
                                                <th></th>
                                                <th>الاسم</th>
                                                <th>رقم الهوية</th>
                                                <th>الهاتف</th>
                                                <th>العمر</th>
                                                <th>السلاح</th>
                                                <th>نادي الرماية</th>
                                                <th>مكان التسجيل</th>
                                                <th>الجنسية</th>
                                                <th>المجموعات</th>
                                                <th>تاريخ التسجيل</th>
                                                <th>ادوات تحكم</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($available_players as $player)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="member-checkbox" name="checkedMembers[]"
                                                        value="{{ $player->mid }}">
                                                </td>
                                                <td>{{ $player->name }}</td>
                                                <td>{{ $player->ID }}</td>
                                                <td>{{ $player->phone1 ?? $player->phone2 }}</td>
                                                <td>{{ $player->age_calculation() }}</td>
                                                <td>{{ $player->weapon->name }}</td>
                                                <td>{{ $player->club?->name ?? '---' }}</td>
                                                <td>{{ $player->registrationClub?->name ?? '---' }}</td>
                                                <td>
                                                    {{ $player->nationality && trim($player->nationality->country_name_ar ?? '') !== ''
                                                        ? $player->nationality->country_name_ar
                                                        : (trim($player->nationality->country_name ?? '') !== ''
                                                            ? $player->nationality->country_name
                                                            : '---')
                                                    }}
                                                </td>
                                                <td>{{ $player->member_group?->name ?? '---' }}</td>
                                                <td>{{ $player->registration_date }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        @if(checkModulePermission('members', 'edit'))
                                                        {{-- Edit Button --}}
                                                        <form action="{{route('personal.edit')}}" method="GET" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                                            <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="تعديل">
                                                                <i class="ri-edit-box-line fs-16"></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                        @if(checkModulePermission('members', 'delete'))
                                                        {{-- Delete Button --}}
                                                        <form action="{{route('personal-registration-delete')}}" method="POST"
                                                            class="d-inline"
                                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">

                                                            @csrf
                                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="حذف">
                                                                <i class="ri-delete-bin-line fs-16"></i>
                                                            </button>
                                                        </form>

                                                        @endif

                                                        @if(checkModulePermission('members', 'active'))

                                                        {{-- Toggle Status Button --}}
                                                        <form action="{{route('personal-registration-toggle')}}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                                            <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                              title="{{ $player->active ? 'الغاء التفعيل' : 'تفعيل' }}">
                                                                                                                                <!--<i class="fas fa-{{ $player->active ? 'pause' : 'play' }}"></i>-->
                                                                @if($club->active) <i class="ri-pause-line"></i> @else <i class="ri-play-line"></i> @endif
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>

                                            @empty
                                            <tr>
                                                <td colspan="12" class="text-center text-muted mt-3">
                                                    @if(request()->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']))
                                                    <p class="mt-3 w-100">لا توجد نتائج مطابقة لبحثك.</p>
                                                    @elseif(isset($Edit_report))
                                                    <p class="mt-3 w-100">لا يوجد رماه لهم نفس السلاح - {{ $Edit_report?->weapon?->name ?? '---' }}</p>
                                                    @else
                                                    <p class="mt-3 w-100">لا يوجد رماة غير مضافين في تقارير.</p>
                                                    @endif

                                                    @if(isset($Edit_report))
                                                    <form action="{{ route('detailed-members-report-save', $Edit_report->Rid) }}" method="POST" class="mt-3">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-lg px-5">
                                                            الرجوع للتقرير
                                                        </button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endempty

                                        </tbody>

                                    </table>
                                    <div id="pr" style="display:none">
                                        @include('members/registered_members_print', ['members'=>@$available_players])
                                    </div>
                                    @endisset
                                </div>
                            </div>

                            @else
                            <table class="table table-bordered mb-3">
                                <thead class="bg-soft-primary">

                                    <tr>

                                        <th>الاسم</th>
                                        <th>رقم الهوية</th>
                                        <th>الهاتف</th>
                                        <th>العمر</th>
                                        <th>السلاح</th>
                                        <th>نادي الرماية</th>
                                        <th>مكان التسجيل</th>
                                        <th>الجنسية</th>
                                        <th>المجموعات</th>
                                        <th>تاريخ التسجيل</th>
                                        <th>ادوات تحكم</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($members as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->ID}}</td>
                                        <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                                        <td>{{ $member->age_calculation()}}</td>
                                        <td>{{ $member->weapon->name}}</td>
                                        <td>{{ $member->club?->name ?? '---' }}</td>
                                        <td>{{ $member->registrationClub?->name ?? '---' }}</td>
                                        <td>
                                            {{ $member->nationality && trim($member->nationality->country_name_ar ?? '') !== ''
                                            ? $member->nationality->country_name_ar
                                            : (trim($member->nationality->country_name ?? '') !== ''
                                                ? $member->nationality->country_name
                                                : '---')
                                            }}
                                        </td>


                                        </td>
                                        <td>{{ $member->member_group?->name ?? '---' }}</td>
                                        <td>{{ $member->registration_date}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-1">


                                                @if(checkModulePermission('members', 'edit'))

                                                {{-- Edit Button --}}
                                                <form action="{{route('personal.edit')}}" method="GET" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="تعديل">
                                                        <i class="ri-edit-box-line fs-16"></i>
                                                    </button>
                                                </form>

                                                @endif
                                                @if(checkModulePermission('members', 'delete'))

                                                {{-- Delete Button --}}
                                                <form action="{{route('personal-registration-delete')}}" method="POST" class="d-inline"
                                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">

                                                    @csrf
                                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="حذف">
                                                        <i class="ri-delete-bin-line fs-16"></i>
                                                    </button>
                                                </form>

                                                @endif
                                                @if(checkModulePermission('members', 'active'))

                                                {{-- Toggle Status Button --}}
                                                <form action="{{route('personal-registration-toggle')}}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                        title="{{ $member->active ? 'تعطيل' : 'تفعيل' }}">
                                                        <!--<i class="fas fa-{{ $member->active ? 'pause' : 'play' }}"></i>-->
                                                        @if($club->active) <i class="ri-pause-line"></i> @else <i class="ri-play-line"></i> @endif
                                                    </button>
                                                </form>@endif
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            لا توجد نتائج مطابقة للبحث
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div id="pr" style="display:none">
                                @include('members/registered_members_print', ['members'=>@$members_without_pag])
                            </div>

                            @endif
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $members->appends(request()->query())->links() }}
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
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clubSelect = document.getElementById('club_id');
        const weaponSelect = document.getElementById('weapon_id');

        clubSelect.addEventListener('change', function() {
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

@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')

<div class="page-container my-4">
    {{-- Filter Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            {{-- Header with Title and Export Buttons --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="card-title mb-0">
                    <i class="ri-filter-line text-success me-2" style="font-size:2rem !important"></i>
                    تصفية البيانات
                </h2>

                {{-- Export Buttons --}}
                <div class="documents d-flex gap-2">
                    <span class="badge bg-light text-success d-flex align-items-center gap-2 px-3"
                        style="height: 48px; font-size: 1rem;">
                        عدد الأفراد المسجلين : {{$membersCount}}
                    </span>
                    <form action="{{ route('members.export.excel') }}" method="post" class="mb-0">
                        @csrf
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-success btn-lg d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-excel"></i>
                            <span>طباعة اكسيل</span>
                        </button>
                    </form>

                    <form action="{{ route('members-download-pdf') }}" method="get" class="mb-0">
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-danger btn-lg d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-pdf"></i>
                            <span>تحميل PDF</span>
                        </button>
                    </form>
                </div>
            </div>


            <form action="{{route('personal-registration')}}" method="get">
                <div class="row g-3">
                    {{-- Member Groups --}}
                    <div class="col-md-6">
                        <label for="mgid" class="form-label">المجموعات</label>
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

                    {{-- Registration Status --}}
                    <div class="col-md-6">
                        <label class="form-label">حالة التسجيل</label>
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

                    {{-- Countries --}}
                    <div class="col-md-4">
                        <label for="nat" class="form-label">الجنسية</label>
                        <select name="nat" id="nat" class="form-select form-select-lg">
                            <option value="" disabled {{ !request('nat') ? 'selected' : '' }}>اختر الجنسية</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}">
                                {{ $country?->country_name_ar ? $country->country_name_ar : $country->country_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Clubs --}}
                    <div class="col-md-4">
                        <label for="club_id" class="form-label">النادي</label>
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
                        <label for="weapon_id" class="form-label">السلاح</label>
                        <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                            <option value="" disabled selected>اختر النادي أولاً</option>
                        </select>
                    </div>

                    {{-- Search Input --}}
                    <div class="col-md-4">
                        <input class="form-control form-control-lg" type="text" name="q"
                            placeholder="الاسم / رقم الهوية / رقم الهاتف">
                    </div>

                    {{-- gender --}}
                    <div class="mb-3 col-md-4 d-flex align-items-center justify-content-center gap-3">
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
                        @error('gender')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- active --}}
                    <div class="mb-3 col-md-4 d-flex align-items-center justify-content-center gap-3">
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
                            <label for="all">الكل </label>
                        </div>
                    </div>

                    {{-- Dates + Registration Place in same row --}}
                    <div class="col-md-12 d-flex align-items-end gap-3">
                        <div class="col-md-3">
                            <label for="date-from" class="form-label">من</label>
                            <input id="date-from" type="date" name="date_from" class="form-control form-control-lg"
                                value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="date-to" class="form-label">إلى</label>
                            <input id="date-to" type="date" name="date_to" class="form-control form-control-lg"
                                value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="reg_club" class="form-label">مكان التسجيل</label>
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
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-2 mt-4"> <button type="submit" class="btn btn-success">
                        <i class="fas fa-search me-2"></i>بحث </button> <a href="{{ url()->current() }}"
                        class="btn btn-danger"> <i class="fas fa-undo me-2"></i>إعادة تعيين </a>
                </div>
            </form>



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
                <div class="card-header bg-success text-white">
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

                    <hr>
                    @isset($available_players)
                    <table class="table table-bordered">
                        <thead>
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
                                    <div class="d-flex justify-content-center gap-3">
                                        {{-- Edit Button --}}
                                        <form action="{{route('personal.edit')}}" method="GET" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                            <button type="submit" class="icon-btn text-warning" title="تعديل">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                        {{-- Delete Button --}}
                                        <form action="{{route('personal-registration-delete')}}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">

                                            @csrf
                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                            @method('DELETE')
                                            <button type="submit" class="icon-btn text-danger" title="حذف">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                        {{-- Toggle Status Button --}}
                                        <form action="{{route('personal-registration-toggle')}}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <input type="hidden" name="mid" value="{{ $player->mid }}">
                                            <button type="submit" class="icon-btn text-success"
                                                title="{{ $player->active ? 'تعطيل' : 'تفعيل' }}">
                                                <i class="fas fa-{{ $player->active ? 'pause' : 'play' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12" class="text-center text-muted mt-3">
                                    <p class="mt-3 w-100"> لا يوجد رماه لهم نفس السلاح - {{$Edit_report?->weapon?->name}}</p>
                                    <form action="{{ route('detailed-members-report-save', $Edit_report->Rid) }}"
                                        method="POST" class="mt-3">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-lg px-5">
                                            الرجوع للتقرير
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @endisset




                </div>
            </div>
            @else

            <table class="table table-bordered">
                <thead>
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
                            <div class="d-flex justify-content-center gap-3">
                                {{-- Edit Button --}}
                                <form action="{{route('personal.edit')}}" method="GET" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                    <button type="submit" class="icon-btn text-warning" title="تعديل">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                                {{-- Delete Button --}}
                                <form action="{{route('personal-registration-delete')}}" method="POST" class="d-inline"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">

                                    @csrf
                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn text-danger" title="حذف">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                {{-- Toggle Status Button --}}
                                <form action="{{route('personal-registration-toggle')}}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                    <button type="submit" class="icon-btn text-success"
                                        title="{{ $member->active ? 'تعطيل' : 'تفعيل' }}">
                                        <i class="fas fa-{{ $member->active ? 'pause' : 'play' }}"></i>
                                    </button>
                                </form>
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

@endsection
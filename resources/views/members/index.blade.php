@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')

<div class="page-container my-4">
    {{-- Filter Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-filter-line text-success me-2" style="font-size:2rem !important"></i>
                تصفية البيانات
            </h2>

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
                            @foreach($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ request('nat') == $country->id ? 'selected' : ( !request('nat') && $country->id == 222 ? 'selected' : '') }}>
                                {{ $country->country_name_ar ? $country->country_name_ar : $country->country_name }}
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
                <div class="d-flex gap-2 mt-4"> <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>بحث </button> <a href="{{ url()->current() }}"
                        class="btn btn-secondary"> <i class="fas fa-undo me-2"></i>إعادة تعيين </a>
                </div>
            </form>



        </div>
    </div>
    {{-- Filtered Data --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @if($members->count()>0)
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

                    @foreach($members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->ID}}</td>
                        <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                        <td>{{ $member->age_calculation()}}</td>
                        <td>{{ $member->weapon->name}}</td>
                        <td>{{ $member->club?->name ?? '---' }}</td>
                        <td>{{ $member->registrationClub?->name ?? '---' }}</td>
                        <td>{{ $member->nationality ? ($member->nationality->country_name_ar ?? $member->nationality->country_name) : '---' }}
                        </td>
                        <td>{{ $member->member_group?->name ?? '---' }}</td>
                        <td>{{ $member->registration_date}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                {{-- Edit Button --}}
                                <a href="" class="icon-btn text-warning" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
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
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">لا توجد أندية</h5>
                <p class="text-muted mb-0">ابدأ بإضافة أول نادي من النموذج أعلاه</p>
            </div>
            @endif
        </div>
    </div>
</div>

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

@endsection
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

            <form action="" method="GET">
                <div class="row g-3">
                    {{-- Member Groups --}}
                    <div class="col-md-6">
                        <label for="mgid" class="form-label">المجموعات</label>
                        <select name="mgid" id="mgid" class="form-select form-select-lg">
                            <option value="" disabled selected>اختر المجموعة</option>
                            @foreach($memberGroups as $memberGroup)
                            <option value="{{ $memberGroup->mgid }}" {{ request('mgid') == $memberGroup->mgid ? 'selected' : '' }}>
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
                                <input class="form-check-input" type="radio" id="registered" name="reg" value="registered" 
                                    {{ request('reg') == 'registered' ? 'checked' : '' }}>
                                <label class="form-check-label" for="registered">
                                    المسجلين المشاركين
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="not-registered" name="reg" value="not-registered"
                                    {{ request('reg') == 'not-registered' ? 'checked' : '' }}>
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
                            <option value="{{ $country->id }}" {{ request('nat') == $country->id ? 'selected' : '' }}>
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
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>بحث
                    </button>
                    <a href="{{ url()->current() }}" class="btn btn-secondary">
                        <i class="fas fa-undo me-2"></i>إعادة تعيين
                    </a>
                </div>
            </form>
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
                    weaponSelect.innerHTML = '<option value="" disabled selected>اختر السلاح</option>';
                    
                    data.weapons.forEach(weapon => {
                        const option = document.createElement('option');
                        option.value = weapon.wid;
                        option.textContent = weapon.name;
                        weaponSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    weaponSelect.innerHTML = '<option value="" disabled selected>حدث خطأ في التحميل</option>';
                });
        } else {
            weaponSelect.innerHTML = '<option value="" disabled selected>اختر النادي أولاً</option>';
        }
    });
});
</script>

@endsection
@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="page-container my-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-2">
                <i class="fas fa-edit text-success me-2" style="font-size:2rem !important"></i>
                تعديل بيانات {{$group->name}}
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

            {{-- Edit Form --}}
            <form action="{{ route('group-update', $group->tid) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">اسم الفريق</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $group->name) }}" placeholder="اكتب اسم الفريق">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
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
                <button type="submit" class="btn btn-primary px-4">تحديث</button>
                <a href="{{ route('group-registration') }}" class="btn btn-danger px-4 ms-2">إلغاء</a>
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
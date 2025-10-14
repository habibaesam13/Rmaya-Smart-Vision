@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-12">
            <h4 class="header-title"> تعديل بيانات {{$group->name}}</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body"> 
            @if (session('success')) 
            <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif
            {{-- Success Message --}}
            
            <form action="{{ route('group-update', $group->tid) }}" method="POST" class="form-horizontal">
                @csrf
                <div class="row mb-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-3">
                        <label for="name" class="form-label">اسم الفريق</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $group->name) }}"
                            placeholder="اكتب اسم الفريق">
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        {{-- Clubs --}}
                        <label for="club_id" class="form-label">النادي</label>
                        <select name="club_id" id="club_id" class="form-select form-select-lg">
                            <option value="" disabled {{ !request('club_id') ? 'selected' : '' }}>اختر النادي
                            </option>
                            @foreach($clubs as $club)
                            <option value="{{ $club->cid }}"
                                {{ request('club_id') == $club->cid ? 'selected' : '' }}>
                                {{ $club->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Weapons --}}
                    <div class="col-md-3">
                        <label for="weapon_id" class="form-label">السلاح</label>
                        <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                            <option value="" disabled selected>اختر النادي أولاً</option>
                        </select>
                    </div>
                    <div class="col-md-12 d-flex justify-content-start gap-2 my-2" style="padding-top:8px">
                        <div class="g-1 row justify-content-center">
                            <div class="col-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-info w-100">
                                    تحديث
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('group-registration') }}" class="btn btn-sm btn-warning w-100">
                                    الغاء
                                </a>
                            </div>
                        </div>
                    </div>
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
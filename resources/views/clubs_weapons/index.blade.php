@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')

<div class="page-container my-4">
    {{-- Add Club Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-shield-line text-success me-2" style="font-size:2rem !important"></i>
                أسلحة نادي {{ $club->name }}
            </h2>

            {{-- Error Message --}}
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>يرجى تصحيح الأخطاء أدناه
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Add Weapon Button --}}
            <div class="mb-4">
                <a href="{{ route('weapons.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>اضافة سلاح
                </a>

                {{-- Add Club Weapon Form --}}
                <form action="{{ route('clubs-weapons.store') }}" method="POST">
                    @csrf

                    {{-- Hidden Club ID --}}
                    <input type="hidden" name="cid" value="{{ $club->cid }}">

                    {{-- Weapon --}}
                    <div class="mb-3">
                        <label for="weapon_id" class="form-label">اختر السلاح</label>
                        <select name="wid" id="weapon_id" class="form-select form-select-lg" required>
                            <option value="" disabled {{ old('wid') ? '' : 'selected' }}>اختر السلاح</option>
                           
                            @foreach($weapons as $weapon)
                                <option value="{{ $weapon->wid }}" {{ old('wid') == $weapon->wid ? 'selected' : '' }}>
                                    {{ $weapon->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('wid')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="mb-3">
                        <label for="gender" class="form-label">النوع</label>
                        <select name="gender" id="gender" class="form-select" required>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Age From --}}
                    <div class="mb-3">
                        <label for="age_from" class="form-label">العمر من</label>
                        <input type="number" name="age_from" id="age_from" class="form-control"
                               value="{{ old('age_from') }}" min="1" required>
                        @error('age_from')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Age To --}}
                    <div class="mb-3">
                        <label for="age_to" class="form-label">العمر إلى</label>
                        <input type="number" name="age_to" id="age_to" class="form-control"
                               value="{{ old('age_to') }}" min="0">
                        @error('age_to')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Success Degree --}}
                    <div class="mb-3">
                        <label for="success_degree" class="form-label">العلامة المؤهلة</label>
                        <input type="number" name="success_degree" id="success_degree" class="form-control"
                               value="{{ old('success_degree') }}" min="0" max="100" required>
                        @error('success_degree')
                            <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </form>
            </div>
        </div>
    </div>


    {{-- Club Weapons Table Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-list-check-2 text-success me-2" style="font-size:2rem !important"></i>
                قائمة أسلحة نادي {{ $club->name }}
            </h2>

            {{-- Weapons Table --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>اسم السلاح</th>
                        <th>النوع</th>
                        <th>العمر من</th>
                        <th>العمر إلى</th>
                        <th>العلامة المؤهلة</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clubsWeapons as $clubWeapon)
                        <tr>
                            <td>{{ $clubWeapon->weapon->name }}</td>
                            <td>{{ $clubWeapon->gender }}</td>
                            <td>{{ $clubWeapon->age_from }}</td>
                            <td>{{ $clubWeapon->age_to }}</td>
                            <td>{{ $clubWeapon->success_degree }}</td>
                            <td>
                                <a href="{{ route('clubs-weapons.edit', [$club->cid, $clubWeapon->wid]) }}" class="btn btn-sm btn-warning">تعديل</a>
                                <form action="{{ route('clubs-weapons.destroy', [$club->cid, $clubWeapon->wid]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                <form action="{{ route('clubs-weapons.toggle-status', [$club->cid, $clubWeapon->wid]) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        {{ $clubWeapon->active ? 'تعطيل' : 'تفعيل' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

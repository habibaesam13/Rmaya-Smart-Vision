@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')

<div class="page-container my-4">
    {{-- Edit Club Weapon Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-shield-line text-success me-2" style="font-size:2rem !important"></i>
                تعديل سلاح نادي {{ $club->name }}
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

            {{-- Edit Club Weapon Form --}}
            <form action="{{ route('clubs-weapons.update', [$club->cid, $clubWeapon->wid]) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Hidden Club ID --}}
                <input type="hidden" name="cid" value="{{ $club->cid }}">

                {{-- Weapon --}}
                <div class="d-flex justify-content-between w-100 align-items-center">
                    <div class="mb-3 w-50">
                        <label for="weapon_id" class="form-label">اختر السلاح</label>
                        <select name="wid" id="weapon_id" class="form-select form-select-lg" required>
                            <option value="" disabled {{ old('wid', $clubWeapon->wid) ? '' : 'selected' }}>اختر السلاح</option>
                            @foreach($weapons as $weapon)
                            <option value="{{ $weapon->wid }}" {{ old('wid', $clubWeapon->wid) == $weapon->wid ? 'selected' : '' }}>
                                {{ $weapon->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('wid')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Gender --}}
                    <div class="mb-3 w-50 d-flex align-items-center justify-content-center gap-3">
                        <div>
                            <input id="male" type="radio" name="gender" value="male" {{ old('gender', $clubWeapon->gender) == 'male' ? 'checked' : '' }}>
                            <label for="male">ذكر</label>
                        </div>
                        <div>
                            <input id="female" type="radio" name="gender" value="female" {{ old('gender', $clubWeapon->gender) == 'female' ? 'checked' : '' }}>
                            <label for="female">أنثى</label>
                        </div>

                        @error('gender')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-3">

                    {{-- Age From --}}
                    <div class="mb-3 w-25">
                        <label for="age_from" class="form-label">العمر من</label>
                        <input type="number" name="age_from" id="age_from" class="form-control text-center"
                               value="{{ old('age_from', $clubWeapon->age_from) }}" min="1" required placeholder="العمر من">
                        @error('age_from')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Age To --}}
                    <div class="mb-3 w-25">
                        <label for="age_to" class="form-label">العمر إلى</label>
                        <input type="number" name="age_to" id="age_to" class="form-control text-center"
                               value="{{ old('age_to', $clubWeapon->age_to) }}" min="0" placeholder="العمر إلى">
                        @error('age_to')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Success Degree --}}
                    <div class="mb-3 w-25">
                        <label for="success_degree" class="form-label">العلامة المؤهلة</label>
                        <input type="number" name="success_degree" id="success_degree" class="form-control text-center"
                               value="{{ old('success_degree', $clubWeapon->success_degree) }}" min="0" max="100" required placeholder="العلامه المؤهلة للتصفيات الأولية">
                        @error('success_degree')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                
                {{-- Submit Button --}}
                <div>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                    <a href="{{ route('clubs-weapons.index', ['cid' => $club->cid]) }}" class="btn btn-secondary">إلغاء</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

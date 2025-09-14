@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')

<div class="page-container my-4">
    {{-- Add Club Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-shield-line text-success me-2" style="font-size:2rem !important"></i>
                أسلحة {{ $club->name }}
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
                    <div class="d-flex justify-content-between w-100  align-items-center">
                        <div class="mb-3 w-50">
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
                        <div class="mb-3 w-50 d-flex  align-items-center justify-content-center gap-3">
                            <div>
                                <input id="male" type="radio" name="gender" value="male"
                                    {{ old('gender') == 'male' ? 'checked' : '' }}>
                                <label for="male">ذكر</label>
                            </div>
                            <div>
                                <input id="female" type="radio" name="gender" value="female"
                                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                                <label for="female">أنثى</label>
                            </div>

                            @error('gender')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex gap-3 ">

                        {{-- Age From --}}
                        <div class="mb-3 w-25">
                            <label for="age_from" class="form-label ">العمر من</label>
                            <input type="number" name="age_from" id="age_from" class="form-control text-center "
                                value="{{ old('age_from') }}" min="1" required placeholder="العمر من ">
                            @error('age_from')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Age To --}}
                        <div class="mb-3 w-25">
                            <label for="age_to" class="form-label">العمر إلى</label>
                            <input type="number" name="age_to" id="age_to" class="form-control text-center"
                                value="{{ old('age_to') }}" min="0" placeholder="العمر الي ">
                            @error('age_to')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Success Degree --}}
                        <div class="mb-3 w-25">
                            <label for="success_degree" class="form-label">العلامة المؤهلة</label>
                            <input type="number" name="success_degree" id="success_degree"
                                class="form-control text-center" value="{{ old('success_degree') }}" min="0" max="100"
                                required placeholder="العلامه المؤهلة للتصفيات الاولية">
                            @error('success_degree')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit --}}

                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary  ">حفظ</button>

                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- Club Weapons Table Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="ri-list-check-2 text-success me-2" style="font-size:2rem !important"></i>
                قائمة أسلحة {{ $club->name }}
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
                        <td>{{ $clubWeapon->gender == "female" ? "إناث" : "ذكور" }}</td>
                        <td>{{ $clubWeapon->age_from }}</td>
                        <td>{{ $clubWeapon->age_to }}</td>
                        <td>{{ $clubWeapon->success_degree }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                {{-- Edit Button --}}
                                <a href="{{ route('clubs-weapons.edit', [$clubWeapon->cwid]) }}"
                                    class="icon-btn text-warning" title="تعديل">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- Delete Button --}}
                                <form action="{{ route('clubs-weapons.destroy',  $clubWeapon->cwid) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا السلاح؟');">

                                    @csrf
                                    <input type="hidden" name="cid" value="{{ $club->cid }}">
                                    @method('DELETE')
                                    <button type="submit" class="icon-btn text-danger" title="حذف"
                                       >
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                                {{-- Toggle Status Button --}}
                                <form action="{{ route('clubs-weapons.toggle-status', [$clubWeapon->cwid]) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="cid" value="{{ $club->cid }}">
                                    <button type="submit" class="icon-btn text-secondary"
                                        title="{{ $clubWeapon->active ? 'تعطيل' : 'تفعيل' }}" >
                                        <i class="fas fa-{{ $clubWeapon->active ? 'pause' : 'play' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
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

    
    @endsection
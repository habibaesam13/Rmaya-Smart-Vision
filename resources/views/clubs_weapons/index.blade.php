@extends('admin.master')
@section('content')
<div class="page-container ">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">أسلحة {{ $club->name }}</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">
                <!--<a title="{{__('lang.print')}}" onclick="printDiv('pr')" class="btn btn-sm btn-primary  ">
            <i class="ri-printer-line"></i>&nbsp;&nbsp;{{__('lang.print')}}
          </a>-->
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                @if(checkModulePermission('clubs', 'add'))
                <div class="card-body">
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
                    </p>
                    <div class="card bg-search">

                        {{-- Success Message --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif

                        {{-- Form --}}
                        <form action="{{ route('clubs-weapons.store') }}" method="POST" class="card-body">
                            @csrf
                            {{-- Hidden Club ID --}}
                            <input type="hidden" name="cid" value="{{ $club->cid }}">

                            <div class="row g-3 align-items-end">
                                <div class="col-md-9">
                                    <label for="name" class="form-label fw-bold">اختر السلاح </label>
                                    <select name="wid" id="weapon_id" class="form-select form-select-lg" required>
                                        <option value="" disabled {{ old('wid') ? '' : 'selected' }}>اختر السلاح</option>

                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}" {{ old('wid') == $weapon->wid ? 'selected' : '' }}>
                                            {{ $weapon->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('wid')
                                    <div class="invalid-feedback d-block">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
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
                                <div class="col-md-3">
                                    <label for="age_from" class="form-label ">العمر من</label>
                                    <input type="number" name="age_from" id="age_from" class="form-control text-center "
                                        value="{{ old('age_from') }}" min="1" required placeholder="العمر من ">
                                    @error('age_from')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="age_to" class="form-label">العمر إلى</label>
                                    <input type="number" name="age_to" id="age_to" class="form-control text-center"
                                        value="{{ old('age_to') }}" min="0" placeholder="العمر الي ">
                                    @error('age_to')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="success_degree" class="form-label">العلامة المؤهلة</label>
                                    <input type="number" name="success_degree" id="success_degree"
                                        class="form-control text-center" value="{{ old('success_degree') }}" min="0" max="100"
                                        required placeholder="العلامه المؤهلة للتصفيات الاولية">
                                    @error('success_degree')
                                    <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <div class="">
                                        <div class="col-12 col-lg-5 col-md-6 ">
                                            <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-300" name="search" value="اضافة ">
                                                <i class="fas fa-plus me-2"></i>&nbsp;&nbsp;حفظ
                                            </button>
                                        </div>
                                        <br>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @endif


                    {{-- Clubs Table Section --}}


                    @if($clubsWeapons->count() > 0)
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                        <div class="col-12 col-md-8 mb-2 mb-md-0">
                            <h4 class="header-title"> قائمة أسلحة {{ $club->name }}</h4>
                        </div>
                        <div class="col-12 col-md-4 text-md-end text-center">
                        </div>
                    </div>


                    <div class="table-responsive">
                        <table class="table table-bordered mb-3">
                            <thead class="bg-soft-primary">
                                <tr>
                                    <th>اسم السلاح</th>
                                    <th>النوع</th>
                                    <th>العمر من</th>
                                    <th>العمر إلى</th>
                                    <th>العلامة المؤهلة</th>
                                    <th>التحكم</th>
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
                                                class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="تعديل">
                                                <i class="ri-edit-box-line fs-16"></i>
                                            </a>
                                            {{-- Delete Button --}}
                                            <form action="{{ route('clubs-weapons.destroy',  $clubWeapon->cwid) }}" method="POST"
                                                class="d-inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا السلاح؟');">

                                                @csrf
                                                <input type="hidden" name="cid" value="{{ $club->cid }}">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="حذف">
                                                    <i class="ri-delete-bin-line fs-16"></i>
                                                </button>
                                            </form>

                                            {{-- Toggle Status Button --}}
                                            <form action="{{ route('clubs-weapons.toggle-status', [$clubWeapon->cwid]) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="cid" value="{{ $club->cid }}">
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                    title="{{ $clubWeapon->active ? 'إلغاء التفعيل' : 'تفعيل' }}"
                                                    data-bs-toggle="tooltip">
                                                    @if($clubWeapon->active) <i class="ri-pause-line"></i> @else <i class="ri-play-line"></i> @endif

                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        {{-- Bootstrap Tooltip Initialization --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            });
        </script>
        @endsection
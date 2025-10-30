
@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title">الأفراد المسجلين بفريق {{$group->name}} - سلاح : {{$group?->weapon?->name}} - نادي :
                        {{$group?->club?->name}}
                    </h4>
                </div>
                <div class="col-12 col-md-4 text-md-end text-center"></div>
            </div>

            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        @if($TeamMembers->count() > 0)
                            <table class="table table-bordered mb-3">
                                <thead class="bg-soft-primary">
                                <tr>
                                    <th scope="col" class="text-start">الاسم</th>
                                    <th>رقم الهوية</th>
                                    <th>الهاتف</th>
                                    <th>العمر</th>
                                    <th>السلاح</th>
                                    <!--<th>نادي الرماية</th>-->
                                    <!--<th>مكان التسجيل</th>-->
                                    <th>الجنسية</th>
                                    <th>تاريخ التسجيل</th>
                                    <th scope="col" class="text-center">ادوات تحكم</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($TeamMembers as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->ID}}</td>
                                        <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                                        <td>{{ $member->age_calculation()}}</td>
                                        <td>{{ $member->weapon->name}}</td>
                                    <!--<td>{{ $member->club?->name ?? '---' }}</td>-->
                                    <!--<td>{{ $member->registrationClub?->name ?? '---' }}</td>-->
                                        <td>
                                            {{ $member->nationality && trim($member->nationality->country_name_ar ?? '') !== ''
                                    ? $member->nationality->country_name_ar
                                    : (trim($member->nationality->country_name ?? '') !== ''
                                        ? $member->nationality->country_name
                                        : '---')
                                    }}
                                        </td>
                                        <td>{{ $member->registration_date}}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-3">
                                                {{-- Show Button --}}
                                                <form action="{{route('memeber-show' , $member->mid )}}" method="GET" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="عرض">
                                                        <i class="ri-eye-2-line fs-16"></i>
                                                    </button>
                                                </form>

                                                {{-- Edit Button --}}
                                                <form action="{{route('memeber-edit')}}" method="GET" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="تعديل">
                                                        <i class="ri-edit-box-line fs-16"></i>
                                                    </button>
                                                </form>
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

                                                {{-- Toggle Status Button --}}
                                                <form action="{{route('personal-registration-toggle')}}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="mid" value="{{ $member->mid }}">
                                                    <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                            title="{{ $member->active ? 'تعطيل' : 'تفعيل' }}">
                                                        <i class="ri-play-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted">
                                            لا يوجد أفراد مسجلين في الفريق
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-crosshairs fa-4x text-muted opacity-50"></i>
                                </div>
                                <h5 class="text-muted">
                                    لا يوجد أفراد مسجلين في الفريق</h5>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Bootstrap Tooltip Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection

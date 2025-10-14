{{-- dd($TeamMembers) --}}
@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="page-container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            <h2 class="card-title mb-4">
                <i class="fas fa-edit text-success me-2" style="font-size:2rem !important"></i>
                الأفراد المسجلين بفريق {{$group->name}} - سلاح : {{$group?->weapon?->name}} - نادي :
                {{$group?->club?->name}}
            </h2>

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
                        <th>تاريخ التسجيل</th>
                        <th>ادوات تحكم</th>
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
                        <td>{{ $member->registration_date}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                {{-- Edit Button --}}
                                <form action="{{route('memeber-edit')}}" method="GET" class="d-inline">
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
                            لا يوجد أفراد مسجلين في الفريق
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
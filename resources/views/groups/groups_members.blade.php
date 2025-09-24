{{-- dd($TeamMembers) --}}
@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="page-container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="fas fa-edit text-success me-2" style="font-size:2rem !important"></i>
                المسجلين فرق تفصيلي
            </h2>
            <form action="{{ route('groups-view-pdf') }}" method="get" class="mb-0">
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-danger btn-lg d-flex align-items-center gap-2">
                            <i class="fa-solid fa-file-pdf"></i>
                            <span>تحميل PDF</span>
                        </button>
                    </form>
            {{-- Search Form --}}
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('groups-members-search') }}" method="get">
                        @csrf
                        {{-- Weapon Selection --}}
                        <div class="mb-3">
                            <label for="weapon_id" class="form-label">السلاح</label>
                            <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                                <option value="" disabled selected>اختر السلاح</option>
                                @foreach($weapons as $weapon)
                                <option value="{{ $weapon->wid }}">{{ $weapon->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="team_name" class="form-label">اسم الفريق</label>
                                <input type="text" name="team_name" id="team_name" class="form-control form-control-lg">
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-search me-2"></i>بحث
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-danger btn-lg">
                                <i class="fas fa-undo me-2"></i>إعادة تعيين
                            </a>

                        </div>
                    </form>
                </div>
            </div>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>رقم الهوية</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>العمر</th>
                        <th>السلاح</th>
                        <th>اسم الفريق</th>
                        
                    </tr>
                </thead>

                <tbody>

                    @forelse($members as $member)
                    <tr>
                        <td>{{ $member->ID}}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                        <td>{{ $member->age_calculation()}}</td>
                        <td>{{ $member->weapon->name}}</td>
                        <td>{{ $member->team?->name ?? '---' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            لا  يوجد فرق مسجلة
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 d-flex justify-content-center">
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
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
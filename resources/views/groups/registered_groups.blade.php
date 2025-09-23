@extends('admin.master')
@section('content')
<div class="page-container my-4">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-2">
                <i class="fa-solid fa-circle-info text-success me-0" style="font-size:2rem !important"></i>
                المسجلين فرق
            </h2>

            <div class="col-md-4">
                <form action="{{ route('group-search') }}" method="get">
                    @csrf
                    <label for="weapon_id" class="form-label">السلاح</label>
                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                        <option value="" disabled selected>اختر السلاح</option>
                        @foreach($weapons as $weapon)
                        <option value="{{ $weapon->wid }}">{{ $weapon->name }}</option>
                        @endforeach
                    </select>

                    <!-- search for team  -->
                    <div class="search-team mt-3">
                        <label for="team_name" class="form-label">اسم الفريق</label>
                        <input type="text" name="team_name" id="team_name" class="form-control">

                        <div class="row mt-2">
                            <div class="col-md-3">
                                <label for="date-from" class="form-label">من</label>
                                <input id="date-from" type="date" name="date_from" class="form-control form-control-lg"
                                    value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-3">
                                <label for="date-to" class="form-label">إلى</label>
                                <input id="date-to" type="date" name="date_to" class="form-control form-control-lg"
                                    value="{{ request('date_to') }}">
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-search me-2"></i>بحث
                            </button>
                            <a href="{{ url()->current() }}" class="btn btn-danger">
                                <i class="fas fa-undo me-2"></i>إعادة تعيين
                            </a>
                            <button type="submit" formaction=""
                                class="btn btn-success btn-lg d-flex align-items-center gap-2">
                                <i class="fa-solid fa-file-excel"></i>
                                <span>طباعة اكسيل</span>
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- Registered Teams --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>اسم الفريق</th>
                        <th>السلاح</th>
                        <th>تاريخ التسجيل</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($groups as $group)
                    <tr>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->weapon?->name ?? '---' }}</td>
                        <td>{{ $group->createdAt}}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-3">
                                {{-- Edit Button --}}
                                <form action="" method="GET" class="d-inline"> @csrf <input type="hidden" name="mid"
                                        value="{{ $group->tid}}"> <button type="submit" class="icon-btn text-warning"
                                        title="تعديل"> <i class="fas fa-edit"></i> </button>
                                </form> {{-- Delete Button --}}
                                <form action="{{ route('group-registration')}}" method="POST" class="d-inline"
                                    onsubmit="return confirm('هل أنت متأكد من حذف هذا الفريق؟');"> @csrf <input
                                        type="hidden" name="tid" value="{{ $group->tid }}"> @method('DELETE') <button
                                        type="submit" class="icon-btn text-danger" title="حذف"> <i
                                            class="fas fa-trash-alt"></i> </button> </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            لا توجد نتائج مطابقة للبحث
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-4 d-flex justify-content-center">
                {{ $groups->appends(request()->query())->links() }}
            </div>

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
@endsection
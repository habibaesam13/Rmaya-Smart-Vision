@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">المسجلين فرق</h4>
                
            </div>
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="col-12 col-md-4 text-md-end text-center">
                <div class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">

                    <span class="badge badge-outline-primary"> عدد الفرق المسجلين : {{$groupsCount}}</span>
                    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  "><i class="ri-printer-line"></i> </a>
                    <!-- Excel Download Form -->
                    <form
                        action="{{route('groups.export.excel')}}"
                        method="post"
                        class="mb-0">
                        @csrf
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-success d-flex align-items-center justify-content-center" title="تحميل Excel">
                            <i class="ri-file-excel-line fs-5"></i>
                        </button>
                    </form>

                    <!-- PDF Download Form -->
                    <form
                        action="{{ route('download-groups-details-pdf') }}"
                        method="get"
                        class="mb-0">
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" title="تحميل PDF">
                            <i class="ri-file-pdf-2-line fs-5"></i>
                        </button>
                    </form>

                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
                    </p>
                    <div class="card bg-search">


                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        {{-- Search Form --}}
                        <form action="{{ route('group-search') }}" method="get" class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="weapon_id" class="form-label">السلاح</label>
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                                        <option value="" disabled selected>اختر السلاح</option>
                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}">{{ $weapon->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="team_name" class="form-label">اسم الفريق</label>
                                    <input type="text" name="team_name" id="team_name" class="form-control form-control-lg">
                                </div>
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
                            <div class="col-md-12 d-flex justify-content-start gap-2 my-2">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                        <i class="ri-search-2-line "></i>&nbsp;&nbsp;بحث
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-warning w-100">
                                        الغاء
                                    </a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>

                {{-- Registered Teams --}}
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <table class="table table-bordered mb-3">
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
                                    <td>{{ $group->created_at}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-3">
                                            @if(checkModulePermission('members_groups', 'show_mems'))
                                            <form action="{{route('group-members')}}" method="GET" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="tid" value="{{ $group->tid }}">
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="الأفراد">
                                                    <i class="ri-eye-line"></i>
                                                </button>
                                            </form>
                                            {{-- Edit Button --}}
                                            @endif
                                            @if(checkModulePermission('members_groups', 'edit'))
                                            <form action="{{route('group-edit')}}" method="GET" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="tid" value="{{ $group->tid}}">
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="تعديل">
                                                    <i class="ri-edit-box-line fs-16"></i>
                                                </button>
                                            </form>
                                            @endif
                                            @if(checkModulePermission('members_groups', 'delete'))
                                            {{-- Delete Button --}}
                                            <form action="{{ route('group-registration')}}" method="POST" class="d-inline"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذا الفريق؟');">
                                                @csrf
                                                <input type="hidden" name="tid" value="{{ $group->tid }}">
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="حذف">
                                                    <i class="ri-delete-bin-line fs-16"></i>
                                                </button>
                                                </button>
                                            </form>@endif
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
                        <div id="pr" style="display:none">
                            @include('groups/registered_groups_print', ['groups'=>@$groups_without_pag])
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $groups->appends(request()->query())->links() }}
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
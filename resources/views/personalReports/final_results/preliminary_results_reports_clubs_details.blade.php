@extends('admin.master')
@section('content')
    <div class="page-container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title">تقارير النتائح النهائية - الديتيل</h4>
                </div>
                <div class="col-12 col-md-4 text-md-end text-center">
                    <span class="badge badge-outline-primary"> عدد التقارير : {{count($ReportsDetails)}}</span>
                    <span  title="طباعة" onclick="printDiv('pr')"  class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>
                </div>
                 {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
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
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card bg-search">
                            {{-- Search Form --}}
                            <!--<form action="{{route('reports-details_absent_players_final')}}" method="get"-->
                                <form action="{{route('reports-details_players_final')}}" method="get"
                                  class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <!--<label for="weapons" class="form-label">الأسلحة</label>-->
                                        <select name="weapon_id" id="weapons" class="form-select form-select">
                                            <option value="">اختر السلاح</option>
                                            @foreach($weapons as $weapon)
                                                <option value="{{ $weapon->wid }}"
                                                    {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}>
                                                    {{ $weapon->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                            <!--<label for="detail" class="form-label">رقم الديتيل</label>-->
                                        <input type="number" name="details" id="detail"
                                               value="{{ request('details') }}"
                                               class="form-control form-control text-center"
                                               placeholder="أدخل رقم الديتيل">
                                    </div>
                                    <div class="col-md-3">
                                        <!--<label for="date-from" class="form-label">من</label>-->
                                        <input id="date-from" type="date" name="date_from"
                                               class="form-control form-control"
                                               value="{{ request('date_from') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <!--<label for="date-to" class="form-label">إلى</label>-->
                                        <input id="date-to" type="date" name="date_to"
                                               class="form-control form-control"
                                               value="{{ request('date_to') }}">
                                    </div>

                                </div>
                                <div class="col-md-12 d-flex justify-content-start gap-2 my-2">
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-sm btn-success mt-1 mt-md-0 mt-lg-0 w-100"
                                                name="search" value="بحث">
                                            <i class="ri-search-2-line"></i>&nbsp;&nbsp;بحث
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <a href="{{ url()->current() }}" class="btn btn-sm btn-primary w-100">

                                            اعادة ضبط
                                        </a>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>

                    {{-- Registered Teams --}}
                    <div class="card shadow-sm border-0" >
                        <div class="card-body">
                            <table class="table table-bordered mb-3">
                                <thead>
                                <tr>
                                    <th>التاريخ</th>
                                    <th>السلاح</th>
                                    <th>رقم الديتيل</th>
                                    <th>التحكم</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($ReportsDetails as $report)
                                    <tr>
                                    <!-- <td>{{$report?->Rid}}</td> -->
                                        <td>{{ date_create($report->date)->format('d-m-Y') }}</td>
                                        <td>{{ $report->weapon?->name ?? '-' }}</td>
                                        <td>{{ $report->details }}</td>
                                        <td class="text-center d-flex" style="justify-content: center" >
                                            <a href="{{route('report-members_final',$report->id)}}"
                                               class=" me-2"
                                               data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="طباعة التقرير">
                                                <i class="ri-printer-line icon-btn"></i>
                                            </a>

                                            <!-----delete-->
                                            <form action="{{route('final_reports_delete.delete' , $report->id)}}" method="post" style="background-color: transparent" >
                                                @csrf
                                                @method('delete')
                                            <span
                                                style="border: none; background-color: transparent" onclick="confirmSubmit(this)"
                                               class=" me-2"
                                               data-bs-toggle="tooltip"
                                               data-bs-placement="top"
                                               title="الغاء التقرير">
                                                <i class="ri-delete-bin-fill icon-btn"></i>
                                            </span>
                                            </form>

                                            {{-- Attached File Icon (shown only if exists) --}}
                                            {{--                                        <a href="{{ $report->file ? asset('storage/' . $report->file) : '#' }}"--}}
                                            @if($report->file)
                                                <a href="{{ asset(  $report->file)  }}"
                                                   target="_blank"
                                                   class="dis"
                                                   data-bs-toggle="tooltip"
                                                   data-bs-placement="top"
                                                   title="عرض الملف المرفق">
                                                    <i class="ri-attachment-line icon-btn"></i>
                                                </a>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle me-2"></i> لا توجد نتائج مطابقة للبحث.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                            {{-- Pagination --}}
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $ReportsDetails->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                    <style>
                        .icon-btn {
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            width: 38px;
                            height: 38px;
                            border-radius: 8px;
                            background-color: #f8f9fa;
                            color: #bf1e2f;
                            transition: all 0.2s ease-in-out;
                            text-decoration: none;
                        }

                        .icon-btn:hover {
                            background-color: #bf1e2f;
                            color: #f8f9fa;
                        }

                        .icon-btn.disabled {
                            opacity: 0.4;
                            pointer-events: none;
                        }

                        .dis.disabled {
                            opacity: 0.4;
                            pointer-events: none;
                        }
                    </style>




                    <!---------------start print part ----------------->
                    <div id="pr" style="display:none">
                        @include('personalReports/final_results/preliminary_results_reports_clubs_details_print' ,  ['ReportsDetails' => @$reportsDetailsWithoutPagination])
                    </div>
                    <!--------end print part ------>


                 </div>
            </div>
        </div>
    </div>
    <script>
        function confirmSubmit(object) {
           const check = window.confirm('هل انت متأكد من إلغاء هذا الديتيل ؟'   );
           if(check === true){
               object.parentElement.submit();
           }
        }
    </script>
@endsection

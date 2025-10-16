{{--@extends('admin.master')--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">--}}
{{--</script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>--}}
{{--<style>--}}

{{--</style>--}}
{{--@section('content')--}}
{{--    <div class="page-container my-4">--}}
{{--        --}}{{-- Success Message --}}
{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        --}}{{-- Header Card --}}
{{--        <div class="card shadow-sm border-0 mb-4">--}}
{{--            <div class="card-body">--}}
{{--                <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                    <h2 class="card-title mb-0">--}}
{{--                        <i class="ri-file-list-3-line text-primary me-2" style="font-size:2rem !important"></i>--}}
{{--                        final reports--}}
{{--                    </h2>--}}
{{--                </div>--}}

{{--                --}}{{-- Report Info --}}
{{--                <div class="row g-3 mb-4">--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="info-box bg-light p-3 rounded">--}}
{{--                            <label class="text-muted small mb-1">السلاح</label>--}}
{{--                            <h5 class="mb-0 text-dark"> rtrtrtrt</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="info-box bg-light p-3 rounded">--}}
{{--                            <label class="text-muted small mb-1">رقم الديتيل</label>--}}
{{--                            <h5 class="mb-0 text-dark">rtrtrt</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-4">--}}
{{--                        <div class="info-box bg-light p-3 rounded">--}}
{{--                            <label class="text-muted small mb-1">التاريخ</label>--}}
{{--                            <h5 class="mb-0 text-dark">rtttrtr</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                --}}{{-- Action Buttons --}}
{{--                <form class="d-flex flex-wrap gap-2" action="{{route('final_reports.index')}}"--}}
{{--                      method="get"--}}
{{--                      id="saveReportForm"--}}
{{--                      enctype="multipart/form-data">--}}
{{--                    @csrf--}}

                    {{-- report save --}}

{{--/************************************************old part **********************/--}}

@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

@section('content')
    <div class="page-container">
        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-12">
                <h4 class="header-title">@lang('lang.settings') </h4>
            </div>
        </div>
        <div class="card">
            <div class="card-body"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif

                <form action="{{route('final_reports.index')}}" method="get" enctype="multipart/form-data" id="saveReportForm" class="form-horizontal">
                    @csrf


{{--                    <div class="d-flex align-items-center gap-2">--}}
                    <div class="row g-3 align-items-end">
                    <input type="hidden" name="players_data" id="playersData">

                        <!-----start search------------->

                        <div class="row form">
                            {{-- الملف --}}
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select onchange="getClubs(this.value)" name="club_id"
                                            class="form-control form-control-sm">
                                        <option value="">اختر النادي .....</option>
                                        @foreach($clubs as $club)
                                            <option value="{{$club->cid}}">{{$club->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select name="weapon_id" required id="weaponSelect"
                                            class="form-control form-control-sm">
                                        <option value=""> اختر السلاح .....</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select name="rate"
                                            class="form-control form-control-sm">
                                        <option value="">فرز الترتيب .....</option>
                                        <option value="1">من الاول الى الأول</option>
                                        <option value="2">من الاول الى الثانى</option>
                                        <option value="3">من الاول الى الثالث</option>
                                        <option value="4">من الاول الى العشرون</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!----end search---------------->
                    <div class="row">
                        {{-- Print Button --}}
                        <div class="d-flex">
                            <div>
                                <a onclick="exportDivToExcel('printArea', 'final_report.xlsx')"
                                   target="_blank"
                                   class="btn btn-outline-dark  d-flex align-items-center gap-2">
                                    <i class="fas fa-print"></i>
                                    <span>طباعة</span>
                                </a>
                            </div>
                            <div>
                                <button onclick="printDiv('printArea')"
                                        class="btn btn-danger   d-flex align-items-center gap-2">
                                    <i class="fas fa-print"></i>
                                    <span>PDF</span>
                                </button>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <button type="submit" value="submit" class="btn btn-sm btn-warning"> Search</button>

                                    <a class="btn btn-sm btn-primary" href="{{route('final_reports.index')}}">
                                        Refresh </a>
                                </div>


                            </div>

                        </div>
                    </div>


                </form>
            </div>
        </div>

        {{-- Results Table Card --}}
        <div class="card shadow-sm border-0" id="printArea">
            <div class="card-body">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered ">
                        <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>الأسم</th>
                            <th>رقم الهوية</th>
                            <th>السلاح</th>
                            <th>علامة مكتسبة</th>
                            <th>علامة المتعادلين</th>
                            <th>الترتيب</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $current=0;
                            $last=count($res)-1;
                            $prevColor = 'white';
                            $currentColor = 'white';
                        @endphp
{{-- {{dd($sortedRatings )}}--}}
                            @forelse($res as $index => $item)
                                @php  $current = $index ;
                                if( $index > 0 && $index <= $last  && $item->total === $res[$index - 1]->total ){
                                    $currentColor = $prevColor;
                                }elseif($index == 0){
                                }else{
                                    $r = rand(0, 255);
                                    $g = rand(0, 255);
                                    $b = rand(0, 255);
                                    $currentColor = "rgb($r, $g, $b , 0.2)";
                                }
                                @endphp
                                {{--{{dd($sortedRatings[$index])}}--}}
                                <tr style="background-color: {{$currentColor}} !important;">
                                    <td class="text-center fw-bold">{{ $index + 1 }} </td>
                                    <td>{{$item->player_name}}</td>
                                    <td>{{$item->ID}}</td>
                                    <td>{{$item->weapon_name}}</td>
                                    <td class="fw_bold total-input">{{$item->total}}</td>
                                    {{-- goal --}}
                                    <td>
                                        <form class="d-flex"
                                              action="{{route('final_report_save_second_total.update' , $item->result_player_id)}}"
                                              method="get">
                                            @csrf
                                            <input type="number" name="second_total"
                                                   value="{{$item->second_total ?? 0}}" class="second_total" min="0"/>
                                            <label class="col">
                                                <input type="submit" value="save">
                                            </label>
                                        </form>
                                    </td>
                                    {{-- total --}}
                                    <td>
                                        {{   isset($sortedRatings[$index]   ) ? $sortedRatings[$index]   : ''  }}

                                                                            {{   isset($sortedRatings[$index] [(string) $item->total]   ) ? $sortedRatings[$index] [(string) $item->total] : ''  }}
                                    </td>

                                    {{-- notes --}}
                                    <td>
                                        {{$item->notes }}
                                    </td>


                                </tr>
                            @empty
                                <tr>
                                    <td colspan="18" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                        لا توجد بيانات لعرضها
                                    </td>
                                </tr>
                            @endforelse
                         </tbody>


                        </tbody>
                    </table>
                </div>
{{--                @else--}}
{{--                    <div class="text-center py-5">--}}
{{--                        <div class="mb-4">--}}
{{--                            <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>--}}
{{--                        </div>--}}
{{--                        <h5 class="text-muted">لا توجد أندية</h5>--}}
{{--                        <p class="text-muted mb-0">ابدأ بإضافة أول نادي من النموذج أعلاه</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
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
    {{-- Bootstrap Tooltip Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
@endsection

{{--                    </table>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <style>--}}
{{--        .info-box {--}}
{{--            border-left: 4px solid #97ca52;--}}
{{--            transition: all 0.3s ease;--}}
{{--        }--}}

{{--        .info-box:hover {--}}

{{--            transform: translateY(-2px);--}}
{{--            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);--}}
{{--        }--}}

{{--        .file-upload-wrapper {--}}
{{--            position: relative;--}}
{{--            min-width: 250px;--}}
{{--        }--}}

{{--        .file-upload-wrapper input[type="file"] {--}}
{{--            height: 48px;--}}
{{--            padding: 0.75rem;--}}
{{--        }--}}

{{--        .btn {--}}
{{--            transition: all 0.2s ease-in-out;--}}
{{--            white-space: nowrap;--}}
{{--        }--}}

{{--        .btn:hover {--}}
{{--            transform: translateY(-2px);--}}
{{--            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);--}}
{{--        }--}}

{{--        .table th {--}}

{{--            font-weight: 600;--}}
{{--        }--}}

{{--        .table td {--}}
{{--            vertical-align: middle;--}}
{{--        }--}}

{{--        .score-input {--}}
{{--            text-align: center;--}}
{{--            font-weight: 600;--}}
{{--            padding: 0.375rem;--}}
{{--        }--}}

{{--        .total-input {--}}
{{--            text-align: center;--}}
{{--            font-weight: bold;--}}
{{--            color: #0d6efd;--}}
{{--            font-size: 1.1rem;--}}
{{--        }--}}

{{--        .score-input:focus {--}}
{{--            border-color: #0d6efd;--}}
{{--            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);--}}
{{--        }--}}

{{--        .icon-btn {--}}
{{--            background: none;--}}
{{--            border: none;--}}
{{--            padding: 0;--}}
{{--            font-size: 1.2rem;--}}
{{--            cursor: pointer;--}}
{{--        }--}}

{{--        .icon-btn:hover {--}}
{{--            opacity: 0.8;--}}
{{--        }--}}

{{--        @media (max-width: 768px) {--}}
{{--            .d-flex.flex-wrap.gap-2 {--}}
{{--                flex-direction: column;--}}
{{--            }--}}

{{--            .d-flex.flex-wrap.gap-2 form,--}}
{{--            .d-flex.flex-wrap.gap-2 .file-upload-wrapper {--}}
{{--                width: 100%;--}}
{{--            }--}}

{{--            .d-flex.flex-wrap.gap-2 button {--}}
{{--                width: 100%;--}}
{{--                justify-content: center;--}}
{{--            }--}}
{{--        }--}}

{{--        .table-responsive {--}}
{{--            border-radius: 2px;--}}
{{--        }--}}

{{--        tbody tr:hover {--}}
{{--            background-color: #f8f9fa;--}}
{{--        }--}}

{{--    </style>--}}


{{--    <script>--}}
{{--        function getClubs(club) {--}}
{{--            weaponSelect.innerHTML = "<option value=''>  اختر سلاح ..... </option>";--}}

{{--            $.ajax({--}}
{{--                type: 'GET',--}}
{{--                url: "{{url("/admin/final-results/get-weapons/")}}" + '/' + club, // clean interpolation--}}
{{--                --}}{{--data:'_token = <?php echo csrf_token() ?>',--}}
{{--                success: function (data) {--}}
{{--                    let innerTxt = '';--}}
{{--                    let weaponSelect = document.getElementById('weaponSelect');--}}
{{--                    data.weapons.forEach(function (item) {--}}
{{--                        innerTxt += "<option value='" + item.wid + "'>" + item.name + "</option>";--}}
{{--                    });--}}

{{--                    if (data.weapons.length > 0) {--}}
{{--                        weaponSelect.innerHTML = innerTxt;--}}
{{--                    } else {--}}
{{--                        weaponSelect.innerHTML = "<option value=''> لا توجد اسلحة </option>";--}}

{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}


{{--    <script>--}}
{{--        function printDiv(divId) {--}}
{{--            let printContents = document.getElementById(divId).innerHTML;--}}
{{--            let originalContents = document.body.innerHTML;--}}

{{--            document.body.innerHTML = printContents;--}}
{{--            window.print();--}}

{{--            document.body.innerHTML = originalContents; // restore the page--}}
{{--        }--}}


{{--        // Print only a certain div--}}
{{--        function printDiv(divId) {--}}
{{--            const printContents = document.getElementById(divId).innerHTML;--}}
{{--            const originalContents = document.body.innerHTML;--}}

{{--            // Open a new window for printing — cleaner and safer--}}
{{--            const printWindow = window.open('', '', 'height=600,width=800');--}}
{{--            printWindow.document.write('<html><head><title>Print</title>');--}}
{{--            // Optional: add your styles for the print page--}}
{{--            printWindow.document.write('<style>body{font-family: Arial; padding:20px;} table{width:100%;border-collapse:collapse;} td,th{border:1px solid #000;padding:6px;text-align:center;}</style>');--}}
{{--            printWindow.document.write('</head><body>');--}}
{{--            printWindow.document.write(printContents);--}}
{{--            printWindow.document.write('</body></html>');--}}
{{--            printWindow.document.close();--}}
{{--            printWindow.print();--}}
{{--        }--}}

{{--        // Export div content to Excel--}}
{{--        function exportDivToExcel(divId, filename = 'report.xlsx') {--}}
{{--            const div = document.getElementById(divId);--}}
{{--            if (!div) return alert("Div not found!");--}}

{{--            // If div contains a table — convert it directly--}}
{{--            const table = div.querySelector("table");--}}
{{--            if (!table) return alert("No table found inside the div!");--}}

{{--            // Convert the HTML table into a worksheet--}}
{{--            const ws = XLSX.utils.table_to_sheet(table);--}}

{{--            // Create a new workbook--}}
{{--            const wb = XLSX.utils.book_new();--}}
{{--            XLSX.utils.book_append_sheet(wb, ws, "Report");--}}

{{--            // Download as .xlsx--}}
{{--            XLSX.writeFile(wb, filename);--}}
{{--        }--}}

{{--    </script>--}}




{{--@endsection--}}

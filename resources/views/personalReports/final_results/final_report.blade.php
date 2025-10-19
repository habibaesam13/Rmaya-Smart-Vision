@extends('admin.master')

@section('content')

{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <div class="page-container">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">نتيجة التصفيات النهائية</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">
                <div
                    class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">

                    <span class="badge badge-outline-primary"> عدد التقارير : {{count($res)}}</span>


                    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  "><i
                            class="ri-printer-line"></i> </a>


                </div>
            </div>

        </div>


        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 "
                           style="display: none;">&nbsp;</a>
                    </p>

                    <div class="card bg-search py-2">
                        <div class="card-body"> @if (session('success'))
                                <div
                                    class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error'))
                                <div
                                    class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning'))
                                <div
                                    class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>@endforeach <br>@endif

                            <form action="{{route('final_reports.index')}}" method="get" enctype="multipart/form-data"
                                  id="saveReportForm" class="form-horizontal">
                                @csrf


                                {{--                    <div class="d-flex align-items-center gap-2">--}}
                                <div class="row g-3 align-items-end">
                                    <input type="hidden" name="players_data" id="playersData">

                                    <!-----start search------------->

                                    <div class="row form">

                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <select name="weapon_id" required id="weaponSelect"
                                                        class="form-control form-control-sm">
                                                    <option value=""> اختر السلاح .....</option>
                                                    @foreach($weapons as $weapon)
                                                        <option
                                                            {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}  value="{{$weapon->wid}}">{{$weapon->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <select name="club_id"
                                                        class="form-control form-control-sm">
                                                    <option {{ request('club_id') === "" ? 'selected' : '' }} value="">
                                                        اختر النادي .....
                                                    </option>
                                                    @foreach($clubs as $club)
                                                        <option
                                                            {{ request('club_id') == $club->cid ? 'selected' : '' }}   value="{{$club->cid}}">{{$club->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <select name="rate_limiting"
                                                        class="form-control form-control-sm">
                                                    <option value="">فرز الترتيب .....</option>
                                                    <option
                                                        {{ request('rate_limiting') == 1 ? 'selected' : '' }}   value="1">
                                                        من الاول الى الأول
                                                    </option>
                                                    <option
                                                        {{ request('rate_limiting') == 2 ? 'selected' : '' }}   value="2">
                                                        من الاول الى الثانى
                                                    </option>
                                                    <option
                                                        {{ request('rate_limiting') == 3 ? 'selected' : '' }}   value="3">
                                                        من الاول الى الثالث
                                                    </option>
                                                    <option
                                                        {{ request('rate_limiting') == 20 ? 'selected' : '' }}   value="20">
                                                        من الاول الى العشرون
                                                    </option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <input name="search" value="{{ request('search')}}"
                                                       placeholder="ألاسم / رقم الهوية / رقم الهاتف"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <div class="d-flex">
                                                    <label>تاريخ الديتيل</label>
                                                    <input name="details_date" value="{{ request('details_date')}}"
                                                           type="date"
                                                           class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-4">
                                            <div class="file-upload-wrapper p-1">
                                                <div class="d-flex">
                                                    <label>مجموع العلامة المكتسبة</label>
                                                    <input name="total" value="{{ request('total')}}" type="number"
                                                           min="0"
                                                           class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <!----end search---------------->
                                <div class="row">
                                    {{-- Print Button --}}
                                    <div class="d-flex">
                                        {{--                            <div>--}}
                                        {{--                            </div>--}}
                                        <div class="col-8 ">
                                            <div class="file-upload-wrapper p-1 d-flex">
                                                {{--                                    <a onclick="exportDivToExcel('printArea', 'final_report.xlsx')"--}}
                                                {{--                                       target="_blank"--}}
                                                {{--                                       class="btn btn-outline-dark btn-sm  d-flex align-items-center gap-2 ml">--}}
                                                {{--                                        <i class="fas fa-print"></i>--}}
                                                {{--                                        <span>طباعة</span>--}}
                                                {{--                                    </a>--}}

                                                <button type="submit" value="submit" class="btn btn-sm btn-warning ml">
                                                    بحث
                                                </button>

                                                <a class="btn btn-sm btn-primary ml"
                                                   href="{{route('final_reports.index')}}">
                                                    اعادة ضبط </a>
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
                                                <form class="d-flex "
                                                      action="{{route('final_report_save_second_total.update' , $item->result_player_id)}}"
                                                      method="get">
                                                    @csrf
                                                    <input type="number" name="second_total" onfocus=" this.value='';"
                                                           onblur="if(this.value == '') this.value='{{$item->second_total ?? 0}}';"
                                                           {{--                                               onkeydown="this.value='';"--}}
                                                           value="{{$item->second_total ?? 0}}" class="second_total"
                                                           min="0"/>
                                                    <label class="col">
                                                        <input type="submit" class="btn btn-sm btn-primary" value="حفظ">
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
                                </table>


                                {{count($res) ? $res->links() : ''}}
                                <div id="pr" style="display:none">

                                    @include('personalReports.final_results.final_report_print', ['items'=>@$data_without_pag])
                                    <div>
                                    </div>

                                </div>

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

        .ml {
            margin-left: 2px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {{-- Bootstrap Tooltip Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>


    <script>
        // function printDiv(divId) {
        //     const printContents = document.getElementById(divId).innerHTML;
        //     const originalContents = document.body.innerHTML;
        //
        //     // Open a new window for printing — cleaner and safer
        //     const printWindow = window.open('', '', 'height=600,width=800');
        //     printWindow.document.write('<html><head><title>Print</title>');
        //     // Optional: add your styles for the print page
        //     printWindow.document.write('<style>body{font-family: Arial; padding:20px;} table{width:100%;border-collapse:collapse;} td,th{border:1px solid #000;padding:6px;text-align:center;}</style>');
        //     printWindow.document.write('</head><body>');
        //     printWindow.document.write(printContents);
        //     printWindow.document.write('</body></html>');
        //     printWindow.document.close();
        //     printWindow.print();
        // }

        // Export div content to Excel
        function exportDivToExcel(divId, filename = 'report.xlsx') {
            const div = document.getElementById(divId);
            if (!div) return alert("Div not found!");

            // If div contains a table — convert it directly
            const table = div.querySelector("table");
            if (!table) return alert("No table found inside the div!");

            // Convert the HTML table into a worksheet
            const ws = XLSX.utils.table_to_sheet(table);

            // Create a new workbook
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Report");

            // Download as .xlsx
            XLSX.writeFile(wb, filename);
        }

    </script>


<script>
    function printDiv(divId) {
        const content = document.getElementById(divId).innerHTML;
        const printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Print</title>');
        printWindow.document.write("<style> .hide_print{display:none !important;}@page { size: auto;  margin: 5mm; }.hide_print{display:none !important}.show_print{display:block !important}@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:5px;font-size:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}</style><style>@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}.table td th{border: 1px solid #ccc !important;} th{background:#cccccc69 !important; -webkit-print-color-adjust: exact !important;} h4,h3,h2,h1,h5 {text-align:right;}</style>");
        printWindow.document.write('</head><body>');
        printWindow.document.write(content);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }

</script>

@endsection

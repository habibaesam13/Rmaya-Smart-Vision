@extends('admin.master')

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <div class="page-container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title">تقارير النتائج النهائية</h4>
                </div>
                <div class="col-12 col-md-4 text-md-end text-center">
                    <div
                        class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">

                        <span class="badge badge-outline-primary"> عدد التقارير : {{count($data_without_pag)}}</span>


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
                        <div class="card bg-search py-4 px-3">


                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                                <br>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                                <br>
                            @endif
                            @if (session('warning'))
                                <div
                                    class="alert alert-warning">{{ session('warning') }}</div>
                                <br>
                            @endif
                            @if ($errors->any()) @foreach ($errors->all() as $error)
                                <div class="text-danger">{{$error}}</div>@endforeach <br>
                            @endif


                            <form action="{{route('final_reports.first_list')}}" method="get"
                                  enctype="multipart/form-data"
                                  id="saveReportForm" class="form-horizontal">
                                @csrf


                                {{--                    <div class="d-flex align-items-center gap-2">--}}
                                <div class="row g-3 align-items-end">
                                    <input type="hidden" name="players_data" id="playersData">

                                    <!-----start search------------->

                                    <div class="row form">

                                        <div class="col-3">
                                            <div class="file-upload-wrapper p-1">
                                                <select name="weapon_id"
                                                        class="form-control form-control-sm">
                                                    <option value="">اختر السلاح .....</option>
                                                    @forelse($weapons as $weapon)
                                                        <option
                                                            {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }} value="{{$weapon->wid}}">{{$weapon->name}}</option>
                                                    @empty
                                                        <option value="">لا توجد اسلحة</option>
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3">
                                            <div class="file-upload-wrapper p-1">
                                                <input name="details" value="{{ request('details') }}" type="text"
                                                       placeholder="رقم الديتيل"
                                                       class="form-control form-control-sm">
                                            </div>
                                        </div>


                                        <div class="col-3">
                                            <div class="d-flex  p-1">
                                                <label for="date-from" class="form-label">من</label>
                                                <input id="date-from" type="date" name="date_from"
                                                       class="form-control form-control-sm"
                                                       value="{{ request('date_from') }}">
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="d-flex  p-1">
                                                <label for="date-to" class="form-label">إلى</label>
                                                <input id="date-to" type="date" name="date_to"
                                                       class="form-control form-control-sm"
                                                       value="{{ request('date_to') }}">
                                            </div>
                                        </div>


                                    </div>
                                    <!----end search---------------->
                                    <div class="row">
                                        {{-- Print Button --}}
                                        <div class="col-8 ">
                                            <div class="file-upload-wrapper p-1 d-flex">
                                                {{--                                                <a onclick="exportDivToExcel('printArea', 'final_report.xlsx')"--}}
                                                {{--                                                   target="_blank"--}}
                                                {{--                                                   class="btn btn-outline-dark btn-sm  d-flex align-items-center gap-2 ml">--}}
                                                {{--                                                    <i class="fas fa-print"></i>--}}
                                                {{--                                                    <span>طباعة</span>--}}
                                                {{--                                                </a>--}}

                                                {{--                                                 <button onclick="printDiv('printArea')"--}}
                                                {{--                                                        class="btn btn-danger btn-sm   d-flex align-items-center gap-2 ml">--}}
                                                {{--                                                    <i class="fas fa-print"></i>--}}
                                                {{--                                                    <span>PDF</span>--}}
                                                {{--                                                </button>--}}

                                                <button type="submit" value="submit" class="btn btn-sm btn-warning ml">
                                                    بحث
                                                </button>

                                                <a class="btn btn-sm btn-primary ml"
                                                   href="{{route('final_reports.first_list')}}">
                                                    اعادة ضبط </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </form>
                        </div>

                        {{-- Results Table Card --}}
                        <div class="card shadow-sm border-0" id="printArea">
                            <div class="card-body ">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table table-bordered ">
                                        <thead>
                                        <tr>
                                            <th style="width: 50px;">#</th>
                                            <th>التاريخ</th>
                                            <th>السلاح</th>
                                            <th>رقم الديتيل</th>
                                            <th>الادوات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        {{-- {{dd($sortedRatings )}}--}}

                                        {{--{{dd($sortedRatings[$index])}}--}}
                                        @forelse($items as $key => $item)
                                            <tr>
                                                <td class="text-center fw-bold">{{$key+1}}</td>
                                                <td class="text-primary">{{date_create($item->date)->format('Y-m-d')}}</td>
                                                <td>{{optional($item->weapon)->name}}</td>
                                                <td class="fw_bold total-input">{{$item->details}}</td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-1">
                                                        <form
                                                            action="{{route('final_reports_delete.delete' , $item->id )}}"
                                                            method="POST"
                                                            class="d-inline"
                                                            onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                                    title="حذف">
                                                                <i class="ri-delete-bin-line fs-16"></i>
                                                            </button>
                                                        </form>
                                                        <span class="d-inline">
                                            <a title="عرض/طباعة" href="{{route('results-registered-members_by_print_final' , $item->id)}}?autoprint=true"
                                                  class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                   <i class="ri-printer-fill"></i>
                                            </a>
                                        </span>


                                                        <div class="d-inline">
                                                            @if($item->file)
                                                                <a target="_blank" href="{{asset($item->file)}}" download
                                                                   class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                                   title="الملف المرفق">
                                                                    <i class="ri-file-2-line"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty

                                        @endforelse



                                        <!-----------empty ---------------->
                                        {{--                            <tr>--}}
                                        {{--                                <td colspan="18" class="text-center text-muted py-4">--}}
                                        {{--                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>--}}
                                        {{--                                    لا توجد بيانات لعرضها--}}
                                        {{--                                </td>--}}
                                        {{--                            </tr>--}}
                                        <!-----------empty ---------------->


                                        </tbody>


                                        </tbody>
                                    </table>
                                    {{count($items) ? $items->links() : ''}}


                                    <div id="pr" style="display:none">

                                        @include('personalReports.final_results.final_list_print', ['items'=>@$data_without_pag])
                                        <div>
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
                            <script
                                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                                function getClubs(club) {
                                    weaponSelect.innerHTML = "<option value=''>  اختر سلاح ..... </option>";

                                    $.ajax({
                                        type: 'GET',
                                        url: "{{url("/admin/final-results/get-weapons/")}}" + '/' + club, // clean interpolation
                                        data: '_token = <?php echo csrf_token() ?>',
                                        success: function (data) {
                                            let innerTxt = '';
                                            let weaponSelect = document.getElementById('weaponSelect');
                                            data.weapons.forEach(function (item) {
                                                innerTxt += "<option value='" + item.wid + "'>" + item.name + "</option>";
                                            });

                                            if (data.weapons.length > 0) {
                                                weaponSelect.innerHTML = innerTxt;
                                            } else {
                                                weaponSelect.innerHTML = "<option value=''> لا توجد اسلحة </option>";

                                            }
                                        }
                                    });
                                }
                            </script>


                            <script>


                                // // Print only a certain div
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

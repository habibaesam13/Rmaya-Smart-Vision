@extends('admin.master')
@section('content')
    <div  class="page-container">
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title"> تقرير النتائج اليومية للأسلحة</h4>
                </div>
                {{-- Success Message --}}
                <div class="col-12 col-md-4 text-md-end text-center">
                </div>
            </div>
            <div class="col-12" >
                    <a class="btn btn-primary" onclick="printDiv('pr')">print</a>
                    {{-- Registered Teams --}}
                    <div class="card shadow-sm border-0"  id="pr">
                        <div class="card-body">
                            @csrf
                            <table class="table table-bordered mb-3" >
                                <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>الهاتف</th>
                                    <th>رقم الهوية</th>
                                    <th>الأسم</th>
                                    <th>رقم الهدف</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                                    <th>5</th>
                                    <th>6</th>
                                    <th>7</th>
                                    <th>8</th>
                                    <th>9</th>
                                    <th>10</th>
                                    <th>المجموع</th>
                                    <th>ملاحظات</th>
{{--                                    @if(!$confirmed)--}}
{{--                                        <th>إجراءات</th>--}}
{{--                                    @endif--}}
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($members as $index => $member)
                                    <tr>
                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                        <td>{{ $member?->player?->phone1 ?? '---' }}</td>
                                        <td>{{ $member?->player?->ID ?? '---' }}</td>
                                        <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>
                                        {{-- goal --}}
                                        <td>
                                            <input type="number"
                                                   name="goal"
                                                   required
                                                   data-player="{{ $member->id }}"
                                                   class="form-control form-control-sm"
                                                   min="1"
                                                   value="{{ old('goal.' . $member->id, $member->goal ?? '') }}"
                                                     >
                                        </td>

                                        {{-- R1 → R10 --}}
                                        @for($i=1; $i<=10; $i++)
                                            <td>
                                                <input type="number"
                                                       name="R{{ $i }}"
                                                       data-player="{{ $member->id }}"
                                                       class="form-control form-control-sm score-input"
                                                       placeholder="0"
                                                       min="0"
                                                       data-row="{{ $index }}"
                                                       value="{{ old('R'.$i.'.'.$member->id, $member->{'R'.$i} ?? '') }}"
                                                      >
                                            </td>
                                        @endfor

                                        {{-- total --}}
                                        <td>
                                            <input type="number"
                                                   name="total"
                                                   data-player="{{ $member->id }}"
                                                   class="form-control form-control-sm bg-light total-input"
                                                   placeholder="0"
                                                   id="total-{{ $index }}"
                                                   value="{{ old('total.'.$member->id, $member->total ?? '') }}">
                                        </td>

                                        {{-- notes --}}
                                        <td>
                                            <input type="text"
                                                   name="notes"
                                                   data-player="{{ $member->id }}"
                                                   class="form-control form-control-sm"
                                                   placeholder="ملاحظات"
                                                   value="{{ old('notes.'.$member->id, $member->notes ?? '') }}"
                                                  >
                                        </td>



                                        {{--                                        @if(!$confirmed)--}}
                                        {{--                                            <td class="text-center">--}}
                                        {{--                                                <form action="{{ route('report-player-delete', ['rid' => $report->Rid, 'player_id' => $member->id]) }}"--}}
                                        {{--                                                      method="POST" class="d-inline"--}}
                                        {{--                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الرامي؟');">--}}
                                        {{--                                                    @csrf--}}
                                        {{--                                                    @method('DELETE')--}}
                                        {{--                                                    <button type="submit" class="icon-btn text-danger" title="حذف">--}}
                                        {{--                                                        <i class="fas fa-trash-alt"></i>--}}
                                        {{--                                                    </button>--}}
                                        {{--                                                </form>--}}
                                        {{--                                            </td>--}}
                                        {{--                                        @endif--}}
                                    </tr>

                                    {{--                                    <tr>--}}
{{--                                        <td class="text-center fw-bold">{{ $index + 1 }}</td>--}}
{{--                                        <td>{{ $member?->player?->phone1 ?? '---' }}</td>--}}
{{--                                        <td>{{ $member?->player?->ID ?? '---' }}</td>--}}
{{--                                        <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>--}}
{{--                                        --}}{{-- goal --}}
{{--                                        <td>--}}
{{--                                            <input type="number"--}}
{{--                                                   name="goal"--}}
{{--                                                   required--}}
{{--                                                   data-player="{{ $member->id }}"--}}
{{--                                                   class="form-control form-control-sm"--}}
{{--                                                   min="1"--}}
{{--                                                   value="{{ old('goal.' . $member->id, $member->goal ?? '') }}"--}}
{{--                                                   @if($confirmed) readonly @endif>--}}
{{--                                        </td>--}}

{{--                                        --}}{{-- R1 → R10 --}}
{{--                                        @for($i=1; $i<=10; $i++)--}}
{{--                                            <td>--}}
{{--                                                <input type="number"--}}
{{--                                                       name="R{{ $i }}"--}}
{{--                                                       data-player="{{ $member->id }}"--}}
{{--                                                       class="form-control form-control-sm score-input"--}}
{{--                                                       placeholder="0"--}}
{{--                                                       min="0"--}}
{{--                                                       data-row="{{ $index }}"--}}
{{--                                                       value="{{ old('R'.$i.'.'.$member->id, $member->{'R'.$i} ?? '') }}"--}}
{{--                                                       @if($confirmed) readonly @endif>--}}
{{--                                            </td>--}}
{{--                                        @endfor--}}

{{--                                        --}}{{-- total --}}
{{--                                        <td>--}}
{{--                                            <input type="number"--}}
{{--                                                   name="total"--}}
{{--                                                   data-player="{{ $member->id }}"--}}
{{--                                                   class="form-control form-control-sm bg-light total-input"--}}
{{--                                                   placeholder="0"--}}
{{--                                                   id="total-{{ $index }}"--}}
{{--                                                   value="{{ old('total.'.$member->id, $member->total ?? '') }}">--}}
{{--                                        </td>--}}

{{--                                        --}}{{-- notes --}}
{{--                                        <td>--}}
{{--                                            <input type="text"--}}
{{--                                                   name="notes"--}}
{{--                                                   data-player="{{ $member->id }}"--}}
{{--                                                   class="form-control form-control-sm"--}}
{{--                                                   placeholder="ملاحظات"--}}
{{--                                                   value="{{ old('notes.'.$member->id, $member->notes ?? '') }}"--}}
{{--                                                   @if($confirmed) readonly @endif>--}}
{{--                                        </td>--}}



{{--                                        @if(!$confirmed)--}}
{{--                                            <td class="text-center">--}}
{{--                                                <form action="{{ route('report-player-delete', ['rid' => $report->Rid, 'player_id' => $member->id]) }}"--}}
{{--                                                      method="POST" class="d-inline"--}}
{{--                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا الرامي؟');">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="icon-btn text-danger" title="حذف">--}}
{{--                                                        <i class="fas fa-trash-alt"></i>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                        @endif--}}
{{--                                    </tr>--}}
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

                        </div>
                    </div>

                    <style>
                        .info-box {
                            border-left: 4px solid #bf1e2f;
                            transition: all 0.3s ease;
                        }

                        .info-box:hover {

                            transform: translateY(-2px);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                        }

                        .file-upload-wrapper {
                            position: relative;
                            min-width: 250px;
                        }

                        .file-upload-wrapper input[type="file"] {
                            height: 48px;
                            padding: 0.75rem;
                        }

                        .btn {
                            transition: all 0.2s ease-in-out;
                            white-space: nowrap;
                        }

                        .btn:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                        }

                        .table th {

                            font-weight: 600;
                        }

                        .table td {
                            vertical-align: middle;
                        }

                        .score-input {
                            text-align: center;
                            font-weight: 600;
                            padding: 0.375rem;
                        }

                        .total-input {
                            text-align: center;
                            font-weight: bold;
                            color: #0d6efd;
                            font-size: 1.1rem;
                        }

                        .score-input:focus {
                            border-color: #0d6efd;
                            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
                        }

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

                        @media (max-width: 768px) {
                            .d-flex.flex-wrap.gap-2 {
                                flex-direction: column;
                            }

                            .d-flex.flex-wrap.gap-2 form,
                            .d-flex.flex-wrap.gap-2 .file-upload-wrapper {
                                width: 100%;
                            }

                            .d-flex.flex-wrap.gap-2 button {
                                width: 100%;
                                justify-content: center;
                            }
                        }

                        .table-responsive {
                            border-radius: 2px;
                        }

                        tbody tr:hover {
                            background-color: #f8f9fa;
                        }

                    </style>
{{--                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>--}}




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

{{--generalReportForClubsAndWeapons--}}

@extends('admin.master')

@section('content')
    <div class="page-container my-4">
        {{-- Success Message --}}
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


        <div class="page-container my-4">
            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <h4 class="header-title"> الاحصائيات </h4>
                </div>
                <div class="col-12 col-md-4 text-md-end text-center">


                    <div class="">

                <span class="badge badge-outline-primary">
                           عدد الأفراد المسجلين : 6
                </span>

                        <span title="اكسيل" onclick="exportDivToExcel('pr', 'final_report.xlsx')" target="_blank"
                              class="btn btn-sm btn-success  ">
                        <i class="ri-file-excel-line"></i>
                    </span>


                        <span title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                    </div>
                </div>
            </div>


            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <!--  -->
                    <div class="card border-success mb-3 rounded-3 overflow-hidden">
                        <div class="card-header ">
                            <h5 class="mb-0 header-title">
                                <i class="fas fa-file-alt me-2"></i>
                                تقرير الإحصاء العام للأسلحة والنوادي
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th></th>

                                    @foreach($generalReportForClubsAndWeapons->pluck( 'club_name')->unique() as $key3 => $item3)
                                        <th>{{$item3 }}</th>
                                    @endforeach

                                </tr>
                                </thead>

                                <tbody>

                                {{--                                @foreach($generalReportForClubsAndWeapons->groupBy( 'weapon_name' , 'club_name')->unique() as $key3 => $item3)--}}
                                {{--                                    <tr>--}}
                                @foreach($generalReportForClubsAndWeapons->groupBy( 'weapon_name' , 'club_name')->unique() as $key3 => $item3)
                                    <tr>
                                        <th>  {{    $item3->first() != null ? $item3->first()->weapon_name  : ''  }}   </th>
                                        @foreach($generalReportForClubsAndWeapons->pluck( 'club_name' , 'weapon_name')->unique() as $key2 => $item2)
                                            <td>
                                                @foreach($item3 as $key4 => $val4)
                                                    @if($val4->club_name == $item2 && $val4->weapon_name == $key2)
                                                        fffff    {{$val4->club_name}}
{{--                                                                                                                / {{$val4->all_member_name}}--}}
{{--                                                                                                                / {{$val4->active_member_name}}--}}
                                                        /{{$val4->weapon_name}}
                                                        /{{$val4->pid}}


                                                    <br>
                                                        /wid : {{$val4->wid}}
                                                    <br>
                                                        /cid : {{$val4->cid}}

                                                    <br>
                                                        fffff
                                                    @endif

                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>


                            <!---------------start print part ----------------->
                            <div id="pr" style="display:none">
                                <div style="float:right;width:34%;text-align:right;display:nonex;font-size:12px"
                                     class="show_print"><br><span
                                        style="font-weight:bold!important;color:#bf1e2f;font-size:15px"> الرماية </span><br>
                                    الشارقة <br>P.O. Box : 7447 | 19777<br> erer@ghd.com | www.fcma.gov.ae <br></div>
                                <div style="float:right;width:33%;text-align:center;display:nonex;font-size:12px"
                                     class="show_print"><img style="max-width:60px"
                                                             src="http://127.0.0.1:8000/settings/1759150706logo.jpg">
                                    <br> <b style="font-size:14px">قائمة الافراد المتأهلين للتصفيات النهائية</b></div>
                                <div style="float:right;width:33%;text-align:left;display:nonex;font-size:12px"
                                     class="show_print"><br><span
                                        style="font-weight:bold!important;color:#bf1e2f;font-size:14px"> ميادين الريف للرماية 2025</span><br>
                                    Sharja <br> P.O. Box : 7447 | 19777<br>erer@ghd.com | www.fcma.gov.ae
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>الاسم</th>
                                        <th>السلاح</th>

                                        <th>رقم الهوية</th>
                                        <th>الهاتف</th>

                                        <th>نادي الرماية</th>


                                        <th>العلامة المكتسبة</th>
                                        <th>الترتيب</th>

                                        <th>تاريخ التسجيل</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="12" class="text-center text-muted mt-3">
                                            <p class="mt-3 w-100">لا يوجد رماة غير مضافين في تقارير.</p>

                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <!--------end print part ------>

                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

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

{{--                <span class="badge badge-outline-primary">--}}
{{--                           عدد الأفراد المسجلين : 6--}}
{{--                </span>--}}

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


            <div class="card shadow-sm border-0" id="pr">
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
                            <table class="table table-borderedr">
                                <thead>
                                <tr>
                                    <th>النادي</th>
                                    @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as $clubName)
                                        <th>{{ $clubName }}</th>
                                    @endforeach
                                </tr>
                                </thead>

                                <tbody>
                                <tr  >
                                    <th style="background-color:   #EFC3CA">السلاح</th>
                                    <?php  $i =0;  ?>
                                    @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as   $clubName)
                                        <?php   $i++;  ?>
                                        <th style="{{$i%2 == 0   ?   'background-color: #EFC3CA' :  'background-color:#E7DDFF'   }}">
                                            <div class="row ">
                                                <div class="col-4 fw-bold  px-2 ">المسجلين</div>
                                                <div class="col-4 fw-bold  px-2 border   border-1 border-top-0  border-bottom-0">المفعلين</div>
                                                <div class="col-4 fw-bold  px-2">المتأهلين</div>
                                            </div>
                                        </th>
                                    @endforeach
                                </tr>

                                @php
                                    $weapons = $generalReportForClubsAndWeapons->pluck('weapon_name', 'weapon_id')->unique();
                                @endphp

                                @foreach($weapons as $weaponId => $weaponName)
                                    <tr>
                                        <th>{{ $weaponName }}</th>
                                        @php  $i2 = 0;  @endphp

                                        @foreach($generalReportForClubsAndWeapons->pluck('club_name')->unique() as $clubName)

                                            @php
                                                $record = $generalReportForClubsAndWeapons
                                                    ->first(fn($r) => $r->weapon_id == $weaponId && $r->club_name == $clubName);
                                            $i2++;
                                            @endphp

                                            @if($record)
                                                <td style="{{$i2%2 == 0   ?   'background-color:#E8E8E8' :  ''   }}">
                                                    <div class="row">
                                                    <div class="col-4 fw-bold text-primary px-2  ">{{ $record->all_members_count }}</div>
                                                    <div class="col-4 px-2    ">{{ $record->active_members_count }}</div>
                                                    <div class="col-4 px-2   ">{{ $record->qualified }}</div>
                                                    </div>
                                                </td>
                                            @else
                                                <td class="text-muted" style="{{$i2%2 == 0   ?   'background-color:#E8E8E8' :  ''   }}">—</td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
{{--                            <table class="table table-bordered">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th></th>--}}

{{--                                    @foreach($generalReportForClubsAndWeapons->pluck( 'club_name')->unique() as $key3 => $item3)--}}
{{--                                        <th>{{$item3 }}</th>--}}
{{--                                    @endforeach--}}

{{--                                </tr>--}}
{{--                                </thead>--}}

{{--                                <tbody>--}}

{{--                                                                @foreach($generalReportForClubsAndWeapons  as $key => $item)--}}
{{--                                                                    @foreach($generalReportForClubsAndWeapons->pluck('weapon_id' , 'club_name')->unique()  as $key1 => $weapon)--}}
{{--                                                                        @if($item->weapon_id == $weapon && $item->club_name == $key1  )--}}
{{--                                                                            <tr>--}}
{{--                                                                                <th>{{$item->weapon_name}}</th>--}}
{{--                                                                                @foreach($generalReportForClubsAndWeapons  as $key => $val)--}}

{{--                                                                                    @if($val->weapon_id  ==$item->weapon_id)--}}
{{--                                                                                        <td>--}}
{{--                                                                                          All  Members count : {{$val->all_members_count}} <br>--}}
{{--                                                                                            Active Members : {{$val->active_members_count}} <br>--}}
{{--                                                                                            Qualified : {{$val->qualified}}--}}
{{--                                                                                               {{$val->all_member_name}}--}}
{{--                                                                                        </td>--}}
{{--                                                                                    @endif--}}


{{--                                                                                @endforeach--}}
{{--                                                                            </tr>--}}
{{--                                                                        @endif--}}
{{--                                                                    @endforeach--}}
{{--                                                                @endforeach--}}


{{--                                @foreach($generalReportForClubsAndWeapons as $clubName => $weapons)--}}
{{--                                    <tr style="background-color: #bf1e2f;">--}}
{{--                                        <th class="text-light" colspan="4">{{ $clubName }}</th>--}}
{{--                                    </tr>--}}

{{--                                    @foreach($weapons as $weapon)--}}
{{--                                        <tr>--}}
{{--                                            <td>{{ $weapon->weapon_name }}</td>--}}
{{--                                            <td>All Members: {{ $weapon->all_members_count }}</td>--}}
{{--                                            <td>Active: {{ $weapon->active_members_count }}</td>--}}
{{--                                            <td>Qualified: {{ $weapon->qualified }}</td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                @endforeach--}}

{{--                                </tbody>--}}
{{--                            </table>--}}


                        </div>
                    </div>
                    <div class="mt-4 d-flex justify-content-center">

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

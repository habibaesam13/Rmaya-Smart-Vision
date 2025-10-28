@extends('admin.master')
@php
use Carbon\Carbon;
@endphp
@section('content')
<div class="page-container">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-12">
            <h4 class="header-title"> عرض بيانات
                <span class="text-primary">{{$member->name}}</span>
            </h4>
        </div>
    </div>

    <!-----start ------->
    <div class="ml-0 text-left">
    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary d-block text-left ml-0 "><i
            class="ri-printer-line"></i> </a>
    </div>

    <div class="card shadow-sm border-0" id="pr">

        <div class="card-body">
            <table class="table table-bordered mb-3  m-auto"  id="pr" >
                <thead>
{{--                <tr>--}}
{{--                    <th>اسم العنصر</th>--}}
{{--                    <th>القيمة </th>--}}
{{--                    <th>اسم العنصر</th>--}}
{{--                    <th>القيمة</th>--}}
{{--                 </tr>--}}
                </thead>


                <tbody>
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                        رقم بطاقة الهوية
                    </td>
                    <td>
                        {{ $member->ID}}
                    </td>
                    <td  class="text-primary">
                        تاريخ انتهاء الهوية
                    </td>

                    <td>
                        {{$member->Id_expire_date ? Carbon::parse($member->Id_expire_date)->format('Y-m-d') : '' }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                        الاسم بالكامل
                    </td>
                    <td>
                        {{  $member->name }}
                    </td>
                    <td  class="text-primary">
                        تاريخ الميلاد
                    </td>

                    <td>
                        {{  $member->dob ? Carbon::parse($member->dob)->format('Y-m-d') : ''  }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                        الجنسية
                    </td>
                    <td>
                                      {{  optional($member->nationality)->country_name_ar }}
                      </td>
                    <td  class="text-primary">
                        النوع
                    </td>

                    <td>
                        {{  $member->gender }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                      النادي
                    </td>
                    <td>
                        {{ optional($member->club)->name }}
                    </td>
                    <td  class="text-primary">
                        العمر
                    </td>

                    <td>
                        {{ $member->dob ? Carbon::parse($member->dob)->age : '' }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                       السلاح
                    </td>
                    <td>
                        {{ optional($member->weapon)->name }}
                    </td>
                    <td  class="text-primary">
                        المجموعات
                    </td>

                    <td>
                        {{ optional($member->member_group)->name  }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>
                    <td class="text-primary">
                       رقم هاتف 1
                    </td>
                    <td>
                        {{ $member->phone1  }}
                    </td>
                    <td  class="text-primary">
                        رقم هاتف 2
                    </td>

                    <td>
                        {{$member->phone2  }}
                    </td>
                </tr>
                <!------------------------------------------------------------------------->
                <!------------------------------------------------------------------------->
                <tr>

                    <td colspan="4" style="text-align: center">

                        <img src="{{asset('storage/' . $member->front_id_pic)}}">
                        <br>
                        <img src="{{asset('storage/' . $member->back_id_pic)}}">



                    </td>


                </tr>
                <!------------------------------------------------------------------------->

                </tbody>
            </table>
            <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3" >
                <a  class="btn btn-primary rounded-pill px-3" onclick="window.history.back();">
                    <i class="ri-refresh-line"></i> &nbsp;&nbsp;رجوع </a>
            </div>


        </div>

    </div>

    <!----------end -------------->



</div>
  @endsection

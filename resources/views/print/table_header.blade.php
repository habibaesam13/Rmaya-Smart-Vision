@php
use App\Models\SiteSettings;
$siteSettings=SiteSettings::first();
@endphp
<div style="float:right;width:34%;text-align:right;display:nonex;font-size:12px" class="show_print"><br><span style="font-weight:bold!important;color:#bf1e2f;font-size:15px"> {{$siteSettings->company_name_ar}} </span><br> {{ $siteSettings->address_ar }} <br>P.O. Box : 7447 | {{ $siteSettings->phone }}<br> {{ $siteSettings->email }} | www.fcma.gov.ae <br> </div>
<div style="float:right;width:33%;text-align:center;display:nonex;font-size:12px" class="show_print"> <img style="max-width:60px" src="{{ url(asset($siteSettings->logo)) }}"> <br> <b style="font-size:14px">{{@$title}}</b> </div>
<div style="float:right;width:33%;text-align:left;display:nonex;font-size:12px" class="show_print"><br><span style="font-weight:bold!important;color:#bf1e2f;font-size:14px"> {{$siteSettings->company_name}}</span><br> {{ $siteSettings->address}} <br> P.O. Box : 7447 | {{$siteSettings->phone}}<br>{{$siteSettings->email}} | www.fcma.gov.ae</div>
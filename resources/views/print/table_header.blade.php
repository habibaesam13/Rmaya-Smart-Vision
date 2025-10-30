@php
    use App\Models\SiteSettings;
    $siteSettings=SiteSettings::first();
@endphp




<div style="width: 100%;  margin: auto; padding: 2mm;  ">
    <!-- Header (with shadow block) -->
    <div style="width:100%;  display: flex; justify-content: space-between; align-items: center;  padding: 15px 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border-radius:4px;">
        <!-- Left Section -->
        <div style="width:30%; text-align:right; font-size:11px; line-height:1.4;">
            {{$siteSettings->company_name_ar}} <br>
            www.rmaya.ae <br>
            {{$siteSettings->email}} <br>
            {{--$siteSettings->phone--}}
        </div>
        <!-- Center Section -->
        <div style="width:40%; text-align:center;">
            <img src="{{ url(asset($siteSettings->logo)) }}" alt="" style="height:65px; width:75px; margin-bottom:5px;">

        </div>

        <!-- Right Section -->
        <div style="width:30%; text-align:left; font-size:11px; line-height:1.4;">
            {{$siteSettings->company_name}} <br>
            www.rmaya.ae <br>
            {{$siteSettings->email}}<br>
            {{--$siteSettings->phone--}}
        </div>
    </div>
    <!--<div style="border-bottom: 2px solid #003366;padding-top:10px;margin: auto;"></div>-->

</div>
<center class="my-2"><span style="margin:0; font-size:16px; color:#bf1e2f;">{{@$title}}</span></center>







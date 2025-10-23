<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered members</title>
</head>
<style>
    body {
        font-family: 'cairo', DejaVu Sans, sans-serif;
        direction: rtl;
        text-align: right;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #000;
        font-size: 12px;
    }

    /* --- Header Layout --- */
    .header-table {
        width: 100%;
        border: none;
        table-layout: fixed;
    }

    .header-table td {
        border: none;
        vertical-align: top;
        font-size: 13px;
        padding: 10px;
    }

    .header-right {
        width: 35%;
        text-align: right;
    }

    .header-center {
        width: 30%;
        text-align: center;
        vertical-align: middle;
    }

    .header-center img {
        width: 50px;
        height: 50px;
        display: block;
        margin: 0 auto;
    }

    .header-left {
        width: 35%;
        text-align: left;
        direction: ltr;
    }

    .header-right p,
    .header-left p {

        line-height: 1.5;
    }

    hr {
        border: none;
        border-top: 2px solid #000;
    }
</style>

<body>
    @php
    [$report, $reportMembers] = $data;
    @endphp
    <div class="page-container my-4">
        @if($siteSettings !==null)
        <hr>
        <table class="header-table">
            <tr>
                <td class="header-right">
                    <p><strong>{{ $siteSettings->company_name_ar }}</strong></p>
                    <p>{{ $siteSettings->address_ar }}</p>
                    <p>{{ $siteSettings->phone }}</p>
                </td>
                <td class="header-center">
                    <img src="{{ public_path($siteSettings->logo) }}" alt="logo">
                    <br><br>
                    <h4> تقرير {{$report?->weapon?->name}}  </h4>
                    <br>
                    <h6> رقم الديتيل - {{$report?->details}} </h6> <br>
                    <h6> {{ $report?->date ? $report->date : '---'}} </h6>

                </td>
                <td class="header-left">
                    <p><strong>{{ $siteSettings->company_name }}</strong></p>
                    <p>{{ $siteSettings->address }}</p>
                    <p>{{ $siteSettings->phone }}</p>
                </td>
            </tr>
        </table>
        <hr>
        @endif
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الهاتف</th>
                            <th>رقم الهوية</th>
                            <th>الاسم</th>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportMembers as $member)
                        <tr>
                            <td>{{ $member?->player?->phone1?$member?->player?->phone1:'---' }}</td>
                            <td>{{ $member?->player?->ID }}</td>
                            <td>{{ $member?->player?->name}}</td>
                            <td>{{ $member?->goal }}</td>
                            @for($i = 1; $i <= 10; $i++)
                                <td>{{ $member->{'R'.$i} ?? '-' }}</td>
                            @endfor
                            <td>
                                {{$member?->total}}
                            </td>
                            <td>
                                {{$member?->notes ? $member?->notes :'----'}}
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
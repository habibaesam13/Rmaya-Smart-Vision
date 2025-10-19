@php
use App\Models\SiteSettings;
$siteSettings=SiteSettings::first();
@endphp
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>طباعة التقرير</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>
        *,
        *::after,
        *::before {
            box-sizing: border-box;
        }

        body {
            font-family: 'Cairo', sans-serif;
            background-color: #fff;
            color: #000;
            padding: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
            font-size: 14px;
            padding: 6px;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .title-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .print-btn {
            position: relative;
            /* top: 185px; */
            left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .w-logo {
            width: 70px;
        }

        .print-btn:hover {
            background-color: #0056b3;
        }
         .m-left{
            margin-left: -24px;
         }
        @media print {
            @page {
                size: landscape;
            }

            .print-btn {
                display: none !important;
            }

        }
    </style>
</head>

<body>
    <header class="mb-3">
        <div class="d-flex justify-content-between align-items-center ">
            <div>
                <p class="fw-bold m-0">{{ $siteSettings->company_name_ar }}</p>
                <p class="m-0">{{ $siteSettings->address_ar }}</p>
                <p class="m-0">{{ $siteSettings->phone }}</p>
            </div>
            <div class="w-25 text-center">
                <img src="{{ url(asset($siteSettings->logo)) }}" class="w-logo" alt="Logo">
                <br>
                {{@$title}}
               
            </div>
            <div class="text-end">
                <p class="fw-bold m-0">{{ $siteSettings->company_name }}</p>
                <p class="m-0">{{ $siteSettings->address }}</p>
                <p class="m-0">{{ $siteSettings->phone }}</p>
            </div>
        </div>
    </header>
</body>

</html>

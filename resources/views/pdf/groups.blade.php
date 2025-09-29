<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Members</title>
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

        .header-left {
            width: 35%;
            text-align: left;
            direction: ltr;
        }

        .header-center img {
            max-width: 70px;
            max-height: 60px;
            display: inline-block;
        }

        .header-right p,
        .header-left p {
            margin: 4px 0;
            line-height: 1.5;
        }

        hr {
            border: none;
            border-top: 2px solid #000;
            margin: 15px 0;
        }
    </style>

<body>

    <div class="page-container my-4">
        @if($siteSettings !==null)
        <hr>
        <table class="header-table">
            <tr>
                <td class="header-right">
                    <p><strong>{{ $siteSettings->company_name }}</strong></p>
                    <p>{{ $siteSettings->address }}</p>
                    <p>هاتف: {{ $siteSettings->phone }}</p>
                    <p>واتساب: {{ $siteSettings->whatsapp }}</p>
                    <p>{{ $siteSettings->email }}</p>
                </td>
                <td class="header-center">
                    <img src="{{ public_path($siteSettings->logo) }}" alt="logo">
                </td>
                <td class="header-left">
                    <p><strong>{{ $siteSettings->company_name }}</strong></p>
                    <p>{{ $siteSettings->address }}</p>
                    <p>Phone: {{ $siteSettings->phone }}</p>
                    <p>WhatsApp: {{ $siteSettings->whatsapp }}</p>
                    <p>{{ $siteSettings->email }}</p>
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
                            <th>اسم الفريق</th>
                            <th>السلاح</th>
                            <th>النادي</th>
                            <th>تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item?->weapon?->name}}</td>
                            <td>{{ $item?->club?->name}}</td>
                            <td>{{ $item->created_at}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
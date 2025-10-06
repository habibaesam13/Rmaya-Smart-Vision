<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طباعة التقرير</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <style>
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
            position: fixed;
            top: 150px;
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
    <header>
        <div class="d-flex justify-content-between align-items-center ">
            <div>
                <p><strong>{{ $siteSettings->company_name_ar }}</strong></p>
                <p>{{ $siteSettings->address_ar }}</p>
                <p>{{ $siteSettings->phone }}</p>
            </div>
            <div class="w-25 text-center">
                <img src="{{ asset($siteSettings->logo) }}" class="w-logo" alt="Logo">
            </div>

            <div>
                <p><strong>{{ $siteSettings->company_name }}</strong></p>
                <p>{{ $siteSettings->address }}</p>
                <p>{{ $siteSettings->phone }}</p>
            </div>
        </div>
    </header>
    <button class="print-btn" onclick="window.print()">🖨️ طباعة</button>

    <div class="title-header">
        <h3>تقرير النتائج</h3>
        <p class="text-muted">نوع السلاح: {{ $report->weapon?->name ?? '-' }}</p>
        <p class="text-muted"> رقم الديتيل: {{ $report->details}}</p>
        <p class="text-muted">التاريخ: {{ $report->date?->format('d/m/Y') }}</p>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>الهاتف</th>
                    <th>رقم الهوية</th>
                    <th>الأسم</th>
                    <th>رقم الهدف</th>
                    @for($i=1; $i<=10; $i++)
                        <th>{{ $i }}</th>
                        @endfor
                        <th>المجموع</th>
                        <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $member)
                <tr>
                    <td>{{ $member?->player?->phone1 ?? '---' }}</td>
                    <td>{{ $member?->player?->ID ?? '---' }}</td>
                    <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>
                    <td>{{ $member->goal ?? '-' }}</td>

                    {{-- R1 → R10 --}}
                    @for($i=1; $i<=10; $i++)
                        <td>{{ $member->{'R'.$i} ?? '-' }}</td>
                        @endfor

                        <td class="fw-bold">{{ $member->total ?? '-' }}</td>
                        <td>{{ $member->notes ?? 'لا توجد ملاحظات' }}</td>
                </tr>
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

</body>

</html>
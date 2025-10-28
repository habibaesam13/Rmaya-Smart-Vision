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

        .m-left {
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
                <img src="{{ asset($siteSettings->logo) }}" class="w-logo" alt="Logo">
                <h3>تقرير النتائج</h3>
                <p class="text-muted m-0">نوع السلاح: {{ $report->weapon?->name ?? '-' }}</p>
                <p class="text-muted m-0"> رقم الديتيل: {{ $report->details}}</p>
                <p class="text-muted m-0">التاريخ: {{ optional( $report->date)->format('d/m/Y')  }}</p>

            </div>
            <div class="text-end">
                <p class="fw-bold m-0">{{ $siteSettings->company_name }}</p>
                <p class="m-0">{{ $siteSettings->address }}</p>
                <p class="m-0">{{ $siteSettings->phone }}</p>
            </div>
        </div>
    </header>



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
                @php $club_id=$member->player->club_id; @endphp

                <tr>
                    <td>{{ $member?->player?->phone1 ?? '---' }} {{$member->confirmed}}</td>
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
        <table celpadding="0" cellspacing="0" class="noborder show_printxx" style="border:none;width:100%;padding-top:10px;">
            <tr>
                <td class="noborder" style="text-align:center;width:50%;vertical-align: text-bottom;">لجنة الرماية
                </td>
                <td class="noborder" style="text-align:center;width:50%">لجنة التحكيم
                    <br>
                        <?php if ($club_id == 1) { ?>
                                        <span style="font-size: 16px;"> مقدم / سيف صبيح طناف الراشدي </span>
                                        <?php } ?><?php if ($club_id == 3) { ?>
                                        <span style="font-size: 16px;"> مقدم ركن م / سالم عبيد راشد السلامي </span>
                                        <?php } ?><?php if ($club_id == 4) { ?>
                                        <span style="font-size: 16px;"> رائد / علي حيي سعيد محمد الكعبي </span>
                                        <?php } ?><?php if ($club_id == 2) { ?>
                                        <span style="font-size: 16px;"> رائد / احمد خلف براك المزروعي </span>
                                    <?php } ?>
                                    <br>
                               
                   
                    <br>

                     @if($report->confirmed) <img style="max-width:200px" src="{{ asset('storage/' . $club_id.'.png') }}"> @endif 
                </td>
            </tr>
        </table>
    </div>
    <div class="d-flex justify-content-end m-left">
        <button class="print-btn" onclick="window.print()">🖨️ طباعة</button>

    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: 'cairo', DejaVu Sans, sans-serif;
        direction: rtl;
        text-align: right;
        font-size: 10px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 6px;
        border: 1px solid #000;
    }
</style>

<body>
    <div class="page-container my-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>رقم الهوية</th>
                            <th>الهاتف</th>
                            <th>العمر</th>
                            <th>السلاح</th>
                            <th>نادي الرماية</th>
                            <th>مكان التسجيل</th>
                            <th>الجنسية</th>
                            <th>المجموعات</th>
                            <th>تاريخ التسجيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->ID }}</td>
                            <td>{{ $member->phone1 ?? $member->phone2 ?? '---' }}</td>
                            <td>{{ $member->age_calculation() }}</td>
                            <td>{{ $member->weapon?->name ?? '---' }}</td>
                            <td>{{ $member->club?->name ?? '---' }}</td>
                            <td>{{ $member->registrationClub?->name ?? '---' }}</td>
                            <td>
                                {{ $member->nationality && trim($member->nationality->country_name_ar ?? '') !== '' 
                                ? $member->nationality->country_name_ar 
                                : (trim($member->nationality->country_name ?? '') !== '' 
                                    ? $member->nationality->country_name 
                                    : '---') 
                            }}
                            </td>
                            <td>{{ $member->member_group?->name ?? '---' }}</td>
                            <td>{{ $member->registration_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
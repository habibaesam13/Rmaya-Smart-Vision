<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered items</title>
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
        @if($siteSettings !==null)
        <div>
            <h2 class="text-center mb-0">{{ $siteSettings->company_name }}</h2>
            <p class="text-center mb-0">{{ $siteSettings->address }}</p>
            <p class="text-center mb-0">{{$siteSettings->company_department_name}}</p>
            <img src="{{public_path($siteSettings->logo) }}" alt="">
            <p class="text-center mb-0">هاتف: {{ $siteSettings->phone }}</p>
            <p class="text-center mb-0">البريد الإلكتروني: {{ $siteSettings->email }}</p>
            <p class="text-center mb-0">  {{ $siteSettings->whatsapp }}</p>
            
            <hr>
        </div>
        @endif
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
                        @foreach($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->ID }}</td>
                            <td>{{ $item->phone1 ?? $item->phone2 ?? '---' }}</td>
                            <td>{{ $item->age_calculation() }}</td>
                            <td>{{ $item->weapon?->name ?? '---' }}</td>
                            <td>{{ $item->club?->name ?? '---' }}</td>
                            <td>{{ $item->registrationClub?->name ?? '---' }}</td>
                            <td>
                                {{ $item->nationality && trim($item->nationality->country_name_ar ?? '') !== '' 
                                ? $item->nationality->country_name_ar 
                                : (trim($item->nationality->country_name ?? '') !== '' 
                                    ? $item->nationality->country_name 
                                    : '---') 
                            }}
                            </td>
                            <td>{{ $item->member_group?->name ?? '---' }}</td>
                            <td>{{ $item->registration_date }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
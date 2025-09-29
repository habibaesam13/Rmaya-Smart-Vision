<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Groups items</title>
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
                            
                            <th>رقم الهوية</th>
                            <th>الاسم</th>
                            <th>الهاتف</th>
                            <th>العمر</th>
                            <th>السلاح</th>
                            <th>اسم الفريق</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($data as $item)
                    <tr>
                        <td>{{ $item->ID}}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone1 ?$item->phone1:$item->phone2}}</td>
                        <td>{{ $item->age_calculation()}}</td>
                        <td>{{ $item->weapon->name}}</td>
                        <td>{{ $item->team?->name ?? '---' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            لا  يوجد فرق مسجلة
                        </td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
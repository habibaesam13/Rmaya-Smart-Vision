<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Groups Members</title>
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
                            
                            <th>رقم الهوية</th>
                            <th>الاسم</th>
                            <th>الهاتف</th>
                            <th>العمر</th>
                            <th>السلاح</th>
                            <th>اسم الفريق</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse($members as $member)
                    <tr>
                        <td>{{ $member->ID}}</td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                        <td>{{ $member->age_calculation()}}</td>
                        <td>{{ $member->weapon->name}}</td>
                        <td>{{ $member->team?->name ?? '---' }}</td>
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
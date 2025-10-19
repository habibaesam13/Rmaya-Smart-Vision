<body>
    <div id="pr">
        @include('print.table_header',['title'=>'قائمة الافراد المتغيبين فى النتائج الاولية'])

        <table class="table table-bordered mb-3">

            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>رقم الهوية</th>
                    <th>الهاتف</th>
                    <th>السلاح </th>
                    <th>تاريخ الرماية</th>
                    <th>رقم الديتيل</th>
                    <th>تاريخ التسجيل</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($members  as $player)
                <tr>
                    <td>{{ $player?->player?->name ?? '---' }}</td>
                    <td>{{ $player?->player?->ID }}</td>
                    <td>{{ $player?->player?->phone1 }}</td>
                    <td>{{ $player?->report?->weapon?->name }}</td>
                    <td>{{ $player?->report?->date}}</td>
                    <td>{{ $player?->report?->details }}</td>
                    <td>{{ $player?->player?->created_at->format('d-m-Y') }}</td>
                    <td>{{ $player?->notes ?? 'لا يوجد ملاحظات' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/scripts.js')}}"></script>
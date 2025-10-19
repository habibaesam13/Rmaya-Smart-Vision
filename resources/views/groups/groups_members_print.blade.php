<body>
    <div id="pr">
        @include('print.table_header',['title'=>' المسجلين فرق تفصيلي'])

        <table class="table table-bordered mb-3">

            <thead>
                <tr>
                    <th>رقم الهوية</th>
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>العمر</th>
                    <th>الفريق</th>
                    <th>السلاح</th>
                </tr>
            </thead>

            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>{{ $member->ID }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone1 ? $member->phone1 : $member->phone2 }}</td>
                    <td>{{ $member->age_calculation() }}</td>
                    <td>
                        {{ $member->team?->name ?? '---' }}
                    </td>
                    <td>{{ $member->weapon->name ?? '---' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/scripts.js')}}"></script>
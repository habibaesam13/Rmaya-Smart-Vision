<body>
    <div id="pr">
        @include('print.table_header',['title'=>'المسجلين فرق'])

        <table class="table table-bordered mb-3">

            <thead>
                <tr>
                    <th>اسم الفريق</th>
                    <th>السلاح</th>
                    <th>تاريخ التسجيل</th>
                </tr>
            </thead>

            <tbody>
                @foreach($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    <td>{{ $group->weapon?->name ?? '---' }}</td>
                    <td>{{ $group->created_at}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/scripts.js')}}"></script>
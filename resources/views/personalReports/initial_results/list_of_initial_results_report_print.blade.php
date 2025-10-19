<body>
    <div id="pr">
        @include('print.table_header',['title'=>'قائمة النتائج الاولية'])

        <table class="table table-bordered mb-3">

            <thead>
                <tr>
                    <th>الاسم</th>
                    <th>السلاح </th>
                    <th>رقم الهوية</th>
                    <th>الهاتف</th>
                    <th>تاريخ الرماية</th>
                    <th>رقم الهدف</th>
                    <th>نادى الرماية</th>
                    <th>الجنسية</th>
                    <th>العلامة المكتسبة</th>
                    <th>الترتيب</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>

            <tbody>
                @foreach($results_without_pag as $index => $player)
                <tr>
                    <td>{{ $player?->player?->name }}</td>
                    <td>{{ $player?->player?->weapon?->name }}</td>
                    <td>{{ $player?->player?->ID }}</td>
                    <td>{{ $player?->player?->phone1 }}</td>
                    <td>{{ $player?->report?->date }}</td>
                    <td>{{ $player?->goal }}</td>
                    <td>{{ $player?->player?->club?->name }}</td>
                    <td>
                        {{ $player?->player?->nationality && trim($player?->player?->nationality->country_name_ar ?? '') !== ''
                                                ? $player?->player?->nationality->country_name_ar
                                                : (trim($player?->player?->nationality->country_name ?? '') !== ''
                                                    ? $player?->player?->nationality->country_name
                                                    : '---')
                                            }}
                    </td>
                    <td>{{$index}}</td>
                    <td>{{ $player?->notes ?: 'لا يوجد ملاحظات' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src="{{asset('js/scripts.js')}}"></script>
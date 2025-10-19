<body>
    @include('print.table_header',['title'=>'تقرير النتائج اليومية'])

    <table class="table table-bordered mb-3">

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
                <td>{{ $member->ID}}</td>
                <td>{{ $member->phone1 ?$member->phone1:$member->phone2}}</td>
                <td>{{ $member->age_calculation()}}</td>
                <td>{{ $member->weapon->name}}</td>
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


                </td>
                <td>{{ $member->member_group?->name ?? '---' }}</td>
                <td>{{ $member->registration_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
<script src="{{asset('js/scripts.js')}}"></script>
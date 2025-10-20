
                            @isset($available_players)
                                @include('print.table_header',['title'=> ' قائمة الافراد المتغيبين عن التصفيات النهائية '])
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>الاسم</th>
                                        <th>السلاح</th>

                                        <th>رقم الهوية</th>
                                        <th>الهاتف</th>
                                        {{--                                <th>العمر</th>--}}
                                        <th>نادي الرماية</th>
                                        {{--                                <th>مكان التسجيل</th>--}}
                                        {{--                                <th>الجنسية</th>--}}
                                        {{--                                <th>المجموعات</th>--}}
                                        <th>العلامة المكتسبة</th>
                                        <th>الترتيب</th>

                                        <th>تاريخ التسجيل</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($available_players as  $key => $player)

                                        <tr>
                                            <td>

                                                <input type="checkbox" class="member-checkbox" name="checkedMembers[]"
                                                       value="{{ $player->mid }}">
                                            </td>
                                            <td>{{ $player->name }}</td>
                                            <td>{{ $player->weapon_name }}</td>

                                            <td>{{ $player->ID }}</td>
                                            <td>{{ $player->phone1 ?? $player->phone2 }}</td>
                                            {{--                                <td>{{ $player->age_calculation() }}</td>--}}
                                            <td>{{ $player->club_name ?? '---' }}</td>
                                            {{--                                <td>{{ $player->registrationClub?->name ?? '---' }}</td>--}}
                                            {{--                                <td>--}}
                                            {{--                                    {{ $player->nationality && trim($player->nationality->country_name_ar ?? '') !== ''--}}
                                            {{--                                ? $player->nationality->country_name_ar--}}
                                            {{--                                : (trim($player->nationality->country_name ?? '') !== ''--}}
                                            {{--                                    ? $player->nationality->country_name--}}
                                            {{--                                    : '---')--}}
                                            {{--                            }}--}}
                                            {{--                                </td>--}}
                                            {{--                                <td>{{ $player->member_group?->name ?? '---' }}</td>--}}
                                            <td>  {{  $player->total ?? 0}}</td>
                                            <td>{{isset($arranging_arr[$key]) ?  $arranging_arr[$key] : ''}}</td>
                                            <td>{{ $player->registration_date }}</td>
                                            <td>
                                                {{ $player->notes }}
{{--                                                <div class="d-flex justify-content-center gap-3">--}}
                                                    {{--                                                                                     Edit Button--}}
                                                    {{--                                                                                    <form action="{{route('personal.edit')}}" method="GET" class="d-inline">--}}
                                                    {{--                                                                                        @csrf--}}
                                                    {{--                                                                                        <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
                                                    {{--                                                                                        <button type="submit" class="icon-btn text-warning" title="تعديل">--}}
                                                    {{--                                                                                            <i class="fas fa-edit"></i>--}}
                                                    {{--                                                                                        </button>--}}
                                                    {{--                                                                                    </form>--}}
                                                    {{--                                                                                     Delete Button--}}
{{--                                                    <form action="{{route('personal-registration-delete')}}"--}}
{{--                                                          method="POST"--}}
{{--                                                          class="d-inline"--}}
{{--                                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">--}}

{{--                                                        @csrf--}}
{{--                                                        <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <button type="submit" class="icon-btn text-danger" title="حذف">--}}
{{--                                                            <i class="fas fa-trash-alt"></i>--}}
{{--                                                        </button>--}}
{{--                                                    </form>--}}

                                                    {{--                                                                                     Toggle Status Button--}}
                                                    {{--                                                                                    <form action="{{route('personal-registration-toggle')}}" method="POST"--}}
                                                    {{--                                                                                        class="d-inline">--}}
                                                    {{--                                                                                        @csrf--}}
                                                    {{--                                                                                        <input type="hidden" name="mid" value="{{ $player->mid }}">--}}
                                                    {{--                                                                                        <button type="submit" class="icon-btn text-success"--}}
                                                    {{--                                                                                            title="{{ 1 ? 'تعطيل' : 'تفعيل' }}">--}}
                                                    {{--                                                                                            <i class="fas fa-{{ $player->active ? 'pause' : 'play' }}"></i>--}}
                                                    {{--                                                                                            <i class="fas fa-1 ? 'pause' : 'play' }}"></i>--}}

                                                    {{--                                                                                        </button>--}}
                                                    {{--                                                                                    </form>--}}
{{--                                                </div>--}}

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12" class="text-center text-muted mt-3">
                                                @if(request()->hasAny(['mgid', 'reg', 'nat', 'club_id', 'weapon_id', 'q', 'gender', 'active', 'date_from', 'date_to', 'reg_club']))
                                                    <p class="mt-3 w-100">لا توجد نتائج مطابقة لبحثك.</p>
                                                @elseif(isset($Edit_report))
                                                    <p class="mt-3 w-100">لا يوجد رماه لهم نفس السلاح
                                                        - {{ $Edit_report?->weapon?->name ?? '---' }}</p>
                                                @else
                                                    <p class="mt-3 w-100">لا يوجد رماة غير مضافين في تقارير.</p>
                                                @endif

                                                @if(isset($Edit_report))
                                                    <form
                                                        action="{{ route('detailed-members-report-save_final', $Edit_report->id) }}"
                                                        method="POST" class="mt-3">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-lg px-5">
                                                            الرجوع للتقرير
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endempty

                                    </tbody>
                                </table>
                            @endisset


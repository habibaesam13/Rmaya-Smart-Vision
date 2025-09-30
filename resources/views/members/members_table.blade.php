<table class="table table-bordered">
    <thead>
        <tr>
            @if($withCheckboxes ?? false)
                <th></th>
            @endif
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
            @if($withActions ?? false)
                <th>أدوات تحكم</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @forelse($members as $member)
        <tr>
            @if($withCheckboxes ?? false)
                <td>
                    <input type="checkbox" name="checkedMembers[]" value="{{ $member->mid }}">
                </td>
            @endif
            <td>{{ $member->name }}</td>
            <td>{{ $member->ID }}</td>
            <td>{{ $member->phone1 ?? $member->phone2 }}</td>
            <td>{{ $member->age_calculation() }}</td>
            <td>{{ $member->weapon->name }}</td>
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

            @if($withActions ?? false)
            <td>
                <div class="d-flex justify-content-center gap-3">
                    {{-- Edit --}}
                    <form action="{{route('personal.edit')}}" method="GET" class="d-inline">
                        @csrf
                        <input type="hidden" name="mid" value="{{ $member->mid }}">
                        <button type="submit" class="icon-btn text-warning" title="تعديل">
                            <i class="fas fa-edit"></i>
                        </button>
                    </form>

                    {{-- Delete --}}
                    <form action="{{route('personal-registration-delete')}}" method="POST" class="d-inline"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الشخص؟');">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="mid" value="{{ $member->mid }}">
                        <button type="submit" class="icon-btn text-danger" title="حذف">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>

                    {{-- Toggle Status --}}
                    <form action="{{route('personal-registration-toggle')}}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="mid" value="{{ $member->mid }}">
                        <button type="submit" class="icon-btn text-success"
                            title="{{ $member->active ? 'تعطيل' : 'تفعيل' }}">
                            <i class="fas fa-{{ $member->active ? 'pause' : 'play' }}"></i>
                        </button>
                    </form>
                </div>
            </td>
            @endif
        </tr>
        @empty
        <tr>
            <td colspan="{{ ($withCheckboxes ?? false ? 12 : 11) }}" class="text-center text-muted">
                لا توجد نتائج مطابقة للبحث
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

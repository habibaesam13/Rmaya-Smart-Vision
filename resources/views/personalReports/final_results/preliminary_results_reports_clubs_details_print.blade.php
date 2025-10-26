@include('print.table_header',['title'=>    "تقارير النتائح النهائية - الديتيل"])

<div class="card shadow-sm border-0" >
    <div class="card-body">
        <table class="table table-bordered mb-3">
            <thead>
            <tr>
                <th>التاريخ</th>
                <th>السلاح</th>
                <th>رقم الديتيل</th>
                <th>أدوات تحكم</th>
            </tr>
            </thead>
            <tbody>
            @forelse($ReportsDetails as $report)
                <tr>
                <!-- <td>{{$report?->Rid}}</td> -->
                    <td>{{ date_create($report->date)->format('d-m-Y') }}</td>
                    <td>{{ $report->weapon?->name ?? '-' }}</td>
                    <td>{{ $report->details }}</td>
                    <td class="text-center">
                        <a href="{{route('report-members_final',$report->id)}}"
                           class=" me-2"
                           data-bs-toggle="tooltip"
                           data-bs-placement="top"
                           title="طباعة التقرير">
                            <i class="ri-printer-line icon-btn"></i>
                        </a>

                        {{-- Attached File Icon (shown only if exists) --}}
                        {{--                                        <a href="{{ $report->file ? asset('storage/' . $report->file) : '#' }}"--}}
                        @if($report->file)
                            <a href="{{ asset(  $report->file)  }}"
                               target="_blank"
                               class="dis"
                               data-bs-toggle="tooltip"
                               data-bs-placement="top"
                               title="عرض الملف المرفق">
                                <i class="ri-attachment-line icon-btn"></i>
                            </a>
                        @endif
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        <i class="fas fa-info-circle me-2"></i> لا توجد نتائج مطابقة للبحث.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

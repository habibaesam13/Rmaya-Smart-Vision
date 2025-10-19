
<body onload="printDiv('pr')">
<div id="pr">
    @include('print.table_header',['title'=>'تقرير النتائج اليومية'])

<table class="table table-bordered mb-3">
  
    <thead>
        <tr>
            <th>التاريخ</th>
            <th>السلاح</th>
            <th>رقم الديتيل</th>
        </tr>
    </thead>

    <tbody>
        @foreach($ReportsDetails_without_pag as $report)
        <tr>
            <td>{{ $report?->date ?
                                    $report?->date: '' }}</td>
            <td>{{ $report->weapon?->name ?? '-' }}</td>
            <td>{{ $report->details }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
            </div>
            </body>
<script src="{{asset('js/scripts.js')}}"></script>


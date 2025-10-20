@include('print.table_header',['title'=> "تقارير النتائج النهائية"])
<table class="table table-bordered ">
    <thead>
    <tr>
        <th style="width: 50px;">#</th>
        <th>التاريخ</th>
        <th>السلاح</th>
        <th>رقم الديتيل</th>
    </tr>
    </thead>
    <tbody>
    {{-- {{dd($sortedRatings )}}--}}

    {{--{{dd($sortedRatings[$index])}}--}}
    @if($items)
        @forelse($items as $key => $item)
            <tr>
                <td class="text-center fw-bold">{{$key+1}} {{$item->id}}</td>
                <td class="text-primary">{{date_create($item->date)->format('Y-m-d')}}</td>
                <td>{{optional($item->weapon)->name}}</td>
                <td class="fw_bold total-input">{{$item->details}}</td>


            </tr>
        @empty
        @endforelse
    @endif


    </tbody>


    </tbody>
</table>


@include('print.table_header',['title'=>  "نتيجة التصفيات النهائية"])

{{-- Results Table Card --}}
                    <div class="card shadow-sm border-0"  >
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead>
                                    <tr>
                                        <th style="width: 50px;">#</th>
                                        <th>الأسم</th>
                                        <th>رقم الهوية</th>
                                        <th>السلاح</th>
                                        <th>علامة مكتسبة</th>
                                        <th>علامة المتعادلين</th>
                                        <th>الترتيب</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $current=0;
                                        $last=count($res)-1;
                                        $prevColor = 'white';
                                        $currentColor = 'white';
                                    @endphp
                                    {{-- {{dd($sortedRatings )}}--}}
                                    @forelse($res as $index => $item)
                                        @php  $current = $index ;
                                if( $index > 0 && $index <= $last  && $item->total === $res[$index - 1]->total ){
                                    $currentColor = $prevColor;
                                }elseif($index == 0){
                                }else{
                                    $r = rand(0, 255);
                                    $g = rand(0, 255);
                                    $b = rand(0, 255);
                                    $currentColor = "rgb($r, $g, $b , 0.2)";
                                }
                                        @endphp

                                        {{--{{dd($sortedRatings[$index])}}--}}
                                        <tr style="background-color: {{$currentColor}} !important;">
                                            <td class="text-center fw-bold">{{ $index + 1 }} </td>
                                            <td>{{$item->player_name}}</td>
                                            <td>{{$item->ID}}</td>
                                            <td>{{$item->weapon_name}}</td>
                                            <td class="fw_bold total-input">{{$item->total}}</td>
                                            {{-- goal --}}
                                            <td>
                                                {{$item->second_total ?? 0}}
                                            </td>
                                            {{-- total --}}
                                            <td>
                                                {{   isset($sortedRatings[$index]   ) ? $sortedRatings[$index]   : ''  }}

                                                {{   isset($sortedRatings[$index] [(string) $item->total]   ) ? $sortedRatings[$index] [(string) $item->total] : ''  }}
                                            </td>

                                            {{-- notes --}}
                                            <td>
                                                {{$item->notes }}
                                            </td>


                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="18" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                                لا توجد بيانات لعرضها
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>


                                    </tbody>
                                </table>
                            </div>
                            {{--                @else--}}
                            {{--                    <div class="text-center py-5">--}}
                            {{--                        <div class="mb-4">--}}
                            {{--                            <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>--}}
                            {{--                        </div>--}}
                            {{--                        <h5 class="text-muted">لا توجد أندية</h5>--}}
                            {{--                        <p class="text-muted mb-0">ابدأ بإضافة أول نادي من النموذج أعلاه</p>--}}
                            {{--                    </div>--}}
                            {{--                @endif--}}
                        </div>
                    </div>

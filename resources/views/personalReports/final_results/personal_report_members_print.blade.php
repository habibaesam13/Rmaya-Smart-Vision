<div class="page-container my-4" >
        @include('print.table_header',['title'=> $report?->weapon?->name ?? '---'  . "تقرير "])

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- Header Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">
                    <i class="ri-file-list-3-line text-primary me-2" style="font-size:2rem !important"></i>
                    تقرير {{ $report?->weapon?->name ?? '---' }}

                </h2>
            </div>


            {{-- Report Info --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">السلاح</label>
                        <h5 class="mb-0 text-dark">{{ $report?->weapon?->name ?? '---' }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">رقم الديتيل</label>
                        <h5 class="mb-0 text-dark">{{ $report?->details ?? '---' }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">التاريخ</label>
                        <h5 class="mb-0 text-dark">{{ $report?->date ? date_create($report->date)->format('d-m-Y') : '---' }}</h5>
                    </div>
                </div>
            </div>
         </div>
    </div>

    {{-- Results Table Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @csrf
            <div class="table-responsive">
                {{--                    <h2>{{session()->get('absents')}}</h2>--}}
                <table class="table table-bordered ">
                    <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>الهاتف</th>
                        <th>رقم الهوية</th>
                        <th>الأسم</th>
                        <th>رقم الهدف</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>المجموع</th>
                        <th>ملاحظات</th>
                     </tr>
                    </thead>
                    <tbody>
                    @forelse($members as $index => $member)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $member?->player?->phone1 ?? '---' }}</td>
                            <td>{{ $member?->player?->ID ?? '---' }}</td>
                            <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>
                            {{-- goal --}}
                            <td>
                                {{ old('goal.' . $member->id, $member->goal ?? '') }}
                            </td>

                            {{-- R1 → R10 --}}
                            @for($i=1; $i<=10; $i++)
                                <td>
                                     {{ old('R'.$i.'.'.$member->id, $member->{'R'.$i} ?? '') }}
                                </td>
                            @endfor

                            {{-- total --}}
                            <td>
                                  {{  $member->total ?? '' }}
                            </td>

                            {{-- notes --}}
                            <td>
                                 {{ old('notes.'.$member->id, $member->notes ?? '') }}
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
                </table>
            </div>

        </div>
    </div>
</div>

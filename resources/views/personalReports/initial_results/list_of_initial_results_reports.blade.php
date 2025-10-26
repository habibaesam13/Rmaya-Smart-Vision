@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">قائمة النتائج الاولية</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">
                <div class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">
                    <span class="badge badge-outline-primary"> عدد الرماة : {{ $totalCount??0 }}</span>
                    <a title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-primary  "><i class="ri-printer-line"></i> </a>
                </div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="card bg-search">
                        {{-- Search Form --}}
                        <form action="{{route('search-list-initial-results-reports')}}" method="get" class="card-body">
                            <div class="row g-3">
                                {{-- weapons --}}
                                <div class="col-md-3">
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg" required>
                                        <option value="" disabled selected>اختر السلاح </option>
                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}" {{ request('weapon_id') == $weapon->wid ? 'selected' : '' }}>
                                            {{ $weapon->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Clubs --}}
                                <div class="col-md-3">
                                    <select name="club_id" id="club_id" class="form-select form-select-lg">
                                        <option value="" disabled {{ !request('club_id') ? 'selected' : '' }}>اختر نادي</option>
                                        @foreach($clubs as $club)
                                        <option value="{{ $club->cid }}" {{ request('club_id') == $club->cid ? 'selected' : '' }}>
                                            {{ $club->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- limit --}}
                                <div class="col-md-3">
                                    <select name="limit" id="limit" class="form-select form-select-lg">
                                        <option value="" disabled {{ !request('limit') ? 'selected' : '' }}>الترتيب</option>
                                        <option value="50" {{ request('limit') == 50 ? 'selected' : '' }}>
                                            1-50
                                        </option>
                                        <option value="100" {{ request('limit') == 100 ? 'selected' : '' }}>
                                            1-100
                                        </option>
                                        <option value="150" {{ request('limit') == 150 ? 'selected' : '' }}>
                                            1-150
                                        </option>
                                        <option value="200" {{ request('limit') == 200 ? 'selected' : '' }}>
                                            1-200
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <input type="date" name="date" id="date"
                                        value="{{ request('date') }}"
                                        class="form-control form-control-lg text-center">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="total" id="total"
                                        value="{{ request('total') }}"
                                        class="form-control form-control-lg text-center"
                                        placeholder=" العلامة المكتسبة >=">
                                </div>

                            </div>
                            <div class="col-md-12 col-lg-2 col-12 mb-2" style="padding-top:8px">
                                <div class="g-1 row justify-content-center">
                                    <div class="col-12 col-lg-5 col-md-6 ">
                                        <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                            <i class="ri-search-2-line "></i>&nbsp;&nbsp;بحث
                                        </button>
                                    </div>
                                    <div class="col-12 col-lg-7 col-md-6">
                                        <a href="{{ route('list-initial-results-reports') }}" class="btn btn-sm btn-warning w-100">
                                            اعادة ضبط
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    {{-- results table --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
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

                                {{-- table body --}}
                                <tbody>
                                    @if(isset($results) && $results)
                                    @foreach($results as $index => $player)
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
                                        <td>
                                            <form action="{{ route('update-player-total-for-preliminary-results', $player->id) }}" method="get" class="d-flex align-items-center gap-2">
                                                <input
                                                    type="number"
                                                    name="total"
                                                    data-player="{{ $player->id }}"
                                                    class="form-control form-control-sm bg-light total-input"
                                                    value="{{ old('total', $player->total ?? '') }}"
                                                    style="max-width: 80px;">
                                                <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                    <i class="ri-save-line text-danger"></i>
                                                </button>
                                            </form>
                                        </td>

                                        <td>
                                            {{-- If paginated --}}
                                            @if($results instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                            {{ ($results->currentPage() - 1) * $results->perPage() + $loop->iteration }}
                                            @else
                                            {{-- If limited list --}}
                                            {{ $loop->iteration }}
                                            @endif
                                        </td>
                                        <td>{{ $player?->notes ?: 'لا يوجد ملاحظات' }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="16" class="text-center text-muted py-3">
                                            <i class="fas fa-info-circle me-2"></i> لا توجد نتائج مطابقة للبحث.
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div id="pr" style="display:none">
                                @include('personalReports/initial_results/list_of_initial_results_report_print', ['results_without_pag'=>@$results_without_pag ])
                            </div>
                            {{-- Pagination --}}
                            @if($results instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $results->appends(request()->query())->links() }}
                            </div>
                            @endif

                        </div>
                    </div>


                </div>
                <style>
                    .icon-btn {
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        width: 38px;
                        height: 38px;
                        border-radius: 8px;
                        background-color: #f8f9fa;
                        color: #bf1e2f;
                        transition: all 0.2s ease-in-out;
                        text-decoration: none;
                    }

                    .icon-btn:hover {
                        background-color: #bf1e2f;
                        color: #f8f9fa;
                    }

                    .icon-btn.disabled {
                        opacity: 0.4;
                        pointer-events: none;
                    }

                    .dis.disabled {
                        opacity: 0.4;
                        pointer-events: none;
                    }
                </style>
            </div>
        </div>
    </div>
</div>
@endsection
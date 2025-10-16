@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">البحث فى النتائج الأولية اليومية</h4>
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
                        <form action="{{route('initial-results-search')}}" method="get" class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <input type="date" name="date" id="date"
                                        value="{{ request('date') }}"
                                        class="form-control form-control-lg text-center">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="q" id="q"
                                        value="{{ request('q') }}"
                                        class="form-control form-control-lg text-center"
                                        placeholder="الاسم / رقم الهوية / رقم الهاتف">
                                </div>

                            </div>
                            <div class="col-md-12 d-flex justify-content-start gap-2 my-2">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                        <i class="fas fa-search me-2"></i>&nbsp;&nbsp;بحث
                                    </button>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ url()->current() }}" class="btn btn-sm btn-warning w-100">
                                        اعادة تعيين
                                    </a>
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
                                        <th>الهاتف</th>
                                        <th>رقم الهوية</th>
                                        <th>الاسم</th>
                                        <th>رقم الهدف </th>
                                        @for ($i=1;$i<=10;$i++)
                                            <th>R{{$i}}</th>
                                            @endfor
                                            <th>المجموع</th>
                                            <th>ملاحظات</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @if(isset($results) && !$results->isEmpty())
                                    @foreach($results as $player)
                                    <tr>
                                        <td>{{$player?->player?->phone1}}</td>
                                        <td>{{$player?->player?->ID}}</td>
                                        <td>{{$player?->player?->name}}</td>
                                        <td>{{$player?->goal}}</td>
                                        @for ($i = 1; $i <= 10; $i++)
                                            <td>{{ $player?->{'R'.$i} }}</td>
                                            @endfor
                                            <td>{{$player?->total}}</td>
                                            <td>{{$player?->notes ? $player?->notes: 'لا يوجد ملاحظات'}}</td>
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
                            {{-- Pagination --}}
                            @if(isset($results) && !$results->isEmpty())

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
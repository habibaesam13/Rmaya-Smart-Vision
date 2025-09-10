@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.Create Event Type')}}</h4>
                    <a href="{{ url(route('admin.logs.index')) }}" class="btn btn-soft-info rounded-pill   float-end  ">Back</a>

                </div>

                <div class="card-body">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                    <form action="{{ url(route('admin.logs.store')) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="row mb-3">
                            <label for="inpuname_ar" class="col-3 col-form-label">{{__('lang.name_ar')}}</label>
                            <div class="col-9">
                                <input type="text" name="name_ar" class="form-control" id="inpuname_ar" placeholder="{{__('lang.name_ar')}} ......">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inpuname_en" class="col-3 col-form-label">{{__('lang.name_en')}}</label>
                            <div class="col-9">
                                <input type="text" name="name_en" class="form-control" id="inpuname_en" placeholder="{{__('lang.name_en')}} ......">
                            </div>
                        </div>



                        <div class="row mb-3">
                            <label for="inpuslug_en" class="col-3 col-form-label">{{__('lang.Active')}}</label>
                            <div class="col-9">
                                <input type="checkbox" name="status" value="1"  id="switch02"   data-switch="success">
                                <label for="switch02" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary rounded-pill">Sign in</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

@endsection

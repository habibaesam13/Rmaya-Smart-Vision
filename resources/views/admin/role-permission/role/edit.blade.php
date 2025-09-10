@extends('admin.master')

@section('content')

    <div class="page-container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.edit')}}  {{__('lang.role')}}</h4>
                    <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-soft-info rounded-pill   float-end  ">{{__('lang.Back')}}</a>

                </div>

                <div class="card-body">
                     @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                    <form action="{{route('admin.roles.update' , $role->id)}}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inpuName3" class="col-3 col-form-label">{{__('lang.name')}}</label>
                            <div class="col-9">
                                <input type="text" name="name" value="{{ $role->name }}" class="form-control" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class=" row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill">{{__('lang.update')}}</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

    {{--    <div class="container mt-5">--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12">--}}

    {{--            @if ($errors->any())--}}
    {{--                <ul class="alert alert-warning">--}}
    {{--                    @foreach ($errors->all() as $error)--}}
    {{--                        <li>{{$error}}</li>--}}
    {{--                    @endforeach--}}
    {{--                </ul>--}}
    {{--            @endif--}}

    {{--            <div class="card">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h4>Edit Role--}}
    {{--                        <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-danger float-end">Back</a>--}}
    {{--                    </h4>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}
    {{--                    <form action="{{route('admin.roles.update',$role->id)}}" method="POST">--}}
    {{--                        @csrf--}}
    {{--                        @method('PUT')--}}

    {{--                        <div class="mb-3">--}}
    {{--                            <label for="">Role Name</label>--}}
    {{--                            <input type="text" name="name" value="{{ $role->name }}" class="form-control" />--}}
    {{--                        </div>--}}
    {{--                        <div class="mb-3">--}}
    {{--                            <button type="submit" class="btn btn-primary">Update</button>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
@endsection

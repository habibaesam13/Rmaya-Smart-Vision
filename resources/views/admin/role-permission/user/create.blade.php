@extends('admin.master')

@section('content')

    <div class="page-container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.Add User')}}</h4>
                    <a href="{{ url(route('admin.users.index')) }}" class="btn btn-soft-info rounded-pill   float-end  ">{{__('lang.Back')}}</a>

                </div>

                <div class="card-body">
{{--                    <p class="text-muted">You can create a new user and assign his roles </p>--}}
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                    <form action="{{ url(route('admin.users.store')) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="row mb-3">
                            <label for="inpuName3" class="col-3 col-form-label">{{__('lang.name')}}</label>
                            <div class="col-9">
                                <input type="text" name="name" class="form-control" id="inpuName3" placeholder="{{__('lang.name')}}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-3 col-form-label">{{__('lang.email')}}</label>
                            <div class="col-9">
                                <input type="email"  name="email"  class="form-control" id="inputEmail3" placeholder="{{__('lang.email')}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-3 col-form-label">{{__('lang.password')}}</label>
                            <div class="col-9">
                                <input type="password"  name="password"  autocomplete = "new-password"  class="form-control" id="inputPassword3" placeholder="Password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputPassword5" class="col-3 col-form-label">{{__('lang.roles')}}</label>
                            <div class="col-9">

                                {{--                                        <label for="choices-multiple-remove-button" class="form-label text-muted">Roles</label>--}}
                                {{--                                        <p class="text-muted">Set <code>data-choices data-choices-removeItem multiple</code> attribute.</p>--}}
                                <select class="form-control" id="choices-multiple-remove-button" data-choices
                                        data-choices-removeItem name="roles[]" multiple>
                                    @foreach($roles as $role => $id)
                                        <option value="{{$role}}"  >{{$role }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>


                        {{--                        <div class="row mb-3 justify-content-end">--}}
                        {{--                            <div class="col-9">--}}
                        {{--                                <div class="form-check">--}}
                        {{--                                    <input type="checkbox" class="form-check-input" id="checkmeout">--}}
                        {{--                                    <label class="form-check-label" for="checkmeout">Check me out !</label>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class=" row">
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary rounded-pill">{{__('lang.Add')}}</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

@endsection

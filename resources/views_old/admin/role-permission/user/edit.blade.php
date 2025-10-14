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

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.update')}}   {{__('lang.admin')}}  {{$user->name}}</h4>
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

                    <form action="{{ route('admin.users.update',$user->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inpuName3" class="col-3 col-form-label">{{__('lang.name')}}</label>
                            <div class="col-9">
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inputEmail3" class="col-3 col-form-label">{{__('lang.email')}}</label>
                            <div class="col-9">
                                {{--                                <input type="email"  name="email"  class="form-control" id="inputEmail3" placeholder="Email">--}}
                                <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />

                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputPassword3" class="col-3 col-form-label">{{__('lang.password')}}</label>
                            <div class="col-9">
                                {{--                                <input type="password"  name="password"  class="form-control" id="inputPassword3" placeholder="Password">--}}
                                <input type="password" name="password"  autocomplete = "new-password" class="form-control" />
                                @error('password') <span class="text-danger">{{ $message }}</span> @enderror

                            </div>
                        </div>
                        {{--                        <div class="row mb-3">--}}
                        {{--                            <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>--}}
                        {{--                            <div class="col-9">--}}
                        {{--                                <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password">--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                        <div class="row mb-3">
                            <label for="inputPassword5" class="col-3 col-form-label">{{__('lang.roles')}}</label>
                            <div class="col-9">
                                {{--                                        <label for="choices-multiple-remove-button" class="form-label text-muted">Roles</label>--}}
                                {{--                                        <p class="text-muted">Set <code>data-choices data-choices-removeItem multiple</code> attribute.</p>--}}
                                <select class="form-control" id="choices-multiple-remove-button" data-choices
                                        data-choices-removeItem name="roles[]" multiple>
                                    @foreach($roles as $role => $id)
                                        <option value="{{$role}}"   {{ in_array($role, $userRoles) ? 'selected':'' }}  >{{$role }}</option>
                                    @endforeach
                                </select>
                                @error('roles') <span class="text-danger">{{ $message }}</span> @enderror


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
                                <button type="submit" class="btn btn-primary rounded-pill">{{__('lang.update')}}</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection

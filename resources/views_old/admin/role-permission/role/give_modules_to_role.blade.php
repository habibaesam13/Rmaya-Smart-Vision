@extends('admin.master')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card">

                    <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;">

                        <h4 class="header-title  ">{{__('lang.role')}} : {{$role_name}}</h4>
                        <a href="{{ url(route('admin.roles.index') ) }}"
                           class="btn btn-soft-info rounded-pill float-end">{{__('lang.Back')}}</a>

                    </div>
                    <div class="card-body  ">

                        <form action="{{route('admin.give_module_to_role_store' , $role_id)}}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                @error('role')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{--                                 @foreach(  $role_modules->get()->pluck('module_code' ,'permissions')   as $key => $perm)--}}
                                {{--                                    @php $arr[$perm] =   $key @endphp--}}
                                {{--                                @endforeach--}}
                                @foreach(  $role_modules->select('module_code' ,'permissions')->get()   as $key => $perm)
                                    @php $arr[$perm->module_code] =   $perm->permissions @endphp
                                @endforeach

                                <div class="row">


                                    @foreach ( getModules() as $key => $mod)

                                        <div class="col-md-6">
                                            <div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                                                <div class="card-header  text-bg-info bg-gradient" style="background-color: #8cc540 !important;">
                                                    <input
                                                        type="checkbox"
                                                        name="modules[]"
                                                        value="{{ $mod['code'] }}"
                                                        {{ in_array($mod['code'], $role_modules->pluck('module_code')->toArray()) ? 'checked':'' }}
                                                    />
                                                    <strong class="font-medium fw-bolder">{{ $mod['name'] }}</strong>
                                                </div>


                                                <div class="card-body">
                                                    <div class="row px-1">
                                                        @foreach ( $mod['mod_do'] as $permission)

                                                            <label style="  width: 75px"
                                                                   class="badge badge-soft-primary mx-1 my-1 ">{{$permission['can_do_label_' . app()->getLocale()]}}
                                                                <input class="opacity-75"
                                                                       type="checkbox"
                                                                       name="permission[{{$mod['code']}}][]"
                                                                       value="{{$permission['can_do']}}"
                                                                    {{ isset($arr [$mod['code']])  && in_array(   $permission['can_do'] ,       explode(',' ,$arr  [$mod['code']])  )      ? 'checked':'' }}

                                                                />
                                                            </label>


                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary rounded-pill">{{__('lang.update')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

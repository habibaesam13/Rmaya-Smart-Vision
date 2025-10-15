@extends('admin.master') @section('content') <div class="page-container">
  <div class="row">
    <div class="col-12">
      <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-8">
          <h4 class="header-title">{{__('lang.role')}} : {{$role_name}}</h4>
        </div>
        <div class="col-md-4">
          <a href="{{ url(route('admin.roles.index') ) }}" class="btn btn-soft-info rounded-pill px-3 float-end">
            <i class="ri-arrow-go-back-line"></i>
            <span class="d-none d-sm-inline"> &nbsp;&nbsp; {{__('lang.Back')}}
              <span />
          </a>
        </div>
      </div>
      <div class="col-md-12"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif <div class="card">
          <div class="card-body  ">
            <form action="{{route('admin.give_module_to_role_store' , $role_id)}}" method="POST"> @csrf @method('PUT') <div class="col-md-12"> @error('role') <span class="text-danger">{{ $message }}</span> @enderror {{-- @foreach(  $role_modules->get()->pluck('module_code' ,'permissions')   as $key => $perm)--}}
                {{-- @php $arr[$perm] =   $key @endphp--}}
                {{-- @endforeach--}} @foreach( $role_modules->select('module_code' ,'permissions')->get() as $key => $perm) @php $arr[$perm->module_code] = $perm->permissions @endphp @endforeach <div class="row"> @foreach ( getModules() as $key => $mod) <div class="col-md-12">
                    <div class="card">
                      <div class="card-header-todo">
                        <div class="basic-container card-header-todo-inner ">
                          <input type="checkbox" name="modules[]" value="{{ $mod['code'] }}" {{ in_array($mod['code'], $role_modules->pluck('module_code')->toArray()) ? 'checked':'' }} />
                          <lable> {{ $mod['name'] }}</lable>
                        </div>
                      </div>
                      <div class="todo">
                        <div class="row "> @foreach ( $mod['mod_do'] as $permission) <div class="col-md-3 mb-1 mt-1">
                            <div class="basic-container ">
                              <input type="checkbox" name="permission[{{$mod['code']}}][]" value="{{$permission['can_do']}}" {{ isset($arr [$mod['code']])  && in_array(   $permission['can_do'] ,       explode(',' ,$arr  [$mod['code']])  )      ? 'checked':'' }} />
                              <label> {{$permission['can_do_label']}} </label>
                            </div>
                          </div> @endforeach </div>
                      </div>
                    </div>
                  </div> @endforeach </div>
              </div>
              <hr />
              <div class="col-12 col-md-2 offset-md-10 d-flex justify-content-center justify-content-md-end mb-3">
                <button type="submit" class="btn btn-primary rounded-pill px-3">
                  <i class="ri-save-line"></i> &nbsp;&nbsp; {{__('lang.update')}}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> @endsection
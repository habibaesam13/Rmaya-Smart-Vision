@extends('admin.master') @section('content') <div class="page-container">
    
  <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
  <div class="col-8 col-md-8 mb-2 mb-md-0">
      <h4 class="header-title">{{__('lang.add_user')}}</h4>
    </div>
   <div class="col-4 col-md-4 text-center text-md-end">
      <a href="{{ url(route('admin.users.index')) }}" class="btn btn-soft-info rounded-pill  float-end">
        <i class="ri-arrow-go-back-line"></i>
        <span class="d-none d-sm-inline"> &nbsp;&nbsp;{{__('lang.Back')}}
          <span/>
      </a>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        {{-- <p class="text-muted">You can create a new user and assign his roles </p>--}} @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div> @endforeach <br> @endif 
        <form action="{{ url(route('admin.users.store')) }}" method="POST" class="form-horizontal"> @csrf <div class="row">
            <div class="col-md-6">
              <label for="inpuName3" class="col-3 col-form-label">{{__('lang.name')}}</label>
              <div class="col-12">
                <input type="text" name="name" class="form-control" id="inpuName3" placeholder="{{__('lang.name')}}">
              </div>
            </div>
            <div class="col-md-6">
              <label for="inputEmail3" class=" col-form-label">{{__('lang.email')}}</label>
              <div class="col-12">
                <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="{{__('lang.email')}}">
              </div>
            </div>
             <div class="col-12 col-md-6">
              <label for="inpuName3" class="col-form-label">اسم الدخول</label>
              <input type="text" name="username" value="" class="form-control" /> @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-md-6">
              <label for="inputPassword3" class=" col-form-label">{{__('lang.password')}}</label>
              <div class="col-12">
                <input type="password" name="password" autocomplete="new-password" class="form-control" id="inputPassword3" placeholder="{{__('lang.password')}}">
              </div>
            </div>
            {{-- <div class="col-md-12">--}}
            {{-- <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>--}}
            {{-- <div class="col-12">--}}
            {{-- <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password">--}}
            {{-- </div>--}}
            {{-- </div>--}}
            <div class="col-md-6">
              <label for="inputPassword5" class="col-12 col-form-label">{{__('lang.role')}}</label>
              <div class="col-md-12">
                {{-- <label for="choices-multiple-remove-button" class="form-label text-muted">Roles</label>--}}
                {{-- <p class="text-muted">Set 
															<code>data-choices data-choices-removeItem multiple</code> attribute.
														</p>--}}
                <select class="form-control" id="choices-multiple-remove-buttonx" data-choices data-choices-removeItem name="roles[]" > @foreach($roles as $role => $id) <option value="{{$role}}">{{$role }}</option> @endforeach </select>
              </div>
            </div>
            
            <div class="col-md-6">
              <label for="inputPassword5" class="col-12 col-form-label">النادي</label>
              <div class="col-md-12">
                <select class="form-control"  name="clubid" >
                     @foreach($clubs as $club => $cid) <option value="{{$cid}}">{{$club}}</option> @endforeach </select>
              </div>
            </div>
            
            
            
            <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3 mt-3">
              <button type="submit" class="btn btn-primary rounded-pill px-3">
                <i class="ri-user-add-line"></i> &nbsp;&nbsp; {{__('lang.Add')}}
              </button>
            </div>
            {{-- <div class="row mb-3 justify-content-end">--}}
            {{-- <div class="col-12">--}}
            {{-- <div class="form-check">--}}
            {{-- <input type="checkbox" class="form-check-input" id="checkmeout">--}}
            {{-- <label class="form-check-label" for="checkmeout">Check me out !</label>--}}
            {{-- </div>--}}
            {{-- </div>--}}
            {{-- </div>--}}
        </form>
      </div>
      <!-- end card-body -->
    </div>
  </div>
</div> 
@endsection
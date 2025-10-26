@extends('admin.master') @section('content') <div class="page-container">
  <div class="col-12 d-flex justify-content-between align-items-center my-3">
    <div class="col-md-8">
      <h4 class="header-title">{{__('lang.user_edit')}} {{$user->name}}</h4>
    </div>
    <div class="col-md-4">
      <a href="{{ url(route('admin.users.index')) }}" class="btn btn-soft-info rounded-pill px-3 float-end">
        <i class="ri-arrow-go-back-line"></i>
        <span class="d-none d-sm-inline">&nbsp;&nbsp; {{__('lang.Back')}}
          <span></span>
        </span>
      </a>
    </div>
  </div>
  <div class="col-lg-12"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif <div class="card">
      <div class="card-body">
        {{-- <p class="text-muted">You can create a new user and assign his roles </p>--}} @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div> @endforeach <br> @endif <form action="{{ route('admin.users.update',$user->id) }}" method="POST" class="form-horizontal"> @csrf @method('PUT') <div class="row">
            <div class="col-12 col-md-6">
              <label for="inpuName3" class="col-form-label">{{__('lang.name')}}</label>
              <input type="text" name="name" value="{{ $user->name }}" class="form-control" /> @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 col-md-6">
              <label for="inputEmail3" class=" col-form-label">{{__('lang.email')}}</label>
              {{-- <input type="email"  name="email"  class="form-control" id="inputEmail3" placeholder="Email">--}}
              <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />
            </div>
             <div class="col-12 col-md-6">
              <label for="inpuName3" class="col-form-label">اسم الدخول</label>
              <input type="text" name="username" value="{{ $user->username }}" class="form-control" /> @error('username') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 col-md-6">
              <label for="inputPassword3" class="col-form-label">{{__('lang.password')}}</label>
              {{-- <input type="password"  name="password"  class="form-control" id="inputPassword3" placeholder="Password">--}}
              <input type="password" name="password" autocomplete="new-password" class="form-control" /> @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            {{-- <div class="col-12 col-md-4">--}}
            {{-- <label for="inputPassword5" class="col-3 col-form-label">Re Password</label>--}}
            {{-- <input type="password" class="form-control" id="inputPassword5" placeholder="Retype Password">--}}
            {{-- </div>--}}
            <div class="col-6 col-md-6">
              <label for="inputPassword5" class="col-form-label">{{__('lang.role')}}</label>
              {{-- <label for="choices-multiple-remove-button" class="form-label text-muted">Roles</label>--}}
              {{-- <p class="text-muted">Set 
												<code>data-choices data-choices-removeItem multiple</code> attribute.
											</p>--}}
              <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="roles[]"> @foreach($roles as $role => $id) <option value="{{$role}}" {{ in_array($role, $userRoles) ? 'selected':'' }}>{{$role }}</option> @endforeach </select> @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
             <div class="col-md-6">
              <label for="inputPassword5" class="col-12 col-form-label">النادي</label>
              <div class="col-md-12">
                <select class="form-control"  name="clubid" >
                                        <option value="">اخنر نادي </option>
                     @foreach($clubs as $club => $cid) <option @if($cid==$user->clubid) selected="" @endif value="{{$cid}}">{{$club}}</option> @endforeach </select>
              </div>
            </div>
          </div>
          {{-- <div class="col-12 col-md-12">--}}
          {{-- <div class="form-check">--}}
          {{-- <input type="checkbox" class="form-check-input" id="checkmeout">--}}
          {{-- <label class="form-check-label" for="checkmeout">Check me out !</label>--}}
          {{-- </div>--}}
          {{-- </div>--}}
          <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3 mt-3">
            <button type="submit" class="btn btn-primary rounded-pill px-3">
              <i class="ri-user-add-line"></i> &nbsp;&nbsp; {{__('lang.update')}}
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div> @endsection
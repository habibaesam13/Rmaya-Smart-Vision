@extends('admin.master') @section('content') <div class="page-container">
  <div class="col-12 d-flex justify-content-between align-items-center my-3">
    <div class="col-md-8">
      <h4 class="header-title">{{__('lang.Add')}} {{__('lang.role')}}</h4>
    </div>
    <div class="col-md-4">
      <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-soft-info rounded-pill px-3 float-end">
        <i class="ri-arrow-go-back-line"></i>
        <span class="d-none d-sm-inline">&nbsp;&nbsp; {{__('lang.Back')}}
          <span/>
      </a>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body"> @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div> @endforeach <br> @endif <form action="{{ url(route('admin.roles.store')) }}" method="POST" class="form-horizontal"> @csrf <div class="row mb-3">
            <div class="col-12 col-md-9 col-lg-11">
              <label for="inpuName3" class="col-12 col-form-label">{{__('lang.name')}}</label>
              <input type="text" name="name" value="{{old('name')}}" class="form-control" /> @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 col-md-3 col-lg-1 d-flex justify-content-center align-items-center">
              <button type="submit" class="btn btn-primary rounded-pill min-w-120 min-h-39 mt-lg-2 mt-1 mt-md-3">
                <i class="ri-add-circle-line"></i> &nbsp;&nbsp; {{__('lang.Add')}}
              </button>
            </div>
          </div>
        </form>
      </div>
      <!-- end card-body -->
    </div>
    <!-- end card -->
  </div>
  <!-- end col -->
</div>
{{-- <div class="page-container">--}}
{{-- <div class="col-lg-12">--}}
{{-- <div class="card">--}}
{{-- <div class="card-header border-bottom border-dashed d-flex align-items-center"--}}
{{-- style="  justify-content: space-between;">--}}
{{-- <h4 class="header-title  ">Create Role</h4>--}}
{{-- <a href="{{ url(route('admin.roles.index')) }}"--}} {{-- class="btn btn-soft-info rounded-pill   float-end  ">Back</a>--}}
{{-- </div>--}}
{{-- <div class="card-body">--}}
{{-- <p class="text-muted">You can create a new user and assign his roles </p>--}}
{{-- @if ($errors->any())--}}
{{-- @foreach ($errors->all() as $error)--}}
{{-- <div class="text-danger">{{$error}}</div>--}} {{-- @endforeach--}}
{{-- <br>--}}
{{-- @endif--}}
{{-- <form action="{{ url(route('admin.roles.store')) }}" method="POST" class="form-horizontal">--}} {{-- @csrf--}}
{{-- <div class="row mb-3">--}}
{{-- <label for="inpuName3" class="col-3 col-form-label">Permission Name</label>--}}
{{-- <div class="col-9">--}}
{{-- <input type="text" name="name" class="form-control" id="inpuName3"--}}
{{-- placeholder="Role Name"/>--}}
{{-- @error('name') 
										<span class="text-danger">{{ $message }}</span> @enderror--}} {{-- </div>--}}
{{-- </div>--}}
{{-- <div class="justify-content-end row">--}}
{{-- <div class="col-9">--}}
{{-- <button type="submit" class="btn btn-primary rounded-pill">Sign in</button>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </div>
						<!-- end card-body -->--}}
{{-- </div>
					<!-- end card -->--}}
{{-- </div>
				<!-- end col -->--}}
{{-- </div>--}} @endsection
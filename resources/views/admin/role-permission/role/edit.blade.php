@extends('admin.master') @section('content') <div class="page-container">
  <div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
      <div class="col-md-8">
        <h4 class="header-title">{{__('lang.edit_role')}}</h4>
      </div>
      <div class="col-md-4">
        <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-soft-info rounded-pill px-3 float-end">
          <i class="ri-arrow-go-back-line"></i>
          <span class="d-none d-sm-inline">&nbsp;&nbsp; {{__('lang.Back')}}
            <span />
        </a>
      </div>
    </div>
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body"> @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div> @endforeach <br> @endif <form action="{{route('admin.roles.update' , $role->id)}}" method="POST" class="form-horizontal"> @csrf @method('PUT') <div class="row">
              <div class="col-12 col-md-9 col-lg-10 ">
                <label for="inpuName3" class="col-form-label mb-1">{{__('lang.name')}}</label>
                <input type="text" name="name" value="{{ $role->name }}" class="form-control" /> @error('name') <span class="text-danger">{{ $message }}</span> @enderror
              </div>
              <div class="col-12 col-md-3 col-lg-2  justify-content-center justify-content-md-end mt-1 ">
                <button type="submit" class="btn btn-primary px-3 w-100 fw-bold min-h-39  mb-4  mt-md-4  mb-md-4">
                  <i class="ri-edit-line"></i> &nbsp;&nbsp; {{__('lang.update')}}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- <div class="container">--}}
{{-- <div class="row">--}}
{{-- <div class="col-md-12">--}}
{{-- @if ($errors->any())--}}
{{-- <ul class="alert alert-warning">--}}
{{-- @foreach ($errors->all() as $error)--}}
{{-- <li>{{$error}}</li>--}} {{-- @endforeach--}}
{{-- </ul>--}}
{{-- @endif--}}
{{-- <div class="card">--}}
{{-- <div class="card-header">--}}
{{-- <h4>Edit Role--}}
{{-- <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-danger float-end">Back</a>--}} {{-- </h4>--}}
{{-- </div>--}}
{{-- <div class="card-body">--}}
{{-- <form action="{{route('admin.roles.update',$role->id)}}" method="POST">--}} {{-- @csrf--}}
{{-- @method('PUT')--}}
{{-- <div class="mb-3">--}}
{{-- <label for="">Role Name</label>--}}
{{-- <input type="text" name="name" value="{{ $role->name }}" class="form-control" />--}} {{-- </div>--}}
{{-- <div class="mb-3">--}}
{{-- <button type="submit" class="btn btn-primary">Update</button>--}}
{{-- </div>--}}
{{-- </form>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- </div>--}} @endsection
@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">Create Permission</h4>
                    <a href="{{ url(route('admin.permissions.index')) }}" class="btn btn-soft-info rounded-pill   float-end  ">Back</a>

                </div>

                <div class="card-body">
                    <p class="text-muted">You can create a new user and assign his roles </p>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                    <form action="{{ url(route('admin.permissions.store')) }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="row mb-3">
                            <label for="inpuName3" class="col-3 col-form-label">Permission Name</label>
                            <div class="col-9">
                                <input type="text" name="name" class="form-control"  id="inpuName3" placeholder="Permission Name" />
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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

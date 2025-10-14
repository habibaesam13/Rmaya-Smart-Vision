
@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="col-12 d-flex justify-content-between align-items-center my-3">
        <div class="col-md-12">
            <h4 class="header-title">تعديل سلاح</h4>
        </div>
    </div>
    <div class="card">
        <div class="card-body"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif @if (session('warning')) <div class="alert alert-warning">{{ session('warning') }}</div>@endif @if ($errors->any()) @foreach ($errors->all() as $error) <div class="text-danger">{{$error}}</div>@endforeach <br>@endif
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <form action="{{ route('weapons.update', $weapon->wid) }}" method="POST" class="form-horizontal">
                @csrf
                <div class="row">

                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="form-label">اسم السلاح</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $weapon->name) }}" placeholder="اكتب اسم السلاح">
                        @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 d-flex justify-content-start gap-2 my-2" style="padding-top:8px">
                        <div class="g-1 row justify-content-center">
                            <div class="col-12 col-md-6">
                                <button type="submit" class="btn btn-sm btn-info w-100">
                                   تحديث
                                </button>
                            </div>
                            <div class="col-12 col-md-6">
                                <a href="{{ route('weapons.index') }}" class="btn btn-sm btn-warning w-100">
                                    الغاء
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
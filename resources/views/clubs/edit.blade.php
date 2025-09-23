@extends('admin.master')
@section('content')
<div class="page-container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">تعديل نادي</h4>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('clubs.update', $club->cid) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">اسم النادي</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $club->name) }}" placeholder="اكتب اسم النادي">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary px-4">تحديث</button>
                <a href="{{ route('clubs.index') }}" class="btn btn-danger px-4 ms-2">إلغاء</a>
            </form>
        </div>
    </div>
@endsection

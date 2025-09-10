@extends('admin.master')
@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">تعديل سلاح</h4>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('weapons.update', $weapon->wid) }}" method="POST" class="mb-4">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">اسم السلاح</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $weapon->name) }}" placeholder="اكتب اسم السلاح">
                    @error('name')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary px-4">تحديث</button>
                <a href="{{ route('weapons.index') }}" class="btn btn-secondary px-4 ms-2">إلغاء</a>
            </form>
        </div>
    </div>
@endsection

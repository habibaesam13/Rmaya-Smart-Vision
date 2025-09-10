@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">إضافة سلاح</h4>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('weapons.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">اسم السلاح</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                        placeholder="اكتب اسم السلاح">
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success px-4">إضافة</button>
            </form>

            {{-- Weapons List --}}
            <h5 class="mb-3">كل الأسلحة</h5>
            <ul class="list-group">
                @forelse($weapons as $weapon)
                <li class="list-group-item d-flex gap-2 justify-content-between align-items-center">
                    {{ $weapon->name }}
                    <span class="badge bg-secondary">#{{ $weapon->wid }}</span>
                    <form action="{{ route('weapons.destroy', $weapon->wid) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا السلاح؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    <form action="{{ route('weapons.edit', $weapon->wid) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </li>
                @empty
                <li class="list-group-item text-muted">لا توجد أسلحة مضافة</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="container my-4">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h4 class="card-title mb-4">إضافة نادي</h4>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Form --}}
            <form action="{{ route('clubs.store') }}" method="POST" class="mb-4">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">اسم النادي</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                        placeholder="اكتب اسم النادي">
                    @error('name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success px-4">إضافة</button>
            </form>

            {{-- Clubs List --}}
            <h5 class="mb-3">كل الأندية</h5>
            <ul class="list-group">
                @forelse($clubs as $club)
                <li class="list-group-item d-flex gap-2 justify-content-between align-items-center">
                    {{ $club->name }}
                    <span class="badge bg-secondary">#{{ $club->cid }}</span>
                    <form action="{{ route('clubs.destroy', $club->cid) }}" method="POST"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا النادي؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    <form action="{{ route('clubs.edit', $club->cid) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                    <form action="{{ route('clubs.toggle-status', $club->cid) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn  btn-sm">
                            @if($club->active)
                            <i class="fas fa-toggle-on text-success" style="font-size: 1.4rem;"></i>
                            @else
                            <i class="fas fa-toggle-off text-danger" style="font-size: 1.4rem;"></i>
                            @endif
                        </button>
                    </form>
                    <a href="#"><i class="fa-solid fa-gun"></i></a>
                </li>
                @empty
                <li class="list-group-item text-muted">لا توجد أندية مضافة</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
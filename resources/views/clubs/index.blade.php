@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="page-container my-4">
    {{-- Add Club Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="fas fa-plus-circle text-success me-2" style="font-size:2rem !important"></i>إضافة نادي
            </h2>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('clubs.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="name" class="form-label fw-bold">اسم النادي</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" 
                               value="{{ old('name') }}" placeholder="اكتب اسم النادي" required>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-plus me-2"></i>إضافة النادي
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Clubs Table Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="fas fa-list text-primary me-2"></i>جميع الأندية
            </h5>
        </div>
        <div class="card-body p-0">
            @if($clubs->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-start">
                                <i class="fas fa-tag me-2"></i>اسم النادي
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-info-circle me-2"></i>الحالة
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>الإجراءات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clubs as $index => $club)
                        <tr>
                            <td class="fw-semibold text-start">{{ $club->name }}</td>
                            <td class="text-center">
                                <span class="badge {{ $club->active ? 'bg-success' : 'bg-danger' }} px-3 py-2">
                                    <i class="fas fa-{{ $club->active ? 'check' : 'times' }} me-1"></i>
                                    {{ $club->active ? 'نشط' : 'غير نشط' }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    {{-- Toggle Status Button --}}
                                    <form action="{{ route('clubs.toggle-status', $club->cid) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="icon-btn text-warning" 
                                                title="{{ $club->active ? 'إلغاء التفعيل' : 'تفعيل' }}"
                                                data-bs-toggle="tooltip">
                                            <i class="fas fa-{{ $club->active ? 'pause' : 'play' }}"></i>
                                        </button>
                                    </form>

                                    {{-- Edit Button --}}
                                    <a href="{{ route('clubs.edit', $club->cid) }}" 
                                       class="icon-btn text-primary" 
                                       title="تعديل"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('clubs.destroy', $club->cid) }}" method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا النادي؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn text-danger" 
                                                title="حذف"
                                                data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>

                                    {{-- Custom Icon Example --}}
                                    <a href="{{ route('clubs-weapons.index', $club->cid) }}" class="icon-btn text-dark" title="سلاح مرتبط">
                                        <i class="fa-solid fa-gun"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-inbox fa-4x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">لا توجد أندية</h5>
                <p class="text-muted mb-0">ابدأ بإضافة أول نادي من النموذج أعلاه</p>
            </div>
            @endif
        </div>
    </div>
</div>


<style>
    .icon-btn {
        background: none;
        border: none;
        padding: 0;
        font-size: 1.2rem; 
        cursor: pointer;
    }
    .icon-btn:hover {
        opacity: 0.8;
    }
</style>

{{-- Bootstrap Tooltip Initialization --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection

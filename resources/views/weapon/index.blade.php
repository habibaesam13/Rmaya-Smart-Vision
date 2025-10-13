@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
@section('content')
<div class="page-container my-4">
    {{-- Add Weapon Form Section --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h2 class="card-title mb-4">
                <i class="fas fa-plus-circle text-success me-2"></i>إضافة سلاح
            </h2>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('weapons.store') }}" method="POST">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="name" class="form-label fw-bold">اسم السلاح</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" 
                               value="{{ old('name') }}" placeholder="اكتب اسم السلاح" required>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-plus me-2"></i>إضافة السلاح
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Weapons Table Section --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light">
            <h5 class="card-title mb-0">
                <i class="fas fa-list text-primary me-2"></i>جميع الأسلحة
            </h5>
        </div>
        <div class="card-body p-0">
            @if($weapons->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col" class="text-start">
                                <i class="fas fa-crosshairs me-2"></i>اسم السلاح
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>الإجراءات
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weapons as $index => $weapon)
                        <tr>
                            {{-- text-start عشان النص يبدأ من بداية العمود --}}
                            <td class="fw-semibold text-start">{{ $weapon->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-3">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('weapons.edit', $weapon->wid) }}" 
                                       class="icon-btn text-primary" 
                                       title="تعديل السلاح"
                                       data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('weapons.destroy', $weapon->wid) }}" method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا السلاح؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn text-danger" 
                                                title="حذف السلاح"
                                                data-bs-toggle="tooltip">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
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
                    <i class="fas fa-crosshairs fa-4x text-muted opacity-50"></i>
                </div>
                <h5 class="text-muted">لا توجد أسلحة</h5>
                <p class="text-muted mb-0">ابدأ بإضافة أول سلاح من النموذج أعلاه</p>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Custom CSS for icons --}}
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- Bootstrap Tooltip Initialization --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection

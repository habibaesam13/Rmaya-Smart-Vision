@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')
<div class="page-container my-4">
    {{-- Header Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">
                    <i class="ri-file-list-3-line text-primary me-2" style="font-size:2rem !important"></i>
                    تقرير النتائج اليومية للأسلحة
                </h2>
            </div>

            {{-- Report Info --}}
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">السلاح</label>
                        <h5 class="mb-0 text-dark">{{ $report?->weapon?->name ?? '---' }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">رقم الديتيل</label>
                        <h5 class="mb-0 text-dark">{{ $report?->details ?? '---' }}</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-box bg-light p-3 rounded">
                        <label class="text-muted small mb-1">التاريخ</label>
                        <h5 class="mb-0 text-dark">{{ $report?->date ? $report->date->format('d-m-Y') : '---' }}</h5>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex flex-wrap gap-2">
                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        <span>إضافة رماة</span>
                    </button>
                </form>

                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>اعتماد وإرسال النتائج الأولية</span>
                    </button>
                </form>

                <form action="" method="POST" enctype="multipart/form-data" class="d-flex gap-2">
                    @csrf
                    <div class="file-upload-wrapper">
                        <input type="file" name="attached_file" id="attached_file" class="form-control" accept=".pdf,.doc,.docx,.xlsx,.xls">
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-upload"></i>
                        <span>رفع ملف</span>
                    </button>
                </form>

                <form action="" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>حفظ التقرير</span>
                    </button>
                </form>

                <form action="" method="GET">
                    <button type="submit" class="btn btn-danger btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-print"></i>
                        <span>طباعة</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Results Table Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form action="" method="POST" id="resultsForm">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th style="width: 50px;">#</th>
                                <th style="width: 120px;">الهاتف</th>
                                <th style="width: 120px;">رقم الهوية</th>
                                <th style="width: 200px;">الأسم</th>
                                <th style="width: 100px;">رقم الهدف</th>
                                <th style="width: 60px;">1</th>
                                <th style="width: 60px;">2</th>
                                <th style="width: 60px;">3</th>
                                <th style="width: 60px;">4</th>
                                <th style="width: 60px;">5</th>
                                <th style="width: 60px;">6</th>
                                <th style="width: 60px;">7</th>
                                <th style="width: 60px;">8</th>
                                <th style="width: 60px;">9</th>
                                <th style="width: 60px;">10</th>
                                <th style="width: 80px;">المجموع</th>
                                <th style="width: 150px;">ملاحظات</th>
                                <th style="width: 80px;">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $index => $member)
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td>{{ $member?->player?->phone1 ?? '---' }}</td>
                                <td>{{ $member?->player?->ID ?? '---' }}</td>
                                <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>
                                <td>
                                    <input type="number" name="target_number[]" class="form-control form-control-sm" 
                                           placeholder="رقم الهدف" min="1">
                                </td>
                                <td>
                                    <input type="number" name="R1[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R2[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R3[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R4[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R5[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R6[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R7[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R8[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R9[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="R10[]" class="form-control form-control-sm score-input" 
                                           placeholder="0" min="0" max="10" data-row="{{ $index }}">
                                </td>
                                <td>
                                    <input type="number" name="total[]" class="form-control form-control-sm bg-light total-input" 
                                           placeholder="0"  id="total-{{ $index }}">
                                </td>
                                <td>
                                    <input type="text" name="notes[]" class="form-control form-control-sm" 
                                           placeholder="ملاحظات">
                                </td>
                                <td class="text-center">
                                    <form action="" method="POST" class="d-inline" 
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا اللاعب؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="حذف">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="18" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                    لا توجد بيانات لعرضها
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .info-box {
        border-left: 4px solid #0d6efd;
        transition: all 0.3s ease;
    }

    .info-box:hover {
        background-color: #e9ecef !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .file-upload-wrapper {
        position: relative;
        min-width: 250px;
    }

    .file-upload-wrapper input[type="file"] {
        height: 48px;
        padding: 0.75rem;
    }

    .btn {
        transition: all 0.2s ease-in-out;
        white-space: nowrap;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .table th {
        background-color: #f8f9fa;
        font-weight: 600;
        border-color: #dee2e6;
    }

    .table td {
        vertical-align: middle;
    }

    .score-input {
        text-align: center;
        font-weight: 600;
        padding: 0.375rem;
    }

    .total-input {
        text-align: center;
        font-weight: bold;
        color: #0d6efd;
        font-size: 1.1rem;
    }

    .score-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    @media (max-width: 768px) {
        .d-flex.flex-wrap.gap-2 {
            flex-direction: column;
        }

        .d-flex.flex-wrap.gap-2 form,
        .d-flex.flex-wrap.gap-2 .file-upload-wrapper {
            width: 100%;
        }

        .d-flex.flex-wrap.gap-2 button {
            width: 100%;
            justify-content: center;
        }
    }

    .table-responsive {
        border-radius: 8px;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection
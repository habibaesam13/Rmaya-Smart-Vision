@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

@section('content')
<div class="page-container my-4">
    {{-- Success Message --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    {{-- Header Card --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="card-title mb-0">
                    <i class="ri-file-list-3-line text-primary me-2" style="font-size:2rem !important"></i>
                    تقرير       {{ $report?->weapon?->name ?? '---' }}

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
                        <h5 class="mb-0 text-dark">{{ $report?->date ? date_create($report->date)->format('d-m-Y') : '---' }}</h5>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="d-flex flex-wrap gap-2">
                @if(!$confirmed)
                <form action="{{route('add-player-to-report_final',$report?->id)}}" method="get">
                    <button type="submit" class="btn btn-primary btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-user-plus"></i>
                        <span>إضافة رماة</span>
                    </button>
                </form>
                <form action="{{route('report-confirmation_final',$report?->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <span>اعتماد وإرسال النتائج الأولية</span>
                    </button>
                </form>
                @endif
                {{-- report save --}}

                <form action="{{ route('detailed-members-report-save_final', $report?->id) }}"
                    method="POST"
                    id="saveReportForm"
                    enctype="multipart/form-data"
                    class="d-flex align-items-center gap-2">
                    @csrf
                    <input type="hidden" name="players_data" id="playersData">

                    {{-- الملف --}}
                    <div class="file-upload-wrapper">
                        <input type="file" name="attached_file" id="attached_file"
                            class="form-control" accept=".pdf,.doc,.docx,.xlsx,.xls">
                    </div>
                          {{-- Print Button --}}
                <a href="{{ route('report.print_final', $report->id) }}"
                    target="_blank"
                    class="btn btn-outline-dark btn-lg d-flex align-items-center gap-2">
                    <i class="fas fa-print"></i>
                    <span>طباعة</span>
                </a>
                @if(!$confirmed)
                    {{-- زر الحفظ --}}
                    <button type="submit" class="btn btn-warning btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>حفظ التقرير</span>
                    </button>
                @endif
                </form>
                <form action="{{route('personal-results-report-download-pdf_final',$report->id)}}" method="GET">
                    <button type="submit" class="btn btn-danger btn-lg d-flex align-items-center gap-2">
                        <i class="fas fa-print"></i>
                        <span>PDF</span>
                    </button>
                </form>



            </div>
        </div>
    </div>

    {{-- Results Table Card --}}
    <div class="card shadow-sm border-0">
        <div class="card-body">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th style="width: 50px;">#</th>
                            <th>الهاتف</th>
                            <th>رقم الهوية</th>
                            <th>الأسم</th>
                            <th>رقم الهدف</th>
                            <th>1</th>
                            <th>2</th>
                            <th>3</th>
                            <th>4</th>
                            <th>5</th>
                            <th>6</th>
                            <th>7</th>
                            <th>8</th>
                            <th>9</th>
                            <th>10</th>
                            <th>المجموع</th>
                            <th>ملاحظات</th>
                            @if(!$confirmed)
                            <th>إجراءات</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $index => $member)
                        <tr>
                            <td class="text-center fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $member?->player?->phone1 ?? '---' }}</td>
                            <td>{{ $member?->player?->ID ?? '---' }}</td>
                            <td class="fw-bold">{{ $member?->player?->name ?? '---' }}</td>
                            {{-- goal --}}
                            <td>
                                <input type="number"
                                    name="goal"
                                    required
                                    data-player="{{ $member->id }}"
                                    class="form-control form-control-sm"
                                    min="1"
                                    value="{{ old('goal.' . $member->id, $member->goal ?? '') }}"
                                    @if($confirmed) readonly @endif>
                            </td>

                            {{-- R1 → R10 --}}
                            @for($i=1; $i<=10; $i++)
                                <td>
                                <input type="number"
                                    name="R{{ $i }}"
                                    data-player="{{ $member->id }}"
                                    class="form-control form-control-sm score-input"
                                    placeholder="0"
                                    min="0"
                                    data-row="{{ $index }}"
                                    value="{{ old('R'.$i.'.'.$member->id, $member->{'R'.$i} ?? '') }}"
                                    @if($confirmed) readonly @endif>
                                </td>
                                @endfor

                                {{-- total --}}
                                <td>
                                    <input type="number"
                                        name="total"
                                        data-player="{{ $member->id }}"
                                        class="form-control form-control-sm bg-light total-input"
                                        placeholder="0"
                                        id="total-{{ $index }}"
                                        value="{{ old('total.'.$member->id, $member->total ?? '') }}">
                                </td>

                                {{-- notes --}}
                                <td>
                                    <input type="text"
                                        name="notes"
                                        data-player="{{ $member->id }}"
                                        class="form-control form-control-sm"
                                        placeholder="ملاحظات"
                                        value="{{ old('notes.'.$member->id, $member->notes ?? '') }}"
                                        @if($confirmed) readonly @endif>
                                </td>



                                @if(!$confirmed)
                                <td class="text-center">
                                    <form action="{{ route('report-player-delete', ['rid' => $report->id, 'player_id' => $member->id]) }}"
                                        method="POST" class="d-inline"
                                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الرامي؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn text-danger" title="حذف">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                @endif
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

        </div>
    </div>
</div>

<style>
    .info-box {
        border-left: 4px solid #97ca52;
        transition: all 0.3s ease;
    }

    .info-box:hover {

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

        font-weight: 600;
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
        border-radius: 2px;
    }

    tbody tr:hover {
        background-color: #f8f9fa;
    }

</style>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    //clear input from old values when user start write in it
    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll(".score-input, .total-input, [name^='goal'], [name^='notes']");

        inputs.forEach(input => {
            input.addEventListener("focus", function() {
                if (this.value == this.defaultValue || this.value == "0") {
                    this.value = "";
                }
            });
        });
    });
    //load total from model

    document.addEventListener('DOMContentLoaded', function () {
    const confirmed = @json($confirmed);

    if (confirmed) {
        // Disable all input elements (including file input)
        document.querySelectorAll("input, textarea, select, button").forEach(el => {
            // Skip print & PDF buttons
            if (el.closest('a') || el.closest('form[action*="print"]') || el.closest('form[action*="pdf"]')) return;

            el.disabled = true;
            el.classList.add('bg-light');
            el.style.cursor = 'not-allowed';
        });

        // Extra step: make sure file input wrapper doesn't trigger click
        document.querySelectorAll('.file-upload-wrapper').forEach(wrapper => {
            wrapper.style.pointerEvents = 'none';
            wrapper.style.opacity = '0.6';
        });
    }

    // Enable score calculation only if not confirmed
    if (!confirmed) {
        document.querySelectorAll('.score-input').forEach(input => {
            input.addEventListener('input', function () {
                let row = this.closest('tr');
                let scores = [];

                row.querySelectorAll('.score-input').forEach(scoreInput => {
                    scores.push(parseInt(scoreInput.value) || 0);
                });

                fetch("{{ route('calculate-total') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        scores: scores,
                        player_id: row.querySelector('.score-input').dataset.player
                    })
                })
                .then(res => res.json())
                .then(data => {
                    row.querySelector('.total-input').value = data.total;
                });
            });
        });
    }
});
</script>

<script>
    //get data from table when submit save report
    document.getElementById('saveReportForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let valid = true;
        let players = {};

        document.querySelectorAll('input[data-player]').forEach(input => {
            let playerId = input.getAttribute('data-player');
            let field = input.getAttribute('name');
            let value = input.value.trim();

            // check required for "goal"
            if (field === 'goal' && value === '') {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }

            if (!players[playerId]) players[playerId] = {};
            players[playerId][field] = value;
        });

        if (!valid) {
            alert('الرجاء إدخال رقم الهدف لكل الرماة');
            return;
        }

        document.getElementById('playersData').value = JSON.stringify(players);
        this.submit();
    });
</script>

@endsection

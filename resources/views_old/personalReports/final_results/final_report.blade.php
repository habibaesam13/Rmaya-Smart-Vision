@extends('admin.master')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
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
                        final reports
                    </h2>
                </div>

                {{-- Report Info --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="info-box bg-light p-3 rounded">
                            <label class="text-muted small mb-1">السلاح</label>
                            <h5 class="mb-0 text-dark"> rtrtrtrt</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-light p-3 rounded">
                            <label class="text-muted small mb-1">رقم الديتيل</label>
                            <h5 class="mb-0 text-dark">rtrtrt</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-box bg-light p-3 rounded">
                            <label class="text-muted small mb-1">التاريخ</label>
                            <h5 class="mb-0 text-dark">rtttrtr</h5>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex flex-wrap gap-2">
                    {{-- report save --}}

                    <form action="#"
                          method="POST"
                          id="saveReportForm"
                          enctype="multipart/form-data"
                          class="d-flex align-items-center gap-2">
                        @csrf
                        <input type="hidden" name="players_data" id="playersData">

                        <!-----start search------------->

                        <div class="row form">
                            {{-- الملف --}}
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select onchange="getClubs(this.value)" name="club"
                                            class="form-control form-control-sm">
                                        <option  value="">اختر النادي .....</option>
                                        @foreach($clubs as $club)
                                            <option value="{{$club->cid}}">{{$club->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select name="attached_file" id="weaponSelect"
                                            class="form-control form-control-sm">
                                        <option value=""> اختر السلاح  .....</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <select name="attached_file"
                                            class="form-control form-control-sm">
                                        <option value="">فرز الترتيب .....</option>
                                        <option value="1">من الاول الى الأول</option>
                                        <option value="2">من الاول الى الثانى </option>
                                        <option value="3">من الاول الى الثالث</option>
                                        <option value="4">من الاول الى العشرون</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm" placeholder="dddf">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm" placeholder="dddf">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm" placeholder="dddf">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm" placeholder="dddf">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <input type="text" name="attached_file" id="attached_file"
                                           class="form-control form-control-sm">
                                </div>
                            </div>
                        </div>
                        <!----end search---------------->


                    </form>
                    <div class="row">
                        {{-- Print Button --}}
                        <div class="d-flex">
                            <div>
                                <a href="#"
                                   target="_blank"
                                   class="btn btn-outline-dark  d-flex align-items-center gap-2">
                                    <i class="fas fa-print"></i>
                                    <span>طباعة</span>
                                </a>
                            </div>
                            <form action="#" method="GET">
                                <button type="submit" class="btn btn-danger   d-flex align-items-center gap-2">
                                    <i class="fas fa-print"></i>
                                    <span>PDF</span>
                                </button>
                            </form>
                            <div class="col-4">
                                <div class="file-upload-wrapper p-1">
                                    <a class="btn btn-sm btn-warning"> Search </a>

                                    <a class="btn btn-sm btn-primary"> Search </a>
                                </div>


                            </div>

                        </div>
                    </div>


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
                            <th>المجموع</th>
                            <th>ملاحظات</th>
                            <th>إجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($res as $index => $item)
                            <tr>
                                <td class="text-center fw-bold">{{ $index + 1 }}</td>
                                <td>rrtrt</td>
                                <td>rtrt</td>
                                <td class="fw-bold">rtrtr</td>
                                {{-- goal --}}
                                <td>
                                    <input type="number"
                                           name="goal"
                                           required
                                           data-player="{{ $item->id }}"
                                           class="form-control form-control-sm"
                                           min="1"
                                           value="rtrtr"
                                    >
                                </td>

                                {{-- total --}}
                                <td>
                                    <input type="number"
                                           name="total"
                                           data-player="{{ $item->id }}"
                                           class="form-control form-control-sm bg-light total-input"
                                           placeholder="0"
                                           id="total-{{ $index }}"
                                           value="{{ old('total.'.$item->id, $item->total ?? '') }}">
                                </td>

                                {{-- notes --}}
                                <td>
                                    <input type="text"
                                           name="notes"
                                           data-player="{{ $item->id }}"
                                           class="form-control form-control-sm"
                                           placeholder="ملاحظات"
                                           value="{{ old('notes.'.$item->id, $item->notes ?? '') }}"
                                    >
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


    <script>
        function getClubs(club) {
            weaponSelect.innerHTML = "<option value=''>  اختر سلاح ..... </option>";

            $.ajax({
                type:'GET',
                url: "{{url("/admin/final-results/get-weapons/")}}" + '/' + club  , // clean interpolation
                {{--data:'_token = <?php echo csrf_token() ?>',--}}
                success:function(data) {
                    let innerTxt = '';
                    let weaponSelect = document.getElementById('weaponSelect');
                    data.weapons.forEach(  function (item) {
                         innerTxt  +="<option value='"+  item.name +"'>" +      item.name   + "</option>";
                     });

                    if(data.weapons.length > 0) {
                        weaponSelect.innerHTML = innerTxt;
                    }else{
                        weaponSelect.innerHTML = "<option value=''> لا توجد اسلحة </option>";

                    }
                }
            });
        }
    </script>


@endsection

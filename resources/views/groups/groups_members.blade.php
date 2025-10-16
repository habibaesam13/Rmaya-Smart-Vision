@extends('admin.master')
@section('content')
<div class="page-container">
    <div class="row">
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">المسجلين فرق تفصيلي</h4>
            </div>

        <div class="col-12 col-md-4 text-md-end text-center">
                <div class="d-flex align-items-center justify-content-md-end justify-content-center gap-2 flex-wrap">

                    <span class="badge badge-outline-primary"> عدد المسجلين : {{$members_count}}</span>

                    <!-- Excel Download Form -->
                    <form
                        action="{{route('groups.members.export.excel')}}"
                        method="post"
                        class="mb-0">
                        @csrf
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-success d-flex align-items-center justify-content-center" title="تحميل Excel">
                            <i class="ri-file-excel-line fs-5"></i>
                        </button>
                    </form>

                    <!-- PDF Download Form -->
                    <form
                       action="{{ route('groups-download-pdf') }}"
                        method="get"
                        class="mb-0">
                        @foreach(request()->query() as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                        @endforeach
                        <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center" title="تحميل PDF">
                            <i class="ri-file-pdf-2-line fs-5"></i>
                        </button>
                    </form>

                </div>
            </div>

        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="text-muted font-14">
                        <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
                    </p>
                    <div class="card bg-search">


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
                        <form action="{{ route('groups-members-search') }}" method="get" class="card-body">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label for="team_name" class="form-label">اسم الفريق</label>
                                    <input type="text" name="team_name" id="team_name" class="form-control form-control-lg">
                                </div>

                                <div class="col-md-3">
                                    <label for="weapon_id" class="form-label">السلاح</label>
                                    <select name="weapon_id" id="weapon_id" class="form-select form-select-lg">
                                        <option value="" disabled selected>اختر السلاح</option>
                                        @foreach($weapons as $weapon)
                                        <option value="{{ $weapon->wid }}">{{ $weapon->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-2 col-12" style="padding-top:8px">
                                <div class="g-1 row justify-content-center">
                                    <div class="col-12 col-lg-5 col-md-6 ">
                                        <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-100" name="search" value="بحث">
                                            <i class="ri-search-2-line "></i>&nbsp;&nbsp;بحث
                                        </button>
                                    </div>
                                    <div class="col-12 col-lg-7 col-md-6">
                                        <button type="submit" class="btn btn-sm btn-warning  mb-3 w-100" name="reset" value="اعادة ضبط">
                                            <i class="ri-refresh-line"></i>&nbsp;&nbsp;اعادة ضبط
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>



                    </div>
                    {{-- Filtered Data --}}
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <table class="table table-bordered mb-3">
                                <thead class="bg-soft-primary">

                                    <tr>
                                        <th>رقم الهوية</th>
                                        <th>الاسم</th>
                                        <th>الهاتف</th>
                                        <th>العمر</th>
                                        <th>الفريق</th>
                                        <th>السلاح</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($members as $member)
                                    <tr>
                                        <td>{{ $member->ID }}</td>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->phone1 ? $member->phone1 : $member->phone2 }}</td>
                                        <td>{{ $member->age_calculation() }}</td>
                                        <td>
                                            {{ $member->team?->name ?? '---' }}
                                        </td>
                                        <td>{{ $member->weapon->name ?? '---' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">
                                            لا يوجد فرق مسجلة
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $members->appends(request()->query())->links() }}
                            </div>

                        </div>
                    </div>
                </div>


                <style>
                    .documents {
                        flex-shrink: 0;
                        /* Prevent shrinking */
                    }

                    .documents .btn {
                        font-size: 0.875rem;
                        font-weight: 500;
                        border-radius: 6px;
                        transition: all 0.2s ease-in-out;
                        white-space: nowrap;
                    }

                    .documents .btn:hover {
                        transform: translateY(-1px);
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
                    }

                    .documents .btn i {
                        font-size: 1rem;
                    }


                    @media (max-width: 768px) {
                        .d-flex.justify-content-between.align-items-center {
                            flex-direction: column;
                            align-items: flex-start !important;
                            gap: 1rem;
                        }

                        .documents {
                            width: 100%;
                            justify-content: flex-end;
                        }

                        .documents .btn {
                            flex: 1;
                            justify-content: center;
                        }
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
                </style>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const clubSelect = document.getElementById('club_id');
                        const weaponSelect = document.getElementById('weapon_id');

                        clubSelect.addEventListener('change', function() {
                            const clubId = this.value;

                            // Clear weapons dropdown
                            weaponSelect.innerHTML = '<option value="" disabled selected>جاري التحميل...</option>';

                            if (clubId) {
                                // Fetch weapons for selected club
                                fetch(`{{ url('') }}/admin/clubs/${clubId}/weapons`)
                                    .then(response => response.json())
                                    .then(data => {
                                        weaponSelect.innerHTML =
                                            '<option value="" disabled selected>اختر السلاح</option>';

                                        data.weapons.forEach(weapon => {
                                            const option = document.createElement('option');
                                            option.value = weapon.wid;
                                            option.textContent = weapon.name;
                                            weaponSelect.appendChild(option);
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        weaponSelect.innerHTML =
                                            '<option value="" disabled selected>حدث خطأ في التحميل</option>';
                                    });
                            } else {
                                weaponSelect.innerHTML = '<option value="" disabled selected>اختر النادي أولاً</option>';
                            }
                        });
                    });
                </script>
                <script>
                    document.getElementById("reportForm").addEventListener("submit", function(e) {
                        const container = document.getElementById("checkedMembersContainer");
                        container.innerHTML = "";

                        document.querySelectorAll(".member-checkbox:checked").forEach(cb => {
                            let hidden = document.createElement("input");
                            hidden.type = "hidden";
                            hidden.name = "checkedMembers[]";
                            hidden.value = cb.value;
                            container.appendChild(hidden);
                        });
                    });
                </script>

                <script>
                    //date
                    // Get the current date
                    const today = new Date();

                    // Format the date to 'YYYY-MM-DD' for the input type="date"
                    const year = today.getFullYear();
                    const month = (today.getMonth() + 1).toString().padStart(2, '0'); // Months are 0-indexed
                    const day = today.getDate().toString().padStart(2, '0');

                    const formattedDate = `${year}-${month}-${day}`;

                    // Set the value of the input field
                    document.getElementById('report_date').value = formattedDate;
                </script>

                @endsection
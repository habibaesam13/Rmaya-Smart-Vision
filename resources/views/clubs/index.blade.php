@extends('admin.master')
@section('content')
<div class="page-container ">
   <div class="row"> 
     <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
  <div class="col-12 col-md-8 mb-2 mb-md-0">
          <h4 class="header-title">الأسلحة</h4>
        </div>
        <div class="col-12 col-md-4 text-md-end text-center">
          
          
          <!--<a title="{{__('lang.print')}}" onclick="printDiv('pr')" class="btn btn-sm btn-primary  ">
            <i class="ri-printer-line"></i>&nbsp;&nbsp;{{__('lang.print')}}
          </a>-->
        </div>
      </div>
    
    
    
 
 
          <div class="col-12">
      <div class="card">
    
    
  <div class="card-body">
          <p class="text-muted font-14">
            <a href="#" class="btn btn-soft-success rounded-pill  mx-1 " style="display: none;">&nbsp;</a>
          </p>
          <div class="card bg-search">
              
            {{-- Success Message --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('clubs.store') }}" method="POST" class="card-body">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="name" class="form-label fw-bold">اسم النادي</label>
                        <input type="text" name="name" id="name" class="form-control form-control-lg" 
                               value="{{ old('name') }}" placeholder="  " required>
                        @error('name')
                        <div class="invalid-feedback d-block">
                            <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                    <div class="">
                      <div class="col-12 col-lg-5 col-md-6 ">
                        <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-300" name="search" value="اضافة ">
                           <i class="fas fa-plus me-2"></i>&nbsp;&nbsp;حفظ 
                       </button>
                      </div>
                      <br>
                     
                    </div>
                  </div>
                </div>
            </form>
        </div>
 

    {{-- Clubs Table Section --}}
    
            
            @if($clubs->count() > 0)
            <div class="table-responsive">
                 <table class="table table-bordered mb-0">
                    <thead class="bg-soft-primary">
                        <tr>
                            <th scope="col" class="text-start">
                                <i class="fas fa-tag me-2"></i>اسم النادي
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-info-circle me-2"></i>الحالة
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>التحكم
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
                                <div class="d-flex justify-content-center gap-1">
                                    {{-- Toggle Status Button --}}
                                    <form action="{{ route('clubs.toggle-status', $club->cid) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" 
                                                title="{{ $club->active ? 'إلغاء التفعيل' : 'تفعيل' }}"
                                                data-bs-toggle="tooltip">
                                            <!--<i class="fas fa-{{ $club->active ? 'pause' : 'play' }}"></i>-->

                                         @if($club->active)  <i class="ri-pause-line"></i> @else  <i class="ri-play-line"></i> @endif
                                           
                                        </button>
                                    </form>

                                    {{-- Edit Button --}}
                                    <a href="{{ route('clubs.edit', $club->cid) }}" 
                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle" 
                                       title="تعديل"
                                       data-bs-toggle="tooltip">
                                         <i class="ri-edit-box-line fs-16"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('clubs.destroy', $club->cid) }}" method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا النادي؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" 
                                                title="حذف"
                                                data-bs-toggle="tooltip">
                                             <i class="ri-delete-bin-line fs-16"></i>
                                        </button>
                                    </form>

                                    {{-- Custom Icon Example --}}
                                    <a href="{{ route('clubs-weapons.index', $club->cid) }}"  data-bs-toggle="tooltip" class="btn btn-soft-success btn-icon btn-sm rounded-circle" title="سلاح مرتبط">
                                        <i class="ri-infrared-thermometer-line"></i>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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

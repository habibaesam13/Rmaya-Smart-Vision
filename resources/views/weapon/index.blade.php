@extends('admin.master')
@section('content')
<div class="page-container">
    
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
    
     @if(checkModulePermission('weapons', 'add')) 
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
            <form action="{{ route('weapons.store') }}" method="POST" class="card-body">
                @csrf
                <div class="row g-3 align-items-end">
                    <div class="col-md-9">
                        <label for="name" class="form-label fw-bold">اسم السلاح</label>
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
                        <button type="submit" class="btn btn-sm btn-info mt-1 mt-md-0 mt-lg-0 w-300" name="search" value="اضافة سلاح">
                           <i class="fas fa-plus me-2"></i>&nbsp;&nbsp;حفظ 
                       </button>
                      </div>
                      <br>
                     
                    </div>
                  </div>
                </div>
            </form>
        </div> @endif
    
    
 
 
            @if($weapons->count() > 0)
            <div class="table-responsive">
                <table class="table table-bordered mb-3">
                    <thead class="bg-soft-primary">
                        <tr>
                            <th scope="col" class="text-start">
                                <i class="fas fa-crosshairs me-2"></i>اسم السلاح
                            </th>
                            <th scope="col" class="text-center">
                                <i class="fas fa-cogs me-2"></i>التحكم
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($weapons as $index => $weapon)
                        <tr>
                            {{-- text-start عشان النص يبدأ من بداية العمود --}}
                            <td class="fw-semibold text-start">{{ $weapon->name }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    @if(checkModulePermission('weapons', 'edit')) 
                                    {{-- Edit Button --}}
                                    <a href="{{ route('weapons.edit', $weapon->wid) }}" 
                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle" 
                                       title="تعديل السلاح"
                                       data-bs-toggle="tooltip">
                                            <i class="ri-edit-box-line fs-16"></i>
                                    </a>
 
                             @endif 
                             @if(checkModulePermission('weapons', 'delete')) 
                                    {{-- Delete Button --}}
                                    <form action="{{ route('weapons.destroy', $weapon->wid) }}" method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('هل أنت متأكد من حذف هذا السلاح؟');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-soft-success btn-icon btn-sm rounded-circle" 
                                                title="حذف السلاح"
                                                data-bs-toggle="tooltip">
                                            <i class="ri-delete-bin-line fs-16"></i>
                                        </button>
                                    </form>@endif 
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
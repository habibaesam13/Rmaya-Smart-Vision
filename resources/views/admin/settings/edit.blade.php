@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="col-lg-12">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning">{{ session('warning') }}</div>
            @endif

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.Edit settings')}}</h4>

                </div>

                <div class="card-body">
                    <p class="text-muted"> </p>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                     <form action="{{route('admin.settings.update')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                        @csrf

@if($setting)
                             <div class="row mb-3">
                                 <label for="{{$setting->logo}}" class="col-3 col-form-label">{{__('lang.logo')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="file" name="image[logo]"  value="{{$setting->logo}}"
                                                class="form-control w-75    "  id="{{$setting->logo}}">
                                         <img src="{{asset($setting->logo)}}" style="width: 100px; height: 100px " class="     rounded " >
                                     </div>
                                 </div>
                             </div>



{{--                             <div class="row mb-3">--}}
{{--                                 <label for="{{$setting->secondary_logo}}" class="col-3 col-form-label">{{__('lang.secondary logo')}}</label>--}}
{{--                                 <div class="col-9">--}}
{{--                                     <div class="row">--}}
{{--                                         <input type="file" name="secondary_logo"  value="{{$setting->secondary_logo}}"--}}
{{--                                                class="form-control w-75    "  id="{{$setting->secondary_logo}}">--}}
{{--                                         <img src="data:image/png;base64, {{$setting->secondary_logo}}" style="width: 100px; height: 100px " class="     rounded " >--}}
{{--                                     </div>--}}
{{--                                 </div>--}}
{{--                             </div>--}}

                             <div class="row mb-3">
                             <label for="{{$setting->company_name}}" class="col-3 col-form-label">{{__('lang.company_name')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="company_name"  value="{{$setting->company_name}}"
                                            class="form-control w-75    "  id="{{$setting->company_name}}">
                                 </div>
                             </div>
                         </div>
                         <div class="row mb-3">
                             <label for="{{$setting->company_department_name}}" class="col-3 col-form-label">{{__('lang.company_department_name')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="company_department_name"  value="{{$setting->company_department_name}}"
                                            class="form-control w-75    "  id="{{$setting->company_department_name}}">
                                 </div>
                             </div>
                         </div>
                         <div class="row mb-3">
                             <label for="{{$setting->phone}}" class="col-3 col-form-label">{{__('lang.phone')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="phone"  value="{{$setting->phone}}"
                                            class="form-control w-75    "  id="{{$setting->phone}}">
                                 </div>
                             </div>
                         </div>


                         <div class="row mb-3">
                             <label for="{{$setting->whatsapp}}" class="col-3 col-form-label">{{__('lang.whatsapp')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="whatsapp" value="{{$setting->whatsapp}}"
                                            class="form-control w-75    "  id="{{$setting->whatsapp}}">
                                 </div>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label for="{{$setting->address}}" class="col-3 col-form-label">{{__('lang.address')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="address" value="{{$setting->address}}"
                                            class="form-control w-75    "  id="{{$setting->address}}">
                                 </div>
                             </div>
                         </div>

                         <div class="row mb-3">
                             <label for="{{$setting->email}}" class="col-3 col-form-label">{{__('lang.email')}}</label>
                             <div class="col-9">
                                 <div class="row">
                                     <input type="text" name="email" value="{{$setting->email}}"
                                            class="form-control w-75    "  id="{{$setting->email}}">
                                 </div>
                             </div>
                         </div>


                         @else
                             <div class="row mb-3">
                                 <label   class="col-3 col-form-label">{{__('lang.logo')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="file" name="image[logo]"  value=""
                                                class="form-control w-75    " >
                                     </div>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label  class="col-3 col-form-label">{{__('lang.company_name')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="company_name"
                                                class="form-control w-75    " >
                                     </div>
                                 </div>
                             </div>
                             <div class="row mb-3">
                                 <label  class="col-3 col-form-label">{{__('lang.company_department_name')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="company_department_name"
                                                class="form-control w-75    " >
                                     </div>
                                 </div>
                             </div>
                             <div class="row mb-3">
                                 <label  class="col-3 col-form-label">{{__('lang.phone')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="phone"
                                                class="form-control w-75    "  >
                                     </div>
                                 </div>
                             </div>


                             <div class="row mb-3">
                                 <label  class="col-3 col-form-label">{{__('lang.whatsapp')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="whatsapp"
                                                class="form-control w-75    "  >
                                     </div>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label  class="col-3 col-form-label">{{__('lang.address')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="address"
                                                class="form-control w-75    "  >
                                     </div>
                                 </div>
                             </div>

                             <div class="row mb-3">
                                 <label   class="col-3 col-form-label">{{__('lang.email')}}</label>
                                 <div class="col-9">
                                     <div class="row">
                                         <input type="text" name="email"
                                                class="form-control w-75    "  >
                                     </div>
                                 </div>
                             </div>

                         @endif


                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary rounded-pill">{{__('lang.update')}}</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>

@endsection

@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;
">

                    <h4 class="header-title  ">{{__('lang.Update Event Type')}} <br><span class="text-primary"> {{$event_type->name_ar}} / {{$event_type->name_en}} </span></h4>
                    <a href="{{ url(route('admin.logs.index')) }}" class="btn btn-soft-info rounded-pill   float-end  ">Back</a>

                </div>

                <div class="card-body">

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{$error}}</div>
                        @endforeach
                        <br>
                    @endif

                    <form action="{{ route('admin.logs.update',$event_type->id) }}" method="POST" class="form-horizontal">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inpuname_ar" class="col-3 col-form-label">{{__('lang.name_ar')}}</label>
                            <div class="col-9">
                                <input type="text" name="name_ar"  value="{{ $event_type->name_ar }}"  class="form-control" id="inpuname_ar" placeholder="Name in arabic ......">
                                @error('name_ar') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inpuname_en" class="col-3 col-form-label">{{__('lang.name_en')}}</label>
                            <div class="col-9">
                                <input type="text" name="name_en"  value="{{ $event_type->name_en }}"  class="form-control" id="inpuname_en" placeholder="Name in english ......">
                                @error('name_en') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="inpuslug_en" class="col-3 col-form-label">{{__('lang.Active')}}</label>
                            <div class="col-9">
                            <input type="checkbox" name="status" value="1"  id="switch02" @if($event_type->status == 1 )   checked="checked"  @endif data-switch="success">
                            <label for="switch02" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                            </div>
                        </div>

                        <div class="justify-content-end row">
                            <div class="col-9">
                                <button type="submit" class="btn btn-primary rounded-pill">@lang('lang.update')</button>
                            </div>
                        </div>

                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection

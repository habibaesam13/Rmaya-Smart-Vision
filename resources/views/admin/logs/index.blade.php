@extends('admin.master')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

    <!-------start ----------->
    <div class="page-container">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header border-bottom border-dashed d-flex align-items-center" style="  justify-content: space-between;">

                        <h4 class="header-title">{{__('lang.logs')}}</h4>

                    </div>

                    <div class="card-body">


                        @if (session('msg'))
                            <div class="alert alert-success">{{ session('msg') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif



                        <div class="card">
                            <div class="form-box">
                                <form action="{{route('admin.logs.index')}}" class="container card-body"
                                      method="get">
                                    @csrf

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <input class="form-control" value="{{request()->get('search_input')}}" name="search_input" placeholder="search ..."/>
                                            </div> <!-- end col -->

                                            <div class="col-lg-4">
                                                <select class="form-control select2 my-3" name="admin_id"
                                                        data-toggle="select2">
                                                    <option value="">{{__('lang.Select a User')}}</option>
                                                    @foreach($users as $user)
                                                        <option
                                                            {{  $user->id == request()->get('admin_id')  ? 'selected' : ''}} value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div> <!-- end col -->

                                            <div class="col-lg-4">
                                                <select class="form-control select2 my-3" name="module_name"
                                                        data-toggle="select2">
                                                    <option value="">{{__('lang.Select a Module')}}</option>
                                                    @foreach($modules as $mod)
                                                        <option
                                                            {{  $mod == request()->get('module_name')  ? 'selected' : ''}}  value="{{$mod }}">{{__('lang.'.$mod) }}</option>
                                                    @endforeach
                                                </select>
                                            </div> <!-- end col -->

                                        </div>


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <input type="date" value="{{request()->get('from_date')}}"
                                                       class="form-control my-3" name="from_date">
                                            </div> <!-- end col -->


                                            <div class="col-lg-6">
                                                <input type="date" value="{{request()->get('to_date')}}"
                                                       class="form-control my-3" name="to_date">
                                            </div> <!-- end col -->


                                        </div>
                                    </div>
                                    <div class="form-buttons d-flex justify-content-end">
{{--                                        <input type="submit" class="btn btn-sm btn-primary  rounded-pill" name="search"--}}
{{--                                               value="search">--}}
{{--                                        <a   class="btn btn-sm btn-warning  rounded-pill"  href="{{url(route('admin.logs.index'))}}"--}}
{{--                                        > Reset </a>--}}
                                        <button type="submit" class="btn btn-sm btn-primary  rounded-pill" name="search"
                                                value="search">{{__('lang.search')}}</button>
                                        <a   class="btn btn-sm btn-warning  rounded-pill"  href="{{url(route('admin.logs.index'))}}"
                                        > {{__('lang.reset')}} </a>

                                    </div>

                                    {{--                                <input type="submit" class="btn btn-sm btn-warning  rounded-pill" name="reset"--}}
                                    {{--                                       value="reset">--}}


                                    {{--                                <a href="{{url(route('admin.logs.pdf'))}}"--}}
                                    {{--                                   class="btn btn-sm btn-secondary  rounded-pill">print</a>--}}
                                </form>
                            </div>
                        </div>



                        <table
                            {{--                            id="datatable-buttons"--}}
                            class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                            <tr>
{{--                                <th class="sorting sorting_asc text-center" tabindex="0" aria-controls="datatable-buttons"--}}
{{--                                    rowspan="1" colspan="1" style="width: 150.4px;"--}}
{{--                                    aria-label="Name: activate to sort column descending"--}}
{{--                                    aria-sort="ascending"></th>--}}
                                {{--                                <th>{{__('lang.item_code')}}</th>--}}
                                {{--                                <th>{{__('lang.module_name')}}</th>--}}
                                <th class=" text-center">{{__('lang.admin')}}</th>

                                <th class=" text-center">{{__('lang.action')}}</th>
                                <th class=" text-center">{{__('lang.created_at')}}</th>
                                {{--                                <th width="40%">{{__('lang.Action')}}</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($logs as $key => $log)
                                <tr>
{{--                                    <td class="ps-3" style="width: 50px;">--}}
{{--                                        <input type="checkbox" class="form-check-input" id="customCheck{{$key}}">--}}
{{--                                    </td>--}}
                                    {{--                                    <td>{{ $log->item_id }}</td>--}}
                                    {{--                                    <td>{{ __('lang.'.$log->module_name) }}</td>--}}
                                    <td class="text-bg-primary text-center">{{ $log->user?->name }}</td>

                                    <td  class="text-center">{{ __('lang.logs_'.$log->action) }}  <strong class="text-secondary"> {{ __('lang.'.$log->module_name) }} </strong>  ( {{$log->item_id}} ) </td>
                                    <td class="text-center">{{ $log->created_at }}</td>
                                    {{--                                    <td>--}}
                                    {{--                                        @if(checkModulePermission('logs', 'delete'))--}}
                                    {{--                                            <form method="post" class="d-inline"--}}
                                    {{--                                                  action="{{ url(route('admin.logs.destroy',$log->id)) }}"--}}
                                    {{--                                            >--}}
                                    {{--                                                @csrf--}}
                                    {{--                                                @method('delete')--}}
                                    {{--                                                <button class="btn btn-soft-danger btn-icon btn-sm rounded-circle"--}}
                                    {{--                                                        type="submit"><i class="ri-delete-bin-line fs-16"></i></button>--}}

                                    {{--                                            </form>--}}
                                    {{--                                        @endif--}}

                                    {{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @if($logs) {{$logs->links()}} @endif
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

@endsection

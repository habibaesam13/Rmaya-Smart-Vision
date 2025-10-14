@extends('admin.master')

@section('content')







    <!-----------------start ------------------>

    <div class="page-container">


        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Roles</h4>
                        <br>
                        <p class="text-muted font-14">
                            <a href="{{ url(route('admin.roles.index')) }}"
                               class="btn btn-soft-success rounded-pill  mx-1">Roles</a>
                            <a href="{{ url(route('admin.permissions.index')) }}"
                               class="btn btn-soft-info rounded-pill  mx-1">Permissions</a>
                            <a href="{{ url(route('admin.users.index')) }}"
                               class="btn btn-soft-warning rounded-pill  mx-1">Users</a>
                            @can('create permission')
                                <a href="{{ url(route('admin.permissions.create')) }}"
                                   class="btn btn-soft-primary rounded-pill  float-end">Add Permission</a>
                        @endcan

                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                            @endif
                            <hr>

                            <table
                                class="table table-striped dt-responsive nowrap w-100">

                                <thead>

                                <tr>
                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable-buttons"
                                        rowspan="1" colspan="1" style="width: 150.4px;"
                                        aria-label="Name: activate to sort column descending"
                                        aria-sort="ascending"></th>
                                    <th>{{__('lang.id')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th  class="action_column">{{__('lang.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
 {{--                                    <tr><td class="bg-primary text-center"   colspan="4"><strong class="text-white">{{$item->name}}</strong></td></tr>--}}
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                            <td class="ps-3" style="width: 50px;">
                                                <input type="checkbox" class="form-check-input"
                                                       id="customCheck{{$key}}">
                                            </td>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                @can('update permission')
                                                    <a href="{{ url(route('admin.permissions.edit',$permission->id) ) }}"
                                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i
                                                            class="ri-edit-box-line fs-16"></i></a>
                                                @endcan

                                                @can('delete permission')
                                                    <a href="{{ url(route('admin.permissions.delete',$permission->id) ) }}"
                                                       class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                            class="ri-delete-bin-line"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                 </tbody>
                            </table>

                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->


    <!-----------end ------------------->
@endsection

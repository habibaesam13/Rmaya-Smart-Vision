@extends('admin.master')

@section('content')




    <div class="page-container">


        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center"
                         style="  justify-content: space-between;">

                        <h4 class="header-title">{{__('lang.roles')}}</h4>
                        <div class="buttons">
                            <a href="{{ url(route('admin.roles.create')) }}"
                               class="btn btn-soft-primary rounded-pill  float-end">{{__('lang.Add Role')}}</a>
                            <a href="{{ url(route('admin.users.index')) }}"
                               class="btn btn-primary rounded-pill  mx-1">{{__('lang.users')}}</a>
                        </div>

                    </div>
                    <div class="card-body">


                        @if (session('role_status'))
                            <div class="alert alert-success">{{ session('role_status') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif


                        <table
                            {{--                                id="datatable-buttons"--}}
                            class="table table-striped dt-responsive nowrap w-100">
                            <thead>

                            <tr>
{{--                                <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable-buttons"--}}
{{--                                    rowspan="1" colspan="1" style="width: 150.4px;"--}}
{{--                                    aria-label="Name: activate to sort column descending"--}}
{{--                                    aria-sort="ascending"></th>--}}
                                <th>{{__('lang.name')}}</th>
                                <th  class="action_column">{{__('lang.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
{{--                                    <td class="ps-3" style="width: 50px;">--}}
{{--                                        <input type="checkbox" class="form-check-input" id="customCheck{{$key}}">--}}
{{--                                    </td>--}}
                                    <td>{{ $role->name }}</td>
                                    <td>
                                        {{--                                            <a href="{{url( route('admin.roles.give-permissions' , $role->id)) }}"--}}
                                        {{--                                               class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><i--}}
                                        {{--                                                    class="ri-key-2-fill   fs-16"></i>--}}

                                        {{--                                            </a>--}}
                                        <a href="{{url( route( 'admin.give_module_to_role_show' , $role->id)) }}"
                                           class="btn btn-soft-warning btn-icon btn-sm rounded-circle"><i
                                                class="ri-key-2-fill   fs-16"></i>

                                        </a>

                                        @if(checkModulePermission('roles', 'add'))
                                            <a href="{{ url(route('admin.roles.edit',$role->id) ) }}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i
                                                    class="ri-edit-box-line fs-16"></i>

                                            </a>
                                        @endif

                                        @if(checkModulePermission('roles', 'delete'))
                                            <span onclick="confirmDeletion(this)"
                                                  data-attr="{{ url(route( 'admin.roles.delete' , $role->id )) }}"
                                                  class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                    class="ri-delete-bin-line fs-16"></i>

                                                </span>
                                        @endif
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
    <script>
        function confirmDeletion(obj) {
            let result = confirm("{{__("lang.Are you sure you want to delete this item?")}}");
            if (result) {
                window.location.href = obj.getAttribute('data-attr');
            }
        }

    </script>
@endsection

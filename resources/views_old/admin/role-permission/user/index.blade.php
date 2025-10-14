@extends('admin.master')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif

    {{--    <div class="container mt-5">--}}
    {{--    <a href="{{ url(route('admin.roles.index')) }}" class="btn btn-primary mx-1">Roles</a>--}}
    {{--    <a href="{{ url(route('admin.permissions.index')) }}" class="btn btn-info mx-1">Permissions</a>--}}
    {{--    <a href="{{ url(route('admin.users.index')) }}" class="btn btn-warning mx-1">Users</a>--}}
    {{--</div>--}}

    {{--<div class="container mt-2">--}}
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12">--}}

    {{--            @if (session('status'))--}}
    {{--                <div class="alert alert-success">{{ session('status') }}</div>--}}
    {{--            @endif--}}

    {{--            <div class="card mt-3">--}}
    {{--                <div class="card-header">--}}
    {{--                    <h4>Users--}}
    {{--                        @can('create user')--}}
    {{--                            <a href="{{ url(route('admin.users.create')) }}" class="btn btn-primary float-end">Add User</a>--}}
    {{--                        @endcan--}}
    {{--                    </h4>--}}
    {{--                </div>--}}
    {{--                <div class="card-body">--}}

    {{--                    <table class="table table-bordered table-striped">--}}
    {{--                        <thead>--}}
    {{--                        <tr>--}}
    {{--                            <th>Id</th>--}}
    {{--                            <th>Name</th>--}}
    {{--                            <th>Email</th>--}}
    {{--                            <th>Roles</th>--}}
    {{--                            <th>Action</th>--}}
    {{--                        </tr>--}}
    {{--                        </thead>--}}
    {{--                        <tbody>--}}
    {{--                        @foreach ($users as $user)--}}
    {{--                            <tr>--}}
    {{--                                <td>{{ $user->id }}</td>--}}
    {{--                                <td>{{ $user->name }}</td>--}}
    {{--                                <td>{{ $user->email }}</td>--}}
    {{--                                <td>--}}
    {{--                                    @if (!empty($user->getRoleNames()))--}}
    {{--                                        @foreach ($user->getRoleNames() as $rolename)--}}
    {{--                                            <label class="badge bg-primary mx-1">{{ $rolename }}</label>--}}
    {{--                                        @endforeach--}}
    {{--                                    @endif--}}
    {{--                                </td>--}}
    {{--                                <td>--}}
    {{--                                    @can('update user')--}}
    {{--                                        <a href="{{ url(route('admin.users.edit',$user->id)) }}" class="btn btn-success">Edit</a>--}}
    {{--                                    @endcan--}}

    {{--                                    @can('delete user')--}}
    {{--                                        <a href="{{ url(route('admin.users.delete',$user->id)) }}" class="btn btn-danger mx-2">Delete</a>--}}
    {{--                                    @endcan--}}
    {{--                                </td>--}}
    {{--                            </tr>--}}
    {{--                        @endforeach--}}
    {{--                        </tbody>--}}
    {{--                    </table>--}}

    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}


    <!-------start ----------->
    <div class="page-container">


        <div class="row">

            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card">

                    <div class="card-header border-bottom border-dashed d-flex align-items-center"
                         style="  justify-content: space-between;">

                        <h4 class="header-title">{{__('lang.users')}}</h4>
                        <div class="buttons">
                            @if(checkModulePermission('admins', 'add'))
                                <a href="{{ url(route('admin.users.create')) }}"
                                   class="btn btn-soft-primary rounded-pill  float-end">{{__('lang.Add Admin')}}</a>
                            @endif
                            <a href="{{ url(route('admin.roles.index')) }}"
                               class="btn btn-primary rounded-pill  mx-1">{{__('lang.roles')}}</a>
                        </div>


                    </div>


                    <div class="card-body">


                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                        @endif


                        <table
                            {{--                                id="datatable-buttons"--}}
                            class="table table-striped dt-responsive nowrap w-100">
                            <thead>

                            <tr>
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.email')}}</th>
                                <th>{{__('lang.roles')}}</th>
                                <th class="action_column">{{__('lang.Action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>  @if (!empty($user->getRoleNames()))
                                            @foreach ($user->getRoleNames() as $rolename)
                                                <label class="badge bg-primary mx-1">{{ $rolename }}</label>
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @if(checkModulePermission('admins', 'edit'))
                                            <a href="{{ url(route('admin.users.edit',$user->id)) }}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                <i class="ri-edit-box-line fs-16"></i></a>
                                        @endif

                                        @if(checkModulePermission('admins', 'delete'))
                                            <span onclick="confirmDeletion(this)"
                                                  data-attr="{{ url(route('admin.users.delete',$user->id)) }}"
                                                  class="btn btn-soft-danger btn-icon btn-sm rounded-circle">
                                                    <i class="ri-delete-bin-line fs-16"></i></span>
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

    <script>
        function confirmDeletion(obj) {
            let result = confirm("{{__("lang.Are you sure you want to delete this item?")}}");
            if (result) {
                window.location.href = obj.getAttribute('data-attr');
            }
        }
    </script>
@endsection

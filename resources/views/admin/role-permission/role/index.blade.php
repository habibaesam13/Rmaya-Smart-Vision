@extends('admin.master')

@section('content')




    <div class="page-container">


        <div class="row">
            
            
            
            
      <div class="col-12 d-flex justify-content-between align-items-center my-3">
      <div>
      <h4 class="header-title">{{__('lang.admins_roles')}}</h4>
      </div>
      <div>
     
     
     
    <div class="buttons">
						  @if(checkModulePermission('users', 'add_role'))
                            <a href="{{ url(route('admin.roles.create')) }}"
                               class="btn btn-sm btn-info min-w-180 float-end me-1"> <i class="ri-group-line"></i>
 &nbsp; {{__('lang.Add Role')}}</a>
							   @endif

							   
					  @if(checkModulePermission('users', 'view'))
                            <a href="{{ url(route('admin.users.index')) }}"
                               class="btn btn-sm btn-primary min-w-180 float-end me-1"> <i class="ri-user-settings-line"></i> &nbsp; {{__('lang.users')}}</a>
                        </div>@endif

     
     
     
     
     
     
     
         </div>
    </div>
            
            
            

            <div class="col-12">
                <div class="card">
                 
                    <div class="card-body">


                        @if (session('role_status'))
                            <div class="alert alert-success">{{ session('role_status') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

<div class="table-responsive">
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
                                        {{--                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i--}}
                                        {{--                                                    class="ri-key-2-fill   fs-16"></i>--}}

                                        {{--                                            </a>--}}
                                          @if(checkModulePermission('users', 'roles_perm'))
											  <a href="{{url( route( 'admin.give_module_to_role_show' , $role->id)) }}"
                                           class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i
                                                class="ri-key-2-fill   fs-16"></i>

                                        </a>  @endif
                     @if($role->id>8)
                                        @if(checkModulePermission('users', 'edit_role'))
                                            <a href="{{ url(route('admin.roles.edit',$role->id) ) }}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i
                                                    class="ri-edit-box-line fs-16"></i>

                                            </a>
                                        @endif

                                        @if(checkModulePermission('users', 'delete_role'))
                                            <span onclick="confirmDeletion(this)"
                                                  data-attr="{{ url(route( 'admin.roles.delete' , $role->id )) }}"
                                                  class="btn btn-soft-success btn-icon btn-sm rounded-circle"><i
                                                    class="ri-delete-bin-line fs-16"></i>

                                                </span>
                                        @endif
                     @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>

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

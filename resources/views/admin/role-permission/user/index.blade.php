@extends('admin.master') @section('content') @if ($errors->any()) @foreach ($errors->all() as $error) <div>{{$error}}</div> @endforeach @endif {{-- <div class="container mt-5">--}}

<div class="page-container">
    
  <div class="row">
      
      

  <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
  <div class="col-8 col-md-8 mb-2 mb-md-0">
        <h4 class="header-title">{{__('lang.users')}}</h4>
      </div>
<div class="col-4 col-md-4 text-md-end text-center">
        <a href="{{ url(route('admin.roles.index')) }} " class="btn btn-sm btn-info min-w-180 float-end mb-1">
          <i class="ri-shield-user-line"></i> &nbsp; Roles
        </a> @if(checkModulePermission('users', 'add')) <a href="{{ url(route('admin.users.create')) }}" class="btn btn-sm btn-primary min-w-180 float-end me-0 me-md-1   ">
          <i class="ri-user-settings-line"></i> &nbsp; Add User
        </a> @endif
      </div>
    </div>
    
    
    
    
    
    
    <div class="col-12"> @if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif <div class="card">
        <div class="card-body"> @if (session('status')) <div class="alert alert-success">{{ session('status') }}</div> @endif <div class="table-responsive">
            <table {{--  id="datatable-buttons"--}} class="table table-striped dt-responsive nowrap w-100">
              <thead>
                <tr>
                  <th>{{__('lang.name')}}</th>
                  <th>{{__('lang.email')}}</th>
                  <th>{{__('lang.role')}}</th>
                  <th class="action_column">{{__('lang.Action')}}</th>
                </tr>
              </thead>
              <tbody> @foreach ($users as $key => $user) <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td> @if (!empty($user->getRoleNames())) @foreach ($user->getRoleNames() as $rolename) <label>{{ $rolename }}</label> @endforeach @endif </td>
                  <td>
                       @if(checkModulePermission('users', 'edit')) 
                  <a href="{{ url(route('admin.users.edit',$user->id)) }}" class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                      <i class="ri-edit-box-line fs-16"></i>
                    </a>
                    @endif 
                    @if(checkModulePermission('users', 'delete')) <span onclick="confirmDeletion(this)" data-attr="{{ url(route('admin.users.delete',$user->id)) }}" class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                      <i class="ri-delete-bin-line fs-16"></i>
                    </span> @endif </td>
                </tr> @endforeach </tbody>
            </table>
          </div>
        </div>
        <!-- end card body-->
      </div>
      <!-- end card -->
    </div>
    <!-- end col-->
  </div>
  <!-- end row-->
</div>
<!-- container -->
<script>
  function confirmDeletion(obj) {
    let result = confirm("{{__("
      lang.Are you sure you want to delete this item ? ")}}");
    if (result) {
      window.location.href = obj.getAttribute('data-attr');
    }
  }
</script> @endsection
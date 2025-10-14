@extends('admin.master')

@section('content')







    <!-----------------start ------------------>

    <div class="page-container">
        <div>
            {{--    {{dd(\App\Http\Helpers\getModules())}}--}}
        </div>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="header-title">Roles</h4>
                        <br>
                        <p class="text-muted font-14">
                            <a href="{{ url(route('admin.roles.index')) }}"
                               class="btn btn-soft-success rounded-pill  mx-1">Roles</a>
                            <a href="{{ url(route('admin.users.index')) }}"
                               class="btn btn-soft-warning rounded-pill  mx-1">Users</a>
                        @if (session('status'))
                            <div class="alert alert-success">{{ session('status') }}</div>
                            @endif
                            </p>
                            <hr>
                            <table
{{--                                id="datatable-buttons"--}}
                                class="table table-striped dt-responsive nowrap w-100">
                                <thead>

                                <tr>
{{--                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="datatable-buttons"--}}
{{--                                        rowspan="1" colspan="1" style="width: 150.4px;"--}}
{{--                                        aria-label="Name: activate to sort column descending"--}}
{{--                                        aria-sort="ascending"></th>--}}
                                    <th>{{__('lang.code')}}</th>
                                    <th>{{__('lang.name')}}</th>
                                    <th  class="action_column">{{__('lang.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach (getModules() as $key => $val)
                                    <tr>
{{--                                        <td class="ps-3" style="width: 50px;">--}}
{{--                                            <input type="checkbox" class="form-check-input"--}}
{{--                                                   id="customCheck{{$key}}">--}}
{{--                                        </td>--}}
                                        <td>{{ $val['code'] }}</td>
                                        <td>{{ $val['name'] }}</td>
                                        <td>@foreach( $val['mod_do'] as $item)
                                              <span class="badge badge-soft-primary rounded-pill"> {{ $item['can_do']}} </span>
                                            @endforeach
                                        </td>

                                        <td>
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

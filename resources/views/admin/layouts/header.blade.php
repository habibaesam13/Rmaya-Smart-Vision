<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Rmaya</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="Coderthemes" name="author"/>


    <!-- App favicon -->
     <!--<link rel="shortcut icon" href="{{url('admin/assets/images/favicon.ico')}}">-->

    <!-- Vendor css -->
    <link href="{{url('admin/assets/css/vendor.min.css')}}" rel="stylesheet" type="text/css"/>

@if(app()->getLocale()  == 'en')
    <!-- App css -->
        <link href="{{url('admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
    @else
    <!-- arabic App css -->
        <link href="{{url('admin/assets/css/app-rtl.min.css')}}" rel="stylesheet" type="text/css" id="app-style"/>
@endif


<!-- Theme Config Js -->
    <script src="{{url('admin/assets/js/config.js')}}"></script>

    <!-- Datatables css -->
    <link href="{{url('admin/assets/datatables.net-bs5/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('admin/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('admin/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('admin/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('admin/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css')}}"
          rel="stylesheet"
          type="text/css"/>
    <link href="{{url('admin/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <!-- Icons css -->
    <link href="{{url('admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!----------test-------->
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
<!----------test-------->



    @yield('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<body>
<!-- Begin page -->
<div class="wrapper">














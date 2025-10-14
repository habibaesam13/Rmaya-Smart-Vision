@include('admin.layouts.header')

@include('admin.layouts.navbar')

{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

@yield('content')


@include('admin.layouts.footer')

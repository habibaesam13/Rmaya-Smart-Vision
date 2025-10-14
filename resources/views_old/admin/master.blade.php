@include('admin.layouts.header')

@include('admin.layouts.navbar')
{{--<livewire:styles />--}}
{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}

@yield('content')
{{--<livewire:scripts />--}}

@include('admin.layouts.footer')

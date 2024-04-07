<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>

    {{-- Custom fonts --}}
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- Font awesome --}}
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Theme styles --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    {{-- Global styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
    {{-- Custom styles --}}
    @stack('styles')
</head>

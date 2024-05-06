<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>

    {{-- Theme styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome.css') }}">
    {{-- Global styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin/form.css') }}">
    {{-- Custom styles --}}
    @stack('styles')
</head>

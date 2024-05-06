<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

    {{-- Custom styles --}}

    {{-- Main styles --}}
    <link rel="stylesheet" href="{{ asset('assets/css/guest/index.css') }}">

    @stack('styles')

    {{-- Dependencies styles --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome.css') }}">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
</head>

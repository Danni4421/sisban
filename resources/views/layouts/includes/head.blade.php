<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title')
    </title>

   {{-- Link to a dependencies --}}
   <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
   <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}">
   <link rel="stylesheet" href="{{ asset('dist/css/boxicons.css') }}">
   <link rel="stylesheet" href="{{ asset('dist/css/fontawesome.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/admin/adminlte.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/dataTable/css/dataTable.css') }}">
   <link rel="icon" href="{{ asset('assets/img/Logo1_RBG.png') }}">

    @stack('styles')
</head>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') </title>

    {{-- Dependencies styles --}}
    <link rel="stylesheet" href="{{ asset('dist/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/boxicons.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/guest/index.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/guest/guide.css') }}">

    @stack('styles')
</head>

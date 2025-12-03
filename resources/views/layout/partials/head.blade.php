<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My App | @yield('title', 'Dashboard')</title>

    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <!-- ✅ Add this line -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('styles')
</head>

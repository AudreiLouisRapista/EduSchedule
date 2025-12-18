 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>AdminLTE 3 | Navbar & Tabs</title>

     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet"
         href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
     <!-- SweetAlert2 -->
     <link rel="stylesheet" href="../../plugins/sweetalert2/sweetalert2.min.css">
     <!-- Toastr -->
     <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
     <!-- Theme style -->
     <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
 </head>

 <body class="hold-transition sidebar-mini">
     <div class="wrapper">
         <!-- Navbar -->
         <nav class="main-header navbar navbar-expand navbar-white navbar-light">
             <!-- Left navbar links -->
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                             class="fas fa-bars"></i></a>
                 </li>
                 <li class="nav-item d-none d-sm-inline-block">
                     <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
                 </li>
             </ul>

             <ul class="navbar-nav ml-auto">
                 <li class="nav-item">
                     <span class="brand-text">Aethel</span>
                 </li>
             </ul>

         </nav>
         <!-- /.navbar -->
         <style>
             .brand-text {
                 font-weight: 800;
                 font-size: 22px;
                 background: linear-gradient(90deg, #4A00E0, #8E2DE2);
                 -webkit-background-clip: text;
                 -webkit-text-fill-color: transparent;
                 letter-spacing: -0.5px;
                 align-items: center;
                 padding-right: 15px;
             }
         </style>

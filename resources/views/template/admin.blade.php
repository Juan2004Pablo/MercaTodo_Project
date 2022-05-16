<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="{{ asset('jquery-3.5.1.min.js')}}"></script>

    <!-- Font Awesome -->
    <!-- Ionicons -->
    <!-- overlayScrollbars -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body class="hold-transition sidebar-mini">


<!-- Site wrapper -->
<div class="container mt-5">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <div class="card">
            
            <ul class="navbar-nav">

                <li class="nav-item"> <a href={{ route('home')}} class="nav-link">{{ trans('template.admin.home') }}</a></li>

                <li class="nav-item"><a href="{{route('role.index')}}" class="nav-link">{{ trans('template.admin.role') }}</a></li>

                <li class="nav-item"> <a href="{{ route('user.index') }}" class="nav-link">{{ trans('template.admin.users') }}</a></li>

                <li class="nav-item"><a href="{{ route('admin.category.index') }}" class="nav-link">{{ trans('template.admin.categories') }}</a></li>
                
                <li class="nav-item"><a href="{{ route('admin.product.index') }}" class="nav-link">{{ trans('template.admin.products') }}</a></li>

                <li class="nav-item"><a href="{{ route('admin.order.index') }}" class="nav-link">{{ trans('template.admin.orders') }}</a></li>
                
                <li class="nav-item"><a href="{{route('report.index')}}" class="nav-link">{{ trans('template.admin.reports') }}</a></li>

            </ul>

        </div>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                @foreach(auth()->user()->unreadNotifications as $notification)
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> {{ $notification->data['message'] }}
                            <span class="ml-3 float-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('markAsRead') }}" class="dropdown-item dropdown-footer">Mark as read</a>
                    @endforeach

                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">

    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                            @yield('breadcrumb')

                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong> Mercatodo </strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>

<script src="{{ asset('js/app_admin.js') }}" defer></script>
</body>
</html>

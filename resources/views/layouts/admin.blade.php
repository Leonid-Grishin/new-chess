<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!--Иконки-->
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('images/favicon/favicon-svg.svg') }}" type="image/svg+xml">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="manifest" href=" {{ asset('manifest.webmanifest') }} ">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        @yield('breadcrumbs')

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <li class="nav-item">
                <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                    <i class="fas fa-search"></i>
                </a>
                <div class="navbar-search-block">
                    <form class="form-inline">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">Выйти</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('index') }}" class="brand-link text-center">
            <img src="{{ asset('images/logo.svg') }}" alt="На Главную">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ asset('assets/admin/dist/img/fox.jpg') }}" class="img-circle elevation-2" alt="Админ">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('admin.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Главная админка</p>
                        </a>
                    </li>
                    <li class="nav-header">СТРУКТУРА</li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Страницы
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.club') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Клуб</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.school') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Школа</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Лагерь
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.camp.edit') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Общая информация</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.campLocationSlider') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Слайдер локация</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.campGallerySlider') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Слайдер галерея</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Блоки
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.students') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Ученики</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.news') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Новости</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.reviews') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Отзывы</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.teachers') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Преподаватели</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-envelope"></i>
                            <p>
                                Заявки
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.requests') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Заявки</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.subscribers') }}" class="nav-link">
                                    <i class="fa fa-angle-right nav-icon"></i>
                                    <p>Подписки</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">

        <div class="container ">
            <div class="row">
                <div class="col-12 mt-3">
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        @yield('content')
    </div>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/dist/js/demo.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/admin/admin.js') }}" type="module"></script>

</body>
</html>


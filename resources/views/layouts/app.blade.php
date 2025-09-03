<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>نظام السمات</title>
    <link rel="apple-touch-icon" href="{{asset('newlogo.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('newlogo.png')}}">

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />



    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/vendors-rtl.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/vendors/css/extensions/toastr.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/themes/semi-dark-layout.css')}}">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />




    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/pages/dashboard-ecommerce.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/plugins/charts/chart-apex.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('/app-assets/css-rtl/plugins/extensions/ext-component-toastr.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/app-assets/css-rtl/custom-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/style-rtl.css') }}">

    <style>
        .navigation-main .nav-item a {
            font-family: 'Cairo', sans-serif !important;
        }


        body {
            font-family: 'Cairo', sans-serif;
        }


        .main-menu.menu-light .navigation>li.active>a {
            background: -webkit-linear-gradient(208deg, #3c8dbc, rgba(115, 103, 240, 0.7));
            background: linear-gradient(-118deg, #3c8dbc, #3c8dbc);
            box-shadow: 0 0 10px 1px #3c8dbc;
            color: #FFFFFF;
            font-weight: 400;
            border-radius: 4px;
        }
    </style>
</head>

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <nav
        class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="#"><i class="ficon"
                                data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"></a>
                        <h2 style="font-weight: bold;font-family: 'Cairo', sans-serif;">نظام السمات </h2>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item d-none d-lg-block">
                    @foreach(auth()->user()->getRoleNames() as $v)
                        <h2 style="font-weight: bold;font-family: 'Cairo', sans-serif;"
                            class="badge badge-secondary text-dark">
                            {{ auth()->user()->name }} -
                            @if ($v == 'Simats')
                                موظف سمات
                            @elseif ($v == 'Tourist Insurance')
                                موظف تأمينات السياحي
                            @elseif ($v == 'Cargo Insurance')
                                موظف تأمينات الشحن
                            @elseif ($v == 'Admin')
                                مدير الفئة
                            @else
                                {{ $v }}
                            @endif
                        </h2>
                    @endforeach
                </li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link"
                        id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder"></span><span
                                class="user-status"></span></div><span class="avatar"><img class="round"
                                src="{{asset('newlogo.png')}}" alt="avatar" height="40" width="40"><span
                                class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{ route('password.change') }}">
                            <i class="me-50" data-feather="user"></i> المعلومات الشخصية
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="me-50" data-feather="log-out"></i> تسجيل الخروج
                            </button>
                        </form>
                    </div>

                </li>
            </ul>
        </div>
    </nav>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion justify-content-between"><a
                class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="me-75"
                        data-feather="alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>

    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand"
                        href="../../../html/rtl/vertical-menu-template/index.html">
                        <span class="brand-logo">
                            <img src="{{ asset('newlogo.png') }}" alt="" />
                        </span>
                        <h2 class="brand-text">برنامج السمات</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                            class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                            class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary"
                            data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main">
                @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-money-bill-wave me-1"></i>
                            <span class="menu-title text-truncate">لوحة التحكم</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('Simats') || auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('simats.index') }}">
                            <i class="fa-solid fa-money-bill-wave me-1"></i>
                            <span class="menu-title text-truncate">السمات</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('Simats'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('simats.create') }}">
                            <i class="fas fa-plus me-1"></i>
                            <span class="menu-title text-truncate">إضافة سمة</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('Tourist Insurance') || auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('insurances.indexTourist') }}">
                            <i class="fa-solid fa-car-burst me-1"></i>
                            <span class="menu-title text-truncate">تأمينات السياحي</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('Cargo Insurance') || auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Admin'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('insurances.indexCargo') }}">
                            <i class="fa-solid fa-car-burst me-1"></i>
                            <span class="menu-title text-truncate">تأمينات الشحن</span>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->hasRole('Cargo Insurance') || auth()->user()->hasRole('Tourist Insurance'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('insurances.create') }}">
                            <i class="fas fa-plus me-1"></i>
                            <span class="menu-title text-truncate">إضافة تأمين</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasRole('Super Admin'))
                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('nationalities.index') }}">
                            <i class="fa-solid fa-flag me-1"></i>
                            <span class="menu-title text-truncate">الجنسيات</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('users.index') }}">
                            <i class="fa-solid fa-user-group me-1"></i>
                            <span class="menu-title text-truncate">المستخدمين</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="d-flex align-items-center" href="{{ route('roles.index') }}">
                            <i class="fa-solid fa-circle-minus me-1"></i>
                            <span class="menu-title text-truncate">الصلاحيات</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <footer class="footer footer-static footer-light" style="background-color: white;">
        <p class=" mb-0"><span class="float-md-start d-none d-md-block">Copyright © 2025 الهيئة العامة للمنافذ البرية
                والبحرية . جميع الحقوق محفوظة.<a class="ms-25" href="{{asset('newlogo.png')}}" target="_blank"> </a>
                <img class="round" src="{{asset('newlogo.png')}}" alt="avatar" height="20"
                    width="20"></span></span><span class="float-md-end d-none d-md-block">الهيئة العامة للمنافذ البرية
                والبحرية - المكتب البرمجي <img class="round" src="{{asset('newlogo.png')}}" alt="avatar" height="20"
                    width="20"></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>



    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script src="{{ asset('/app-assets/vendors/js/vendors.min.js') }}"></script>


    <script src="{{ asset('/app-assets/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('/app-assets/vendors/js/extensions/toastr.min.js') }}"></script>


    <script src="{{ asset('/app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('/app-assets/js/core/app.js') }}"></script>

    <script src="{{ asset('/app-assets/js/scripts/pages/dashboard-ecommerce.js') }}"></script>

    <script src="../../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/polyfill.min.js"></script>

    <script src="../../../app-assets/js/scripts/extensions/ext-component-sweet-alerts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(window).on('load', function () {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var currentPath = window.location.pathname;

            var menuItems = document.querySelectorAll(".navigation-main .nav-item a");

            menuItems.forEach(function (item) {
                const linkPath = new URL(item.href).pathname;
                if (linkPath === currentPath) {
                    item.parentElement.classList.add("active");
                }
            });

        });
    </script>
    @stack('scripts')
</body>

</html>
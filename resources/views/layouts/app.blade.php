<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css"
          integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin=""/>
</head>

<body>
<nav class="navbar navbar-dark navbar-expand-lg sticky-top bg-dark flex-md-nowrap shadow p-0 mb-5">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3 text-white py-3"
       href="#">Laravel Transaction</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse"
            data-target="#sidebarMenu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav ml-auto">
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
            @endif
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item text-nowrap">
                <a class="btn btn-dark" href="#" id="logoutBtn">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</nav>

<div class="container-fluid">
    @auth
        <nav id="sidebarMenu"
             class="{{ !Route::is(['login', 'register']) ? 'col-md-3 col-lg-2' : '' }} d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('home') ? 'active' : '' }}" href="/home">
                            <span data-feather="home"></span>
                            Dashboard
                        </a>
                    </li>
                    @if(strpos(Session::get('user_access'), 'barang_manage') !== false ||
                    strpos(Session::get('user_access'),
                    'order_manage') !== false)
                        @can('access', 'barang_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('barang.*') ? 'active' : '' }}"
                                   href="{{ route('barang.index') }}">
                                    <span data-feather="package"></span>
                                    Barang
                                </a>
                            </li>
                        @endcan
                        @can('access', 'barang_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('orders.*') ? 'active' : '' }}"
                                   href="{{ route('orders.index') }}">
                                    <span data-feather="shopping-cart"></span>
                                    Order
                                </a>
                            </li>
                        @endcan
                        @can('access', 'barang_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('purchase-requests.*') ? 'active' : '' }}"
                                   href="{{ route('purchase-requests.index') }}">
                                    <span data-feather="list"></span>
                                    Permintaan Pembelian
                                </a>
                            </li>
                        @endcan
                    @endif
                    @if(strpos(Session::get('user_access'), 'access_group_manage') !== false ||
                    strpos(Session::get('user_access'),
                    'access_master_manage') !== false || strpos(Session::get('user_access'), 'users_manage') !== false)
                        @can('access', 'users_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('users.*') ? 'active' : '' }}"
                                   href="{{ route('users.index') }}">
                                    <span data-feather="users"></span>
                                    Users
                                </a>
                            </li>
                        @endcan
                        @can('access', 'access_group_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('access_groups.*') ? 'active' : '' }}"
                                   href="{{ route('access_groups.index') }}">
                                    <span data-feather="bar-chart-2"></span>
                                    Group Access
                                </a>
                            </li>
                        @endcan
                        @can('access', 'access_master_manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::is('access_masters.*') ? 'active' : '' }}"
                                   href="{{ route('access_masters.index') }}">
                                    <span data-feather="layers"></span>
                                    Access Master
                                </a>
                            </li>
                        @endcan
                    @endif
                </ul>
            </div>
        </nav>
    @endauth

    <main role="main" class="{{ !Route::is(['login', 'register']) ? 'col-md-9 ml-sm-auto col-lg-10' : '' }} px-md-4">
        @yield('content')
    </main>
</div>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.1/knockout-latest.js"
        integrity="sha512-2AL/VEauKkZqQU9BHgnv48OhXcJPx9vdzxN1JrKDVc4FPU/MEE/BZ6d9l0mP7VmvLsjtYwqiYQpDskK9dG8KBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js"
        integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('script');
<script>
    /* globals feather:false */
    (function () {
        'use strict'

        feather.replace();

        $('#logoutBtn').on('click', (event) => {
            if (confirm('Yakin ingin keluar?') === true) {
                event.preventDefault();
                document.getElementById('logout-form').submit();
            }
        })
    })()
</script>
</body>

</html>

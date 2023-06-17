<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>بلدية وادي غزة - تطبيق قراءة العداد</title>
    <link rel="stylesheet" href='{{ asset('./css/bootstrap-rtl.min.css') }}' />
    <link rel="stylesheet" href='{{ asset('./css/style.css') }}' />
    <link rel="stylesheet" href='{{ asset('./css/all.min.css') }}' />
    <link rel="stylesheet" href='{{ asset('./js/all.min.js') }}' />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href='{{ asset('./css/bootstrap-rtl.min.css') }}' />
    <script src="{{ asset('./js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{asset('./js/popper-1.16.1.min.js')}}"></script>
    <script src="{{asset('./js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        @font-face {
            font-family: "JF Flat Regular";
            src: url(../fonts/JF-Flat-regular.eot) format('embedded-opentype'), url('../fonts/JF-Flat-regular.svg#JF Flat Regular') format('svg'), url(../fonts/JF-Flat-regular.woff) format('woff'), url(../fonts/JF-Flat-regular.ttf) format('truetype');
            font-weight: bolder;
            font-style: normal
        }

        body {
            font-family: "JF Flat Regular";
            /* font-size: 18px !important; */
            background-color: #f7f5f5;
        }

        table {
            background-color: white;
        }

        input[type="number"] {
            direction: rtl;
            text-align: right;
        }

        input.form-control {
            margin-top: 8px !important;
            margin-bottom: 20px !important;
        }

        @media (max-width:1199px) {
            .hide-on-small {
                display: none !important
            }
        }

        @media (max-width: 575.98px) {
            .search-sm {
                margin-top:-2px !important
            }
        }

        @media (min-width:992px) {
            .my-table{
                margin-right: 30px;
                margin-left: 30px
            }
        }
        @media (max-width:370px) {
            .current_read_input {
                width: 40px !important;
            }
           
        }
        @media (max-width:430px) {
            .hide-on-extra-small {
                display: none !important;
            }
            td, th {
                padding: 5px !important
            }
            .page-link {
                padding-left: 9.5px !important;
                padding-right: 9.5px !important
            }
           
        }
        
    </style>
</head>

<body class="antialiased" dir="rtl">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm py-2">
        <div class="container">
            <a class="text-muted" href="{{ url('/') }}"
                style="margin-right:0px !important; text-decoration: none !important">
                قراءة العدادات - بلدية وادي غزة
            </a>
            <button class="navbar-toggler p-1" type="button"  data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon small"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل دخول') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('إنشاء حساب') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item ">
                            <a id="navbarDropdown" class="nav-link" href="{{ route('logout') }}" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ Auth::user()->name }} : تسجيل خروج

                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <div class="main container-fluid">

        @yield('content')
    </div>

</body>

</html>

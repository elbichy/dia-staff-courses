<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        {{ config('app.name', 'Lt. Gen. A.B Dambazau Medical Centre Management Platform') }}@isset($title) - {{ $title }}@endisset
    </title>
    
    <style>
        :root {
            --primary-bg-dark: #164f6b; 
            --primary-bg-mid: #0e75a7; 
            --primary-bg-light: #039be5;  
            
            --primary-trans-bg-dark: #164f6b;
            --primary-trans-bg-light: #039be5;
            
            --secondary-bg-dark: #8d1003; 
            --secondary-bg-light: #c91e0b; 
            
            --switch-dark: #164f6b; 
            --switch-light: #039be5; 

            --button-dark: #164f6b; 
            --button-light: #039be5;
            --button-secondary: #8d1003;
        }
    </style>
    
    {!! MaterializeCSS::include_css() !!}
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet"> <!-- font-awesome -->
    <link rel="stylesheet" href="{{asset('css/material-icons.css')}}">
    <link rel="stylesheet" href="{{ asset('css/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet"  href="{{asset('css/lightbox.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/wnoty.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="app" id="app">
        {{-- Navbar goes here --}}
        <div id="space-for-sidenave" class="navbar-fixed">
            <nav>
                <div class="nav-wrapper">
                    {{-- Show View --}}
                    <a href="#" id="show-side-nav">
                        <i class="small material-icons white-text">menu</i>
                    </a>
                    {{-- BREADCRUMB --}}
                    <div class="left breadcrumbWrap hide-on-small-only">
                        {{-- @if(request()->segment(1) == 'administrator')
                            <a href="/administrator" class="breadcrumb">Administrator</a>
                        @else
                            <a href="/dashboard" class="breadcrumb">Dashboard</a>
                        @endif --}}

                        <a href="/dashboard/{{ request()->segment(2) }}" class="breadcrumb">{{(request()->segment(2) == '') ? 'Dashbord' : ucfirst(request()->segment(2))}}</a>
                        @if(request()->segment(3) != '')
                            <a href="#" class="breadcrumb">{{ strtoupper(request()->segment(3)) }}</a>
                        @endif
                    </div>

                    {{-- USER TYPE --}}
                    @if(auth()->user()->isRecord)
                        <h6 class="left" style=" width: auto; margin: 0 0 0 10%; height:100%; text-align: center; ">
                            <i class="fas fa-folder-open"></i> Records Unit
                        </h6>
                    @endif
                    @if(auth()->user()->isAccount)
                        <h6 class="left" style=" width: auto; margin: 0 0 0 10%; height:100%; text-align: center; ">
                            <i class="fas fa-money-bill-alt"></i> Account Unit
                        </h6>
                    @endif

                    {{-- OTHER MENU RIGHT --}}
                    <a href="#" data-target="slide-out" class="sidenav-trigger hide-on-med-and-up right"><i class="material-icons">menu</i></a>
                    <ul class="right hide-on-med-and-down">
                        <li class="logOutBtn">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="material-icons right">power_settings_new</i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    @auth
                    <ul class="right hide-on-small-only">
                         <p style="padding-right:12px;">Hi! {{ auth()->user()->fullname }}</p>
                    </ul>
                    @endauth
                </div>
            </nav>
        </div>

        {{-- SIDE NAV --}}
        <ul id="slide-out" class="sidenav sidenav-fixed" style="min-height: 100%; display: flex; flex-direction: column;">
            <div class="sideNavContainer">
                {{-- THE RED LOGO AREA --}}
                <li>
                    <div class="user-view">
                        {{-- Hide View --}}
                        <a href="#" id="hide-side-nav">
                            <i class="small material-icons white-text">close</i>
                        </a>

                        {{-- BUSINESS LOGO --}}
                        <a href="#user"><img class="circle" src="{{asset('storage/dia-logo.png')}}"></a>
                    
                        {{-- BUSINESS NAME --}}
                        <a href="#name"><span class="white-text name">
                            Defence Intelligence Agency
                        </span></a>

                        {{-- BUSINESS BRANCH AND ADDRESS --}}
                        <a href="#email"><span class="white-text email">Staff Courses Management Platform</span></a>
                    </div>
                </li>

                {{-- THE SIDEBAR PROPER --}}
                {{-- <li class="{{(request()->segment(1) == 'dashboard' && request()->segment(2) == NULL) ? 'active' : ''}}">
                    <a href="/dashboard"><i class="fas fa-tachometer-alt white-text fa-2x"></i>DASHBOARD</a>
                </li> --}}
                {{-- PERSONNEL --}}
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                    <li class="{{ request()->segment(2) == 'personnel' ? 'active' : '' }}">
                        <a style="padding:0 32px;" class="collapsible-header">
                            <i class="fas fa-users white-text fa-2x"></i>PERSONNEL<i class="material-icons right">arrow_drop_down</i>
                        </a>
                        <div class="collapsible-body">
                        <ul>
                            @if(auth()->user()->isAdmin)
                                <li class="{{(request()->segment(3) == 'new') ? 'active' : ''}}">
                                    <a href="/dashboard/personnel/new">Register New</a>
                                </li>
                            @endif
                            <li class="{{(request()->segment(3) == 'military') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/military">Military Staff</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'senior') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/senior">Senior Staff</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'junior') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/junior">Junior Staff</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'contract') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/contract">Contract Staff</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'all') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/all">All Staff</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'archived') ? 'active' : ''}}">
                                <a href="/dashboard/personnel/archived">Archived Staff</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    </ul>
                </li>

                {{-- COURSES --}}
                @if(auth()->user()->isTraining)
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                    <li class="{{ request()->segment(2) == 'courses' ? 'active' : '' }}">
                        <a style="padding:0 32px;" class="collapsible-header">
                            <i class="fas fa-file-signature white-text fa-2x"></i>COURSES<i class="material-icons right">arrow_drop_down</i>
                        </a>
                        <div class="collapsible-body">
                        <ul>
                            <li class="{{(request()->segment(3) == 'new') ? 'active' : ''}}">
                                <a href="/dashboard/courses/new">Register New</a>
                            </li>
                            <li class="{{(request()->segment(3) == 'all') ? 'active' : ''}}">
                                <a href="/dashboard/courses/all">All Courses</a>
                            </li>
                        </ul>
                        </div>
                    </li>
                    </ul>
                </li>
                @endif

                {{-- OTHER MENU RIGHT FOR MOBILE DEVICES --}}
                <li class="hide-on-med-and-up col s12" style="border-top:1px solid rgba(0,0,0, 0.3); justify-self: flex-end; margin-top: auto;">
                    <ul class="right col s8" style="display:flex; justify-content:center; align-items:center; width:20%;">
                        <li class="logOutBtn">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i style="" class="material-icons left">power_settings_new</i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <ul class="col s4 right white-text" style="display:flex; justify-content:center; align-items:center; width:80%;">
                        @if(auth()->check())
                            <a class="white-text" href="#">{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</a>
                        @endif
                    </ul>
                </li>
            </div>
        </ul>

        {{-- CONTENT AREA    --}}
        @yield('content')
    </div>
    <script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/axios.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/wnoty.js')}}"></script>
    {!! MaterializeCSS::include_js() !!}
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    @stack('scripts')
    <script type="text/javascript" src="{{ asset('js/sweetalert.min.js') }}"></script>
    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')
</body>
</html>

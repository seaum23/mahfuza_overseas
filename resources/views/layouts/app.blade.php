<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" href="{{ asset('storage/images/favicon.ico') }}">
    <title>@yield('title') - Mahfuza Overseas</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.2/dist/jBox.all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
    <link href="{{ asset('css/bootstrap-datetimepicker.css?v2') }}" rel="stylesheet" />
    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

</head>
<body {{ Session::has('alert') ? 'data-alert' : '' }} data-alert-type='{{ Session::get('alert_type') }}' data-alert-message='{{ Session::get('message') }}'>
    @auth
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <div class="loader-container"><div class="loader"><div class="loadingio-spinner-spinner-ptyf34t14na"><div class="ldio-4bfaoxawr8j"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div></div></div>
            <div class="app-header header-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="app-header__content">
                    <div class="app-header-left">
                        <div class="search-wrapper">
                            <div class="input-holder">
                                <input type="text" class="search-input" placeholder="Type to search">
                                <button class="search-icon"><span></span></button>
                            </div>
                            <button class="close"></button>
                        </div>
                        <ul class="header-menu nav">
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon fa fa-database"> </i>
                                    Statistics
                                </a>
                            </li>
                            <li class="btn-group nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon fa fa-edit"></i>
                                    Projects
                                </a>
                            </li>
                            <li class="dropdown nav-item">
                                <a href="javascript:void(0);" class="nav-link">
                                    <i class="nav-link-icon fa fa-cog"></i>
                                    Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="app-header-right">
                        <div class="header-btn-lg pr-0">
                            <div class="widget-content p-0">
                                <div class="widget-content-wrapper">
                                    <div class="widget-content-left">
                                        <div class="btn-group">
                                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                                <img width="42" class="rounded-circle" src="{{ asset('images/avatars/1.jpg')}}" alt="">
                                                <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                            </a>
                                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                                <button type="button" tabindex="0" class="dropdown-item">User Account</button>
                                                <button type="button" tabindex="0" class="dropdown-item">Settings</button>
                                                <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                                <button type="button" tabindex="0" class="dropdown-item">Actions</button>
                                                <div tabindex="-1" class="dropdown-divider"></div>
                                                <form action="{{ route('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit" tabindex="0" class="btn-transition btn btn-outline-danger dropdown-item">Logout</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget-content-left  ml-3 header-user-info">
                                        <div class="widget-heading">
                                            {{ auth()->user()->name; }}
                                        </div>
                                        <div class="widget-subheading">
                                            Developer
                                        </div>
                                    </div>
                                    <div class="widget-content-right header-user-info ml-3">
                                        <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                            <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ui-theme-settings">
                <button type="button" id="TooltipDemo" class="btn-open-options btn btn-warning">
                    <i class="fa fa-cog fa-w-16 fa-spin fa-2x"></i>
                </button>
                <div class="theme-settings__inner">
                    <div class="scrollbar-container">
                        <div class="theme-settings__options-wrapper">
                            <h3 class="themeoptions-heading">Layout Options
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-header">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Header
                                                    </div>
                                                    <div class="widget-subheading">Makes the header top fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-sidebar">
                                                        <div class="switch-animate switch-on">
                                                            <input type="checkbox" checked data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Sidebar
                                                    </div>
                                                    <div class="widget-subheading">Makes the sidebar left fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="switch has-switch switch-container-class" data-class="fixed-footer">
                                                        <div class="switch-animate switch-off">
                                                            <input type="checkbox" data-toggle="toggle" data-onstyle="success">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Fixed Footer
                                                    </div>
                                                    <div class="widget-subheading">Makes the app footer bottom fixed, always visible!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>
                                    Header Options
                                </div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-header-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-header-cs-class" data-class="bg-primary header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-secondary switch-header-cs-class" data-class="bg-secondary header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-success switch-header-cs-class" data-class="bg-success header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-info switch-header-cs-class" data-class="bg-info header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-warning switch-header-cs-class" data-class="bg-warning header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-danger switch-header-cs-class" data-class="bg-danger header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-light switch-header-cs-class" data-class="bg-light header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-dark switch-header-cs-class" data-class="bg-dark header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-focus switch-header-cs-class" data-class="bg-focus header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-alternate switch-header-cs-class" data-class="bg-alternate header-text-light">
                                            </div>
                                            <div class="divider">
                                            </div>
                                            <div class="swatch-holder bg-vicious-stance switch-header-cs-class" data-class="bg-vicious-stance header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-midnight-bloom switch-header-cs-class" data-class="bg-midnight-bloom header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-night-sky switch-header-cs-class" data-class="bg-night-sky header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-slick-carbon switch-header-cs-class" data-class="bg-slick-carbon header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-asteroid switch-header-cs-class" data-class="bg-asteroid header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-royal switch-header-cs-class" data-class="bg-royal header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-warm-flame switch-header-cs-class" data-class="bg-warm-flame header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-night-fade switch-header-cs-class" data-class="bg-night-fade header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-sunny-morning switch-header-cs-class" data-class="bg-sunny-morning header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-tempting-azure switch-header-cs-class" data-class="bg-tempting-azure header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-amy-crisp switch-header-cs-class" data-class="bg-amy-crisp header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-heavy-rain switch-header-cs-class" data-class="bg-heavy-rain header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-mean-fruit switch-header-cs-class" data-class="bg-mean-fruit header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-malibu-beach switch-header-cs-class" data-class="bg-malibu-beach header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-deep-blue switch-header-cs-class" data-class="bg-deep-blue header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-ripe-malin switch-header-cs-class" data-class="bg-ripe-malin header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-arielle-smile switch-header-cs-class" data-class="bg-arielle-smile header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-plum-plate switch-header-cs-class" data-class="bg-plum-plate header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-fisher switch-header-cs-class" data-class="bg-happy-fisher header-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-happy-itmeo switch-header-cs-class" data-class="bg-happy-itmeo header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-mixed-hopes switch-header-cs-class" data-class="bg-mixed-hopes header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-strong-bliss switch-header-cs-class" data-class="bg-strong-bliss header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-grow-early switch-header-cs-class" data-class="bg-grow-early header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-love-kiss switch-header-cs-class" data-class="bg-love-kiss header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-premium-dark switch-header-cs-class" data-class="bg-premium-dark header-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-green switch-header-cs-class" data-class="bg-happy-green header-text-light">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Sidebar Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto btn btn-focus btn-sm switch-sidebar-cs-class" data-class="">
                                    Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Choose Color Scheme
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div class="swatch-holder bg-primary switch-sidebar-cs-class" data-class="bg-primary sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-secondary switch-sidebar-cs-class" data-class="bg-secondary sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-success switch-sidebar-cs-class" data-class="bg-success sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-info switch-sidebar-cs-class" data-class="bg-info sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-warning switch-sidebar-cs-class" data-class="bg-warning sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-danger switch-sidebar-cs-class" data-class="bg-danger sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-light switch-sidebar-cs-class" data-class="bg-light sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-dark switch-sidebar-cs-class" data-class="bg-dark sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-focus switch-sidebar-cs-class" data-class="bg-focus sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-alternate switch-sidebar-cs-class" data-class="bg-alternate sidebar-text-light">
                                            </div>
                                            <div class="divider">
                                            </div>
                                            <div class="swatch-holder bg-vicious-stance switch-sidebar-cs-class" data-class="bg-vicious-stance sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-midnight-bloom switch-sidebar-cs-class" data-class="bg-midnight-bloom sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-night-sky switch-sidebar-cs-class" data-class="bg-night-sky sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-slick-carbon switch-sidebar-cs-class" data-class="bg-slick-carbon sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-asteroid switch-sidebar-cs-class" data-class="bg-asteroid sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-royal switch-sidebar-cs-class" data-class="bg-royal sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-warm-flame switch-sidebar-cs-class" data-class="bg-warm-flame sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-night-fade switch-sidebar-cs-class" data-class="bg-night-fade sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-sunny-morning switch-sidebar-cs-class" data-class="bg-sunny-morning sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-tempting-azure switch-sidebar-cs-class" data-class="bg-tempting-azure sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-amy-crisp switch-sidebar-cs-class" data-class="bg-amy-crisp sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-heavy-rain switch-sidebar-cs-class" data-class="bg-heavy-rain sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-mean-fruit switch-sidebar-cs-class" data-class="bg-mean-fruit sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-malibu-beach switch-sidebar-cs-class" data-class="bg-malibu-beach sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-deep-blue switch-sidebar-cs-class" data-class="bg-deep-blue sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-ripe-malin switch-sidebar-cs-class" data-class="bg-ripe-malin sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-arielle-smile switch-sidebar-cs-class" data-class="bg-arielle-smile sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-plum-plate switch-sidebar-cs-class" data-class="bg-plum-plate sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-fisher switch-sidebar-cs-class" data-class="bg-happy-fisher sidebar-text-dark">
                                            </div>
                                            <div class="swatch-holder bg-happy-itmeo switch-sidebar-cs-class" data-class="bg-happy-itmeo sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-mixed-hopes switch-sidebar-cs-class" data-class="bg-mixed-hopes sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-strong-bliss switch-sidebar-cs-class" data-class="bg-strong-bliss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-grow-early switch-sidebar-cs-class" data-class="bg-grow-early sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-love-kiss switch-sidebar-cs-class" data-class="bg-love-kiss sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-premium-dark switch-sidebar-cs-class" data-class="bg-premium-dark sidebar-text-light">
                                            </div>
                                            <div class="swatch-holder bg-happy-green switch-sidebar-cs-class" data-class="bg-happy-green sidebar-text-light">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <h3 class="themeoptions-heading">
                                <div>Main Content Options</div>
                                <button type="button" class="btn-pill btn-shadow btn-wide ml-auto active btn btn-focus btn-sm">Restore Default
                                </button>
                            </h3>
                            <div class="p-3">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5 class="pb-2">Page Section Tabs
                                        </h5>
                                        <div class="theme-settings-swatches">
                                            <div role="group" class="mt-2 btn-group">
                                                <button type="button" class="btn-wide btn-shadow btn-primary btn btn-secondary switch-theme-class" data-class="body-tabs-line">
                                                    Line
                                                </button>
                                                <button type="button" class="btn-wide btn-shadow btn-primary active btn btn-secondary switch-theme-class" data-class="body-tabs-shadow">
                                                    Shadow
                                                </button>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            <li class="app-sidebar__heading">Dashboards</li>
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-rocket"></i>
                                    Dashboard
                                </a>
                            </li>
                            <li class="app-sidebar__heading">Local affair</li>
                            <li class="{{ request()->is('candidate*') ? 'mm-active' : '' }}" >
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-user"></i>
                                    Candidate
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ url('/candidate/create') }}" class="{{ request()->is('candidate/create') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>New Candidate
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/candidate') }}" class="{{ request()->is('candidate') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Candidate List
                                        </a>
                                    </li>
                                </ul>
                            </li>                            
                            <li class="{{ request()->is('processing*') ? 'mm-active' : '' }}">
                                <a href="{{ route('processing') }}">
                                    <i class="metismenu-icon pe-7s-credit {{ request()->is('processing') ? 'mm-active' : '' }}"></i>
                                    VISA List
                                </a>
                            </li>
                            <li class="{{ request()->is('ticket*') ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-plane"></i>
                                    Ticket
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    {{-- <li>
                                        <a href="#">
                                            <i class="metismenu-icon"></i>New Ticket
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{ route('ticket-index') }}" class="{{ request()->is('ticket') ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Candidate Ticket List
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Outside Candidate List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Outside Candidate Ticket List
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="{{ (request()->is('agent*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-car"></i>
                                    Agent
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ url('agent/create') }}" class="{{ (request()->is('agent/create')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Add New Agent
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('agent') }}" class="{{ (request()->is('agent')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Agent List
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Add Agent Expense
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            {{-- <li>
                                <a href="tables-regular.html">
                                    <i class="metismenu-icon pe-7s-credit"></i>
                                    Pay Mode
                                </a>
                            </li>
                            <li>
                                <a href="tables-regular.html">
                                    <i class="metismenu-icon pe-7s-display2"></i>
                                    Report
                                </a>
                            </li> --}}
                                                        
                            {{-- <li>
                                <a href="tables-regular.html">
                                    <i class="metismenu-icon pe-7s-phone"></i>
                                    CRM
                                </a>
                            </li> --}}
                            <li class="app-sidebar__heading">Foreign Affair</li>
                            <li class="{{ (request()->is('delegate*')) ? 'mm-active' : '' }}" >
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-id"></i>
                                    Delegate
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('delegate') }}" class="{{ (request()->is('delegate')) ? 'mm-active' : '' }}" >
                                            <i class="metismenu-icon"></i>Add New Delegate
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('delegate-show') }}" class="{{ (request()->is('delegate/list')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Delegates List
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Mr. Maheer Bu Arish
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="{{ (request()->is('sponsor*')) ? 'mm-active' : '' }}" >
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-notebook"></i>
                                    Sponsor
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('sponsor') }}" class="{{ (request()->is('sponsor')) ? 'mm-active' : '' }}" >
                                            <i class="metismenu-icon"></i>Add New Sponsor
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('sponsor-list') }}" class="{{ (request()->is('sponsor/list*')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Sponsor List
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/sponsor-visa/create') }}" class="{{ (request()->is('sponsor-visa/create')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Add Sponsor's VISA
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/sponsor-visa.list') }}" class="{{ (request()->is('sponsor-visa.list')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Show VISA list
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('outside-office*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-portfolio"></i>
                                    Outside Office
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ url('outside-office') }}" class="{{ (request()->is('outside-office')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Office List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('manpower-office*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-portfolio"></i>
                                    Manpower
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ url('manpower-office/create') }}" class="{{ (request()->is('manpower-office/create')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Add Office
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('manpower-office') }}" class="{{ (request()->is('manpower-office')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Office List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-portfolio"></i>
                                    Office
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="components-tabs.html">
                                            <i class="metismenu-icon"></i>Add New Office
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-accordions.html">
                                            <i class="metismenu-icon"></i>Office List
                                        </a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li class="{{ (request()->is('jobs*')) ? 'mm-active' : '' }}">
                                <a href="{{ url('jobs') }}" class="{{ (request()->is('jobs*')) ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-box1"></i>
                                    Jobs
                                </a>
                            </li>

                            @hasanyrole('Super Admin|developer')
                            <li class="app-sidebar__heading">Admin</li>
                            <li class="{{ (request()->is('employee*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    HRM
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('employee') }}" class="{{ (request()->is('employee')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Add New Employee
                                        </a>
                                    </li>
                                    <li>
                                        <a href="employee-show" class="{{ (request()->is('employee-show')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Employee List
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Add Sections
                                        </a>
                                    </li>
                                    <li>
                                        <a href="components-notifications.html">
                                            <i class="metismenu-icon"></i>Send SMS
                                        </a>
                                    </li> --}}
                                </ul>
                            </li>
                            <li class="{{ (request()->is('permission*')) ? 'mm-active' : '' }} {{ (request()->is('role*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Role/Permission
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('role') }}" class="{{ (request()->is('role')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Roles
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('maheer*')) ? 'mm-active' : '' }} {{ (request()->is('maheer*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Mr. Maheer Bu Arish
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('maheer.index') }}" class="{{ (request()->is('maheer')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Account
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('accounts*')) ? 'mm-active' : '' }}">
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-users"></i>
                                    Accounts
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{ route('accounts.index') }}" class="{{ (request()->is('accounts')) ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon"></i>Accounts List
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="{{ (request()->is('website')) ? 'mm-active' : '' }}">
                                <a href="{{ url('website') }}" class="{{ (request()->is('website')) ? 'mm-active' : '' }}">
                                    <i class="metismenu-icon pe-7s-box1"></i>
                                    Website Frontpage
                                </a>
                            </li>
                            <?php $all_packages = App\Models\WebsiteContent::get()->unique('section')->skip(3); ?>
                            <li>
                                <a href="#">
                                    <i class="metismenu-icon pe-7s-portfolio"></i>
                                    Packages
                                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                                </a>
                                <ul>
                                    @foreach($all_packages as $row)
                                        <li>
                                            <a href="{{ url('package_image_headline',$row->id) }}">
                                                <i class="metismenu-icon"></i>{{$row->section}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endhasanyrole
                            <li style="margin-bottom: 150px"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
            </div>
        </div>
        @yield('modals')
    @endauth
    @guest
        @yield('login')
    @endguest
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.min.js" integrity="sha512-i8ERcP8p05PTFQr/s0AZJEtUwLBl18SKlTOZTH0yK5jVU0qL8AIQYbbG5LU+68bdmEqJ6ltBRtCxnmybTbIYpw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.2/dist/jBox.all.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/fh-3.1.8/r-2.2.7/datatables.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/template.js') }}"></script></body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
    <script src="{{ asset('js/hijri/bootstrap-hijri-datetimepicker.js?v2') }}"></script>
    <script src="{{ asset('js/timepicker.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- include FilePond library -->
    <script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

    <!-- include FilePond plugins -->
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

    <!-- include FilePond jQuery adapter -->
    <script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

    <!-- Sweet Alert -->
    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /**
         * 
         * Filepond configuration!
         * 
         */
        
        // const pond = FilePond.create();

        // First register any plugins
        $.fn.filepond.registerPlugin(FilePondPluginImagePreview);        
            
        // Generic file-pond
        $('.my-pond').filepond({
            credits: false,
            'allowMultiple': false
        });



        // Generic file-pond multiple
        $('.my-pond-multiple').filepond({
            credits: false,
            'allowMultiple': true
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        document.addEventListener('FilePond:processfilestart', (e) => {
            $(".file-pond-submit").html('<i class="fas fa-spinner fa-pulse"></i>');
            $(".file-pond-submit").prop('disabled', true);        
        });
        document.addEventListener('FilePond:processfile', (e) => {
            $(".file-pond-submit").html('Save');
            $(".file-pond-submit").prop('disabled', false);
        });
    </script>

    <script>
        $('.amount-input').on('keyup', () => {
            let account = $('#account').val();
            let left_input = $('#left_input').val();
            let right_input = $('#right_input').val();
            if(account == '1' || account == '2'){
                if(left_input === "" && right_input === ""){
                    $('#left_input').prop('disabled', false);
                    $('#right_input').prop('disabled', false);
                    return;
                }
                if(left_input === ""){
                    $('#left_input').prop('disabled', true);
                    return;
                }
                if(right_input === ""){
                    $('#right_input').prop('disabled', true);
                    return;
                }
            }
            $('#left_input').prop('disabled', false);
            $('#right_input').prop('disabled', false);
        })

        let amount_input = () => {
            let account = $('#account').val();
            let left_input = $('#left_input').val();
            let right_input = $('#right_input').val();
            if(account == '1' || account == '2'){
                if(left_input === "" && right_input === ""){
                    $('#left_input').prop('disabled', false);
                    $('#right_input').prop('disabled', false);
                    return;
                }
                if(left_input === ""){
                    $('#left_input').prop('disabled', true);
                    return;
                }
                if(right_input === ""){
                    $('#right_input').prop('disabled', true);
                    return;
                }
            }
            $('#left_input').prop('disabled', false);
            $('#right_input').prop('disabled', false);
        }

        let transaction_form_submit_form = () => {
            var form = $('#transaction_form')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{ route("transaction") }}',
                data: data,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    // $("#transaction_form_submit").html('<i class="fas fa-spinner fa-pulse"></i>');
                    // $("#transaction_form_submit").prop('disabled', true);
                },
                success: function (response){
                    $('#transaction_modal_close').click();
                    $('#transaction_form').trigger('reset');
                    $('.select2').val(null).trigger('change');
                    $('.transaction_inputs').hide();
                    $("#transaction_form_submit").html('Submit');
                    $("#transaction_form_submit").prop('disabled', true);
                    // location.reload();
                },
            });
        }

        let get_particular = (particular_type) => {
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: '{{ route("get.particular") }}',
                data: {particular_type},
                // beforeSend:function(){
                //     $("#experience_div").html('<i class="fas fa-spinner fa-pulse"></i>');
                // },
                success: function (response){
                    $("#particular").html(response);
                }
            });
        }

        let get_account_input_field = (e) => {            
            $('.left_input_div').show();
            $('.right_input_div').show();
            if(typeof $(e).find(':selected').data('account_type') != 'undefined'){
                let account_type = $(e).find(':selected').data('account_type');
                $('.transaction_inputs').show();
                // 1 => Accounts receivable / ???????????? ; 2 => Accounts payable / ????????????
                if( e.value == '1' || e.value == '2' ){
                    // $('.right_input_div').hide();
                    // $('#left_input_label').html('???????????????');
                    $('#left_input_label').html('Received Amount');
                    // $('#right_input_label').html('???????????????');
                    $('#right_input_label').html('Paid Amount');
                    return;
                }
                if( account_type == 'revenue' ){
                    // $('#left_input_label').html('?????????');
                    $('#left_input_label').html('Due Amount');
                    // $('#right_input_label').html('???????????????');
                    $('#right_input_label').html('Received Amount');
                    return;
                }
                if( account_type == 'asset' ){
                    // $('#left_input_label').html('????????????');
                    $('#left_input_label').html('Purchased Amount');
                    // $('#right_input_label').html('???????????????');
                    $('#right_input_label').html('Paid Amount');
                    return;
                }
                if( account_type == 'expense' ){
                    // $('#left_input_label').html('????????????');
                    $('#left_input_label').html('Purchased Amount');
                    // $('#right_input_label').html('???????????????');
                    $('#right_input_label').html('Paid Amount');
                    return;
                }
                if( account_type == 'liability' ){
                    // $('.right_input_div').hide();
                    // $('#left_input_label').html('???????????????');
                    $('#left_input_label').html('Received Amount');
                    // $('#right_input_label').html('???????????????');
                    $('#right_input_label').html('Paid Amount');
                    return;
                }
            }
        }

        let processing_transaction = (id, name) => {
            $('#transaction_title').val(name);
            $('#transaction_candidate_id').val(id);
        }

        let transaction_particular_select = (type, id) => {
            $.ajax({
                type: 'GET',
                enctype: 'multipart/form-data',
                url: '{{ route("transaction.specific") }}',
                data: {type, id},
                beforeSend:function(){
                    $("#transaction_form_submit").html('<i class="fas fa-spinner fa-pulse"></i>');
                    $("#transaction_form_submit").prop('disabled', true);
                },
                success: function (response){
                    $('#transaction_form_body').html(response);
                    $('.select2').select2({
                        width: '100%',
                    });
                },
            });
        }

        $('#transaction_form').on('submit', (e) => {
            e.preventDefault();
            
            var form = $('#transaction_form')[0];
            var data = new FormData(form);
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '{{ route("transaction") }}',
                data: data,
                processData: false,
                contentType: false,
                beforeSend:function(){
                    $("#transaction_form_submit").html('<i class="fas fa-spinner fa-pulse"></i>');
                    $("#transaction_form_submit").prop('disabled', true);
                },
                success: function (response){
                    $('#transaction_modal_close').click();
                    $('#transaction_form').trigger('reset');
                    $('.select2').val(null).trigger('change');
                    $('.transaction_inputs').hide();
                    $("#transaction_form_submit").html('Submit');
                    $("#transaction_form_submit").prop('disabled', false);
                },
            });
        })
    </script>

    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    @yield('script')
    @yield('script-file-pond')
</body>

</body>
</html>
<!doctype html>
<html class="no-js " lang="en">


<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Mahfuza Overseas & Travelling Agency">

<title>@yield('title') - Mahfuza Overseas</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->

{{-- <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('assets/plugins/charts-c3/plugin.css')}}"/>

<link rel="stylesheet" href="{{ asset('assets/plugins/morrisjs/morris.min.css')}}" /> --}}


<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css')}}">

<link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css')}}">

<link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
<link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
<link rel="stylesheet" href="{{ asset('assets/css/app.css')}}">
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg')}}" type="image/x-icon">


<!-- Custom Css -->
<link rel="stylesheet" href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css')}}"/>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.2/dist/jBox.all.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" />
<link href="{{ asset('css/bootstrap-datetimepicker.css?v2') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

{{-- <link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}"> --}}


<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

</head>

<body class="theme-blush">
@auth
<div id="app">
    <div id="sidebar" class="active">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header">
                <div class="d-flex justify-content-between">
                    <div class="logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                    </div>
                    <div class="toggler">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>
                    
                    <li
                        class="sidebar-item  ">
                        <a href="index.html" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub {{ request()->is('candidate*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link '>
                            <i class="bi bi-stack"></i>
                            <span>Candidate</span>
                        </a>
                        <ul class="submenu {{ request()->is('candidate*') ? 'active' : '' }}">
                            <li class="submenu-item {{ request()->is('candidate/create') ? 'active' : '' }}">
                                <a href="{{ url('/candidate/create') }}">New Candidate</a>
                            </li>
                            <li class="submenu-item {{ request()->is('candidate') ? 'active' : '' }}">
                                <a href="{{ url('/candidate') }}">Candidate List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-badge.html">Pending Candidate List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-button.html">Completed Candidate List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="component-card.html">Returned Candidate List</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-collection-fill"></i>
                            <span>VISA</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="extra-component-avatar.html">Assign VISA</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="extra-component-sweetalert.html">VISA List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="extra-component-toastify.html">Completed VISA List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="extra-component-rating.html">Returned VISA List</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>Ticket</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="layout-default.html">New Ticket</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-vertical-1-column.html">Candidate Ticket List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-vertical-navbar.html">Outside Candidate List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="layout-rtl.html">Outside Candidate Ticket List</a>
                            </li>
                        </ul>
                    </li>
                                        
                    <li
                        class="sidebar-item  has-sub {{ (request()->is('agent*')) ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-hexagon-fill"></i>
                            <span>Agent</span>
                        </a>
                        <ul class="submenu {{ (request()->is('agent*')) ? 'active' : '' }}">
                            <li class="submenu-item {{ (request()->is('agent/create')) ? 'active' : '' }}">
                                <a href="{{ url('agent/create') }}">Add New Agent</a>
                            </li>
                            <li class="submenu-item {{ (request()->is('agent')) ? 'active' : '' }}">
                                <a href="{{ url('agent') }}">Agent List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-element-select.html">Add Agent Expense</a>
                            </li>
                        </ul>
                    </li>

                    <li
                        class="sidebar-item  ">
                        <a href="index.html" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Report</span>
                        </a>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub {{ (request()->is('employee*')) ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-pen-fill"></i>
                            <span>HRM</span>
                        </a>
                        <ul class="submenu {{ (request()->is('employee*')) ? 'active' : '' }}">
                            <li class="submenu-item {{ (request()->is('employee')) ? 'active' : '' }}">
                                <a href="{{ route('employee') }}">Add New Employee</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-editor-ckeditor.html">Employee List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-editor-summernote.html">Add Sections</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="form-editor-tinymce.html">Send SMS</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item  ">
                        <a href="table.html" class='sidebar-link'>
                            <i class="bi bi-grid-1x2-fill"></i>
                            <span>CRM</span>
                        </a>
                    </li>

                    <li class="sidebar-title">Foreign Affairs</li>

                    <li
                        class="sidebar-item  has-sub {{ (request()->is('delegate*')) ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                            <span>Delegate</span>
                        </a>
                        <ul class="submenu {{ (request()->is('delegate*')) ? 'active' : '' }}">
                            <li class="submenu-item {{ (request()->is('delegate')) ? 'active' : '' }}">
                                <a href="{{ route('delegate') }}">Add New Delegate</a>
                            </li>
                            <li class="submenu-item {{ (request()->is('delegate/list')) ? 'active' : '' }}">
                                <a href="{{ route('delegate-show') }}">Delegates List</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="table-datatable-jquery.html">Mr. Maheer Bu Arish</a>
                            </li>
                        </ul>
                    </li>
                                        
                    <li
                        class="sidebar-item  has-sub {{ (request()->is('sponsor*')) ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-pentagon-fill"></i>
                            <span>Sponsor</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ (request()->is('sponsor')) ? 'active' : '' }}">
                                <a href="{{ route('sponsor') }}">Add New Sponsor</a>
                            </li>
                            <li class="submenu-item {{ (request()->is('sponsor/list*')) ? 'active' : '' }}">
                                <a href="{{ route('sponsor-list') }}">Sponsor List</a>
                            </li>
                            <li class="submenu-item {{ (request()->is('sponsor-visa/create')) ? 'active' : '' }}">
                                <a href="{{ url('/sponsor-visa/create') }}">Add Sponsor's VISA</a>
                            </li>
                            <li class="submenu-item {{ (request()->is('sponsor-visa.list')) ? 'active' : '' }}">
                                <a href="{{ url('/sponsor-visa.list') }}">Show VISA list</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub {{ (request()->is('manpower-office*')) ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-egg-fill"></i>
                            <span>Manpower</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item {{ (request()->is('manpower-office/create')) ? 'active' : '' }}">
                                <a href="{{ url('manpower-office/create') }}">Add Office </a>
                            </li>
                            <li class="submenu-item {{ (request()->is('manpower-office')) ? 'active' : '' }}">
                                <a href="{{ url('manpower-office') }}">Office List</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li
                        class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Office</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="ui-chart-chartjs.html">Add New Office</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="ui-chart-apexcharts.html">Office List</a>
                            </li>
                        </ul>
                    </li>
                    <li
                        class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-map-fill"></i>
                            <span>Website</span>
                        </a>
                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ url('website') }}">Website Frontpage</a>
                            </li>
                        </ul>
                    </li>                     
                    <?php $all_packages = App\Models\WebsiteContent::get()->unique('section')->skip(3); ?>
                    <li
                        class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-map-fill"></i>
                            <span>Packages</span>
                        </a>
                        <ul class="submenu ">
                            @foreach($all_packages as $row)
                                <li class="submenu-item ">
                                    <a href="{{ url('package_image_headline',$row->id) }}">{{$row->section}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>                  
                </ul>
            </div>
            <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
        </div>
    </div>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        
        <div class="page-heading">
            <h3>Profile Statistics</h3>
        </div>
        <div class="page-content">
            @yield('content')
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2021 &copy; Mazer</p>
                </div>
                <div class="float-end">
                    <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                            href="http://ahmadsaugi.com">A. Saugi</a></p>
                </div>
            </div>
        </footer>
    </div>
</div>
@yield('modals')
@endauth
@guest
    @yield('login')
@endguest

<!-- Jquery Core Js --> 
{{-- <script src="{{ asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) --> 
<script src="{{ asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- slimscroll, waves Scripts Plugin Js -->

<script src="{{ asset('assets/bundles/jvectormap.bundle.js')}}"></script> <!-- JVectorMap Plugin Js -->
<script src="{{ asset('assets/bundles/sparkline.bundle.js')}}"></script> <!-- Sparkline Plugin Js -->
<script src="{{ asset('assets/bundles/c3.bundle.js')}}"></script> --}}
<script src="{{ asset('assets/vendors/jquery/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{ asset('assets/vendors/apexcharts/apexcharts.js')}}"></script>
<script src="{{ asset('assets/js/pages/dashboard.js')}}"></script>

<script src="{{ asset('assets/js/mazer.js')}}"></script>


<script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.3.2/dist/jBox.all.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/fh-3.1.8/r-2.2.7/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-hijri@2.1.2/moment-hijri.min.js"></script>
<script src="{{ asset('js/hijri/bootstrap-hijri-datetimepicker.js?v2') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ asset('assets/bundles/mainscripts.bundle.js')}}"></script>
<script src="{{ asset('assets/js/pages/index.js')}}"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
</script>

@yield('script')
<script type="text/javascript" src="{{ asset('js/custom.js') }}"></script></body>
@yield('script-file-pond')
</body>


</html>
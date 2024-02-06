<!doctype html>
<html lang="en" >

<head>
    <meta charset="utf-8" />
    <title>Calendar | Qovex - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->


    <!-- Plugin css -->
    <link href="{{ asset('assets/libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

    <body data-layout="detached" data-topbar="colored">



        <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <div class="container-fluid">
            <!-- Begin page -->
            <div id="layout-wrapper">
<!-- Header start -->
                <header id="page-topbar">
                    <div class="navbar-header">
                        <div class="container-fluid">
                            <div class="float-end">

                                <div class="dropdown d-inline-block d-lg-none ms-2">
                                    <button type="button" class="btn header-item noti-icon waves-effect"
                                        id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="mdi mdi-magnify"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                        aria-labelledby="page-header-search-dropdown">

                                        <form class="p-3">
                                            <div class="m-0">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search ..."
                                                        aria-label="Recipient's username">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit"><i
                                                                class="mdi mdi-magnify"></i></button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>



                                <div class="dropdown d-none d-lg-inline-block ms-1">
                                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                        <i class="mdi mdi-fullscreen"></i>
                                    </button>
                                </div>

                                <div class="dropdown d-inline-block">
                                    <button type="button" class="btn header-item noti-icon waves-effect"
                                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="mdi mdi-bell-outline"></i>
                                        <span class="badge rounded-pill bg-danger ">3</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                        aria-labelledby="page-header-notifications-dropdown">
                                        <div class="p-3">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <h6 class="m-0"> Notifications </h6>
                                                </div>
                                                <div class="col-auto">
                                                    <a href="#!" class="small"> View All</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-simplebar style="max-height: 230px;">
                                            <a href="" class="text-reset notification-item">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                            <i class="bx bx-cart"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h6 class="mt-0 mb-1">Your order is placed</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="" class="text-reset notification-item">
                                                <div class="d-flex align-items-start">
                                                    <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs"
                                                        alt="user-pic">
                                                    <div class="flex-1">
                                                        <h6 class="mt-0 mb-1">James Lemire</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1">It will seem like simplified English.</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="" class="text-reset notification-item">
                                                <div class="d-flex align-items-start">
                                                    <div class="avatar-xs me-3">
                                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                                            <i class="bx bx-badge-check"></i>
                                                        </span>
                                                    </div>
                                                    <div class="flex-1">
                                                        <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>

                                            <a href="" class="text-reset notification-item">
                                                <div class="d-flex align-items-start">
                                                    <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs"
                                                        alt="user-pic">
                                                    <div class="flex-1">
                                                        <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                                        <div class="font-size-12 text-muted">
                                                            <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="p-2 border-top d-grid">
                                            <a class="btn btn-sm btn-link font-size-14 " href="javascript:void(0)">
                                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="dropdown d-inline-block">
                                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-2.jpg"
                                            alt="Header Avatar">
                                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->user_name}}</span>
                                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle me-1"></i>
                                            Profile</a>

                                        <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i
                                                class="bx bx-wrench font-size-16 align-middle me-1"></i> Settings</a>

                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#"><i
                                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> Logout</a>
                                    </div>
                                </div>



                            </div>
                            <div>
                                <!-- LOGO -->
                                <div class="navbar-brand-box">
                                    <a  class="logo logo-dark">
                                        <span class="logo-sm">
                                            <img src="assets/images/logo-sm.png" alt="" height="20">
                                        </span>
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-dark.png" alt="" height="17">
                                        </span>
                                    </a>

                                    <a  class="logo logo-light">
                                        <span class="logo-sm">
                                            <img src="assets/images/logo-sm.png" alt="" height="20">
                                        </span>
                                        <span class="logo-lg">
                                            <img src="assets/images/logo-light.png" alt="" height="19">
                                        </span>
                                    </a>
                                </div>

                                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                                    id="vertical-menu-btn">
                                    <i class="fa fa-fw fa-bars"></i>
                                </button>

                                <!-- App Search-->
                                <form class="app-search d-none d-lg-inline-block">
                                    <div class="position-relative">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="bx bx-search-alt"></span>
                                    </div>
                                </form>
<!-- Mega menu -->

                            </div>

                        </div>
                    </div>
                </header>
                <!-- ENd header  -->
 <!-- ========== Left Sidebar Start ========== -->
 <div class="vertical-menu">
    <div class="h-100">
      <div class="user-wid text-center py-4">
        <div class="user-img">
          <img
              src="{{ asset('assets/images/users/avatar-2.jpg') }}"
              alt=""
              class="avatar-md mx-auto rounded-circle"
          />
      </div>


        <div class="mt-3">
          <a href="#" class="text-reset fw-medium font-size-16"
            >{{ Auth::user()->user_name}}</a
          >
          <p class="text-muted mt-1 mb-0 font-size-13">
            Domaine du formation
          </p>
        </div>
      </div>

      <!--- Sidemenu -->
      <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
                <a class="waves-effect" href="{{ url('/') }}">
                    <i class="fas fa-home"></i>
                    <span>Acceuil</span>
                </a>
            </li>

            <li>
                <a href="{{ url('calendarFormateur') }}" class="waves-effect">
                    <i class="mdi mdi-frequently-asked-questions"></i>
                    <span>RequestCalendar</span>
                </a>
            </li>

            <li>
                <a href="{{ url('calendarFormateur') }}" class="waves-effect">
                    <i class="mdi mdi-calendar-text"></i>
                    <span>Calendar</span>
                </a>
            </li>

            <li>
                <a href="{{ url('GroupesAndModules') }}" class="waves-effect">
                    <i class="mdi mdi-calendar-text"></i>
                    <span>Groupe & Module</span>
                </a>
            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-account-group"></i>
                    <span>Groupes</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('FormateurGroupeList') }}">List des Groupes</a></li>
                </ul>
            </li>

            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect">
                    <i class="mdi mdi-inbox-full"></i>
                    <span>Modules</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ url('FormateurModuleList') }}">List des Modules</a></li>
                </ul>
            </li>

            <li>
                <a class="dropdown-item d-block" href="{{ url('settings') }}">
                    <i class="mdi mdi-settings-outline"></i> Settings
                </a>
            </li>

            <li>
                <a class="dropdown-item text-danger" href="{{ url('logOut') }}">
                    <i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>

    </div>
  </div>
<!-- ===========Left Sidebar End=========== -->

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">

                        <div style="margin-top: 6.4rem;margin-left:2rem" class="row">
                            @yield('contentFormateur')
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- End Page-content -->



                </div>
                <!-- end main content-->

            </div>
            <!-- END layout-wrapper -->

        </div>
        <!-- end container-fluid -->

        <!-- Right Sidebar -->


        <div class="rightbar-overlay"></div>

        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- plugin js -->
        <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery-ui-dist/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@fullcalendar/core/main.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@fullcalendar/bootstrap/main.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@fullcalendar/daygrid/main.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@fullcalendar/timegrid/main.min.js') }}"></script>
        <script src="{{ asset('assets/libs/@fullcalendar/interaction/main.min.js') }}"></script>

        <!-- Calendar init -->
        <script src="{{ asset('assets/js/pages/calendar.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

    </body>

</html>

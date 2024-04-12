<!doctype html>
<html lang="en" >

<head>
    <meta charset="utf-8" />
    <title>Admin|Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->


    <!-- Plugin css -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <style>
    .vertical-menu {
    min-width: 100px;
    max-width: var(--bs-sidebar-width);
    width:100px ;
    z-index: 1001;
    background: var(--bs-sidebar-bg);
    bottom: 0;
    margin-top: 0;
    position: fixed;
    top: var(--bs-header-height);
    -webkit-box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.03);
    box-shadow: 0 0.75rem 1.5rem rgba(18, 38, 63, 0.03);
    margin-bottom: 55px;
}

.arow {
    position: fixed;
    top: 100px ;
    left: 10px;
    z-index: 100;
    padding: 10px;

}

.toggle-sidebar {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
}


.collapsed .widthSideBare {
    width: 220px !important;
    background-color: #ffffff ;
}

.vertical-menu.collapsed .arow .toggle-sidebar {
    left: auto;
    right: 0;
}

.remove {
    display:none ;
}
.container-remover{
    margin-bottom:20px;
    margin-left:20px;
    width:100px !important;
    height:100px !important
}

.icon-remove{
    font-size: 35px ;
    color:white ;
    margin: 10px ;
    margin-top: 0px !important;
    margin-bottom: 10px !important;
    padding-bottom: 10px !important ;
}

.icon-remove:hover{
    cursor: pointer;
    border-radius: 1.4px solid black ;
    width: 50% ;
    height: 50%;
    transform: 0.9s  all ;

}

.container, .container-fluid, .container-lg,
 .container-md, .container-sm, .container-xl,
  .container-xxl{
        padding-right: 0px;
        padding-left: 0px;
        margin-right: 0px;
         margin-left: 0px;
    }

    @media screen and (max-width: 990px) {
        .container-remover{
            display: none ;
        }
    }


    </style>
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


                                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                                    id="vertical-menu-btn">
                                    <i class="fa fa-fw fa-bars"></i>
                                </button>

                                <!-- App Search-->

<!-- Mega menu -->

                            </div>

                        </div>

                    </div>
                    <div class="container-remover"><span  class="mdi mdi-format-align-bottom icon-remove"></span></div>
                </header>
                <!-- ENd header  -->
 <!-- ========== Left Sidebar Start ========== -->

 <div class="vertical-menu" >

                    <div class="widthSideBare ">
                        <div class="user-wid text-center py-4">
                            <div class="user-img">
                                <img src="{{asset('assets/images/users/user.jpg')}}" alt="" class="avatar-md mx-auto rounded-circle">
                            </div>

                            <div class="mt-3">

                                <a href="#" class="text-reset fw-medium font-size-16">{{Auth::user()->user_name}}</a>
                                <p class="text-muted mt-1 mb-0 font-size-13">Admin</p>

                            </div>
                        </div>

                        <!--- Sidemenu -->
                        <div id="sidebar-menu"  style="" >
                            <!-- Left Menu Start -->
                            <ul class="metismenu list-unstyled" id="side-menu">
                                <li class="menu-title">Menu</li>


                                <li>
                                    <a  href="{{route('dashboardAdmin')}}" class=" waves-effect">
                                        <i data-toggle="tooltip" data-placement="right" title="admin dashboard" style="font-weight: 400 ; font-size:25PX" class="mdi mdi-home-lightbulb-outline"></i>

                                    </a>
                                </li>







                                <div id="emploi12">
                                        <li><a href="{{route('CreateEmploi')}}" class=" waves-effect"> <span data-toggle="tooltip" data-placement="right" title="tout les groupes" class="mdi mdi-lightbulb-group-outline" style="font-weight: 400 ; font-size:25PX"></span></a></li>
                                        <li><a href="{{route('emploiForFormateurs')}}" class=" waves-effect"> <span data-toggle="tooltip" data-placement="right" title="tout les Formateurs" style="font-weight: 400 ; font-size:25PX" class="mdi mdi-account-supervisor-outline"></span></a></li>
                                        <li><a href="{{route('ChaqueFormateur')}}" class=" waves-effect"> <span data-toggle="tooltip" data-placement="right" title="chaque formateur" style="font-weight: 400 ; font-size:25PX" class="mdi mdi-account-tie-outline"></span></a></li>
                                        <li><a href="{{route('emploiForGroup')}}" class=" waves-effect"> <span data-toggle="tooltip" data-placement="right" title="chaque group" style="font-weight: 400 ; font-size:25PX" class="mdi mdi-lightbulb-multiple-outline"></span></a></li>
                                </div>

                                <li>
                                    <a href="{{route('toutlesEmploi')}}" class=" waves-effect">
                                        <span style="font-weight: 400 ; font-size:25PX" class="mdi mdi-history" data-toggle="tooltip" data-placement="right" title="tous les emplois"></span>

                                    </a>
                                </li>


                                <li>
                                    <a href="{{route('toutlesEmploi')}}" class=" waves-effect">
                                        <span style="font-weight: 400 ; font-size:25PX" class="mdi mdi-message-text-clock-outline" data-toggle="tooltip" data-placement="right" title="tous les demandes"></span>

                                    </a>
                                </li>

                                  <li>
                                    <a href="{{route('AllSetting')}}" class=" waves-effect">
                                        <span style="font-weight: 400 ; font-size:25PX" class="mdi mdi-settings-transfer-outline" data-toggle="tooltip" data-placement="right" title="les paramteres "></span>

                                    </a>
                                 </li>



                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                        <i style="font-weight: 400 ; font-size:25PX" class="bx bx-power-off font-size-16 align-middle me-1 text-danger"
                                         data-toggle="tooltip" data-placement="right" title="Déconnexion"></i>

                                    </a>
                                </li>


                            </ul>
                        </div>
                        <!-- Sidebar -->
                    </div>
                </div>
<!-- ===========Left Sidebar End=========== -->

                <!-- ============================================================== -->
                <!-- Start right Content here -->
                <!-- ============================================================== -->
                <div class="main-content">

                    <div class="page-content">

                        <div style="margin-top: 6.4rem;margin-left:2rem" class="row">
                       {{$slot}}
                        </div>
                        <!-- end row -->

                    </div>
                    <!-- End Page-content -->



                </div>
                <!-- end main content-->

            </div>

        </div>



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
        <!-- Calendar init -->

        <!-- App js -->
        <script src="{{ asset('assets/js/app.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let sidebarMenu = document.querySelector('.vertical-menu');
                let iconRemove = document.querySelector('.icon-remove');
            iconRemove.addEventListener('click', function() {
            sidebarMenu.classList.toggle('remove');
            if (iconRemove.classList.contains('mdi-format-align-bottom')) {
                sidebarMenu.style.marginLeft = '0px !important';
                sidebarMenu.style.left = '0px !important';
                iconRemove.classList.remove('mdi-format-align-bottom');
                iconRemove.classList.add('mdi-format-align-top');
            } else {
                iconRemove.classList.add('mdi-format-align-bottom');
                iconRemove.classList.remove('mdi-format-align-top');

            }


});





            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script>
            Pusher.logToConsole = true;
            var pusher = new Pusher('69820da6887a3d9f8088', {
                cluster: 'mt1'
            });
            var channel = pusher.subscribe('my-channel');
            channel.bind('request-submitted', function(data) {
                if (data && data.user_id && data.comment) {
                    toastr.success('New Request Created', 'Formateur: ' + data.user_id + '<br>MainEmploiId: ' + data
                        .main_emploi_id + '<br>Commentaire: ' + data
                        .comment, {
                            timeOut: 0,
                            extendedTimeOut: 0,
                        });
                } else {
                    console.error('Invalid data structure received:', data);
                }
            });
        </script>



    </body>

</html>

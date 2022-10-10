<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
        <meta content="Coderthemes" name="author">
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- third party css -->
        <link href="/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css">
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
        <link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">

    </head>

    <body class="loading" data-layout="topnav" data-layout-config='{"layoutBoxed":false,"darkMode":false,"showRightSidebarOnStart": true}'>
        <!-- Begin page -->
        <div class="wrapper">

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <div class="navbar-custom topnav-navbar">
                        <div class="container-fluid">

                            <!-- LOGO -->
                            <a href="/" class="topnav-logo">
                                <span class="topnav-logo-lg">
                                    <img src="/assets/images/logo_dark.png" alt="" height="60">
                                    {{-- <h4 class="mt-3" style="color: black">Trend Story</h4> --}}
                                </span>
                                <span class="topnav-logo-sm">
                                    {{-- <img src="/assets/images/logo_sm_dark.png" alt="" height="16"> --}}
                                    <h4 class="mt-3">T S</h4>
                                </span>
                            </a>

                            <ul class="list-unstyled topbar-menu float-end mb-0">
                                @auth
                                    <li class="dropdown notification-list">
                                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="dripicons-bell noti-icon"></i>
                                            <span class="noti-icon-badge"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">
        
                                            <!-- item-->
                                            <div class="dropdown-item noti-title">
                                                <h5 class="m-0">
                                                    <span class="float-end">
                                                        <a href="javascript: void(0);" class="text-dark">
                                                            <small>Clear All</small>
                                                        </a>
                                                    </span>Notification
                                                </h5>
                                            </div>
        
                                            <div style="max-height: 230px;" data-simplebar="">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                    <p class="notify-details">Caleb Flakelar commented on Admin
                                                        <small class="text-muted">1 min ago</small>
                                                    </p>
                                                </a>
        
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                    <div class="notify-icon">
                                                        <img src="/assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt=""> </div>
                                                    <p class="notify-details">Karen Robinson</p>
                                                    <p class="text-muted mb-0 user-msg">
                                                        <small>Wow ! this admin looks good and awesome design</small>
                                                    </p>
                                                </a>
        
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-info">
                                                        <i class="mdi mdi-heart"></i>
                                                    </div>
                                                    <p class="notify-details">Carlos Crouch liked
                                                        <b>Admin</b>
                                                        <small class="text-muted">13 days ago</small>
                                                    </p>
                                                </a>
                                            </div>
        
                                            <!-- All-->
                                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                                View All
                                            </a>
        
                                        </div>
                                    </li>
                                    
                                    <li class="dropdown notification-list">
                                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            <span class="account-user-avatar"> 
                                                <img src="/assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                            </span>
                                            <span>
                                                <span class="account-user-name">{{ auth()->user()->name }}</span>
                                                <span class="account-position">User</span>
                                            </span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                                            <!-- item-->
                                            <div class=" dropdown-header noti-title">
                                                <h6 class="text-overflow m-0">Welcome !</h6>
                                            </div>
        
                                            <!-- item-->
                                            <a href="/profiluser" class="dropdown-item notify-item">
                                                <i class="mdi mdi-account-circle me-1"></i>
                                                <span>Profil</span>
                                            </a>
        
                                            <!-- item-->
                                            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalLogout" class="dropdown-item notify-item">
                                                <i class="mdi mdi-logout me-1"></i>
                                                <span>Logout</span>
                                            </a>
        
                                        </div>
                                    </li>
                                @else
                                    {{-- <li class="dropdown notification-list">
                                        <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                                            <i class="dripicons-bell noti-icon"></i>
                                            <span class="noti-icon-badge"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">
        
                                            <!-- item-->
                                            <div class="dropdown-item noti-title">
                                                <h5 class="m-0">
                                                    <span class="float-end">
                                                        <a href="javascript: void(0);" class="text-dark">
                                                            <small>Clear All</small>
                                                        </a>
                                                    </span>Notification
                                                </h5>
                                            </div>
        
                                            <div style="max-height: 230px;" data-simplebar="">
                                                <!-- item-->
                                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                                    <div class="notify-icon bg-primary">
                                                        <i class="mdi mdi-comment-account-outline"></i>
                                                    </div>
                                                    <p class="notify-details">Caleb Flakelar commented on Admin
                                                        <small class="text-muted">1 min ago</small>
                                                    </p>
                                                </a>
                                            </div>
        
                                        </div>
                                    </li> --}}
                                @endauth
                            </ul>
                            <a class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <div class="app-search dropdown">
                                <form>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Cari Produk disini..." id="top-search">
                                        <span class="mdi mdi-magnify search-icon"></span>
                                        <button class="input-group-text  btn-primary" type="submit">Cari</button>
                                    </div>
                                </form>
            
                            </div>
                        </div>
                    </div>
                    <!-- end Topbar -->

                    @include('home.layout.sidebar')
                    @yield('container')
                </div>

                <div class="modal fade" id="modalLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLogoutLabel">Logout</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin keluar?
                            </div>
                            <form action="/auth/logout" method="post">
                                @csrf
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Logout</button>
                                    <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> © Trend Story
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-end footer-links d-none d-md-block">
                                    <a href="javascript: void(0);">About</a>
                                    <a href="javascript: void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- bundle -->
        <script src="/assets/js/vendor.min.js"></script>
        <script src="/assets/js/app.min.js"></script>

        <!-- third party js -->
        <script src="/assets/js/vendor/apexcharts.min.js"></script>
        <script src="/assets/js/vendor/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/assets/js/vendor/jquery-jvectormap-world-mill-en.js"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        <script src="/assets/js/pages/demo.dashboard.js"></script>
        <!-- end demo js-->

        <script src="/assets/jquery/jquery-3.6.0.min.js"></script>
        @yield('js')
    </body>
</html>
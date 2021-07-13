<!doctype html>
<html class="no-js" lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Dashboard - Turismo</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
        
        <link rel="stylesheet" href="../../../plugins/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../../plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="../../../plugins/ionicons/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="../../../plugins/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="../../../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../../../plugins/jvectormap/jquery-jvectormap.css">
        <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="../../../plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="../../../plugins/c3/c3.min.css">
        <link rel="stylesheet" href="../../../plugins/owl.carousel/dist/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="../../../plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="../../../dist/css/theme.min.css">
        <script src="../../../src/js/vendor/modernizr-2.8.3.min.js"></script>

        <!-- Os selects -->
        <!-- <link rel="stylesheet" href="../../../plugins/select2/dist/css/select2.min.css"> -->
        <!-- <link rel="stylesheet" href="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
        <link rel="stylesheet" href="../../../plugins/mohithg-switchery/dist/switchery.min.css">
        <link rel="stylesheet" href="../../../dist/css/theme.min.css"> -->

    

        <!-- Sweetalert JS -->
        <script src="../../../plugins/Sweetalert/Js/sweetalert2.all.min.js"></script>
        <!-- Sweetalert CSS -->
        <script src="../../../plugins/Sweetalert/Css/sweetalert2.min.css"></script>
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="wrapper">
            <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                            <div class="header-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                    <input type="text" class="form-control">
                                    <!-- <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span> -->
                                </div>
                            </div>
                            <!-- <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button> -->
                        </div>
                        <div class="top-menu d-flex align-items-center">
                            <div class="dropdown">
                              <!-- Mostrar o nivel de acesso  -->
                              <?php include('../../../includes/mostranivel.php') ?>
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="../../../img/avatar.png" alt=""></a>
                               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                     <a class="dropdown-item" href="../../Actions/logout.php"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <div class="page-wrap">
                <div class="app-sidebar colored">
                    <div class="sidebar-header">
                        <a class="header-brand" href="index.html">
                            <div class="logo-img">
                               <!-- <img src="../../src/img/brand-white.svg" class="header-brand-img" alt="lavalite">  -->
                            </div>
                            <span class="text">Turismo</span>
                        </a>
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>
                    
                    <div class="sidebar-content"> <!-- Sidebar lateral -->
                        <div class="nav-container">

                            <nav id="main-menu-navigation" class="navigation-main">
                                
                                <div class="nav-lavel">Centro de operações</div>
                                
                                <div class="nav-item active">
                                    <a href="../../index.php"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                </div>

                                <div class="nav-item">
                                <div class="nav-lavel">Support</div>
                                <div class="nav-item">
                                    <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Contatar Suporte</span></a>
                                </div>
                                
                            </nav> 
                        </div>
                    </div> <!-- Fecha Sidebar lateral -->
                </div>



                    
              

<?php

require __DIR__ . '/../../../vendor/autoload.php';

use Source\Models\BodyHtml;
use Source\Models\Messages;

if (!function_exists("protect")) {
    function protect()
    {
        if (!isset($_SESSION)) {
            session_start();
            if (!isset($_SESSION['user'])) {
                header('Location:../../index.php');
            }
        }
    }
}

$destino = new \Source\Controllers\ControllerDestinos();

protect();


?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard - Turismo - Passagem - Adicionar</title>
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
                                <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                            </div>
                        </div>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i class="ik ik-maximize"></i></button>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <div class="dropdown">
                            <!-- <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-bell"></i><span class="badge bg-danger">3</span></a> -->
                            <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="notiDropdown">
                                <h4 class="header">Notifications</h4>
                                <div class="notifications-wrap">
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-check"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Invitation accepted</span>
                                            <span class="media-content">Your have been Invited ...</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <img src="img/users/1.jpg" class="rounded-circle" alt="">
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Steve Smith</span>
                                            <span class="media-content">I slowly updated projects</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-calendar"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">To Do</span>
                                            <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="footer"><a href="javascript:void(0);">See all activity</a></div>
                            </div>
                        </div>
                        <!-- <button type="button" class="nav-link ml-10 right-sidebar-toggle"><i class="ik ik-message-square"></i><span class="badge bg-success">3</span></button> Botão de chat -->
                        <div class="dropdown">
                            <!-- <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-plus"></i></a> -->
                            <div class="dropdown-menu dropdown-menu-right menu-grid" aria-labelledby="menuDropdown">
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Dashboard"><i class="ik ik-bar-chart-2"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Message"><i class="ik ik-mail"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Accounts"><i class="ik ik-users"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Sales"><i class="ik ik-shopping-cart"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Purchase"><i class="ik ik-briefcase"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Pages"><i class="ik ik-clipboard"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Chats"><i class="ik ik-message-square"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Contacts"><i class="ik ik-map-pin"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Blocks"><i class="ik ik-inbox"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Events"><i class="ik ik-calendar"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="Notifications"><i class="ik ik-bell"></i></a>
                                <a class="dropdown-item" href="#" data-toggle="tooltip" data-placement="top" title="More"><i class="ik ik-more-horizontal"></i></a>
                            </div>
                        </div>
                        <!-- <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal" data-target="#appsModal"><i class="ik ik-grid"></i></button> -->
                        <div class="dropdown">
                            <?php if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) { ?>
                                <a href="#" class="badge badge-info mb-1">Administrador</a>
                            <?php } else { ?>
                                <a href="#" class="badge badge-info mb-1">Vendedor</a>
                            <?php } ?>
                            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="../../../img/avatar.png" alt=""></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                <!-- <a class="dropdown-item" href="profile.html"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                                    <a class="dropdown-item" href="#"><i class="ik ik-settings dropdown-icon"></i> Settings</a>
                                    <a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span><i class="ik ik-mail dropdown-icon"></i> Inbox</a>
                                    <a class="dropdown-item" href="#"><i class="ik ik-navigation dropdown-icon"></i> Message</a> -->
                                <a class="dropdown-item" href="login.html"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="#">
                        <div class="logo-img">
                            <!-- <img src="../../src/img/brand-white.svg" class="header-brand-img" alt="lavalite">  -->
                        </div>
                        <span class="text">Turismo</span>
                    </a>
                    <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                </div>

                <div class="sidebar-content">
                    <!-- Sidebar lateral -->
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
            <!-- ------------------------------------------------------------------------------------ -->




            <!-- inicio menu superior que fica dentro da div principal -->
            <div class="main-content">
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <i class="ik ik-bar-chart-2 bg-blue"></i>
                                    <div class="d-inline">
                                        <h5>Cadastro de Destinos</h5>
                                        <span>aba destinada para o controle das operações</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <nav class="breadcrumb-container" aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="#"><i class="ik ik-home"></i></a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">UI</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="#">Inicio</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim menu superior -->


                <!-- Div Principal -->



                <form action="../../Actions/actionPassagem.php" method="POST" class="forms-sample">

                    <div class="row">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-10">

                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Formulario de Cadastro de Passagens</h3>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Selecionar Destino</label>
                                                <select name="id_destino_fk" class="form-control" id="exampleFormControlSelect1">
                                                    <?php
                                                    $idLoja = "";

                                                    if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
                                                        $idLoja = $_SESSION['user'][0]['fk_login_loja'];
                                                    } else {
                                                        $idLoja = $_SESSION['user'][0]['id_login'];
                                                    }


                                                    foreach ($destino->read($idLoja) as $d) { ?>

                                                        <option value="<?= $d['id_destino'] ?>"><?= $d['nome_destino'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <fieldset disabled>
                                                        <div class="form-group">
                                                            <label for="disabledTextInput">Valor da passagem: Criaça Colo</label>
                                                            <input type="text" name="valor_criança_colo"  id="disabledTextInput" class="form-control" placeholder="R$ 0,00">
                                                        </div>
                                                    </fieldset>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">

                                                            <label for="exampleInputEmail1">Valor da passagem: Criaça</label>
                                                            <input type="text" name="valor_criança" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <div class="form-group">

                                                            <label for="exampleInputEmail1">Valor da passagem: Criaça de 4 a 10 anos</label>
                                                            <input type="text" name="valor_criança_4a10anos" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Valor da passagem: Adulto</label>
                                                            <input type="text" name="valor_adulto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php

                                            if ($_SESSION['user'][0]['nivel_acesso_fk'] == 1) {
                                            ?>

                                                <input type="hidden" name="fk_login_loja" value="<?= $_SESSION['user'][0]['id_login'] ?>">

                                            <?php } else if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) { ?>

                                                <input type="hidden" name="fk_login_loja" value="<?= $_SESSION['user'][0]['fk_login_loja'] ?>">

                                            <?php } ?>


                                            <?php

                                            // var_dump($_SESSION['user'][0]['nivel_acesso_fk']);

                                            ?>


                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>
                        </div>





                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-2">
                            </div>
                            <div class="col-md-8">
                                <button type="Submit" class="btn btn-info btn-block" name="CadastrarPassagem" value="CadastrarDestino">Cadastrar</button>
                            </div>
                            <div class="col-md-2">
                            </div>
                        </div>
                    </div>

                </form>



                <!-- Fim Div Principal -->

            </div>




            <footer class="footer">
                <div class="w-100 clearfix">
                    <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 SDI All Rights Reserved.</span>
                    <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark" target="_blank">Jv and Company</a></span>
                </div>
            </footer>

        </div>
    </div>




    <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog" aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="ik ik-x-circle"></i></button>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="quick-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 ml-auto mr-auto">
                                <div class="input-wrap">
                                    <input type="text" id="quick-search" class="form-control" placeholder="Search..." />
                                    <i class="ik ik-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="container">
                        <div class="apps-wrap">
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="app-item dropdown">
                                <a href="#" class="dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ik ik-command"></i><span>Ui</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-users"></i><span>Accounts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-shopping-cart"></i><span>Sales</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-briefcase"></i><span>Purchase</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-server"></i><span>Menus</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-clipboard"></i><span>Pages</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-message-square"></i><span>Chats</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-map-pin"></i><span>Contacts</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-box"></i><span>Blocks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-calendar"></i><span>Events</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-bell"></i><span>Notifications</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-pie-chart"></i><span>Reports</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-layers"></i><span>Tasks</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-edit"></i><span>Blogs</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-settings"></i><span>Settings</span></a>
                            </div>
                            <div class="app-item">
                                <a href="#"><i class="ik ik-more-horizontal"></i><span>More</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="../../../plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="../../../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../../plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="../../../plugins/screenfull/dist/screenfull.js"></script>
    <script src="../../../plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../../plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../../plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../../plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="../../../plugins/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../../../plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../../../plugins/moment/moment.js"></script>
    <script src="../../../plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../../../plugins/d3/dist/d3.min.js"></script>
    <script src="../../../plugins/c3/c3.min.js"></script>
    <script src="../../../js/tables.js"></script>
    <script src="../../../js/widgets.js"></script>
    <script src="../../../js/charts.js"></script>
    <script src="../../../dist/js/theme.min.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b, o, i, l, e, r) {
            b.GoogleAnalyticsObject = l;
            b[l] || (b[l] =
                function() {
                    (b[l].q = b[l].q || []).push(arguments)
                });
            b[l].l = +new Date;
            e = o.createElement(i);
            r = o.getElementsByTagName(i)[0];
            e.src = 'https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e, r)
        }(window, document, 'script', 'ga'));
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');
    </script>
</body>

</html>
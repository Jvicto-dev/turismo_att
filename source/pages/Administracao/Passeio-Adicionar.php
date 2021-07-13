<?php

require __DIR__ .'/../../../vendor/autoload.php';
use Source\Models\BodyHtml;
use Source\Models\Messages;
if(!function_exists("protect")){
    function protect(){
        if(!isset($_SESSION)){
            session_start();
            if(!isset($_SESSION['user'])){
                header('Location:../../index.php');
            }
        }   
    }
}

protect();
// $destinos = new Source\Controllers\ControllerDestinos();
?>
<!doctype html>
<html class="no-js" lang="en">
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
        
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

        <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
        <link rel="stylesheet" href="../../../plugins/icon-kit/dist/css/iconkit.min.css">
        <link rel="stylesheet" href="../../../plugins/ionicons/dist/css/ionicons.min.css">
        <!-- <link rel="stylesheet" href="../../../plugins/perfect-scrollbar/css/perfect-scrollbar.css"> -->
        <link rel="stylesheet" href="../../../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
        <!-- <link rel="stylesheet" href="../../../plugins/jvectormap/jquery-jvectormap.css"> -->
        <link rel="stylesheet" href="../../../plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
        <link rel="stylesheet" href="../../../plugins/weather-icons/css/weather-icons.min.css">
        <link rel="stylesheet" href="../../../plugins/c3/c3.min.css">
        <!-- <link rel="stylesheet" href="../../../plugins/owl.carousel/dist/assets/owl.carousel.min.css"> -->
        <link rel="stylesheet" href="../../../plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
        <link rel="stylesheet" href="../../../dist/css/theme.min.css">
        <!-- <script src="../../../src/js/vendor/modernizr-2.8.3.min.js"></script> -->

<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>


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



                    
              



<div class="main-content"> <!-- Div principal que comporta tudo -->

                    <div class="container-fluid"> <!-- inicio menu superior que fica dentro da div principal -->
                        <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="ik ik-bar-chart-2 bg-blue"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard</h5>
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
                    </div> <!-- fim menu superior -->

<!-- //////////// Começo das ações daqui, pode copiar e colar que da certo.  -->



<!-- <form action="" method="POST" class="forms-sample"> -->

<div class="row">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
		



        
                                <div class="card">
                                    <div class="card-header"><h3>Formulario de Cadastro de Passeios</h3></div>
                                    <div class="card-body">
                                       
                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">Local do Passeio</label>
                                                        <select class="form-control" id="select_destinos0">
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">Mes</label>
                                                        <select class="form-control" id="mes">
                                                           <option value="1">Janeiro</option>
                                                           <option value="2">Fevereiro</option>
                                                           <option value="3">Março</option>
                                                           <option value="4">Abril </option>
                                                           <option value="5">Maio</option>
                                                           <option value="6">Junho</option>
                                                           <option value="7">Julho</option>
                                                           <option value="8">Agosto</option>
                                                           <option value="9">Setembro</option>
                                                           <option value="10">Outubro</option>
                                                           <option value="11">Novembro</option>
                                                           <option value="12">Dezembro</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                <label for="exampleInputUsername1">Data de Voltar</label>
                                                <input id="cadastro_data_voltar" class="form-control" type="date">
                                            </div> -->

                                            <!-- <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">Veiculos</label>
                                                        <select id="veiculos" class="selectpicker" multiple data-live-search="true">
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> -->

                                            <div class="row">
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleSelectGender">Veiculo</label>
                                                        <select class="form-control" id="veiculos">
                                                           
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                           <?php 
                                            
                                            if($_SESSION['user'][0]['nivel_acesso_fk'] == 1){
                                            ?>

                                            <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['id_login']?>">
                                                
                                                <?php }else if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){?>
                                            
                                            <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['fk_login_loja']?>">
                                                    
                                                    <?php }?>


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
            <button type="Submit" class="btn btn-info btn-block" onclick="cadastroDestinoVeiculo()">Cadastrar</button>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>

<!-- </form> -->



<!-- /////////// termina aqui as ações --> 
</div> <!-- Fim Div Principal -->


                

<footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2021 RedTag-Mobile All Rights Reserved.</span>
                        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Crafted with <i class="fa fa-heart text-danger"></i> by <a href="http://lavalite.org/" class="text-dark" target="_blank">Jv and Company</a></span>
                    </div>
                </footer>
                
            </div>
        </div>
        
        
        

       
        
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> -->
        <!-- <script>window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->
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
        <script src="../../../plugins/axios/axios.js"></script>
        <script src="../../Mains/administrador_main.js"></script>
       
<script>

// $(document).ready(function() {
//     $('#table').DataTable();
// } );

// load_tabela_main();
getDestinos()
getVeiculos()

function testar(){
    var a = $("#pega_veiculos").val()
    alert(a)
    
}


</script>

</body>
</html>

        

                
<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>







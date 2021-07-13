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
<?php 
// Cabeçalho ate a div principal
include('../../../includes/head.php');
?>


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





<!-- /////////// termina aqui as ações --> 
</div> <!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>

        <script src="../../../plugins/select2/dist/js/select2.min.js"></script>
        <script src="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../../../plugins/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="../../../plugins/mohithg-switchery/dist/switchery.min.js"></script>
        <script src="../../../js/form-advanced.js"></script>

<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>

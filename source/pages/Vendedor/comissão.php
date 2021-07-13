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

$code = substr(md5(md5(time())), -8);

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




    <br>

    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-12">
                
            </div>
        </div>
    </div> 
    <!-- fecha div da tabela-->

<div id="tables">


</div>

    <?php
                $idLoja = "";

              if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){
                $idLoja = $_SESSION['user'][0]['fk_login_loja'];
              }else{
                  $idLoja = $_SESSION['user'][0]['id_login'];
              }


                       
                    ?>






                                            <?php 
                                            
                                            if($_SESSION['user'][0]['nivel_acesso_fk'] == 1){
                                            ?>

                                            <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['id_login']?>">
                                                
                                                <?php }else if($_SESSION['user'][0]['nivel_acesso_fk'] == 2){?>
                                            
                                            <input type="hidden" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['fk_login_loja']?>">
                                                    
                                                    <?php }?>

                                                    <input type="hidden" value="<?=$_SESSION['user'][0]['id_login']?>" id="id_do_vendedor">

                                                    <?php
                                                    
                                                    // var_dump($_SESSION['user'][0]['id_login']);

                                                    ?>

          








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
        <script src="../../Mains/vendedor_main.js"></script>
        <script>
     


        




        </script>

<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>

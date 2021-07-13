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
                                            <h5>Vendas executadas pelos vendedores</h5>
                                            <span>aba destinada para o controle das operações</span>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div> <!-- fim menu superior -->

<!-- //////////// Começo das ações daqui, pode copiar e colar que da certo.  -->


<div class="container-fluid"> <!--div da tabela-->
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Total de passagens Vendidas</th>
                        <th scope="col">Valor Arrecadado</th>
                        
                    </tr>
                </thead>
                <tbody id="vendedores">

   
               


                </tbody>
                </table>
            </div>
        </div>
    </div> <!-- fecha div da tabela-->


<!-- /////////// termina aqui as ações --> 
</div> <!-- Fim Div Principal -->


<?php 
                                            
                                            if($_SESSION['user'][0]['nivel_acesso_fk'] == 1){
                                            ?>

                                            <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['id_login']?>">
                                                
                                                <?php }else if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){?>
                                            
                                            <input type="text" id="fk_login_loja" name="fk_login_loja" value="<?=$_SESSION['user'][0]['fk_login_loja']?>">
                                                    
                                                    <?php }?>


                                                    <?php
                                                    
                                                    var_dump($_SESSION['user'][0]['nivel_acesso_fk']);

                                                    ?>


<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>

        <script src="../../../plugins/select2/dist/js/select2.min.js"></script>
        <script src="../../../plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../../../plugins/jquery.repeater/jquery.repeater.min.js"></script>
        <script src="../../../plugins/mohithg-switchery/dist/switchery.min.js"></script>
        <script src="../../../js/form-advanced.js"></script>
           
        <script src="../../../plugins/axios/axios.js"></script>
        <script src="../../Mains/administrador_main.js"></script>
        <script>
            vendasVendedores()
        </script>

<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>

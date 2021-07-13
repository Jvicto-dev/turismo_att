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

$passagemController = new \Source\Controllers\ControllerPassagem();
$destinosController = new \Source\Controllers\ControllerDestinos();
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





<form action="../../Actions/actionPassagem.php" method="POST" class="forms-sample">

<div class="row">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
		
                                <div class="card">
                                    <div class="card-header"><h3>Formulario de Edição de Passagens</h3></div>
                                    <div class="card-body">
                                    <?php
                                         $idLoja = "";

                                         if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){
                                           $idLoja = $_SESSION['user'][0]['fk_login_loja'];
                                         }else{
                                             $idLoja = $_SESSION['user'][0]['id_login'];
                                         }
                           
                           
                                          foreach ($passagemController ->read($idLoja) as $p) {?>
                                             <input type="hidden" name="id_da_passagem" value="<?=$p['id_passagem']?>">
                                            
                                             
                                    <div class="form-group">
                                            <label for="exampleFormControlSelect1">Destino: <?= $p['nome_destino']?></label>
                                           
                                             <?php } ?>

                                           

                                            </select>
                                    </div>
                                            
                                    <div class="container-fluid">
                                            
                                                

                                    <?php 
                                      $idLoja = "";

                                      if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){
                                        $idLoja = $_SESSION['user'][0]['fk_login_loja'];
                                      }else{
                                          $idLoja = $_SESSION['user'][0]['id_login'];
                                      }
                                    
                                    foreach ($passagemController->read($idLoja) as $j) {
                                            if($j['id_categoria_fk'] == 1){
                                               
                                        ?>
                                                
                                            <div class="row">
                                            <div class="col-md-4">
                                            <div class="form-group">

                                            <label for="exampleInputEmail1">Valor da passagem Adulto</label>
                                            <input type="text" value="<?=$j['valor']?>" name="valor" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                            </div>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>

                                            <?php }else{ ?>
                                               
                                                <div class="row">
                                            <div class="col-md-4">
                                            <div class="form-group">

                                            <label for="exampleInputEmail1">Valor da passagem Criaça</label>
                                            <input type="text" value="<?=$j['valor']?>" name="valor" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                            </div>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div>   

                                            <?php }} ?>

                                            <!-- <div class="row">
                                                <div class="col-md-4">
                                                <div class="form-group">
                                            <label for="exampleInputEmail1">Valor da passagem Adulto</label>
                                            <input type="text" name="valor_adulto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Valor">
                                            </div>
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                </div>
                                            </div> -->
                                        </div>
                                         
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
            <button type="Submit" class="btn btn-info btn-block" name="EditarPassagem">Editar</button>
		</div>
		<div class="col-md-2">
		</div>
	</div>
</div>

</form>



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

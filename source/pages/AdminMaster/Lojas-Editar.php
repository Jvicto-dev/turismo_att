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
$lojas = new \Source\Controllers\ControllerLojas()
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





<form action="../../Actions/ActionLojas.php" method="POST" class="forms-sample">

<div class="row">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
		
                                <div class="card">
                                    <div class="card-header"><h3>Formulario de Edição de Lojas</h3></div>
                                    <div class="card-body">
                                   <?php  foreach ($lojas ->read($_SESSION['user'][0]['fk_login_loja']) as $l) { ?>
                                             <input type="hidden" name="id_login" value="<?=$l['id_login']?>">
                                            
                                             <div class="form-group">
                                                <label for="exampleInputUsername1">Nome do Responsavel</label>
                                                <input type="text" value="<?=$l['nome']?>" name="nome_responsavel" class="form-control" id="exampleInputUsername1" placeholder="Ex: Vilage Palace...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Nome da loja</label>
                                                <input type="text" value="<?=$l['nome_loja']?>" name="nome_loja" class="form-control" id="exampleInputUsername1" placeholder="Ex: Vilage Palace...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputUsername1">email</label>
                                                <input type="text" value="<?=$l['email']?>" name="email" class="form-control" id="exampleInputUsername1" placeholder="Ex: Vilage Palace...">
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputUsername1">senha</label>
                                                <input type="hidden" value="<?=$l['senha']?>" name="old_senha" class="form-control" id="exampleInputUsername1" placeholder="Ex: Vilage Palace...">
                                                <input type="text" value="" name="nova_senha" class="form-control" id="exampleInputUsername1" placeholder="***">
                                            </div>
                                            <?php }?>
                                            <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button> -->
                                         
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
            <button type="Submit" class="btn btn-info btn-block" name="EditarLoja">Editar</button>
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

<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>

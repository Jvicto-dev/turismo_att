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
$usuarios = new \Source\Controllers\ControllerUsuarios();
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

<form action="../../Actions/actionUsuario.php" method="POST" class="forms-sample">
<div class="row">
<div class="container-fluid">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
		
                                <div class="card">
                                    <div class="card-header"><h3>Formulario de Cadastro de Usuarios</h3></div>
                                    <div class="card-body">
                                    <?php
                                    $idLoja = "";

                                    if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){
                                      $idLoja = $_SESSION['user'][0]['fk_login_loja'];
                                    }else{
                                        $idLoja = $_SESSION['user'][0]['id_login'];
                                    }
                                          foreach ($usuarios ->read($idLoja) as $u) {?>
                                             <input type="hidden" name="id_do_login" value="<?=$u['id_login']?>">
                                           
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Nome do Usuario</label>
                                                <input type="text" value="<?= $u['nome'];?>" name="nome_usuario" class="form-control" id="exampleInputUsername1" placeholder="<?= $u['nome'];?>">
                                            </div>
                                            
                                           
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Email</label>
                                                <input type="text" value="<?= $u['email'];?>" name="email" class="form-control" id="exampleInputUsername1" placeholder="<?= $u['email'];?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputUsername1">Senha</label>
                                            <!-- valor antigo    <input type="password" value="<?php //  $u['senha'];?>" name="senha" class="form-control" id="exampleInputUsername1" placeholder="<?php// $u['senha'];?>"> -->
                                           
                                            <input type="hidden" value="<?=$u['senha']?>" name="old_senha" class="form-control" id="exampleInputUsername1" placeholder="Ex: Vilage Palace...">
                                            <input type="text" value="" name="nova_senha" class="form-control" id="exampleInputUsername1" placeholder="***">
                                            
                                          
                                            </div>

                                            <?php }?>

                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Selecionar Nivel de Acesso</label>
                                                <select name="nivel_acesso" class="form-control" id="exampleFormControlSelect1">
                                                
                                                <?php foreach ($usuarios ->read($idLoja) as $u) {?> ?>
                                                <option value="2">Nivel Atual: <?= $u['nivel'];?></option>
                                                 <?php } ?>   
                                                 <option value="1">Administrador</option>
                                                 <option value="2">Vendedor</option>
                                                </select>
                                            </div>
                                                    
                                                                                      
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
            <button type="Submit" class="btn btn-info btn-block" name="EditarUsuarios">Editar Usuario</button>
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

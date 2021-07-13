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


$veiculos = new \Source\Controllers\ControllerVeiculos();
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



<div class="container-fluid">
	<div class="row">
		<div class="col-md-5">
		</div>
		<div class="col-md-5">
		</div>
		<div class="col-md-2">
     <a href="Veiculo-Adicionar.php"><button type="button" class="btn btn-outline-success">Adicionar Veiculos</button></a>
		</div>
	</div>
</div>

<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
            <table id="table" class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Nome do Veiculo</th>
                    <th scope="col">Capacidade</th>
                    <th scope="col">Placa</th>
                    <th scope="col">Ações</th>
                    
                </tr>
            </thead>
               
         
            <tbody>
            <?php
             $idLoja = "";

             if($_SESSION['user'][0]['nivel_acesso_fk'] == 4){
               $idLoja = $_SESSION['user'][0]['fk_login_loja'];
             }else{
                 $idLoja = $_SESSION['user'][0]['id_login'];
             }
                     foreach ($veiculos ->read($idLoja) as $v) {
                ?>
                <tr>
                    <th scope = "row"><?= $v['nome_veiculo']; ?></th>
                    <td><?= $v['capacidade']; ?></td>
                    <td><?= $v['placa']; ?></td>

                    <?php
                    //  if($v['disponivel'] == 'SIM'){
                        ?>

                    <!-- <td><span class="badge badge-pill badge-info mb-1"><?=$v['disponivel']?></span></td> -->

                   <?php // }else{?>

                    <!-- <td><span class="badge badge-pill badge-danger mb-1"><?=$v['disponivel']?></span></td> -->
                   <?php // } ?>
                   
                    <td>
                      <a href="../../pages/Administracao/Veiculo-Editar.php?idVeiculo=<?= $v['id_veiculo']; ?>">
                        <button type="button" class="btn btn-outline-primary">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                          </svg>
                        </button>
                      </a>
                      <a href="#">
                        <button onclick="DeletarVeiculo(<?= $v['id_veiculo']; ?>)" type="button" class="btn btn-outline-danger">
                          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                          </svg>
                        </button>
                      </a>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
                 
                    
            </table>
		</div>
	</div>
</div>







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

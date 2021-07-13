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
$lojas = new \Source\Controllers\ControllerLojas();
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
                        <a href="Lojas-Adicionar.php"><button type="button" class="btn btn-outline-success">Adicionar Empresas</button></a>
                            </div>
                        </div>
                    </div>


<br>




<div class="container-fluid"> <!--div da tabela-->
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome da Loja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                        foreach ($lojas ->read($_SESSION['user'][0]['fk_login_loja']) as $l) {
                    ?>
                    <tr>

                        <th scope = "row"><?= $l['nome_loja']; ?></th>
                        <?php
                        if($l['status'] == 'ativo'){
                            
                        ?>

                        <th>
                            <span class="badge badge-pill badge-success mb-1">
                            <?= $l['status']; ?>
                            </span>  
                        </th>
                        <th>
                             <button onclick="estadoLoja(<?= $l['id_login']; ?>,1)" type="button" class="btn btn-outline-dark">Desativar</button>
                             <a href="Lojas-Editar.php?idLoja=<?= $l['id_login']; ?>">
                             <button type="button" class="btn btn-outline-primary">
                                    Editar
                             </button>
                             </a>
                        </th>
                       <?php }else if($l['status'] == 'desativado'){ ?>

                        <th>
                            <span class="badge badge-pill badge-dark mb-1">
                            <?= $l['status']; ?>
                            </span>  
                        </th>
                        <th>
                             <button onclick="estadoLoja(<?= $l['id_login']; ?>,2)" type="button" class="btn btn-outline-warning">
                                    Reativar
                             </button>
                        </th>
                        </tr>
                            <?php }}?>
                </tbody>
                </table>
            </div>
        </div>
    </div> <!-- fecha div da tabela-->








<!-- /////////// termina aqui as ações --> 
</div> <!-- Fim Div Principal -->
<?php
// resto das coisas depois do "fecha div principal" 
include('../../../includes/footer.php'); ?>

    
<?php

      BodyHtml::footer();
      Messages::Mensagens();

?>

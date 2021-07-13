<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Destinos
 * */ 

if(isset($_POST['fazerVenda'])){

    $allnomes = $_POST['allnomes'];

    $destinos = new \Source\Models\Destinos();
    $destinos->setNomeDestino($nome_destino);
    $destinos->setEndereco($endereco);
    $destinos->setFkLoginLoja($fk_login_loja);

    $controllerDestinos = new \Source\Controllers\ControllerDestinos();
    $controllerDestinos->create($destinos);
    
}

if(isset($_POST['EditarDestino'])){
   
}

/** 
 * Deletar Destinos
 * */ 

if(isset($_GET['deletIdDestino'])){
  
}
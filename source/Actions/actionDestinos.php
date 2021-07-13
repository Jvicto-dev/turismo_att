<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Destinos
 * */ 

if(isset($_POST['CadastrarDestino'])){

    $nome_destino = $_POST['nome_destino'];
    $endereco = $_POST['endereco'];
    $fk_login_loja = $_POST['fk_login_loja'];

    $destinos = new \Source\Models\Destinos();
    $destinos->setNomeDestino($nome_destino);
    $destinos->setEndereco($endereco);
    $destinos->setFkLoginLoja($fk_login_loja);

    $controllerDestinos = new \Source\Controllers\ControllerDestinos();
    $controllerDestinos->create($destinos);
    
}

if(isset($_POST['EditarDestino'])){
    $nome_destino = $_POST['nome_destino'];
    $endereco = $_POST['endereco'];
    $id_do_destino = $_POST['id_do_destino'];

    $destinos = new \Source\Models\Destinos();
    $destinos->setNomeDestino($nome_destino);
    $destinos->setEndereco($endereco);
    $destinos->setIdDestino($id_do_destino);

    $controllerDestinos = new \Source\Controllers\ControllerDestinos();
    $controllerDestinos->update($destinos);
}

/** 
 * Deletar Destinos
 * */ 

if(isset($_GET['deletIdDestino'])){
    $idDestino = $_GET['deletIdDestino'];
    $controllerDestinos = new \Source\Controllers\ControllerDestinos();
    $controllerDestinos->delete($idDestino); 
}
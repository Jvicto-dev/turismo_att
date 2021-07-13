<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar 
 * */ 

if(isset($_POST['CadastrarVeiculo'])){
    $nome_veiculo = $_POST['nome_veiculo'];
    $capacidade = $_POST['capacidade'];
    // $id_do_veiculo = $_POST['id_do_veiculo'];
    $placa = $_POST['placa'];
    $fk_login_loja = $_POST['fk_login_loja'];

    $veiculos = new \Source\Models\Veiculos();
    $veiculos->setNomeVeiculo($nome_veiculo);
    $veiculos->setCapacidade($capacidade);
    $veiculos->setPlaca($placa);
    $veiculos->setFkLoginLoja($fk_login_loja);

    $controllerVeiculos = new \Source\Controllers\ControllerVeiculos();
    $controllerVeiculos->create($veiculos);
}

/** 
 * Editar 
 * */ 

if(isset($_POST['EditarVeiculo'])){
    $nome_veiculo = $_POST['nome_veiculo'];
    $capacidade = $_POST['capacidade'];
    $placa = $_POST['placa'];
    $id_do_veiculo = $_POST['id_do_veiculo'];
  
     
    $veiculos = new \Source\Models\Veiculos();
    $veiculos->setNomeVeiculo($nome_veiculo);
    $veiculos->setCapacidade($capacidade);
    $veiculos->setPlaca($placa);
    $veiculos ->setIdVeiculo($id_do_veiculo);
    
    $controllerVeiculos = new \Source\Controllers\ControllerVeiculos();
    $controllerVeiculos->update($veiculos);
}

/** 
 * Excluir 
 * */ 

if(isset($_GET['deletIdVeiculo'])){
    $idVeiculo = $_GET['deletIdVeiculo'];
    $controllerVeiculos = new \Source\Controllers\ControllerVeiculos();
    $controllerVeiculos->delete($idVeiculo); 
}

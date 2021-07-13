<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Paasagem
 * */ 

if(isset($_POST['CadastrarPassagem'])){

    $id_destino_fk = $_POST['id_destino_fk'];
    // $id_categoria_fk = $_POST[''];
    
    $valor_crianca = $_POST['valor_criança'];
    $valor_adulto = $_POST['valor_adulto'];
    $valor_crianca_colo = 0;
    $valor_crianca_4_10_anos = $_POST['valor_criança_4a10anos'];

    $fk_login_loja = $_POST['fk_login_loja'];

    $cat = array(1, $valor_adulto, 2, $valor_crianca, 3, $valor_crianca_colo, 4, $valor_crianca_4_10_anos);


    $passagem = new \Source\Models\Passagem();
    $passagem->setIdDestinoFk($id_destino_fk);
    $passagem->setFkLoginLoja($fk_login_loja);

    $controllerPassagem = new \Source\Controllers\ControllerPassagem();
    $controllerPassagem->create($passagem,$cat);

}


/** 
 * Adicionar Paasagem
 * */ 

if(isset($_POST['EditarPassagem'])){
   
    $id_da_passagem = $_POST['id_da_passagem'];
    // $id_destino_fk = $_POST['id_destino_fk'];
    $valor = $_POST['valor'];

    $passagem = new \Source\Models\Passagem();
    $passagem->setIdPassagem($id_da_passagem);
    // $passagem->setIdDestinoFk($id_destino_fk);
    $passagem->setValor($valor);

    $controllerPassagem = new \Source\Controllers\ControllerPassagem();
    $controllerPassagem->update($passagem);

}

/** 
 * Deletar Passagem
 * */ 

if(isset($_GET['deletIdPassagem'])){
    $deletIdPassagem = $_GET['deletIdPassagem'];
    $controllerPassagem = new \Source\Controllers\ControllerPassagem();
    $controllerPassagem->delete($deletIdPassagem);
   
}
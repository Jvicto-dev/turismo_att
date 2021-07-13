<?php

use Source\Controllers\ControllerHoteis;

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Hoteis
 * */ 

if(isset($_POST['CadastrarHotel'])){
    $nome_hotel = $_POST['nome_hotel'];
    
    $fk_login_loja = $_POST['fk_login_loja'];


    $hotel = new \Source\Models\Hoteis();
    $hotel->setNome($nome_hotel);
    $hotel->setFkLoginLoja($fk_login_loja);
    

    $controllerHoteis = new \Source\Controllers\ControllerHoteis();
    $controllerHoteis->create($hotel);

}


/** 
 * Editar Hoteis
 * */ 

if(isset($_POST['EditarHotel'])){
    $id_do_hotel = $_POST['id_do_hotel'];
    $nome_hotel = $_POST['nome_hotel'];

    // echo $id_do_hotel;

    $hotel = new \Source\Models\Hoteis();
    $hotel->setNome($nome_hotel);
    $hotel->setIdHotel($id_do_hotel);

    $controllerHoteis = new \Source\Controllers\ControllerHoteis();
    $controllerHoteis->update($hotel);

}


 /** 
 * Deletar Hoteis
 * */ 

if(isset($_GET['deletIdHotel'])){
    $idHotel = $_GET['deletIdHotel'];
    $controllerHoteis = new \Source\Controllers\ControllerHoteis();
    $controllerHoteis->delete($idHotel);
}


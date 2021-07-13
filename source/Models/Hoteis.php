<?php

namespace Source\Models;


Class Hoteis
{
    private $id_hotel;
    private $nome;
    private $fk_login_loja;

    public function getIdHotel(){
        return $this->id_hotel;
    }

    public function setIdHotel($idHotel){
        $this->id_hotel = $idHotel;
    }

    public function getNome(){
        return $this->nome;
    } 

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getFkLoginLoja(){
        return $this->fk_login_loja;
    }

    public function setFkLoginLoja($fk_login_loja){
        $this->fk_login_loja = $fk_login_loja;
    }

}
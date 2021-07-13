<?php

namespace Source\Models;


Class Passagem
{

    private $id_passagem;
    private $id_destino_fk;
    private $id_categoria_fk;
    private $valor;
    private $fk_login_loja;

    public function getIdPassagem(){
        return $this->id_passagem;
    }

    public function setIdPassagem($idPassagem){
        $this->id_passagem = $idPassagem;
    }

    public function getIdDestinoFk(){
        return $this->id_destino_fk;
    }

    public function setIdDestinoFk($idDestinoFk){
        $this->id_destino_fk = $idDestinoFk;
    }

    public function getIdCategoriaFk(){
        return $this->id_categoria_fk;
    }

    public function setIdCategoriaFk($idCategoriaFk){
        $this->id_categoria_fk = $idCategoriaFk;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getFkLoginLoja(){
        return $this->fk_login_loja;
    }

    public function setFkLoginLoja($fk_login_loja){
        $this->fk_login_loja = $fk_login_loja;
    }

    

}


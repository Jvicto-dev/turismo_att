<?php

namespace Source\Models;


Class Destinos
{
    private $id_destino;
    private $nome_destino;
    private $endereco;
    private $fk_login_loja;

    public function getIdDestino(){
        return $this->id_destino;
    }

    public function setIdDestino($idDestino){
        $this->id_destino = $idDestino;
    }
    
    public function getNomeDestino(){
        return $this->nome_destino;
    }

    public function setNomeDestino($nomeDestino){
        $this->nome_destino = $nomeDestino;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function getFkLoginLoja(){
        return $this->fk_login_loja;
    }

    public function setFkLoginLoja($fk_login_loja){
        $this->fk_login_loja = $fk_login_loja;
    }

}


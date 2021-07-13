<?php

namespace Source\Models;


Class Veiculos
{

    private $id_veiculo;
    private $nome_veiculo;
    private $capacidade;
    private $placa;
    private $fk_login_loja;
    

    public function getIdVeiculo(){
        return $this->id_veiculo;
    } 

    public function setIdVeiculo($idVeiculo){
        $this->id_veiculo = $idVeiculo;
    }

    public function getNomeVeiculo(){
        return $this->nome_veiculo;
    } 

    public function setNomeVeiculo($nome_veiculo){
        $this->nome_veiculo = $nome_veiculo;
    }

    public function getCapacidade(){
        return $this->capacidade;
    } 

    public function setCapacidade($capacidade){
        $this->capacidade = $capacidade;
    }

    public function getFkLoginLoja(){
        return $this->fk_login_loja;
    }

    public function setFkLoginLoja($fk_login_loja){
        $this->fk_login_loja = $fk_login_loja;
    }


  
    public function getPlaca()
    {
        return $this->placa;
    }

   
    public function setPlaca($placa)
    {
        $this->placa = $placa;
    }
}
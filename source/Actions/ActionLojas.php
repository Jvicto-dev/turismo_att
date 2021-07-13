<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Destinos
 * */ 

if(isset($_POST['CadastrarLoja'])){

 $nome_loja = $_POST['nome_loja'];
 $nome_responsavel = $_POST['nome_responsavel'];
 $email = $_POST['email'];
 $senha = $_POST['senha'];
 $fk_master = $_POST['master'];

$loja = new \Source\Models\Login();
$loja->setNomeLoja($nome_loja);
$loja->setNome($nome_responsavel);
$loja->setEmail($email);
$loja->setSenha(md5($senha));
$loja->setFkLoginLoja($fk_master);

$controllerLoja = new \Source\Controllers\ControllerLojas();
$controllerLoja->create($loja);
    
}

if((isset($_GET['estadoLoja'])) && (isset($_GET['estado'])) ){
    $idLoja = $_GET['estadoLoja'];
    
    if($_GET['estado'] == 1){
        $estado = 'desativado';
    }else{
        $estado = 'ativo';
    }

    $loja = new \Source\Models\Login();
    $loja->setIdLogin($idLoja);
    $loja->setStatus($estado);

    $controllerLoja = new \Source\Controllers\ControllerLojas();
    $controllerLoja->estadoLoja($loja);

}

// Editar Lojas

if(isset($_POST['EditarLoja'])){
    $senha = "";
    $nome_responsavel = $_POST['nome_responsavel'];
    $nome_loja = $_POST['nome_loja'];
    $email = $_POST['email'];

    $oldsenha = $_POST['old_senha'];
    $novasenha = $_POST['nova_senha'];


    if($novasenha != ''){
        $senha = md5($novasenha);
    }else{
        $senha = $oldsenha;
    }




    $id_login = $_POST['id_login'];

 
    $loja = new \Source\Models\Login();
    $loja->setNome($nome_responsavel);
    $loja->setNomeLoja($nome_loja);
    $loja->setEmail($email);
    $loja->setSenha($senha);
    $loja->setIdLogin($id_login);

    $controllerLojas = new \Source\Controllers\ControllerLojas();
    $controllerLojas->update($loja);

    echo "<a href='../pages/AdminMaster/Lojas.php'> Voltar"."</a>";
}
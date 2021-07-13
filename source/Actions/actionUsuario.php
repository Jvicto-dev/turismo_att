<?php

require __DIR__ .'/../../vendor/autoload.php';

/** 
 * Adicionar Destinos
 * */ 

if(isset($_POST['CadastrarUsuario'])){

    $nome_usuario = $_POST['nome_usuario'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    
    $fk_login_loja = $_POST['fk_login_loja'];

    $usuarios = new \Source\Models\Login();
    $usuarios->setNome($nome_usuario);
    $usuarios->setNivelAcesso($nivel_acesso);
    $usuarios->setEmail($email);
    $usuarios->setSenha(md5($senha));
    $usuarios->setFkLoginLoja($fk_login_loja);

    $controllerUsuarios = new \Source\Controllers\ControllerUsuarios();
    $controllerUsuarios->create($usuarios);
    
}


if(isset($_POST['EditarUsuarios'])){


    $senha = "";
    $oldsenha = $_POST['old_senha'];
    $novasenha = $_POST['nova_senha'];

    if($novasenha != ''){
        $senha = md5($novasenha);
    }else{
        $senha = $oldsenha;
    }


    $nome_usuario = $_POST['nome_usuario'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $email = $_POST['email'];
    $id_do_login = $_POST['id_do_login'];

    $usuarios = new \Source\Models\Login();
    $usuarios->setNome($nome_usuario);
    $usuarios->setNivelAcesso($nivel_acesso);
    $usuarios->setEmail($email);
    $usuarios->setSenha($senha);
    $usuarios->setIdLogin($id_do_login);

    $controllerUsuarios = new \Source\Controllers\ControllerUsuarios();
    $controllerUsuarios->update($usuarios);


}


if(isset($_GET['deletIdUsuario'])){
    $idUsuario = $_GET['deletIdUsuario'];
    $controllerUsuarios = new \Source\Controllers\ControllerUsuarios();
    $controllerUsuarios->delete($idUsuario); 
}


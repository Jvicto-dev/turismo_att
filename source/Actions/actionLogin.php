<?php

require __DIR__ .'/../../vendor/autoload.php';

$post = filter_input_array(INPUT_POST,FILTER_SANITIZE_SPECIAL_CHARS);
$data = (object)$post;

$email = $data->email;
$senha = $data->senha;

$login = new \Source\Models\Login();
$login->setEmail($email);
$login->setSenha(md5($senha));

$logar = new \Source\Controllers\FazerLogin();
$logar->Logar($login);


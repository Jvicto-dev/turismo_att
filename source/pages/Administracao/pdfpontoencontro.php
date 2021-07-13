<?php
require __DIR__ . '/../../../vendor/autoload.php';

if (!function_exists("protect")) {
    function protect()
    {
        if (!isset($_SESSION)) {
            session_start();
            if (!isset($_SESSION['user'])) {
                header('Location:../../index.php');
            }
        }
    }
}

protect();

$codigos = new Source\Controllers\ControllerPdf();
$id_passeio = $_GET['idDestino'];

$data_passeio = $_GET['dataPasseio'];
$destinos = new Source\Controllers\ControllerDestinos();

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css"> -->
    <title>GERANDO PDF</title>

    <style>
        * {
            font-family: sans-serif;
            /* Change your font family */
        }

        .content-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 100%;
            max-height: 100px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .content-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 5px 12px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .content-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        /* .tamanho{
    border: 1px solid red;
    
} */
    </style>

</head>

<body>





    <div class="tamanho">
        <?php $idLoja = "";

        if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
            $idLoja = $_SESSION['user'][0]['fk_login_loja'];
        } else {
            $idLoja = $_SESSION['user'][0]['id_login'];
        } ?>
        <p>Destino:<?= $destinos->read($idLoja)[0]['nome_destino'] ?> </p>
        <p>Data: <?php 
        $date = date_create($data_passeio);
        
        echo date_format($date, 'd/m/Y');?></p>


        <table class="content-table">
            <thead>
                <tr>
                    <th>Responsavel da familia</th>
                    <th>RG</th>
                    <th>Endereco</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php

                $idLoja = "";

                if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
                    $idLoja = $_SESSION['user'][0]['fk_login_loja'];
                } else {
                    $idLoja = $_SESSION['user'][0]['id_login'];
                }
                foreach ($codigos->pdfPontoEncontro($id_passeio, $data_passeio, $idLoja) as $p) {

                ?>
                    <tr>
                        <td><?= @$p['nome'] ?></td>

                        <td><?= @$p['rg'] ?></td>

                        <td><?= @$p['descricao'] ?></td>

                        <td><i class="far fa-square"></i></td>

                    </tr>
                <?php } ?>

            </tbody>
        </table>

</body>

</html>
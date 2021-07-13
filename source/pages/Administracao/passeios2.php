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
$id_veiculo = $_GET['id_veiculo'];


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
      /* height: 100px; */
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

 



    #inforRight {
      /* border: solid 1px red; */
      position: absolute;
      margin-left: 20px;
      margin-top: -29px;
    }

    p {
      margin: 0;
      font-size: 13px;
    }

    #inforLeft {
      position: absolute;
      margin-left: 350px;
      margin-top: -29px;
    }

    .tamanho{
      position: absolute;
      margin-top: -25px;
    }

  </style>

</head>

<body>
  <div id="lado esquerdo">
    <img src="gbg.png" alt="" width="200px;">

    <div id="inforRight">
      <?php
      $idLoja = "";

      if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
        $idLoja = $_SESSION['user'][0]['fk_login_loja'];
      } else {
        $idLoja = $_SESSION['user'][0]['id_login'];
      }
      echo "<p>" . $destinos->inforEmpresa($idLoja)[0]['nome_loja'] . "</p>";
      echo "<p>" . $destinos->inforEmpresa($idLoja)[0]['endereco'] . "</p>";
      echo "<p>CNPJ: " . $destinos->inforEmpresa($idLoja)[0]['cnpj'] . "</p>";
      echo "<p> Email: " . $destinos->inforEmpresa($idLoja)[0]['email'] . "</p>";
      echo "<p> Web: " . $destinos->inforEmpresa($idLoja)[0]['site'] . "</p>";
      echo "<p> Fones:" . $destinos->inforEmpresa($idLoja)[0]['telefone'] .
        "|" . $destinos->inforEmpresa($idLoja)[0]['telefone2'] .
        "|" . $destinos->inforEmpresa($idLoja)[0]['telefone3']

        . "</p>";

      ?>
    </div>

    <div id="inforLeft">
      <?php

      $date = date_create($data_passeio);

      echo "<p>"."Data da Viagem: " . date_format($date, 'd/m/Y')."</p>";

      ?>

      <?php $idLoja = "";

      if ($_SESSION['user'][0]['nivel_acesso_fk'] == 4) {
        $idLoja = $_SESSION['user'][0]['fk_login_loja'];
      } else {
        $idLoja = $_SESSION['user'][0]['id_login'];
      }
      ?>



      <p>Destino: <?= $destinos->read($idLoja)[0]['nome_destino'] ?> </p>

      <p>Guia:
        <?php

      // echo "<pre>";
      // print_r($codigos->valoresCabecalho($id_passeio, $id_veiculo, $data_passeio, 1, $idLoja));
      // echo "</pre>"; exit;

        foreach ($codigos->valoresCabecalho($id_passeio, $id_veiculo, $data_passeio, 1, $idLoja) as $ps) {

          echo @$ps['responsavel'] . " / " . "";
        }


        ?>


      </p>

      <p>Motorista:
        <?php

        foreach ($codigos->valoresCabecalho($id_passeio, $id_veiculo, $data_passeio, 2, $idLoja) as $ps) {

          echo @$ps['responsavel'] . " / " . "";
        }


        ?>



      </p>

      <p>Veiculo Placa:
        <?php echo $codigos->placaVeiculo($id_veiculo)[0]['placa'] ; ?>
      </p>

      <p>Veiculo Nome:
        <?php echo $codigos->placaVeiculo($id_veiculo)[0]['nome_veiculo'] ; ?>
      </p>

    </div>

  </div>








  <!-- Informações cabeçalho -->






  <br>



  <div class="tamanho">




    <?php
    $codigo = "";
    $valorPassagensTodoMundo = 0;
    $valorHoteis = 0;
    $soma = 0;
    $forma_pagamento = "";

    // echo "<pre>";
    // print_r($codigos->read($id_passeio, $data_passeio, $id_veiculo));
    // echo "</pre>"; exit;


    foreach ($codigos->read($id_passeio, $data_passeio, $id_veiculo) as $d) {

    ?>


      <table class="content-table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Rg</th>
            <th>Email</th>
            <th>Telefone 1</th>
            <th>Telefone 2</th>
            <th>Hora</th>
            <th>valor da passagem R$</th>
            <th>valor de venda R$</th>
            <th>Tipo passagem</th>
            <th>Solicitante</th>
          </tr>
        </thead>
        <tbody id="carrega_tabela_familias<?= $d['codigoDasFamilia']; ?>">
          <?php
          foreach (@$codigos->membrosFamilia($id_passeio, $d['codigoDasFamilia'], $id_veiculo) as $x) {
            @$valorPassagensTodoMundo += $x['valor_de_venda'];
          ?>
            <tr>
              <td><?= @$x['nome']; ?></td>

              <td><?= @$x['rg']; ?></td>

              <td><?= @$x['email']; ?></td>

              <td><?= @$x['telefone1']; ?></td>

              <td><?= @$x['telefone2']; ?></td>

              <td><?= $x['horario']; ?></td>

              <td>R$<?= @$x['valor_na_epoca']; ?>,00</td>

              <td>R$<?= @$x['valor_de_venda']; ?>,00</td>

              <td><?= @$x['categoriaPassagem']; ?></td>

              <td><?= @$x['vendedor']; ?></td>
            </tr>
        </tbody>
      <?php } ?>

      </tbody>

      </table>

      <div id="divValores">
        <?php

        foreach (@$codigos->getValoresFinaisPdf($id_passeio, $d['codigoDasFamilia']) as $y) {


          // echo "<pre>";
          // print_r($y);
          // echo "</pre>";


          @$valorHoteis +=  intval(@$y['valor']);
          if ($y['forma_de_pagamento'] == 1) {
            @$forma_pagamento = "Cartão - Crédito";
          } else if ($y['forma_de_pagamento'] == 2) {
            $forma_pagamento = "Cartão - Debito";
          } else if ($y['forma_de_pagamento'] == 3) {
            $forma_pagamento = "Dinheiro";
          } else if ($y['forma_de_pagamento'] == 4) {
            $forma_pagamento = "Transferencia";
          } else if ($y['forma_de_pagamento'] == 5) {
            $forma_pagamento = "PIX";
          }
        ?>


          <?php

          // $categorias = '[NOME] - [QUANTIDADE]';
          // $categorias = str_replace('[NOME]', );

          $body = '<p>Valor das passagens: [VALORPASSAGENS] | nome do Hotel:<b> [NOMEHOTEL] </b> </p>
                  <p> Valor do Hotel: [VALORHOTEL] | Valor final a ser pago pela familia: [FINALFAMILIA] | valcher de entrada: [VAUCHER]
                Valor restante: <b> [VALORRESTANTE] </b> </p>
                <p> Forma de pagamento: <b> [FORMAPAGAMENTO] </b> 
                Ponto de encontro:<b> [PONTOENCONTRO] </b> </p>
           ';

          //  - Horário: <b> [HORARIO] </b>


          $body = str_replace('[VALORPASSAGENS]', "R$" . @$y['valorPassagens'] . ",00", $body);
          $body = str_replace('[NOMEHOTEL]', @$y['nome_hotel'], $body);
          $body = str_replace('[VALORHOTEL]', "R$" . @$y['valor'] . ",00", $body);
          $body = str_replace('[FINALFAMILIA]', "R$" . @$y['valorTotalFamilia'] . ",00", $body);
          $body = str_replace('[VAUCHER]', "R$" . @$y['entrada'] . ",00", $body);
          $body = str_replace('[VALORRESTANTE]', "R$" . (@$y['valorTotalFamilia'] - @$y['entrada']) . ",00", $body);
          $body = str_replace('[FORMAPAGAMENTO]', $forma_pagamento, $body);
          $body = str_replace('[PONTOENCONTRO]', $y['descricao'], $body);
          // $body = str_replace('[HORARIO]', $y['horario'], $body);
          echo $body;
          ?>




        <?php } ?>


      </div>

    <?php } ?>




    <hr>
    <hr>


    <h3>Resumo</h3>


    <table class="content-table">
      <thead>
        <tr>
          <th>Soma de todas as passagens</th>
          <th>Soma de todos os hoteis </th>
          <th>Valor Final da Viagem</th>

        </tr>
      </thead>
      <tbody>

        <tr>
          <td>R$<?= $valorPassagensTodoMundo ?>,00</td>
          <td>R$<?= $valorHoteis ?>,00</td>
          <td>R$<?= ($valorPassagensTodoMundo + $valorHoteis) ?>,00</td>

        </tr>
      </tbody>
    </table>


    <table class="content-table">
      <thead>
        <tr>
          <th>Categoria</th>
          <th>Quantidade</th>

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

        $categorias = $codigos->infos($id_passeio, $data_passeio, $idLoja, $id_veiculo);
        // echo "<pre>";
        // print_r($categorias);
        // echo "</pre>";
        foreach ($categorias as $y) {
        ?>



          <tr>
            <td><?= $y['nomecategoria'] ?></td>
            <td><?= $y['quantidade'] ?></td>

          </tr>
        <?php } ?>

      </tbody>
    </table>

    <b>KM Inicial: ______________<b> <br>
        <b>KM Final: _______________</b>


</body>

</html>
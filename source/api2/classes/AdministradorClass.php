<?php

namespace Source\api2\classes;

use DateTime;
use DatePeriod;
use DateInterval;
use \Source\api2\Sql;
use \Source\Database\Connect;

class AdministradorClass extends Sql
{
    public static function GetVeiculos($array)
    {
        $cmd = "SELECT * FROM `veiculo` WHERE fk_login_veiculo_loja = ?";
        return SQL::use($cmd, $array);
    }

    public static function insertPasseios($array)
    {
        $cmd = "INSERT INTO `passeio2` (`id_passeio`, `id_destino_fk`, `data_ir`, `data_voltar`,`id_passeio_loja_fk`) VALUES (NULL, ?, ?, ?, ?)";
        return SQL::insert($cmd, $array);
    }

    public static function passeioPdf($array)
    {
        $cmd = "SELECT

        passeio2.id_destino_fk,
        destinos.nome_destino
        
        FROM passeio2 
        
        INNER JOIN destinos ON destinos.id_destino = passeio2.id_destino_fk
               ";
        return SQL::use($cmd, $array);
    }

    public static function AddDestinoVeiculo($array)
    {

        var_dump($array);

        // $cmd = "UPDATE `veiculo` SET `id_destino_fk` = ?, `disponivel` = 'NAO' WHERE `veiculo`.`id_veiculo` = ?";
        // return SQL::insert($cmd, $array);


        // $inicio = new DateTime('2021-'.$array[0].'-1');
        // $fim = new DateTime('2021-'.($array[0]+1).'-1');

        // $periodo = new DatePeriod($inicio, new DateInterval('P1D'), $fim);
        // $validos = [];
        // foreach ($periodo as $item) {

        //     if (substr($item->format("D"), 0, 1)) {
        //         $validos[] = $item->format('d/m/Y');
        //     }
        // }
    }

    public static function inforPasseios($array)
    {

        $cmd = "SELECT
        (SELECT COUNT(DISTINCT(familia.codigo_familia)) as familias FROM familia WHERE familia.id_destino_fk = ? AND familia.viagem_finalizada = 'NAO' AND familia.dia_viagem = ?) as qFamilias,
        (SELECT COUNT(DISTINCT(familia.id_veiculo_fk)) as qveiculos FROM familia INNER JOIN veiculo ON veiculo.id_veiculo = familia.id_veiculo_fk WHERE familia.id_destino_fk = ? AND familia.dia_viagem = ?) as qVeiculos,
        (SELECT COUNT(familia.codigo_familia) AS pessoasNoVeiculo FROM `familia` WHERE familia.id_destino_fk = ? AND familia.viagem_finalizada = 'NAO' AND familia.dia_viagem = ?) as qPessoas,
        (SELECT SUM(familia.valor_na_epoca) AS valorDaViagem FROM familia WHERE familia.id_destino_fk = ? AND familia.viagem_finalizada = 'NAO' AND familia.dia_viagem = ?) as vViagem
        ";
        return SQL::use($cmd, [
            $array[0],  $array[1],
            $array[0],  $array[1],
            $array[0],  $array[1],
            $array[0],  $array[1],
        ]);
    }

    public static function getDestinosAdm($array)
    {
        $cmd = "SELECT DISTINCT(destinos.nome_destino) nome_destino, destinos.id_destino  FROM `destinos`
        INNER JOIN familia ON familia.id_destino_fk = destinos.id_destino WHERE familia.dia_viagem = '2021-04-30'";
        return SQL::use($cmd, $array);
    }

    public static function finalizarPasseio($array)
    {
        $cmd1 = "UPDATE `familia` SET `viagem_finalizada` = 'SIM' WHERE familia.id_destino_fk = ?";
        $cmd2 = "UPDATE `veiculo` SET `id_destino_fk` = NULL, disponivel = 'SIM' WHERE veiculo.id_destino_fk = ?";
        $cmd3 = "DELETE FROM `passeio2` WHERE passeio2.id_destino_fk = ?";
        $response1 = SQL::insert($cmd1, [$array[0]]);
        $response2 = SQL::insert($cmd2, [$array[0]]);
        $response3 = SQL::insert($cmd3, [$array[0]]);
        return [$response1, $response2, $response3];
    }

    public static function getDashAdmin($array)
    {
        $cmd = "SELECT 
                (SELECT COUNT(*) as nAdmins FROM login WHERE nivel_acesso_fk = 4 AND fk_login_loja = 14) as nAdmins,
                (SELECT COUNT(*) as nVendedores FROM login WHERE nivel_acesso_fk = 2 AND fk_login_loja = ?) as nVendedores,
                (SELECT COUNT(familia.codigo_familia) as vendasDia FROM familia WHERE familia.fk_login_familia_loja = ? AND familia.dia = CURDATE()) as vendasDia,
                (SELECT COUNT(veiculo.id_veiculo) as nVeiculos FROM veiculo WHERE veiculo.fk_login_veiculo_loja = ?) as nVeiculos,
                (SELECT COUNT(destinos.id_destino) as nDestinos FROM destinos WHERE destinos.fk_login_destino_loja = ?) nDestinos,
                (SELECT SUM(familia.valor_na_epoca) as resumoDia FROM familia WHERE dia = CURDATE() AND familia.fk_login_familia_loja = ?) as resumoDia
                
                ";
        return SQL::use($cmd, [$array[0], $array[0], $array[0], $array[0], $array[0]]);
    }

    public static function passeioMaisVendido($array)
    {
        // var_dump($array);
        $cmd = "SELECT COUNT(familia.id_destino_fk) as conta,
         SUM(familia.valor_na_epoca) as valorArrecadado, 
         destinos.nome_destino,
          familia.fk_login_familia_loja
          FROM familia INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
           WHERE familia.fk_login_familia_loja = ? GROUP BY familia.id_destino_fk LIMIT 1 ";
        return SQL::use($cmd, $array);
    }

    public static function membrosFamilia($array)
    {
        $cmd = "SELECT * FROM `familia` WHERE familia.viagem_finalizada = 'NAO' 
        AND familia.id_destino_fk = ? AND familia.codigo_familia = ? 
         ORDER BY familia.email DESC";
        return SQL::use($cmd, $array);
    }

    public static function getValoresFinaisPdf($array)
    {
        $cmd = "SELECT 
        COUNT(familia.codigo_familia)as NumeroCodigos,
        SUM(familia.valor_na_epoca)+hotel_familia.valor as valorTotalFamilia,
        SUM(familia.valor_na_epoca) as valorPassagens,
        familia.codigo_familia,
        hotel_familia.valor,
        hotel.nome_hotel
        FROM familia
        INNER JOIN hotel_familia ON hotel_familia.codigo_familia = familia.codigo_familia
        INNER JOIN hotel ON hotel.id_hotel = hotel_familia.id_hotel_fk
        WHERE familia.viagem_finalizada = 'NAO' AND familia.id_destino_fk = ? AND familia.codigo_familia = ?
        
        GROUP BY familia.codigo_familia";
        return SQL::use($cmd, $array);
    }

    public static function pegarCodigoFamilia($array)
    {
        $cmd = "SELECT 
        DISTINCT(familia.codigo_familia) as codigoDasFamilia, 
        familia.id_destino_fk
        FROM familia
        INNER JOIN passeio2 ON passeio2.id_destino_fk = familia.id_destino_fk
        WHERE familia.id_destino_fk = ? AND familia.viagem_finalizada = 'NAO'
        ";
        return SQL::use($cmd, $array);
    }

    public static function getDash($array)
    {
        $cmd = "SELECT 
        COUNT(familia.id_familia) as totalVendas,
        SUM(familia.valor_na_epoca) as arrecadado
        
        
        FROM familia WHERE familia.fk_login_familia_loja = 14 ";
        return SQL::use($cmd, $array);
    }

    public static function allVendas($array)
    {
        $cmd = "SELECT COUNT(familia.id_destino_fk) as conta,
        SUM(familia.valor_na_epoca) as valorArrecadado, 
        destinos.nome_destino,
         familia.fk_login_familia_loja
         FROM familia INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
          WHERE familia.fk_login_familia_loja = ? GROUP BY familia.id_destino_fk";
        return SQL::use($cmd, $array);
    }

    public static function vendasVendedores($array)
    {
        $cmd = "SELECT
        login.nome,
        SUM(familia.valor_na_epoca) as valor_total_passagens,
        COUNT(familia.codigo_familia) as total_passagens_vendidas
        
        FROM familia
        
        INNER JOIN login ON familia.id_vendedor_fk = login.id_login
        
        WHERE familia.fk_login_familia_loja = ?
        GROUP BY login.nome 
        ORDER BY total_passagens_vendidas DESC
        ";

        return SQL::use($cmd, $array);
    }

    public static function getVeiculosDestinos($array)
    {
        $cmd = "SELECT * FROM veiculo WHERE veiculo.id_destino_fk = ?";
        return SQL::use($cmd, $array);
    }

    public static function removerVeiculoIndividual($array)
    {
        $cmd = "UPDATE `veiculo` SET `id_destino_fk` = NULL, `disponivel` = 'SIM' WHERE `veiculo`.`id_veiculo` = ?";
        return SQL::insert($cmd, $array);
    }

    public static function getCodFa($array)
    {
        $cmd = "SELECT DISTINCT(familia.codigo_familia) as cFamilia FROM
        familia WHERE familia.id_destino_fk = ?
         and familia.dia_viagem = ?";
        return SQL::use($cmd, $array);
    }

    public static function familiasPessoasAdm($array)
    {
        $cmd = "SELECT 
        familia.id_familia,
       familia.nome,
       familia.email,
       familia.telefone1,
       familia.telefone2,
       familia.valor_na_epoca,
       familia.valor_de_venda,
       familia.id_veiculo_fk,
       familia.id_passagem_fk,
       familia.dia,
       familia.dia_viagem,
       familia.codigo_familia,
       familia.fk_login_familia_loja,
       familia.viagem_finalizada,
       
       passagem.id_passagem,
       passagem.id_destino_fk,
       passagem.valor,
       
       destinos.id_destino,
       destinos.nome_destino, 
       destinos.endereco,
       
       veiculo.nome_veiculo
       
       FROM familia
       
       INNER JOIN passagem ON 
       passagem.id_passagem = familia.id_passagem_fk
       INNER JOIN destinos ON 
       destinos.id_destino = passagem.id_destino_fk
       INNER JOIN veiculo ON veiculo.id_veiculo = familia.id_veiculo_fk

        WHERE destinos.id_destino = ? AND familia.codigo_familia = ?";
        return SQL::use($cmd, $array);
    }

    public static function countSize($array)
    {
        $cmd = "SELECT COUNT(familia.codigo_familia) as qFamilia -- calcula a quantidade de pessoas na familia
        FROM familia WHERE familia.codigo_familia = ?";
        return SQL::use($cmd, $array);
    }

    public static function addVeiculoFamilia($array)
    {
        $cmd = "UPDATE `familia` SET `id_veiculo_fk` = ? WHERE familia.codigo_familia = ?";
        return SQL::insert($cmd, $array);
    }

    public static function pegarVeiculos($array)
    {
        $cmd = "SELECT
        veiculo.id_veiculo,
        veiculo.nome_veiculo,
        veiculo.capacidade,
        destinos.nome_destino,
        COUNT(familia.id_veiculo_fk) as ocupacao 
        FROM familia
        INNER JOIN veiculo ON veiculo.id_veiculo = familia.id_veiculo_fk
        INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
        WHERE familia.id_destino_fk = ? AND familia.dia_viagem = ? GROUP BY familia.id_veiculo_fk";
        return SQL::use($cmd, $array);
    }

    public static function getOneVeiculo($array)
    {
        $cmd = "SELECT
        (SELECT veiculo.id_veiculo FROM `veiculo` WHERE veiculo.id_veiculo = ?) as idVeiculo,
        (SELECT veiculo.nome_veiculo FROM `veiculo` WHERE veiculo.id_veiculo = ?) as nomeVeiculo,
        (SELECT COUNT(familia.codigo_familia) AS pessoasNoVeiculo FROM `familia`
         WHERE familia.id_veiculo_fk = ? AND familia.dia_viagem = ? AND familia.id_destino_fk = ?) as pessoasNoVeiculo,



        (SELECT capacidade FROM `veiculo` WHERE id_veiculo = ?) as capacidade, 
                (
        
                 (SELECT capacidade FROM `veiculo` WHERE id_veiculo = ?)
                  - 
                 (SELECT COUNT(familia.codigo_familia) AS pessoasNoVeiculo
                  FROM `familia`WHERE familia.id_veiculo_fk = ? AND viagem_finalizada = 'NAO'
                   AND familia.dia_viagem = ? AND familia.id_destino_fk = ?)
                
                ) as calculo
                
        FROM familia
        
       GROUP BY familia.id_veiculo_fk LIMIT 1";
        return SQL::use($cmd, [
            $array[0], $array[0], $array[0], $array[2], $array[1], $array[0], $array[0], $array[0], $array[1], $array[2]
        ]);
    }

    public static function trocarVeiculo($array)
    {
        $cmd = "UPDATE `familia` SET `id_veiculo_fk` = ? WHERE familia.id_veiculo_fk = ? AND familia.dia_viagem = ? AND familia.id_destino_fk = ?";
        // 0 -> para o qual veiculo eu quero trocar | 1 -> qual esta sendo trocado | 2  -> data
        $cmd2 = "UPDATE `passeio` SET `id_veiculo_fk` = ? WHERE passeio.id_veiculo_fk = ?";
         // 0 -> para o qual veiculo eu quero trocar | 1 -> qual esta sendo trocado
         /**
          * aqui eu estou trocando tbm os representantes da empresa 
          * como o guia e motorista
          */
          $response1 = SQL::insert($cmd, $array);
          $response2 = SQL::insert($cmd2, [$array[0], $array[1]]);
        return [$response1, $response2];
    }

    public static function getVendedores($array)
    {
        $cmd = "SELECT * FROM `login` WHERE login.nivel_acesso_fk = 2 AND login.fk_login_loja = ?";
        return SQL::use($cmd, $array);
    }

    public static function getComissaoIndividual($array)
    {
        $cmd = "SELECT 
        SUM(familia.valor_na_epoca) as valorEpoca,
        SUM(familia.valor_de_venda) as valorDeVenda,
        
        SUM((familia.valor_de_venda - familia.valor_na_epoca)) as comissao,
      
        (SELECT SUM(transacoes.valor_enviado) as envios FROM transacoes WHERE transacoes.id_vendedor_fk = ? AND categoria = 1) as todosEnviosDeComissao,
        (SELECT SUM(transacoes.valor_enviado) as envios FROM transacoes WHERE transacoes.id_vendedor_fk = ? AND categoria = 2) as todosEnviosParaEmpresa,
        (SELECT SUM(hotel_familia.valor) as hoteis_valor FROM hotel_familia WHERE hotel_familia.id_vendedor_fk = ?) as valoresHoteis
        FROM familia
        WHERE familia.id_vendedor_fk = ?";
        return SQL::use($cmd, [
            $array[0], $array[0], $array[0], $array[0]
        ]);
    }

    public static function getHistoricoIndividual($array)
    {
        $cmd = "SELECT 
        transacoes.id_transacao,
        transacoes.id_responsavel_fk,
        transacoes.id_vendedor_fk,
        transacoes.valor_enviado,
        transacoes.categoria,
        DATE_FORMAT(transacoes.created_at, '%d/%m/%Y - %H:%i:%s' ) as data_envio,
        login.nome
        FROM transacoes INNER JOIN login ON login.id_login = transacoes.id_responsavel_fk
                WHERE transacoes.id_vendedor_fk = ?";
        return SQL::use($cmd, $array);
    }

    public static function transacao($array)
    {
        $cmd = "INSERT INTO `transacoes` (`id_transacao`, `id_responsavel_fk`, `id_vendedor_fk`, `valor_enviado`, `categoria`, `created_at`) 
        VALUES (NULL, ?, ?, ?, ?, NOW())";
        return SQL::insert($cmd, $array);
    }

    public static function apagarTransacao($array)
    {
        $cmd = "DELETE FROM `transacoes` WHERE `transacoes`.`id_transacao` = ?";
        return SQL::insert($cmd, $array);
    }

    public static function valuesGraph($array)
    {
        $cmd = "SELECT
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 1 ) as janeiro,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 2 ) as fevereiro,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 3 ) as marco,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 4 ) as abril,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 5 ) as maio,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 6 ) as junho,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 7 ) as julho,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 8 ) as agosto,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 9 ) as setembro,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 10 ) as outubro,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 11 ) as novembro,
        (SELECT COUNT(familia.valor_na_epoca) as vendas FROM familia WHERE familia.id_destino_fk = ? AND familia.fk_login_familia_loja = ?  AND MONTH(familia.dia) = 12 ) as dezembro";
        return SQL::use($cmd, [
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1]
        ]);
    }

    public static function valuesGraphVendedor($array)
    {
        $cmd = "SELECT 
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 1 ) as janeiro,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 2 ) as fevereiro,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 3 ) as marco,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 4 ) as abril,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 5 ) as maio,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 6 ) as junho,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 7 ) as julho,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 8 ) as agosto,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 9 ) as setembro,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 10 ) as outubro,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 11 ) as novembro,
        (SELECT COUNT(familia.codigo_familia) as vendas FROM familia WHERE familia.id_vendedor_fk = ? AND MONTH(familia.dia) = 12 ) as dezembro 
        ";
        return SQL::use($cmd, [
            $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0], $array[0]
        ]);
    }

    public static function tabelaVendasPdia($array)
    {
        $cmd = "SELECT COUNT(familia.codigo_familia) as qVendasPdia,
        DATE_FORMAT(familia.dia,'%d/%m/%Y') as data
        FROM familia WHERE familia.id_vendedor_fk = ?
        GROUP BY DAY(familia.dia)";
        return SQL::use($cmd, $array);
    }

    public static function graficoGeralDestino($array)
    {
        $cmd = "SELECT destinos.nome_destino,
        COUNT(familia.codigo_familia) as vendas FROM familia 
        INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
        WHERE familia.fk_login_familia_loja = ?
        GROUP BY destinos.nome_destino";
        return SQL::use($cmd, $array);
    }

    public static function graficoGeralVendedor($array)
    {
        $cmd = "SELECT login.nome as nome_vendedor,
        COUNT(familia.codigo_familia) as vendas_vendedor FROM familia 
        INNER JOIN login ON login.id_login = familia.id_vendedor_fk 
        WHERE familia.fk_login_familia_loja = ?
        GROUP BY login.nome";
        return SQL::use($cmd, $array);
    }

    public static function addPonto($array)
    {
        $cmd = "INSERT INTO `ponto_de_encontro` (`id_ponto_encontro`, `descricao`,`horario`,`id_destino_fk`,`id_loja_ponto_encontro_fk`) 
        VALUES (NULL, ?, ?, ?, ?);";
        return SQL::insert($cmd, $array);
    }

    public static function readPonto($array)
    {
        $cmd = "SELECT * FROM `ponto_de_encontro` WHERE ponto_de_encontro.id_loja_ponto_encontro_fk = ? AND ponto_de_encontro.id_destino_fk = ?";
        return SQL::use($cmd, $array);
    }

    public static function excluirLocal($array)
    {
        $cmd = "DELETE FROM `ponto_de_encontro` WHERE `ponto_de_encontro`.`id_ponto_encontro` = ?";
        return SQL::insert($cmd, $array);
    }

    public static function readPontoOne($array)
    {
        $cmd = "SELECT * FROM `ponto_de_encontro` WHERE ponto_de_encontro.id_ponto_encontro = ?";
        return SQL::use($cmd, $array);
    }

    public static function pontoUpdate($array)
    {
        $cmd = "UPDATE `ponto_de_encontro` SET `descricao` = ?, `horario` = ? WHERE ponto_de_encontro.id_ponto_encontro = ?";
        return SQL::insert($cmd, $array);
    }

    public static function insertGuiaEMotorista($array)
    {
        // echo "<pre>";
        // print_r($array);
        // echo "</pre>";
        $cmd = "INSERT INTO `passeio` (`id_passeio`, `id_destino_fk`, `id_veiculo_fk`, `responsavel`, `categoria`, `dia_viagem`, `fk_login_passeio_loja`) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        return SQL::insert($cmd, $array);
    }

    public static function getMotoristaGuia($array)
    {
        $cmd = "SELECT * FROM passeio 
        WHERE passeio.id_destino_fk = ?
        AND passeio.id_veiculo_fk = ? 
        AND passeio.dia_viagem = ? 
        AND passeio.fk_login_passeio_loja = ?";
        return SQL::use($cmd, $array);
    }

    public static function deletarResponsavel($array){
        $cmd = "DELETE FROM `passeio` WHERE `passeio`.`id_passeio` = ?";
        return SQL::insert($cmd, $array);
    }

    public static function getVeiculosPasseio($array){
        $cmd = "SELECT * FROM familia 
        INNER JOIN veiculo ON veiculo.id_veiculo = familia.id_veiculo_fk 
        WHERE familia.dia_viagem = ?
        AND familia.id_destino_fk = ?
        AND familia.fk_login_familia_loja = ?
        GROUP BY familia.id_veiculo_fk";
        return SQL::use($cmd, $array);
    }

    public static function chamaumdestino($array){
        $cmd = "SELECT * FROM destinos WHERE destinos.id_destino = ?";
        return SQL::use($cmd, $array);
    }

}

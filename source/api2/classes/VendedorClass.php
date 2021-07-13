<?php

namespace Source\api2\classes;

use \Source\api2\Sql;
use \Source\Database\Connect;
use \Source\api2\Email;

class VendedorClass extends Sql
{
    public static function GetDestinos($array)
    {
        $cmd = "SELECT * FROM `destinos` WHERE fk_login_destino_loja = ?";
        return SQL::use($cmd, $array);
    }

    public static function getHoteis($array)
    {
        $cmd = "SELECT * FROM `hotel` WHERE fk_login_hotel_loja = ?";
        return SQL::use($cmd, $array);
    }

    public static function passeioVendedor($array)
    {
        $cmd = "SELECT

        passeio2.id_destino_fk,
        destinos.nome_destino
        
        FROM passeio2 
        
        INNER JOIN destinos ON destinos.id_destino = passeio2.id_destino_fk
               ";
        return SQL::use($cmd, $array);
    }

    public static function GetPassagens($array)
    {
        $cmd = "SELECT 
        passagem.id_passagem,
        passagem.id_destino_fk,
        passagem.id_categoria_fk,
        destinos.id_destino,
        destinos.nome_destino,
        destinos.endereco,
        categoria.id_categoria,
        categoria.nome_categoria,
        passagem.valor
        FROM passagem
        
        INNER JOIN destinos ON passagem.id_destino_fk = destinos.id_destino
        INNER JOIN categoria ON passagem.id_categoria_fk = categoria.id_categoria
        
        WHERE id_destino_fk = ? AND id_loja_login_fk = ?";
        return SQL::use($cmd, $array);
    }

    public static function GetVeiculosVendedor($array)
    {
        $cmd = "SELECT 
        veiculo.id_veiculo,
        veiculo.nome_veiculo,
        veiculo.capacidade,
        veiculo.id_destino_fk,
        veiculo.fk_login_veiculo_loja
        FROM veiculo
        WHERE veiculo.id_destino_fk = ? AND fk_login_veiculo_loja = ?";
        return SQL::use($cmd, $array);
    }

    // public static function Vender($array){


    //     $cmd = "INSERT INTO `familia` (`id_familia`,`nome`, `email`, `telefone1`, `telefone2`, `codigo_familia`, `fk_login_familia_loja`)
    //      VALUES (NULL, ? , ? , ? , ?, ?, ?)";

    //     $nomes = $array[0];
    //     $emails = $array[1];
    //     $telefones1 = $array[2];
    //     $telefones2 = $array[3];
    //     $codigo_familia = $array[4];
    //     $id_loja_fk = $array[5];
    //     // $id_loja_fk = $array[5];

    //     var_dump($array);

    //     $explodeNomes = explode("///", $nomes);
    //     $explodeEmails = explode("///", $emails);
    //     $explodeTelefones1 = explode("///", $telefones1);
    //     $explodeTelefones2 = explode("///", $telefones2);
    //     $sizeArray = count($explodeNomes)-1;

    //     var_dump($explodeTelefones2);

    //     for($i = 0; $i < $sizeArray; $i++){


    //     $array[$i] = [$explodeNomes[$i],
    //                   $explodeEmails[$i], 
    //                    $explodeTelefones1[$i],
    //                     $explodeTelefones2[$i],
    //                      $codigo_familia, $id_loja_fk];

    //     $pdo = Connect::getInstance();
    //     $stmt = $pdo->prepare($cmd);

    //     @$stmt->execute($array[$i]);



    //     }
    // }

    public static function VeiculoFamilia($array)
    {
        $cmd1 = "SELECT
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
        
       GROUP BY familia.id_veiculo_fk LIMIT 1
      
        ";
        $td = Sql::use($cmd1, [
            $array[0], $array[0], $array[0], $array[2], $array[1], $array[0], $array[0], $array[0], $array[1], $array[2]
        ]);

        return $td;
    }



    public static function Vender($array)
    {

        $cmd = "INSERT INTO `familia` 
        (`id_familia`,
         `nome`,
         `rg`,
         `email`,
         `telefone1`,
         `telefone2`, 
         `id_destino_fk`,
         `id_veiculo_fk`,
         `id_passagem_fk`,
         `id_vendedor_fk`,
         `valor_na_epoca`,
         `valor_de_venda`,
         `codigo_familia`,
         `dia`,
         `dia_viagem`,
         `fk_login_familia_loja`,
         `viagem_finalizada`)
        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, CURDATE(), ?, ?, 'NAO')";
        return SQL::insert($cmd, $array);
    }

    public static function TabelaVendas($array)
    {
        $cmd = "INSERT INTO `vendas` (`id_vendas`,`id_passagem_fk`, `id_vendedor_login_fk`, `dia`, `valor_na_epoca`,`valor_de_venda`, `fk_login_vendas_loja`)
        VALUES (NULL, ? , ? , CURDATE(), ?, ?, ?)";
        return SQL::insert($cmd, $array);
    }

    public static function TabelaHotelFamilia($array)
    {
        if ($array[1] == "0xkcpj") {
            $array[0] = $array[0];
            $array[1] = 0;
            $array[2] = $array[2];
            $array[3] = $array[3];
            $array[4] = "-----";
            $array[5] = 0;
        }
        var_dump($array);
        $cmd = "INSERT INTO `hotel_familia` (`id_hotel_familia`,`id_destino_fk`, `id_hotel_fk`,`id_vendedor_fk`, `codigo_familia`,`n_apartamento`, `valor`) 
        VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        return SQL::insert($cmd, $array);
    }

    // n vai precisar
    public static function ValorEpoca($array)
    {
        $cmd = "SELECT valor FROM `passagem` WHERE id_passagem = ?";
        return SQL::use($cmd, $array);
    }

    public static function GetMInhasVendas($array)
    {
        $cmd = "SELECT DISTINCT(destinos.nome_destino),
        familia.id_familia,
        familia.nome,
        familia.email,
        familia.telefone1,
        familia.telefone2,
        familia.valor_na_epoca,
        familia.id_veiculo_fk,
        familia.id_passagem_fk,
    
        DATE_FORMAT(familia.dia, '%d/%m/%Y' ) as dia,
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
        INNER JOIN veiculo ON 
        veiculo.id_veiculo = familia.id_veiculo_fk
        
        
        WHERE destinos.id_destino = ? AND familia.viagem_finalizada = 'NAO' AND familia.id_vendedor_fk = ? AND familia.codigo_familia = ?
        
        
        ";
        return SQL::use($cmd, $array);
    }

    public static function getDashVendedor($array)
    {
        $cmd = "SELECT 
        (SELECT COUNT(familia.codigo_familia) as tVendasVendedor FROM familia WHERE familia.id_vendedor_fk = ? AND familia.fk_login_familia_loja = ?) as tVendasVendedor,
        (SELECT SUM(familia.valor_na_epoca) as resumoDia FROM familia WHERE dia = CURDATE() AND familia.id_vendedor_fk = ? AND familia.fk_login_familia_loja = ?) as resumoDiaVendedor,
        (SELECT COUNT(familia.id_vendedor_fk) as vendasDiaVendedor FROM familia WHERE dia = CURDATE() AND familia.id_vendedor_fk = ? AND familia.fk_login_familia_loja = ?) as vendasDiaVendedor,
        (SELECT SUM(familia.valor_na_epoca) as resumoVendedor FROM familia WHERE familia.id_vendedor_fk = ? AND familia.fk_login_familia_loja = ?) as resumoVendedor 
        
        ";
        return SQL::use($cmd, [
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
            $array[0], $array[1],
        ]);
    }

    public static function getPasseioMaisVendidoVendedor($array)
    {
        $cmd = "SELECT COUNT(familia.id_destino_fk) as conta,
        SUM(familia.valor_na_epoca) as valorArrecadado, 
        destinos.nome_destino,
        login.id_login,
        login.nome,
        familia.fk_login_familia_loja
        
        FROM familia 
         
        INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
        INNER JOIN login ON login.id_login = familia.id_vendedor_fk
        WHERE familia.id_vendedor_fk = ? AND familia.fk_login_familia_loja = ?
          
        GROUP BY familia.id_destino_fk LIMIT 1
            ";
        return SQL::use($cmd, $array);
    }

    public static function getCodVendFay($array)
    {
        $cmd = "SELECT DISTINCT(familia.codigo_familia) as cFamilia FROM familia WHERE familia.id_vendedor_fk = ? AND familia.id_destino_fk = ?";
        return SQL::use($cmd, $array);
    }

    public static function insertVaucher($array)
    {
        $cmd = " INSERT INTO `vaucher` (`id_vaucher`, `id_vendedor_fk`, `codigo_familia`, `entrada`, `restante`, `forma_de_pagamento`) 
        VALUES (NULL, ?,?,?,0,?)";
        return SQL::use($cmd, $array);
    }

    public static function pontoEncontro($array)
    {
        $cmd = " INSERT INTO `ponto_encontro` (`id_ponto_encontro`, `codigo_familia`, `id_destino_fk`, `id_vendedor_fk`, `id_ponto_de_encontro_fk`) 
        VALUES (NULL, ?,?,?,?)";
        return SQL::use($cmd, $array);
    }

    public static function cancelarVendaFamilia($array)
    {
        $cmd1 = "DELETE FROM `familia` WHERE familia.codigo_familia = ?";
        $cmd2 = "DELETE FROM `hotel_familia` WHERE hotel_familia.codigo_familia = ?";
        $cmd3 = "DELETE FROM `vaucher` WHERE vaucher.codigo_familia = ?";
        $cmd4 = "DELETE FROM `ponto_encontro` WHERE ponto_encontro.codigo_familia = ?";


        $response1 = SQL::insert($cmd1, [$array[0]]);
        $response2 = SQL::insert($cmd2, [$array[0]]);
        $response3 = SQL::insert($cmd3, [$array[0]]);
        $response4 = SQL::insert($cmd4, [$array[0]]);
        return [$response1, $response2, $response3, $response3];
    }

    public static function passagemFamilia($array)
    {
        $cmd = "SELECT
        passagem.id_passagem, 
        passagem.id_categoria_fk,
        categoria.nome_categoria,
        passagem.valor,
        destinos.nome_destino,
        destinos.id_destino,
        veiculo.id_veiculo,
        veiculo.nome_veiculo,
        familia.dia_viagem
        FROM passagem 
        INNER JOIN familia ON familia.id_destino_fk = passagem.id_destino_fk
        INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        INNER JOIN destinos ON destinos.id_destino = passagem.id_destino_fk
        INNER JOIN veiculo ON veiculo.id_veiculo = familia.id_veiculo_fk
        WHERE familia.codigo_familia = ?
        GROUP BY passagem.id_passagem
        
        ";
        return SQL::use($cmd, $array);
    }

    public static function getNameHotel($array)
    {
        $cmd = "SELECT * FROM hotel WHERE hotel.id_hotel = ?";
        return SQL::use($cmd, $array);
    }

    public function informacoesGerais($array) // classe não instanciada 
    {
        // echo "<pre>";
        // print_r($array);
        // echo "</pre>";exit;


        $cmd = "SELECT 
        (SELECT vaucher.entrada FROM vaucher WHERE vaucher.codigo_familia = ?) as valor_entrada_familia,
        (SELECT hotel_familia.valor FROM hotel_familia WHERE hotel_familia.codigo_familia = ?) as valor_hotel_familia,
        (SELECT hotel.nome_hotel FROM hotel INNER JOIN hotel_familia ON hotel_familia.id_hotel_fk = hotel.id_hotel WHERE hotel_familia.codigo_familia = ?) as nome_hotel_familia,
        -- (SELECT SUM(familia.valor_de_venda) FROM familia WHERE familia.codigo_familia = ?) as valor_total,
        
        
        SUM(
        	((SELECT SUM(familia.valor_de_venda) FROM familia WHERE familia.codigo_familia = ?) + (SELECT hotel_familia.valor FROM hotel_familia WHERE hotel_familia.codigo_familia = ?))
        ) as valor_total,
        
        SUM(
            
      (  (SELECT SUM(familia.valor_de_venda) FROM familia WHERE familia.codigo_familia = ?) +  (SELECT hotel_familia.valor FROM hotel_familia WHERE hotel_familia.codigo_familia = ?) ) - (SELECT vaucher.entrada FROM vaucher WHERE vaucher.codigo_familia = ?)
        ) as valor_restante_familia,
        
        
        
        (SELECT destinos.nome_destino FROM destinos INNER JOIN familia ON familia.id_destino_fk = destinos.id_destino WHERE familia.codigo_familia = ? LIMIT 1) as nome_destino,
        (SELECT DATE_FORMAT(familia.dia_viagem, '%d/%m/%Y' ) as dia_da_viagem FROM familia WHERE familia.codigo_familia = ? LIMIT 1) as dia_viagem,
        (SELECT login.nome_loja FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as nome_agencia,
        (SELECT login.email FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as email_suporte_loja,
        (SELECT login.telefone FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as numero_contato_loja,
        (SELECT login.cnpj FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as cnpj_loja,
        (SELECT login.endereco FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as endereco_loja,
        (SELECT login.site FROM login INNER JOIN familia ON familia.fk_login_familia_loja = login.id_login WHERE familia.codigo_familia = ? LIMIT 1) as website_loja,
        (SELECT familia.email FROM familia WHERE familia.codigo_familia = ? ORDER BY familia.email DESC LIMIT 1) as email_cliente_responsavel,
        (SELECT hotel_familia.n_apartamento FROM hotel_familia WHERE hotel_familia.codigo_familia = ? LIMIT 1) as n_apartamento,
        (SELECT ponto_de_encontro.descricao 
        FROM ponto_de_encontro INNER JOIN ponto_encontro 
        ON ponto_encontro.id_ponto_de_encontro_fk = ponto_de_encontro.id_ponto_encontro
         WHERE ponto_encontro.codigo_familia = ? LIMIT 1) as ponto_encontro

       ";

        $response =  SQL::use($cmd, [
            $array[0], $array[0], $array[0],
            $array[0], $array[0], $array[0],
            $array[0], $array[0], $array[0],
            $array[0], $array[0], $array[0],
            $array[0], $array[0], $array[0],
            $array[0], $array[0], $array[0],
            $array[0]
        ]);

        return $response;
    }

    public function gerarInfoEmail($array)
    {
        $cmd = "SELECT 
        familia.nome,
        familia.rg,
        familia.email,
        familia.telefone1,
        familia.telefone2,
        familia.valor_na_epoca,
        familia.valor_de_venda,
        familia.id_vendedor_fk,
        categoria.nome_categoria as categoriaPassagem,
        login.nome as vendedor
        FROM familia
        INNER JOIN login ON login.id_login = familia.id_vendedor_fk
        INNER JOIN passagem ON passagem.id_passagem = familia.id_passagem_fk
        INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        WHERE familia.viagem_finalizada = 'NAO' AND 
        familia.codigo_familia = ? ORDER BY familia.email DESC";


        return SQL::use($cmd, [$array[0]]);
        // $response2 = VendedorClass::informacoesGerais($array);

        // $aux = [$response1, $response2];

     
    }

    public static function send($array)
    {
        // echo "<pre>";
        // print_r($array);
        // echo "</pre>";
        // exit;

        $obEmail = new Email;
        // $sucesso = $obEmail->sendEmail($adresses, $subject, $body);
        
        $sucesso = $obEmail->sendEmail($array[0], $array[1], $array[2]);

        if($sucesso){
            // session_start();
            // $_SESSION['typeMessage'] = 'success';
            // $_SESSION['mensagem'] = 'Email Enviado com sucesso';
            // header('Location:../pages/Vendedor/fazerVenda.php');
            return true;
        }else{
            // $_SESSION['typeMessage'] = 'error';
            // $_SESSION['mensagem'] = 'Erro ao Enviar Email'. $obEmail->getError();
            // header('Location:../pages/Vendedor/fazerVenda.php');
            return false;
        }

        // echo $sucesso ? header('Location:../pages/Vendedor/fazerVenda.php') : $obEmail->getError();
    }
}

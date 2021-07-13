<?php

namespace Source\Controllers;

use Source\Database\Connect;

class ControllerPdf
{
    public function read($id_destino_fk, $dia_passeio, $id_veiculo)
    {
        $dia_passeio = $dia_passeio;


        $sql = "SELECT 
            DISTINCT(familia.codigo_familia) as codigoDasFamilia, 
            familia.id_destino_fk,
            destinos.nome_destino
            FROM familia
            INNER JOIN destinos ON destinos.id_destino = familia.id_destino_fk
            WHERE familia.id_destino_fk = ? 
            AND familia.viagem_finalizada = 'NAO'
            AND familia.dia_viagem = ? 
            AND familia.id_veiculo_fk = ?
            ";

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_destino_fk);
        $stmt->bindValue(2, $dia_passeio);
        $stmt->bindValue(3, $id_veiculo);
        
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }


    public function membrosFamilia($id_destino_fk, $codigo_familia)
    {
        // $sql = "SELECT * FROM `familia` WHERE familia.viagem_finalizada = 'NAO' AND 
        // familia.id_destino_fk = ? AND familia.codigo_familia = ?  ORDER BY familia.email DESC";

        $sql = "SELECT 
        familia.nome,
        familia.rg,
        familia.email,
        familia.telefone1,
        familia.telefone2,
        familia.valor_na_epoca,
        familia.valor_de_venda,
        familia.id_vendedor_fk,
        categoria.nome_categoria as categoriaPassagem,
        login.nome as vendedor,
        ponto_encontro.id_destino_fk,
        ponto_de_encontro.descricao,
        ponto_de_encontro.horario
        
        FROM familia
        INNER JOIN login ON login.id_login = familia.id_vendedor_fk
        INNER JOIN passagem ON passagem.id_passagem = familia.id_passagem_fk
        INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        INNER JOIN ponto_encontro ON ponto_encontro.codigo_familia = familia.codigo_familia
        INNER JOIN ponto_de_encontro ON ponto_de_encontro.id_ponto_encontro = ponto_encontro.id_ponto_de_encontro_fk
       
        WHERE familia.viagem_finalizada = 'NAO' AND 
        familia.id_destino_fk = ? AND familia.codigo_familia = ?  ORDER BY familia.email DESC";

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_destino_fk);
        $stmt->bindValue(2, $codigo_familia);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public function categoria($id_destino_fk, $codigo_familia)
    {
        $sql2 = "SELECT
        categoria.nome_categoria as nomecategoria, 
        COUNT(categoria.nome_categoria) as quantidade
        FROM familia
        INNER JOIN passagem ON passagem.id_passagem = familia.id_passagem_fk
        INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        
        WHERE familia.id_destino_fk = ?
     
        AND familia.codigo_familia = ?
        GROUP BY categoria.id_categoria";

        $stmt2 = Connect::getInstance()->prepare($sql2);
        $stmt2->bindValue(1, $id_destino_fk);
        $stmt2->bindValue(2, $codigo_familia);
        $stmt2->execute();


        if ($stmt2->rowCount() > 0) {
            $resultado = $stmt2->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public static function getValoresFinaisPdf($id_destino_fk, $codigo_familia)
    {
        $sql = "SELECT 
        COUNT(familia.codigo_familia)as NumeroCodigos,
        SUM(familia.valor_de_venda)+hotel_familia.valor as valorTotalFamilia,
        SUM(familia.valor_na_epoca) as valorPassagens,
        familia.codigo_familia,
        familia.valor_de_venda,
        familia.id_vendedor_fk,
        login.nome as vendedor,
        hotel_familia.valor,
        hotel.nome_hotel,
        vaucher.entrada,
        vaucher.forma_de_pagamento,
       	ponto_encontro.id_destino_fk,
        ponto_de_encontro.descricao,
        ponto_de_encontro.horario
        
        FROM familia
        
        INNER JOIN hotel_familia ON hotel_familia.codigo_familia = familia.codigo_familia
        INNER JOIN hotel ON hotel.id_hotel = hotel_familia.id_hotel_fk
        INNER JOIN vaucher ON vaucher.codigo_familia = familia.codigo_familia
        INNER JOIN login ON login.id_login = familia.id_vendedor_fk
        INNER JOIN ponto_encontro ON ponto_encontro.codigo_familia = familia.codigo_familia
        INNER JOIN ponto_de_encontro ON ponto_de_encontro.id_ponto_encontro = ponto_encontro.id_ponto_de_encontro_fk
        
        WHERE familia.viagem_finalizada = 'NAO' AND familia.id_destino_fk = ? AND familia.codigo_familia = ?
        
        GROUP BY familia.codigo_familia";





        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_destino_fk);
        $stmt->bindValue(2, $codigo_familia);
        $stmt->execute();




        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public function pdfPontoEncontro($id_destino_fk, $data_passeio, $fk_login_loja)
    {
        $data_passeio = $data_passeio;
        // $sql = "SELECT * FROM `ponto_encontro` 
        // INNER JOIN familia ON familia.codigo_familia = ponto_encontro.codigo_familia 

        // WHERE familia.id_destino_fk = ?
        // AND familia.dia_viagem = ?
        // AND familia.fk_login_familia_loja = ?

        // GROUP BY ponto_encontro.endereco";

        $sql = "SELECT * FROM ponto_encontro
        INNER JOIN familia ON familia.codigo_familia = ponto_encontro.codigo_familia  	
        INNER JOIN ponto_de_encontro ON ponto_de_encontro.id_ponto_encontro = ponto_encontro.id_ponto_de_encontro_fk
        WHERE familia.id_destino_fk = ?
        AND familia.dia_viagem = ?
        AND familia.fk_login_familia_loja = ?
        GROUP BY familia.codigo_familia";

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_destino_fk);
        $stmt->bindValue(2, $data_passeio);
        $stmt->bindValue(3, $fk_login_loja);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public function infos($id_destino_fk, $data_passeio, $fk_login_loja)
    {

        $data_passeio = $data_passeio;
        // $sql = "SELECT COUNT(categoria.nome_categoria) as CandA FROM familia
        // INNER JOIN passagem ON passagem.id_passagem = familia.id_passagem_fk
        // INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        // WHERE familia.id_destino_fk = ? AND familia.dia_viagem = ? AND familia.fk_login_familia_loja = ?
        // GROUP BY categoria.nome_categoria";

        $sql = "SELECT
        categoria.nome_categoria as nomecategoria, 
        COUNT(categoria.nome_categoria) as quantidade
        FROM familia
        INNER JOIN passagem ON passagem.id_passagem = familia.id_passagem_fk
        INNER JOIN categoria ON categoria.id_categoria = passagem.id_categoria_fk
        
        WHERE familia.id_destino_fk = ?
        AND familia.dia_viagem = ?
        AND familia.fk_login_familia_loja = ?
        
        GROUP BY categoria.id_categoria
        
        ";

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_destino_fk);
        $stmt->bindValue(2, $data_passeio);
        $stmt->bindValue(3, $fk_login_loja);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public function valoresCabecalho($destino, $id_veiculo, $dia_viagem, $categoria, $id_loja)
    {
        $dia_viagem = $dia_viagem;
        $sql = "SELECT * FROM passeio 
        WHERE passeio.id_destino_fk = ?
         AND passeio.id_veiculo_fk = ? 
         AND passeio.dia_viagem = ?
         AND passeio.categoria = ?
         AND passeio.fk_login_passeio_loja = ?";

        
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $destino);
        $stmt->bindValue(2, $id_veiculo);
        $stmt->bindValue(3, $dia_viagem);
        $stmt->bindValue(4, $categoria);
        $stmt->bindValue(5, $id_loja);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }

    public static function placaVeiculo($id_veiculo){
        $sql = "SELECT * FROM veiculo WHERE veiculo.id_veiculo = ?";
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $id_veiculo);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $resultado;
        } else {
            return ["<h1>Foi não</h1>"];
        }
    }
}

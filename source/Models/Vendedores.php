<?php

namespace Source\Models;


Class Vendedores
{

    SELECT
    login.nome,
    passagem.id_destino_fk,
    destinos.nome_destino,
    SUM(passagem.valor) as valor_total_passagens,
    COUNT(vendas.id_passagem_fk) as total_passagens_vendidas
    
    FROM vendas 
    
    INNER JOIN login ON vendas.id_vendedor_login_fk = login.id_login
    INNER JOIN passagem ON vendas.id_passagem_fk = passagem.id_passagem
    INNER JOIN destinos ON passagem.id_destino_fk = destinos.id_destino 
    
    GROUP BY login.nome 
    
    
    
    SELECT
    login.nome,
    passagem.id_destino_fk,
    destinos.nome_destino,
    SUM(passagem.valor) as valor_total_passagens,
    COUNT(familia.id_passagem_fk) as total_passagens_vendidas
    
    FROM familia
    
    INNER JOIN login ON familia.id_vendedor_fk = login.id_login
    INNER JOIN passagem ON familia.id_passagem_fk = passagem.id_passagem
    INNER JOIN destinos ON passagem.id_destino_fk = destinos.id_destino 
    
    GROUP BY login.nome 
}
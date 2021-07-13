SELECT
(SELECT veiculo.id_veiculo FROM `veiculo` WHERE veiculo.id_veiculo = 3) as idVeiculo,
(SELECT veiculo.nome_veiculo FROM `veiculo` WHERE veiculo.id_veiculo = 3) as nomeVeiculo,
(SELECT COUNT(familia.codigo_familia) AS pessoasNoVeiculo FROM `familia` WHERE familia.id_veiculo_fk = 3 AND familia.dia_viagem = '2021-04-30') as pessoasNoVeiculo,
(SELECT capacidade FROM `veiculo` WHERE id_veiculo = 3) as capacidade, 
                (
        
                 (SELECT capacidade FROM `veiculo` WHERE id_veiculo = 3) - (SELECT COUNT(familia.codigo_familia) AS pessoasNoVeiculo FROM `familia` WHERE familia.id_veiculo_fk = 3 AND viagem_finalizada = 'NAO' AND familia.dia_viagem = '2021-04-30')
                
                ) as calculo, 

        
            GROUP BY familia.id_veiculo_fk LIMIT 1
        -- para o get one veiculo
<?php

namespace Source\Controllers;
use Source\Models\Login;
use Source\Database\Connect;

Class ControllerLojas
{


    public function create(Login $l){
        $sql = 'INSERT INTO login 
        (nivel_acesso_fk, email, nome, senha, nome_loja, fk_login_loja, status)
         VALUES (?,?,?,?,?,?,?)';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1,1);
        $stmt->bindValue(2,$l->getEmail());
        $stmt->bindValue(3,$l->getNome());
        $stmt->bindValue(4,$l->getSenha());
        $stmt->bindValue(5,$l->getNomeLoja());
        $stmt->bindValue(6,$l->getFkLoginLoja());
        $stmt->bindValue(7,'ativo');

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Loja Cadastrada com sucesso';
            header('Location:../pages/AdminMaster/Lojas.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Cadastrar Hotel';
            header('Location:../pages/AdminMaster/Lojas.php');
        }

    }



    public function read($fk_loja){
    
        if(isset($_GET['idLoja'])){
            $idLoja = $_GET['idLoja'];
            $sql = "SELECT * FROM login WHERE id_login = '$idLoja'";
        
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return [];
            }

        }else{

            $sql = 'SELECT * FROM login WHERE fk_login_loja = ? AND fk_login_loja != id_login';
        
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(1,$fk_loja);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return [];
            }
        }

    }

    public function estadoLoja(Login $l){
        $sql = 'UPDATE login SET 
        status = ?
        

          WHERE id_login = ?';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $l->getStatus());
        $stmt->bindValue(2, $l->getIdLogin());
        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Loja Desativada com Sucesso';
            header('Location:../pages/AdminMaster/Lojas.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Desativar Loja';
            header('Location:../pages/AdminMaster/Lojas.php');
        }  
    }


    public function update(Login $l){
        $sql = 'UPDATE login SET nome = ?, nome_loja = ?, email = ?, senha = ? WHERE id_login = ?';
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $l->getNome());
        $stmt->bindValue(2, $l->getNomeLoja());
        $stmt->bindValue(3, $l->getEmail());
        $stmt->bindValue(4, $l->getSenha());
        $stmt->bindValue(5, $l->getIdLogin());
    
        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Loja Atualizada com Sucesso';
            header('Location:../pages/AdminMaster/Lojas.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Atualizar Loja';
            header('Location:../pages/AdminMaster/Lojas.php');
        }  
   
    }



}
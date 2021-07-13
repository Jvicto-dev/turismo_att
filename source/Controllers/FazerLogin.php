<?php

namespace Source\Controllers;
use \Source\Models\Login;
use Source\Database\Connect;

class FazerLogin
{
    public function Logar(Login $login){
        
        $sql = 'SELECT 
        login.id_login,
        login.email, 
        login.nome,
        login.nivel_acesso_fk,
        nivel_acesso.nome as nivelAcesso,
        login.fk_login_loja
        FROM login 
        
        INNER JOIN nivel_acesso ON login.nivel_acesso_fk = nivel_acesso.id_nivel_acesso
        
   		
        
        WHERE email = ? AND senha = ?';



        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $login->getEmail());
        $stmt->bindValue(2, $login->getSenha());
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
               
                    session_start();
                       $_SESSION['user'] = $resultado;
                       
                         header('Location:../index.php');
            
          }else{
            header('Location:../../index.php');
        }
    }
}
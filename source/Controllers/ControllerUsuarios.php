<?php

namespace Source\Controllers;
use Source\Models\Login;
use Source\Database\Connect;

Class ControllerUsuarios
{

    public function create(Login $l){
        $sql = 'INSERT INTO login (nivel_acesso_fk, email, senha, nome,fk_login_loja) VALUES (?,?,?,?,?)';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $l->getNivelAcesso());
        $stmt->bindValue(2, $l->getEmail());
        $stmt->bindValue(3, $l->getSenha());
        $stmt->bindValue(4, $l->getNome());
        $stmt->bindValue(5, $l->getFkLoginLoja());

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Usuario Cadastrado com sucesso';
            header('Location:../pages/Administracao/Usuarios.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Cadastrar Usuario';
            header('Location:../pages/Administracao/Usuarios.php');
        }

    }



    public function read($fk_loja){
    
        if(isset($_GET['idUsuario'])){
            $idUsuario = $_GET['idUsuario'];
            $sql = "SELECT 

            login.id_login,
            login.nome,
            login.email,
            login.senha,
            nivel_acesso.nome as nivel
                        
            FROM login 
            INNER JOIN nivel_acesso ON login.nivel_acesso_fk = nivel_acesso.id_nivel_acesso
            WHERE id_login = '$idUsuario'";
        
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return [];
            }

        }else{

            $sql = 'SELECT 

            login.id_login,
            login.nome,
            login.email,
            login.senha,
            nivel_acesso.nome as nivel
                        
            FROM login 
            INNER JOIN nivel_acesso ON login.nivel_acesso_fk = nivel_acesso.id_nivel_acesso WHERE fk_login_loja = ?
                        ';
        
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

    public function update(Login $l){

        $sql = 'UPDATE login SET 
        nivel_acesso_fk = ?,
        email = ?,
        senha = ?,
        nome = ?

          WHERE id_login = ?';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $l->getNivelAcesso());
        $stmt->bindValue(2, $l->getEmail());
        $stmt->bindValue(3, $l->getSenha());
        $stmt->bindValue(4, $l->getNome());
        $stmt->bindValue(5, $l->getIdLogin());

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Usuario Editado com Sucesso';
            header('Location:../pages/Administracao/Usuarios.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Editar Destino';
            header('Location:../pages/Administracao/Usuarios.php');
        }  

    }

    public function delete($id){

        $sql = 'DELETE FROM login WHERE id_login = ?';
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1,$id);

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Usuario Deletado com Sucesso';
            header('Location:../pages/Administracao/Usuarios.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Deletar Usuario';
            header('Location:../pages/Administracao/Usuarios.php');
        }

    }
}
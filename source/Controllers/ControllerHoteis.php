<?php

namespace Source\Controllers;
use Source\Models\Hoteis;
use Source\Database\Connect;

Class ControllerHoteis
{

    public function create(Hoteis $h){
        $sql = 'INSERT INTO hotel (nome_hotel, fk_login_hotel_loja) VALUES (?,?)';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $h->getNome());
        $stmt->bindValue(2, $h->getFkLoginLoja());

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Hotel Cadastrado com sucesso';
            header('Location:../pages/Administracao/Hoteis.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Cadastrar Hotel';
            header('Location:../pages/Administracao/Hoteis.php');
        }

    }



    public function read($id_loja_fk){
    
        if(isset($_GET['idHotel'])){
            $idHotel = $_GET['idHotel'];
            $sql = "SELECT * FROM hotel WHERE id_hotel = '$idHotel'";
        
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return [];
            }

        }else{

            $sql = 'SELECT * FROM hotel WHERE fk_login_hotel_loja = ?';
        
            $stmt = Connect::getInstance()->prepare($sql);
            $stmt->bindValue(1, $id_loja_fk);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $resultado = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                return $resultado;
            }else{
                return [];
            }
        }

    }

    public function update(Hoteis $h){

        $sql = 'UPDATE hotel SET 
        nome_hotel = ?
        

          WHERE id_hotel = ?';

        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1, $h->getNome());
        $stmt->bindValue(2, $h->getIdHotel());
        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Hotel Editado com Sucesso';
            header('Location:../pages/Administracao/Hoteis.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Editar Destino';
            header('Location:../pages/Administracao/Hoteis.php');
        }  

    }

    public function delete($id){

        $sql = 'DELETE FROM hotel WHERE id_hotel = ?';
        $stmt = Connect::getInstance()->prepare($sql);
        $stmt->bindValue(1,$id);

        if($stmt -> execute()){
            session_start();
            $_SESSION['typeMessage'] = 'success';
            $_SESSION['mensagem'] = 'Hotel Deletado com Sucesso';
            header('Location:../pages/Administracao/Hoteis.php');
        }else{
            $_SESSION['typeMessage'] = 'error';
            $_SESSION['mensagem'] = 'Erro ao Deletar Hotel';
            header('Location:../pages/Administracao/Hoteis.php');
        }

    }
}
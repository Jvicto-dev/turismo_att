<?php

namespace Source\api2;
use \Source\Database\Connect;

Class Sql Extends Connect {
    public static function use ($cmd, $array) {
        $pdo = Connect::getInstance();
        $stmt = $pdo->prepare($cmd);
        $stmt->execute($array);
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }
    public static function line($cmd, $array) {

        $pdo = Connect::getInstance();
        $stmt = $pdo->prepare($cmd);
        $stmt->execute($array);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
    
    public static function insert($cmd, $array) {
        $pdo = Connect::getInstance();
        $stmt = $pdo->prepare($cmd);
        @$stmt->execute($array);
        $result = $pdo->lastInsertId();
        return $result;
    }


    public static function insert2($cmd, $array){
 

    }







        // fiz ai, vamo vê se da. deu oh
        public static function delete($cmd,$array){
            $pdo = Connect::getInstance();
            $stmt = $pdo->prepare($cmd);
            $stmt ->execute($array);
            
        }


      

}
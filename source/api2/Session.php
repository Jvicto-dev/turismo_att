<?php

namespace Source\api2;
use \Source\api2\switchs\Swtvendedor;
use \Source\api2\switchs\Swtadministrador;
// use \Source\api2\PersonalClass;
// use \Source\api2\ClientClass;

Class Session Extends Sql {

    public function SelectController($action, $values) {
        // session_start(); // não precisa estartar pois no controller já foi estartada
        $cmd = "SELECT nivel_acesso_fk FROM `login` WHERE id_login=?";
        $response = Sql::line($cmd, [$_SESSION['user'][0]['id_login']]);
        if (($response['nivel_acesso_fk'] == 1) || ($response['nivel_acesso_fk'] == 4)) {
            
            return Swtadministrador::switch($action, $values);

        } else if ($response['nivel_acesso_fk'] == 2) {

            return Swtvendedor::switch($action, $values);
            
        } else if ($response['nivel_acesso_fk'] == 3){

            // return Swtclient::switch($action, $values);

        }
    }
}

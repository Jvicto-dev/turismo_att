<?php

namespace Source\Database;


class Evironment
{
    public static function load($dir)
    {
        // verifica a existencia do arquivo env
        if (!file_exists($dir . '/.env')) {
            return false;
        }

        // Define as variaveis 
        $lines = file($dir . '/.env');

        foreach ($lines as $line) {
            putenv(trim($line));
        }
    }
}

<?php

namespace Source\Database;
use \Source\Database\Evironment;
Evironment::load(__DIR__);
use \PDO;
use \PDOException;

// SUPER GLOBAL 'CONECT'
define("CONECT",[
    'HOST' => getenv('DB_HOST'), 
    'USER' => getenv('DB_USER'),
    'DBNAME' => getenv('DB_NAME'),
    'PASSWD' => getenv('DB_PASSWORD')
]);

class Connect
{
     const OPTIONS = [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8", // pega por padrao utf-8 general_ci
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // sempre trata a exeption como erro 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, // trara todos os resultados como objeto
        PDO::ATTR_CASE => PDO::CASE_NATURAL // existe o case upper e case lower que tras os nomes das colunas do banco de dados em letras maiuscula e minusculas e o natual, da forma como esta escrito no banco
    ];

    private static $instance;

    public static function getInstance():PDO
    
    {
        if(empty(self::$instance)){
            try{
                self::$instance = new PDO(
                    // o nome =>*mysql* se refere ao banco de dados. depois mudar caso seja outro "drive", tipo PostGreeSQL
                    "mysql:host=".CONECT['HOST'].";dbname=".CONECT['DBNAME'],
                    CONECT['USER'],
                    CONECT['PASSWD'],
                    self::OPTIONS
                      
                ); 
            }catch(PDOException $exception){
                die("<h1>Whoops, erro ao Conectar...</h1>");
            }
        }
        return self::$instance;
    }

    /** 
     * dessa forma o usuario nè´™o cria mais de um construtor e nè´™o o clona.
    */
    // final private function __construct(){

    // }

    // final private function __clone(){

    // }
}




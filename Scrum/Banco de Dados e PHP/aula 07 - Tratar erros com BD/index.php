<?php 

    //Tratamento de erros ao tentar se conectar ao banco de dados

    define ("HOST", "localhost");
    define ("DB", "dbphp");
    define ("USER", "root");
    define ("PASS", "909090");


    try{
        $pdo = new PDO("mysql:host=".HOST.";dbname=".DB, USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch(Exception $a){

        //echo "<h1>Erro de conexão ao Banco de Dados!</h1>";
        $err = "<h1>Erro de conexão ao Banco de Dados!</h1>";

    }

    //Outra forma de tratar um erro usando uma estrutura condicional
    if ($a){

        echo $err;
        
    }

?>
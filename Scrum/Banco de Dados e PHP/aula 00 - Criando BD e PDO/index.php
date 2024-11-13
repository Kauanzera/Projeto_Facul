<?php 

    //$pdo -> Classe nativa do php para gerencia de banco de dados
    $pdo = new PDO("mysql:host=localhost;dbname=databasephp", "root", "");
    //Conexão do php com o banco de dados
    echo "Conexão com o banco de dados realizada!<br>";
    echo 'Comando utilizado - $pdo = new PDO("mysql:host=localhost;dbname=databasephp", "root", "");';

?>
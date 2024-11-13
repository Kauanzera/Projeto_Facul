<?php 

    $pdo = new PDO("mysql:host=localhost;dbname=dbphp", 'root', '');

    //Trava a tabela declarada fazendo com que a prox pagina seja forçada a esperar até que algo aconteça
    $pdo->exec("LOCK TABLE clientes WRITE");

    sleep(10);

?>
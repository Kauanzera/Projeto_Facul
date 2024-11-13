<?php 

    $pdo = new PDO("mysql:host=localhost;dbname=dbphp", 'root', '');

    $aloha = $pdo->prepare("SELECT * FROM clientes");

    $aloha->execute();

    $user = $aloha -> fetchAll();

    foreach ($user as $key => $value) {
        echo $value['nome'] . " <hr>";
    }

?>
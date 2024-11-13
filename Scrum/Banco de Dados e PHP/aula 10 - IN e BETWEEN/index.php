<?php 

    $pdo = new PDO("mysql:host=localhost;dbname=dbphp", 'root', '');

    //IN: Verifica e age, se a condição está dentro dos argumentos declarados
    $sql = $pdo->prepare("SELECT * FROM clientes WHERE id IN (1, 3)");

    $sql->execute();
    $email = $sql->fetchAll();

    foreach ($email as $key => $value) {
        echo $value['nome'] . "<HR>";
    }

?>
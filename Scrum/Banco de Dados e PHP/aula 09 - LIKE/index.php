<?php 

    $pdo = new PDO('mysql:host=localhost;dbname=dbphp', 'root', '');

    //LIKE: Usando a %, define se existe o argumento declarado dentro da tabela (%...%), se começa com o argumento (...%) ou se termina (%...)
    $sql = $pdo->prepare("SELECT * FROM teste WHERE email LIKE '%kauan%'");

    $sql->execute();
    $email = $sql->fetchAll();

    foreach ($email as $key => $value) {
        echo $value['email'] . "<HR>";
    }
    
?>
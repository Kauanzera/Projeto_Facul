<?php 

    $pdo = new PDO('mysql:host=localhost;dbname=dbphp', 'root', '');
    
    //LEFT JOIN: Retorna informações da tabela da esquerda ("clientes" nesse caso) mesmo se a coluna da tabela estiver vazia
    //RIGHT JOIN: Retorna informações da tabela da direita ("cargos" nesse caso) mesmo se a coluna da tabela estiver vazia
    $sql = $pdo->prepare("SELECT * FROM clientes LEFT JOIN cargos ON clientes.cargo = cargos.id");

    $sql->execute();
    $clientes = $sql->fetchAll();

    foreach ($clientes as $key => $value) {
        
        echo $value['nome'] . " | " . $value['nome_cargo'] . " <hr>";

    }

?>
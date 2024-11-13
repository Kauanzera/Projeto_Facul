<?php 

    $pdo = new PDO('mysql:host=localhost;dbname=dbphp', 'root', '');
    
    //GROUP BY: Agrupa uma quantidade de informações dentro de um tipo de coluna e imprime apenas a primeira do grupo.
    //LIMIT: Limite imposto sobre o retorno de informações da coluna.
    //ORDER BY: Ordem na qual será retornada as informações da coluna, usado por padrão antes do LIMIT
    //ASC: Ordem crescente ou ordem alfabética
    //DESC: Ordem decrescente ou ordem alfabética ao contrário
    //LIMIT com vírgula: Retorna o valor do ínicio e a quantidade de valores limite para ser retornado.
    $sql = $pdo->prepare("SELECT * FROM clientes ORDER BY id ASC LIMIT 0,3");


    $sql->execute();
    $clientes = $sql->fetchAll();

    foreach ($clientes as $key => $value) {
        
        echo $value['nome'] . " <hr>";

    }

?>
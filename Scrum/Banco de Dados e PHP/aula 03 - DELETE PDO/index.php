<?php 

    $pdo = new PDO('mysql:host=localhost;dbname=databasephp', 'root', '');

    $id = 1;

    $sql = $pdo->prepare("DELETE FROM `clientes` WHERE id=$id");

    if ($sql->execute()){
        echo "Cliente Deletado com Sucesso!";
    }


/*
 *  Usando outra sintaxe mais segura para o Banco de Dados:
 * 
 *  $sql = $pdo->prepare("DELETE FROM `clientes` WHERE id=?");
 * 
 *  if ($sql->execute(array($id))){
 *      echo "Cliente Deletado com sucesso!";
 *  }
 */


?>
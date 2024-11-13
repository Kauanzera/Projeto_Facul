<?php   //Como inserir clientes no banco de dados através de um formulário

    $titulo = "Dados Via Formulário";
    include('corpo.php');

    //Conexão com o banco de dados local
    $pdo = new PDO("mysql:host=localhost;dbname=databasephp", "root", "");  

/*  
    Inserindo informações manualmente no banco de dados, dentro da tabela clientes
    $sql = $pdo->prepare("INSERT INTO `clientes` VALUES (null, 'Kauan', 'Oliveira', '2024-09-06 17:59:00')");
*/

    //Informando para usar o fuso horário de São Paulo 'GMT -03:00'
    date_default_timezone_set('America/Sao_Paulo');

    //Inserindo dados via formulários no banco de dados local, dentro da tabela clientes
    if (isset($_POST['acao'])){
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $hora_registro = date('Y-m-d H:i:s'); 

        //Pode sim inserir as variáveis no lugar dos ?, mas irá ter brechas na segurança do banco de dados, assim, podendo entrar tags maliciosas para invasões
        $sql = $pdo->prepare("INSERT INTO `clientes` VALUES (null, ?, ?, ?)");  
  
        //Executando a váriavel de uma forma segura para o banco de dados, impedindo a entrada de tags maliciosas no script
        $sql->execute(array($nome, $sobrenome, $hora_registro));          #O PDO que impede a entrada

/*
        Executando a variável que recebeu o comando de inserção de dados, para que a informação entre no banco de dados local
        $sql->execute();
*/

        echo "<br>Cliente inserido com sucesso!";

    }
    

?>
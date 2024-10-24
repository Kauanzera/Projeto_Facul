<?php   //Que os jogos comecem ;-;      • 20/10/24 •

    //Conexão com o banco de dados Local (Por enquanto (eu acho))
    $pdo = new PDO("mysql:host=localhost;dbname=gerenciador_tarefas", "root", "");

    //Data e hora padrão do site: São Paulo 'GMT -03:00'
    date_default_timezone_set('America/Sao_Paulo');
    
    //Tentativa falha de uma possível conexão da criação de um template a tabela `projeto` do banco de dados
    if(isset($_POST['salvar-template'])){
        $nomeTemplate = $_POST['template-name'];
        $desc = $_POST['num-columns'];
        
        $sql = $pdo->prepare("INSERT INTO `projetos` VALUES (null, ?, ?, null)");
        
        $sql->execute(array($nomeTemplate, $desc));
    }
    
    
    //ODEIO PHP

?>
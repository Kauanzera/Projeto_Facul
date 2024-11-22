<?php   // Que os jogos comecem ;-;      • 20/10/24 •

    include('index.php');

    // Conexão com o banco de dados
    $pdo = new PDO("mysql:host=localhost;dbname=gerenciador_tarefas", "root", " ");

    // Data e hora padrão do site: São Paulo 'GMT -03:00'
    date_default_timezone_set('America/Sao_Paulo');


    // Atribuição das informações de criação de Template a tabela `projetos`
    if(isset($_POST['salvar-template'])){
        $nomeTemplate = $_POST['template-name'];
        $categoriaTemplate = $_POST['template-category'];
        $descricaoTemplate = $_POST['template-description'];
        
        $sql = $pdo->prepare("INSERT INTO `projetos` VALUES (null, ?, ?, ?)");
        
        $sql->execute(array($nomeTemplate, $categoriaTemplate, $descricaoTemplate));
            
    }

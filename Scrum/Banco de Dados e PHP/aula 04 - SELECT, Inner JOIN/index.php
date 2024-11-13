<?php 

    $pdo = new PDO('mysql:host=localhost;dbname=databasephp', 'root', ''); 
    
    /*
     
    $sql = $pdo -> prepare("SELECT * FROM posts");
 
    $sql->execute();
 
    $info = $sql -> fetchAll();

    */


    /* -> Puxando os Dados de uma tabela diretamente do Banco de Dados

    foreach($info as $key => $value){
        echo 'Titulo: '.$value['titulo'].'<br>';
        echo 'Noticias: '.$value['conteudo'].'<br><hr>';
    }

    for($i = 0; $i < count($info); $i++){
        echo "Titulo: " . $info[$i]['titulo'] . '<br>';
        echo "Conteúdo: " . $info[$i]['conteudo'] . '<br><hr>';
    }
    
    */
    
    
    $sql = $pdo -> prepare("SELECT posts . *, categorias . *, posts.id AS post_id FROM posts INNER JOIN categorias ON posts.categoria_id = categorias.id");

    $sql->execute();
 
    $info = $sql -> fetchAll(PDO::FETCH_ASSOC);


    echo "<pre>";
    print_r($info);
    echo "</pre>";

?>
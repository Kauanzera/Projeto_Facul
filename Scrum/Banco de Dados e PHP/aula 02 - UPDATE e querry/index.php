<?php   //Atualização de dados dentro de uma tabela no banco de dados 'UPDATE'

    $pdo = new PDO('mysql:host=localhost;dbname=databasephp', 'root', '');

    $id = 2;

    //Irá atribuir o valor declarado à coluna descrita.
    $sql = $pdo->prepare("UPDATE `clientes` SET nome='Léo', sobrenome='Santanna' WHERE id=$id /*ou id=2*/ ");


/** Outra Sintaxe: 
 *  $sql = $pdo->prepare("UPDATE `clientes` SET nome='Léo', sobrenome='Santanna' WHERE nome='Deolane' AND sobrenome='Bezerra'");
 *  Mexendo assim, nos campos nos quais o nome e o sobrenome foram iguais aos declarados
 * 
*/

    if ($sql->execute()){
        echo "Cliente atualizado com Sucesso!"; 
    }

?>
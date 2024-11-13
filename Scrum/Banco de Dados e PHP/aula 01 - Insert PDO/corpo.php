<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo?></title>
</head>
<body>
    <form method="post">

        Nome <br><input type="text" name="nome" required><br><br>
        Sobrenome <br><input type="text" name="sobrenome" required><br><br>
        <input type="submit" name="acao" value="Enviar">

    </form>

    
</body>
</html>
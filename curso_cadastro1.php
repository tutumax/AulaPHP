<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <?php include "menu.php" ?>

    <div class="conteudo">
        <h3>Confirmação de cadastro</h3>


    <?php

        if ( isset($_REQUEST["enviar"]) )
        {
            include "conexao.php";

            $nome = $_REQUEST["nome"];
            $coordenador = $_REQUEST["coordenador"];

            $sql = "insert into curso (codigo, nome, coordenador) 
                    VALUES (codigo, :nome, :coordenador)";

            $result = $conexao->prepare($sql);
            $result->bindValue(":nome", $nome);
            $result->bindValue(":coordenador", $coordenador);
            $result->execute();

            echo "<p>Curso cadastrado com sucesso!</p>";
        }
    
    ?>

        <a href="curso_cadastro.php">Voltar</a>
    </div>
    
</body>
</html>
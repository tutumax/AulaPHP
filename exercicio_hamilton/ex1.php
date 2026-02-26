<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='POST' name='sistema' action='ex1.php'>
        <p>Digite o seu nome?</p> <br>
        <input type='text' name='nome'><br>

        <p>Digite a sua nota 1?</p> <br>
        <input type='text' name='nota1'><br>

        <p>Digite a sua nota 2?</p> <br>
        <input type='text' name='nota2'><br>

        <p>Digite a sua nota 3?</p> <br>
        <input type='text' name='nota3'><br>

        <p>Digite a sua nota 4?</p> <br>
        <input type='text' name='nota4'><br>

        <input type='submit' value='enviar' name='enviar'>
    </form>
</body>
<?php
    if(isset($_REQUEST['enviar'])){
        $nome = ($_REQUEST['nome']);
        $nota1 = $_REQUEST['nota1'];
        $nota2 = $_REQUEST['nota2'];
        $nota3 = $_REQUEST['nota3'];
        $nota4 = $_REQUEST['nota4'];

        $media = ($nota1 + $nota2 + $nota3 + $nota4) / 4;
        if($media >= 7.5 ){
            echo"Aprovado!Suas notas são $nota1,$nota2,$nota3,$nota4.Sua média é $media";
        }
        else{
            echo"Reprovado!Suas notas são $nota1,$nota2,$nota3,$nota4.Sua média é $media";
        };

    }

?>
</html>
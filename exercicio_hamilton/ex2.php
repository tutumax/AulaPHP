<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='POST' name='sistema' action='ex1.php'>
        <p>Digite o seu salário base?</p> <br>
        <input type='text' name='salario'><br>

        <p>Digite as suas horas extras?</p> <br>
        <input type='text' name='horasextras'><br>

        <p>Digite o valor das horas extras?</p> <br>
        <input type='text' name='valorextras'><br>

        <p>Digite número de dependentes?</p> <br>
        <input type='text' name='numero'><br>

        <p>Digite o nome dos funcionários?</p> <br>
        <input type='text' name='nome'><br>

        <input type='submit' value='enviar' name='enviar'>
    </form>
</body>
<?php
    if(isset($_REQUEST['enviar'])){
        $salario = ($_REQUEST['salario']);
        $horasextras = $_REQUEST['horasextras'];
        $valorextras = $_REQUEST['valorextras'];
        $numero = $_REQUEST['numero'];
        $nome = $_REQUEST['nome'];

        $salario_bruto = $salario + ($horasextras * $valorextras)+($numero * 45,00)

        if($salario_bruto < 1659,38){
            $inss = $salario_bruto * 0.08;
        }
        elseif($salario_bruto ) 1659,38 && 2.826){
            $inss = $salario_bruto * 0.08;
        }
    }

?>
</html>
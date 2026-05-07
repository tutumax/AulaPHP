<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method='POST' name='formulario' action='index.php'>
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

        $salario_bruto = $salario + ($horasextras * $valorextras)+($numero * 45.00);

        if($salario_bruto < 1659.38){
            $inss = $salario_bruto * 0.08;
        }
        elseif($salario_bruto > 1659.38 && $salario_bruto < 2765){
            $inss = $salario_bruto * 0.09;
        }
        elseif($salario_bruto > 2765 && $salario_bruto < 5531){
            $inss = $salario_bruto * 0.11;
        }
        elseif($salario_bruto > 5531){
            $inss = 608.44;
        };

        if($salario_bruto <1903.98){
            $ir = 0;
        }
        elseif($salario_bruto > 1903.98 && $salario_bruto < 2826){
            $ir = $salario_bruto * 0.075;
        }
        elseif($salario_bruto > 2826 && $salario_bruto < 3751){
            $ir = $salario_bruto * 0.15;
        }
        elseif($salario_bruto > 3751 && $salario_bruto < 4664.68){
            $ir = $salario_bruto * 0.225;
        }
        elseif($salario_bruto > 4664.68){
            $ir = $salario_bruto * 0.275;
        };


        



        $salarioliquido = $salario_bruto - $inss - $ir;

        echo"Ola $nome, seu salario base: $salario, seu salario base: $salario_bruto ; suas horas extras: $horasextras e o valor: $valorextras ; seu número de dependentes: $numero ;
        seu inss : $inss ; seu ir : $ir ; salario final: $salarioliquido";

    }   

?>
</html>
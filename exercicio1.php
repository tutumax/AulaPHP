<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio1</title>
</head>
<body>
    <h1>Exercicio de PHP </h1>
    <form action="exercicio1.php" method="post">
        <p>Digite o nome do cliente<br>
            <input type="text" name="cliente">
        </p>

        <p>Digite o sexo do cliente<br>
            <input type="radio" name="sexo" value="masculino"> Masculino <br>
            <input type="radio" name="sexo" value="feminino"> Femenino <br>
        </p>

        <p>Digite o valor da compra<br>
            <input type="text" name="valor">
        </p>

        <p>
            <input type="submit" name="Calcular" value="Calcular">
        </p>
    </form>

    <?php
        if(isset($_REQUEST['Calcular'])){

            $nome = $_REQUEST['cliente'];
            $sexo = $_REQUEST['sexo'];
            $valor = $_REQUEST['valor'];
            $desconto = 0;
            $valorfinal = 0;


            if($sexo == 'feminino'){
                $valorfinal = $valor * 0.80;
                $desconto = $valor - $valorfinal;
                echo $valorfinal;
                echo $nome;
                echo $sexo;
            }
            if($sexo == 'masculino'){
                $valorfinal = $valor * 0.95;
                $desconto = $valor - $valorfinal;
                echo $valorfinal;
                echo $nome;
                echo $sexo;
            }

        }
    ?>
</body>
</html>
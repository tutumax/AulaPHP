<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Funcionários</title>
</head>

<?php

require_once "conexao.php";

$row = false;

/*
|--------------------------------------------------------------------------
| BUSCAR FUNCIONÁRIO
|--------------------------------------------------------------------------
*/

try {

    if (isset($_GET["al"]) && !empty($_GET["al"])) {

        $id_funcionarios = $_GET["al"];

        $sqlSelect = $conn->prepare("
            SELECT *
            FROM empresa
            WHERE id_funcionarios = :id_funcionarios
        ");

        $sqlSelect->bindValue(
            ":id_funcionarios",
            $id_funcionarios,
            PDO::PARAM_INT
        );

        $sqlSelect->execute();

        $row = $sqlSelect->fetch(PDO::FETCH_ASSOC);

        /*
        | Se não encontrou o funcionário
        */
        if (!$row) {

            echo "<script>
                    alert('Funcionário não encontrado!');
                    window.location.href = 'form_folha.php';
                  </script>";

            exit;
        }
    } else {

        echo "<script>
                alert('ID do funcionário não informado!');
                window.location.href = 'form_folha.php';
              </script>";

        exit;
    }

} catch (PDOException $erro) {

    echo "Erro ao buscar funcionário: " . $erro->getMessage();
    exit;
}


/*
|--------------------------------------------------------------------------
| ALTERAR FUNCIONÁRIO
|--------------------------------------------------------------------------
*/

if (isset($_POST["Alterar"])) {

    try {

        $id_funcionarios = $_POST["id_funcionarios"];
        $nome = $_POST["nome"];

        $salariob = (float) $_POST["salarioB"];
        $horas = (float) $_POST["numeroHE"];
        $valorh = (float) $_POST["valorHE"];
        $dependentes = (int) $_POST["numeroD"];


        /*
        |--------------------------------------------------------------------------
        | CÁLCULO DO SALÁRIO BRUTO
        |--------------------------------------------------------------------------
        */

        $salariobru =
            $salariob +
            ($horas * $valorh) +
            ($dependentes * 45);


        /*
        |--------------------------------------------------------------------------
        | CÁLCULO DO INSS
        |--------------------------------------------------------------------------
        */

        if ($salariobru < 1659.38) {

            $inss = $salariob * 0.08;

        } elseif ($salariobru < 2765.67) {

            $inss = $salariob * 0.09;

        } elseif ($salariobru <= 5531.31) {

            $inss = $salariob * 0.11;

        } else {

            $inss = 608.44;
        }


        /*
        |--------------------------------------------------------------------------
        | CÁLCULO DO IR
        |--------------------------------------------------------------------------
        */

        if ($salariobru < 1903.98) {

            $Irenda = 0;

        } elseif ($salariobru < 2826.65) {

            $Irenda = $salariob * 0.075;

        } elseif ($salariobru < 3751.06) {

            $Irenda = $salariob * 0.15;

        } elseif ($salariobru <= 4664.68) {

            $Irenda = $salariob * 0.225;

        } else {

            $Irenda = $salariob * 0.275;
        }


        /*
        |--------------------------------------------------------------------------
        | SALÁRIO LÍQUIDO
        |--------------------------------------------------------------------------
        */

        $salarioliq =
            $salariobru -
            $inss -
            $Irenda;


        /*
        |--------------------------------------------------------------------------
        | ATUALIZAR BANCO
        |--------------------------------------------------------------------------
        */

        $sqlUpdate = $conn->prepare("
            UPDATE empresa SET

                nome = :nome,
                salariob = :salariob,
                horas = :horas,
                valorh = :valorh,
                dependentes = :dependentes,
                salariobru = :salariobru,
                salarioliq = :salarioliq,
                Irenda = :Irenda,
                inss = :inss

            WHERE id_funcionarios = :id_funcionarios
        ");


        $sqlUpdate->bindValue(
            ":id_funcionarios",
            $id_funcionarios,
            PDO::PARAM_INT
        );

        $sqlUpdate->bindValue(
            ":nome",
            $nome
        );

        $sqlUpdate->bindValue(
            ":salariob",
            $salariob
        );

        $sqlUpdate->bindValue(
            ":horas",
            $horas
        );

        $sqlUpdate->bindValue(
            ":valorh",
            $valorh
        );

        $sqlUpdate->bindValue(
            ":dependentes",
            $dependentes,
            PDO::PARAM_INT
        );

        $sqlUpdate->bindValue(
            ":salariobru",
            $salariobru
        );

        $sqlUpdate->bindValue(
            ":salarioliq",
            $salarioliq
        );

        $sqlUpdate->bindValue(
            ":Irenda",
            $Irenda
        );

        $sqlUpdate->bindValue(
            ":inss",
            $inss
        );


        $sqlUpdate->execute();


        echo "<script>

                alert('Alteração efetuada com sucesso!');

                window.location.href =
                    'alterar.php?al=" . $id_funcionarios . "';
              </script>";
        exit;
    } catch (PDOException $erro) {
        echo "Erro ao alterar funcionário: " .
             $erro->getMessage();
        exit;
    }
}
?>
<body>
    <h2>Alterar informações do Funcionário</h2>
    <fieldset>
        <form name="Alterar" method="POST" action="alterar.php?al=<?php echo htmlspecialchars($row['id_funcionarios']); ?>">
            <p>Id do funcionário</p>
            <input
                type="text" name="id_funcionarios" value="<?php($row['id_funcionarios']); ?>"readonly >
            <p>Digite seu nome</p>
            <input type="text" name="nome" value="<?php ($row['nome']); ?>"required>
            <p>Digite seu salário base:</p>
            <input type="number" name="salarioB" value="<?php ($row['salariob']); ?>"required>
            <p>Digite seu número de horas extras:</p>
            <input type="number"  name="numeroHE"  value="<?php ($row['horas']); ?>"required>
            <p>Digite o valor das horas extras:</p>
            <input type="number" name="valorHE" value="<?php ($row['valorh']); ?>"required>
            <p>Digite o número de dependentes:</p>
            <input type="number" name="numeroD"value="<?php ($row['dependentes']); ?>" required>
            <br><br>
            <inputtype="submit" value="Alterar"name="Alterar">
            <a href="form_folha.php"> Volta</a>
        </form>
    </fieldset>
</body>
</html>
<?php
require_once "conexao.php";
$time1 = $_POST["time1"] ?? "TIME 1";
$time2 = $_POST["time2"] ?? "TIME 2";

$pontos1 = $_POST["pontos1"] ?? 0;
$pontos2 = $_POST["pontos2"] ?? 0;

if (isset($_POST["mais1"])) $pontos1++;
if (isset($_POST["mais2"])) $pontos1 += 2;
if (isset($_POST["mais3"])) $pontos1 += 3;
if (isset($_POST["menos1"])) $pontos1 = max(0, $pontos1 - 1);
if (isset($_POST["mais1b"])) $pontos2++;
if (isset($_POST["mais2b"])) $pontos2 += 2;
if (isset($_POST["mais3b"])) $pontos2 += 3;
if (isset($_POST["menos1b"])) $pontos2 = max(0, $pontos2 - 1);
if (isset($_POST["enviar"])) {
     try{
        

        $sqlInsert = $conn->prepare("insert into placar(id,time1,pontos1,time2,pontos2)
        values(:id,:time1,:pontos1,:time2,:pontos2)");

        $sqlInsert->bindValue(":id",null);
        $sqlInsert->bindValue(":time1", $time1);
        $sqlInsert->bindValue(":pontos1", $pontos1);
        $sqlInsert->bindValue(":time2", $time2);
        $sqlInsert->bindValue(":pontos2", $pontos2);

        $sqlInsert -> execute();

       echo "<script>
        alert('Dados gravados com sucesso!');
        location.href = 'placar.php';
      </script>";

    }
    catch(PDOException $erro){
        echo $erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placar de Basquete</title>
</head>

<body>

<div class="placar">

    <h1>PLACAR DE BASQUETE</h1>

    <form method="POST">

        <div class="times">

            <div class="time">

                <input type="text" name="time1" value="<?php echo $time1; ?>">

                <div class="pontos">
                    <?php echo $pontos1; ?> </div>

                <button name="mais1">+1</button>
                <button name="mais2">+2</button>
                <button name="mais3">+3</button>
                <button name="menos1">-1</button>

            </div>


            <div class="versus">
                VS
            </div>


            <div class="time">

                <input type="text" name="time2"
                       value="<?php echo $time2; ?>">

                <div class="pontos">
                    <?php echo $pontos2; ?>
                </div>

                <button name="mais1b">+1</button>
                <button name="mais2b">+2</button>
                <button name="mais3b">+3</button>
                <button name="menos1b">-1</button>

            </div>

        </div>

        <input type="hidden" name="pontos1"
               value="<?php echo $pontos1; ?>">

        <input type="hidden" name="pontos2"
               value="<?php echo $pontos2; ?>">

        <button class="enviar" name="enviar">
            Enviar Valores
        </button>
        <a href="classificacao.php">
        <button type="button" class="classificacao">
            CLASSIFICAÇÃO
        </button>
        </a>


</div>
</body>
</html>

<?php
require_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classificação</title>
</head>
<body>
<h1>Classificação</h1>
<table border="1">
    <tr>
        <th>POS</th>
        <th>TIME</th>
        <th>PONTOS</th>
    </tr>
    
<?php

try {

    $sql = $conn->prepare("
        SELECT time, SUM(pontos) AS total
        FROM (
            SELECT time1 AS time, pontos1 AS pontos FROM placar
            UNION ALL
            SELECT time2 AS time, pontos2 AS pontos FROM placar
        ) AS tabela
        GROUP BY time
        ORDER BY total DESC
    ");
    $sql->execute();
    $posicao = 1;
    while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
?>

    <tr>
        <td><?php echo $posicao; ?></td>
        <td><?php echo $row["time"]; ?></td>
        <td><?php echo $row["total"]; ?></td>
    </tr>
<?php
        $posicao++;
    }

}
catch(PDOException $erro)
{
    echo $erro->getMessage();
}

?>

</table>
    <a href="placar.php">
        <button type="button" class="placar">
            PLACAR
        </button>
        </a>
</body>
</html>

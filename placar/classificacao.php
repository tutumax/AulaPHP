```php id="7m2qpx"
<?php
require_once "conexao.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Classificação</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-dark">

<div class="container py-5">

    <div class="card shadow-lg border-0">

        <!-- TÍTULO -->
        <div class="card-header bg-primary text-white text-center py-3">

            <h1 class="mb-0">
                🏆 CLASSIFICAÇÃO
            </h1>

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped table-hover table-bordered text-center align-middle mb-0">

                    <thead class="table-dark">

                        <tr>

                            <th>
                                POS
                            </th>

                            <th>
                                TIME
                            </th>

                            <th>
                                PONTOS
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php

                    try {

                        $sql = $conn->prepare("

                            SELECT time, SUM(pontos) AS total

                            FROM (

                                SELECT
                                    time1 AS time,
                                    pontos1 AS pontos
                                FROM placar

                                UNION ALL

                                SELECT
                                    time2 AS time,
                                    pontos2 AS pontos
                                FROM placar

                            ) AS tabela

                            GROUP BY time

                            ORDER BY total DESC

                        ");

                        $sql->execute();

                        $posicao = 1;


                        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <tr>

                            <td class="fw-bold">

                                <?php
                                echo $posicao . "º";
                                ?>

                            </td>


                            <td class="fw-bold">

                                <?php
                                echo htmlspecialchars($row["time"]);
                                ?>

                            </td>


                            <td>

                                <span class="badge bg-primary fs-6">

                                    <?php
                                    echo $row["total"];
                                    ?>

                                    pontos

                                </span>

                            </td>

                        </tr>

                    <?php

                            $posicao++;

                        }

                    } catch (PDOException $erro) {

                    ?>

                        <tr>

                            <td colspan="3"
                                class="text-danger fw-bold">

                                Erro ao carregar a classificação:
                                <?php echo htmlspecialchars($erro->getMessage()); ?>

                            </td>

                        </tr>

                    <?php
                    }

                    ?>

                    </tbody>

                </table>

            </div>


            <!-- BOTÃO VOLTAR -->

            <div class="d-grid mt-4">

                <a
                    href="placar.php"
                    class="btn btn-primary btn-lg">

                    🏀 Voltar para o Placar

                </a>

            </div>

        </div>

    </div>

</div>

</body>

</html>

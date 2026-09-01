```php
<?php
require_once "conexao.php";

$time1 = $_POST["time1"] ?? "TIME 1";
$time2 = $_POST["time2"] ?? "TIME 2";

$pontos1 = $_POST["pontos1"] ?? 0;
$pontos2 = $_POST["pontos2"] ?? 0;

// Pontos do Time 1
if (isset($_POST["mais1"])) {
    $pontos1++;
}

if (isset($_POST["mais2"])) {
    $pontos1 += 2;
}

if (isset($_POST["mais3"])) {
    $pontos1 += 3;
}

if (isset($_POST["menos1"])) {
    $pontos1 = max(0, $pontos1 - 1);
}

// Pontos do Time 2
if (isset($_POST["mais1b"])) {
    $pontos2++;
}

if (isset($_POST["mais2b"])) {
    $pontos2 += 2;
}

if (isset($_POST["mais3b"])) {
    $pontos2 += 3;
}

if (isset($_POST["menos1b"])) {
    $pontos2 = max(0, $pontos2 - 1);
}

// Salvar placar
if (isset($_POST["enviar"])) {

    try {

        $sqlInsert = $conn->prepare("
            INSERT INTO placar
            (id, time1, pontos1, time2, pontos2)
            VALUES
            (:id, :time1, :pontos1, :time2, :pontos2)
        ");

        $sqlInsert->bindValue(":id", null);
        $sqlInsert->bindValue(":time1", $time1);
        $sqlInsert->bindValue(":pontos1", $pontos1);
        $sqlInsert->bindValue(":time2", $time2);
        $sqlInsert->bindValue(":pontos2", $pontos2);

        $sqlInsert->execute();

        echo "<script>
            alert('Dados gravados com sucesso!');
            location.href = 'placar.php';
        </script>";

    } catch (PDOException $erro) {

        echo "Erro: " . $erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Placar de Basquete</title>

    <!-- Bootstrap 5 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body class="bg-dark">

<div class="container py-5">

    <div class="card shadow-lg">

        <!-- TÍTULO -->
        <div class="card-header bg-primary text-white text-center">

            <h1 class="mb-0">
                 PLACAR DE BASQUETE
            </h1>

        </div>


        <div class="card-body">

            <form method="POST">

                <div class="row align-items-center">


                    <!-- TIME 1 -->
                    <div class="col-md-5 text-center">

                        <input
                            type="text"
                            name="time1"
                            class="form-control form-control-lg text-center fw-bold mb-3"
                            value="<?php echo htmlspecialchars($time1); ?>"
                        >

                        <h2 class="display-1 fw-bold text-primary">
                            <?php echo $pontos1; ?>
                        </h2>

                        <div class="d-grid gap-2 mt-4">

                            <button
                                type="submit"
                                name="mais1"
                                class="btn btn-success btn-lg">
                                +1
                            </button>

                            <button
                                type="submit"
                                name="mais2"
                                class="btn btn-success btn-lg">
                                +2
                            </button>

                            <button
                                type="submit"
                                name="mais3"
                                class="btn btn-success btn-lg">
                                +3
                            </button>

                            <button
                                type="submit"
                                name="menos1"
                                class="btn btn-danger btn-lg">
                                -1
                            </button>

                        </div>

                    </div>


                    <!-- VS -->
                    <div class="col-md-2 text-center">

                        <h2 class="fw-bold text-secondary my-4">
                            VS
                        </h2>

                    </div>


                    <!-- TIME 2 -->
                    <div class="col-md-5 text-center">

                        <input
                            type="text"
                            name="time2"
                            class="form-control form-control-lg text-center fw-bold mb-3"
                            value="<?php echo htmlspecialchars($time2); ?>"
                        >

                        <h2 class="display-1 fw-bold text-danger">
                            <?php echo $pontos2; ?>
                        </h2>

                        <div class="d-grid gap-2 mt-4">

                            <button
                                type="submit"
                                name="mais1b"
                                class="btn btn-success btn-lg">
                                +1
                            </button>

                            <button
                                type="submit"
                                name="mais2b"
                                class="btn btn-success btn-lg">
                                +2
                            </button>

                            <button
                                type="submit"
                                name="mais3b"
                                class="btn btn-success btn-lg">
                                +3
                            </button>

                            <button
                                type="submit"
                                name="menos1b"
                                class="btn btn-danger btn-lg">
                                -1
                            </button>

                        </div>

                    </div>

                </div>


                <!-- PONTOS OCULTOS -->

                <input
                    type="hidden"
                    name="pontos1"
                    value="<?php echo $pontos1; ?>"
                >

                <input
                    type="hidden"
                    name="pontos2"
                    value="<?php echo $pontos2; ?>"
                >


                <hr class="my-4">


                <!-- BOTÕES -->

                <div class="d-grid gap-2">

                    <button
                        type="submit"
                        name="enviar"
                        class="btn btn-primary btn-lg">
                        Enviar Valores
                    </button>

                    <a
                        href="classificacao.php"
                        class="btn btn-outline-dark btn-lg">
                         Classificação
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>

</html>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

<?php
require_once "conexao.php";

if (isset($_POST['enviar'])) {

    try {

        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
        $serie = $_POST['serie'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $responsavel = $_POST['responsavel'];
        $escola = $_POST['escola'];
        $endereco = $_POST['endereco'];

        $sqlInsert = $conn->prepare("
            INSERT INTO pacientes
            (nome, data_nascimento, serie, cpf, rg, telefone, responsavel, escola, endereco)
            VALUES
            (:nome, :data_nascimento, :serie, :cpf, :rg, :telefone, :responsavel, :escola, :endereco)
        ");

        $sqlInsert->bindValue(":nome", $nome);
        $sqlInsert->bindValue(":data_nascimento", $data_nascimento);
        $sqlInsert->bindValue(":serie", $serie);
        $sqlInsert->bindValue(":cpf", $cpf);
        $sqlInsert->bindValue(":rg", $rg);
        $sqlInsert->bindValue(":telefone", $telefone);
        $sqlInsert->bindValue(":responsavel", $responsavel);
        $sqlInsert->bindValue(":escola", $escola);
        $sqlInsert->bindValue(":endereco", $endereco);

        $sqlInsert->execute();

        echo "
        <script>
            alert('Dados gravados com sucesso!');
            window.location.href = 'cadastro.php';
        </script>
        ";

    } catch (PDOException $erro) {
        echo "Erro ao cadastrar: " . $erro->getMessage();
    }
}


if (isset($_GET["ex"])) {

    try {

        $id = $_GET["ex"];

        $sqlDelete = $conn->prepare("
            DELETE FROM pacientes
            WHERE id = :id
        ");

        $sqlDelete->bindValue(":id", $id);
        $sqlDelete->execute();

        header("Location: cadastro.php");
        exit;

    } catch (PDOException $erro) {
        echo "Erro ao excluir: " . $erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro de Pacientes</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background-color: #f4f8fc;
            color: #1f2937;
        }

        .navbar {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        }

        .navbar-brand {
            font-weight: 600;
        }

        .container-main {
            max-width: 1200px;
            margin: 40px auto;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(13, 110, 253, 0.08);
        }

        .card-header {
            background: white;
            border-bottom: 1px solid #e9ecef;
            padding: 20px 24px;
        }

        .card-header h4 {
            margin: 0;
            color: #0d6efd;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: #374151;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 10px 12px;
            border: 1px solid #d7dee8;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.12);
        }

        .btn-primary {
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }

        .table thead th {
            background-color: #0d6efd;
            color: white;
            font-weight: 500;
            white-space: nowrap;
        }

        .table tbody tr:hover {
            background-color: #f0f6ff;
        }

        .btn-sm {
            border-radius: 6px;
        }

        .badge-escola {
            background-color: #e7f1ff;
            color: #0d6efd;
            font-weight: 500;
        }

        .section-title {
            color: #0d6efd;
            font-weight: 600;
        }

    </style>

</head>

<body>



<nav class="navbar navbar-dark">

    <div class="container">

        <span class="navbar-brand">
             Cadastro de Pacientes
        </span>

    </div>

</nav>


<div class="container container-main">

    

    <div class="card mb-5">

        <div class="card-header">

            <h4>
                Novo paciente
            </h4>

            <small class="text-muted">
                Preencha os dados abaixo para cadastrar um paciente.
            </small>

        </div>

        <div class="card-body p-4">

            <form method="POST" action="cadastro.php">

                <div class="row g-3">

                    <div class="col-md-6">

                        <label class="form-label">
                            Nome
                        </label>

                        <input type="text" name="nome" class="form-control" placeholder="Digite o nome completo" required>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Data de Nascimento
                        </label>

                        <input type="date"  name="data_nascimento" class="form-control" required>

                    </div>


                    <div class="col-md-3">

                        <label class="form-label">
                            Série
                        </label>

                        <input type="text" name="serie" class="form-control" placeholder="Ex.: 8º ano" >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            CPF
                        </label>

                        <input type="text"name="cpf"class="form-control"placeholder="000.000.000-00" >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            RG
                        </label>

                        <input type="text"   name="rg" class="form-control"placeholder="00.000.000-0" >

                    </div>


                    <div class="col-md-4">

                        <label class="form-label">
                            Telefone
                        </label>

                        <input type="text" name="telefone" class="form-control"placeholder="(00) 00000-0000">

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Responsável
                        </label>

                        <input type="text" name="responsavel" class="form-control"placeholder="Nome do responsável" >

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Escola
                        </label>

                        <select
                            name="escola"
                            class="form-select"
                        >

                            <option value="">
                                Selecione a escola
                            </option>

                            <option value="DGG COC">
                                DGG COC
                            </option>

                            <option value="Doutor Candido Rodrigues">
                                Doutor Candido Rodrigues
                            </option>

                            <option value="Etec Professor Rodolpho José Del Guerra">
                                Etec Professor Rodolpho José Del Guerra
                            </option>

                            <option value="Colégio Lumen">
                                Colégio Lumen
                            </option>

                            <option value="Colégio Santa Ines">
                                Colégio Santa Ines
                            </option>

                        </select>

                    </div>


                    <div class="col-12">

                        <label class="form-label">
                            Endereço
                        </label>

                        <input type="text" name="endereco"class="form-control"placeholder="Digite o endereço completo">

                    </div>

                </div>


                <div class="mt-4">

                    <button type="submit" name="enviar" class="btn btn-primary" > Cadastrar paciente</button>

                </div>

            </form>

        </div>

    </div>


    <div class="card">

        <div class="card-header">

            <h4>
                Pacientes cadastrados
            </h4>

            <small class="text-muted">
                Lista de pacientes registrados no sistema.
            </small>

        </div>

        <div class="card-body p-0">

            <div class="table-container">

                <table class="table table-hover">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Nascimento</th>
                            <th>Série</th>
                            <th>CPF</th>
                            <th>RG</th>
                            <th>Telefone</th>
                            <th>Responsável</th>
                            <th>Escola</th>
                            <th>Endereço</th>
                            <th>Ações</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php

                    try {

                        $sqlSelect = $conn->prepare("
                            SELECT *
                            FROM pacientes
                            ORDER BY id DESC
                        ");

                        $sqlSelect->execute();

                        while ($row = $sqlSelect->fetch(PDO::FETCH_ASSOC)) {

                    ?>

                        <tr>

                            <td>
                                <?= $row["id"] ?>
                            </td>

                            <td>
                                <strong>
                                    <?= htmlspecialchars($row["nome"]) ?>
                                </strong>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["data_nascimento"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["serie"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["cpf"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["rg"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["telefone"]) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($row["responsavel"]) ?>
                            </td>

                            <td>

                                <span class="badge badge-escola">

                                    <?= htmlspecialchars($row["escola"]) ?>

                                </span>

                            </td>

                            <td>
                                <?= htmlspecialchars($row["endereco"]) ?>
                            </td>

                            <td class="text-nowrap">

                                <a
                                    href="alterar.php?al=<?= $row["id"] ?>"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Alterar
                                </a>

                                <a
                                    href="cadastro.php?ex=<?= $row["id"] ?>"
                                    class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir este paciente?')"
                                >
                                    Excluir
                                </a>

                            </td>

                        </tr>

                    <?php

                        }

                    } catch (PDOException $erro) {

                        echo "
                        <tr>
                            <td colspan='11' class='text-center text-danger p-4'>
                                Erro ao consultar pacientes: {$erro->getMessage()}
                            </td>
                        </tr>
                        ";

                    }

                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>

</html>

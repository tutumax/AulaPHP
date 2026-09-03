<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Funcionários</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f8fc;
        }

        .navbar {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
        }

        .container {
            max-width: 900px;
        }

        .card {
            border: none;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(13, 110, 253, 0.08);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid #e9ecef;
            border-radius: 14px 14px 0 0 !important;
        }

        .card-header h2 {
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
            padding: 10px 25px;
        }

        .btn-secondary {
            border-radius: 8px;
            padding: 10px 25px;
        }
    </style>
</head>

<?php
    require_once "conexao.php";

    try{
        if(isset($_REQUEST["al"])){
            $id = $_REQUEST["al"];

            $sqlSelect = $conn->prepare("select * from pacientes where id
            = :id");
            $sqlSelect->bindValue(":id",$id);
            $sqlSelect->execute();
            $row = $sqlSelect->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $erro){
            echo $erro->getMessage();
        }
?>
<?php
    try{
    if(isset($_REQUEST["Alterar"])){

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $data_nascimento = $_POST['data_nascimento'];
        $serie = $_POST['serie'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $responsavel = $_POST['responsavel'];
        $escola = $_POST['escola'];
        $endereco = $_POST['endereco'];



        $sqlUpdate = $conn->prepare("update pacientes set nome =:nome,
        data_nascimento = :data_nascimento, serie = :serie, cpf = :cpf,
        rg = :rg, telefone = :telefone,
        responsavel = :responsavel, escola = :escola, endereco = :endereco where id = 
        :id");

        $sqlUpdate->bindValue(':id', $id);
        $sqlUpdate->bindValue(':nome',$nome);
        $sqlUpdate->bindValue(':data_nascimento',$data_nascimento);
        $sqlUpdate->bindValue(':serie',$serie);
        $sqlUpdate->bindValue(':cpf',$cpf);
        $sqlUpdate->bindValue(':rg',$rg);
        $sqlUpdate->bindValue(':telefone',$telefone);
        $sqlUpdate->bindValue(':responsavel',$responsavel);
        $sqlUpdate->bindValue(':escola',$escola);
        $sqlUpdate->bindValue(':endereco',$endereco);
        $sqlUpdate->execute();

        echo "<script language=javascript>
            alert('Alteração efetuada com sucesso!!!');
            location.href='alterar.php?al=$id';
        </script>";
        }
        }
        catch(PDOException $erro){
                echo $erro->getMessage();
        }
        
?>
<body>

    <nav class="navbar navbar-dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">
                Cadastro de Pacientes
            </span>
        </div>
    </nav>

    <div class="container mt-5 mb-5">

        <div class="card">

            <div class="card-header p-4">
                <h2 class="mb-1">Alterar Informações do usuário</h2>
                <small class="text-muted">Atualize as informações do paciente abaixo.</small>
            </div>

            <div class="card-body p-4">

                <form name="Alterar" method="POST" action="alterar.php">

                    <div class="row g-3">

                        <div class="col-md-3">
                            <label class="form-label">ID do funcionário</label>
                            <input type="text" name="id" value="<?php echo $row['id'];?>"
                            class="form-control" readonly>
                        </div>

                        <div class="col-md-9">
                            <label class="form-label">Digite seu nome</label>
                            <input type="text" name="nome" value="<?php echo $row['nome'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sua data de Nascimento</label>
                            <input type="date" name="data_nascimento" value="<?php echo $row['data_nascimento'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Sua série</label>
                            <input type="text" name="serie" value="<?php echo $row['serie'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Seu CPF</label>
                            <input type="text" name="cpf" value="<?php echo $row['cpf'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Seu RG</label>
                            <input type="text" name="rg" value="<?php echo $row['rg'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Seu Telefone</label>
                            <input type="text" name="telefone" value="<?php echo $row['telefone'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Seu Responsável</label>
                            <input type="text" name="responsavel" value="<?php echo $row['responsavel'];?>"
                            class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sua Escola</label>
                            <select name="escola" class="form-select" required>
                                <option value="DGG COC" <?php if($row['escola'] == "DGG COC") echo "selected"; ?>>DGG COC</option>
                                <option value="Doutor Candido Rodrigues" <?php if($row['escola'] == "Doutor Candido Rodrigues") echo "selected"; ?>>Doutor Candido Rodrigues</option>
                                <option value="Etec Professor Rodolpho José Del Guerra" <?php if($row['escola'] == "Etec Professor Rodolpho José Del Guerra") echo "selected"; ?>>Etec Professor Rodolpho José Del Guerra</option>
                                <option value="Colégio Lumen" <?php if($row['escola'] == "Colégio Lumen") echo "selected"; ?>>Colégio Lumen</option>
                                <option value="Colégio Santa Ines" <?php if($row['escola'] == "Colégio Santa Ines") echo "selected"; ?>>Colégio Santa Ines</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Seu Endereço</label>
                            <input type="text" name="endereco" value="<?php echo $row['endereco'];?>"
                            class="form-control" required>
                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">

                        <input type="submit" value="Alterar" name="Alterar"
                        class="btn btn-primary">

                        <a href="cadastro.php" class="btn btn-secondary">
                            Voltar
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

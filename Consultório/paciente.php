<?php
session_start();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro Paciente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Cadastro de Paciente</h2>

<form method="POST" action="paciente.php">

<div class="form-grid">

    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome">
    </div>

    <div class="form-group">
        <label>Data de Nascimento</label>
        <input type="date" name="data">
    </div>

    <div class="form-group">
        <label>Série</label>
        <input type="text" name="serie">
    </div>

    <div class="form-group">
        <label>CPF</label>
        <input type="text" name="cpf">
    </div>

    <div class="form-group">
        <label>RG</label>
        <input type="text" name="rg">
    </div>

    <div class="form-group">
        <label>Telefones</label>
        <input type="text" name="telefone">
    </div>

    <div class="form-group">
        <label>Responsável</label>
        <input type="text" name="responsavel">
    </div>

    <div class="form-group">
        <label>Escola</label>
        <select name="escola">
            <option value="">---</option>
            <option value="DGG COC">DGG COC</option>
            <option value="Doutor Candido Rodrigues">Doutor Candido Rodrigues</option>
            <option value="Etec Professor Rodolpho José Del Guerra">Etec Professor Rodolpho José Del Guerra</option>
            <option value="Colégio Lumen">Colégio Lumen</option>
            <option value="Colégio Santa Ines">Colégio Santa Ines</option>
        </select>
    </div>

    <div class="form-group">
        <label>Endereço</label>
        <textarea name="endereco"></textarea>
    </div>

</div>

<div class="botoes">

    <a href="home.php">
        <button type="button" class="btn btn-secondary">Voltar</button>
    </a>

    <button type="submit" name="cadastrar" class="btn btn-success">
        Cadastrar
    </button>

</div>

</form>

</div>

</body>

<?php
include("conexao.php");

if(isset($_REQUEST['cadastrar'])){

    $nome = $_REQUEST['nome'];
    $data = $_REQUEST['data'];
    $serie = $_REQUEST['serie'];
    $cpf = $_REQUEST['cpf'];
    $rg = $_REQUEST['rg'];
    $telefone = $_REQUEST['telefone'];
    $responsavel = $_REQUEST['responsavel'];
    $escola = $_REQUEST['escola'];
    $endereco = $_REQUEST['endereco'];

    $sql = "INSERT INTO pacientes
    (nome,data_nascimento,serie,cpf,rg,telefone,responsavel,escola,endereco)
    VALUES
    ('$nome','$data','$serie','$cpf','$rg','$telefone','$responsavel','$escola','$endereco')";

    if($conn->exec($sql)){
        echo "<script>alert('Paciente cadastrado com sucesso');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar');</script>";
    }
}
?>

</html>

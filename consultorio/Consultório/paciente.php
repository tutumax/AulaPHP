<?php
session_start();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['cadastrar'])){
    echo "<script>alert('Cadastro de paciente efetuado com sucesso');</script>";
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

<form method="post">

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
        <select id="escola">
            <option value="">---</option>
            <option value="escola">DGG COC</option>
            <option value="escola">Doutor Candido Rodrigues</option>
            <option value="escola">Etec Professor Rodolpho José Del Guerra</option>
            <option value="escola">Colégio Lumen</option>
            <option value="escola">Colégio Santa Ines</option>

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
</html>
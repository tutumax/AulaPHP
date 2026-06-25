<?php
session_start();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

if(isset($_POST['enviar'])){
    echo "<script>alert('Cadastro de usuário efetuado com sucesso');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<h2>Novo Usuário</h2>

<form method="post">

<div class="form-grid">

    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome">
    </div>

    <div class="form-group">
        <label>CPF</label>
        <input type="text" name="cpf">
    </div>

    <div class="form-group">
        <label>Endereço</label>
        <input type="text" name="endereco">
    </div>

    <div class="form-group">
        <label>Nível</label>
        <select name="nivel">
            <option>Administrador</option>
            <option>Usuário</option>
        </select>
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email">
    </div>

    <div class="form-group">
        <label>Senha</label>
        <input type="password" name="senha">
    </div>

    <div class="form-group">
        <label>Status</label>
        <select name="status">
            <option>Ativo</option>
            <option>Inativo</option>
        </select>
    </div>

</div>

<div class="botoes">

    <a href="home.php">
        <button type="button" class="btn btn-secondary">Cancelar</button>
    </a>

    <button type="submit" name="enviar" class="btn btn-success">
        Enviar
    </button>

</div>

</form>

</div>

</body>
</html>
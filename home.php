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
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h1>Home</h1>

    <div class="home-buttons">

        <a href="paciente.php">
            <button class="btn btn-primary">Cadastro de Paciente</button>
        </a>

        <a href="usuario.php">
            <button class="btn btn-primary">Cadastro de Usuário</button>
        </a>

        <a href="logout.php">
            <button class="btn btn-secondary">Sair</button>
        </a>

    </div>

</div>

</body>
</html>
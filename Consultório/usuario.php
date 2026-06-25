<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Usuário</title>
</head>
<body>

<form method="POST" action="usuario.php">

    <p>Digite o nome:</p>
    <input type="text" name="nome"><br><br>

    <p>Digite o CPF:</p>
    <input type="text" name="cpf"><br><br>

    <p>Digite o endereço:</p>
    <input type="text" name="endereco"><br><br>

    <p>Digite o nível:</p>
    <select name="nivel">
        <option>Administrador</option>
        <option>Usuário</option>
    </select><br><br>

    <p>Digite o email:</p>
    <input type="email" name="email"><br><br>

    <p>Digite a senha:</p>
    <input type="password" name="senha"><br><br>

    <p>Digite o status:</p>
    <select name="status">
        <option>Ativo</option>
        <option>Inativo</option>
    </select><br><br>

    <input type="submit" value="enviar" name="enviar">

</form>

</body>

<?php
session_start();

if(!isset($_SESSION['logado'])){
    header("Location: login.php");
    exit;
}

include("conexao.php");

if(isset($_REQUEST['enviar'])){

    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $endereco = $_REQUEST['endereco'];
    $nivel = $_REQUEST['nivel'];
    $email = $_REQUEST['email'];
    $senha = $_REQUEST['senha'];
    $status = $_REQUEST['status'];

    $sql = "INSERT INTO usuarios
    (nome, cpf, endereco, nivel, email, senha, status)
    VALUES
    ('$nome','$cpf','$endereco','$nivel','$email','$senha','$status')";

    try {

        if($conn->exec($sql)){
            echo "<script>alert('Usuário cadastrado com sucesso');</script>";
        }

    } catch(PDOException $e) {

        echo "<script>alert('Erro ao cadastrar usuário');</script>";
    }
}
?>
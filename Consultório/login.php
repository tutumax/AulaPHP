<?php
session_start();

if(isset($_REQUEST['entrar'])){

    $usuario = $_REQUEST['usuario'];
    $senha = $_REQUEST['senha'];

    if($usuario == "ADM" && $senha == "senha123"){

        $_SESSION['logado'] = true;
        $_SESSION['usuario'] = $usuario;

        header("Location: home.php");
        exit;

    } else {

        echo "<h3>Login ou senha inválidos!</h3>";

    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>

    <form method="POST" action="home.php">

        <p>Digite o usuário:</p>
        <input type="text" name="usuario"><br><br>

        <p>Digite a senha:</p>
        <input type="password" name="senha"><br><br>

        <input type="submit" value="Entrar" name="entrar">

    </form>

</body>
</html>
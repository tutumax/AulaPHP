<?php
session_start();

if(isset($_POST['entrar'])){

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if($usuario == "admin" && $senha == "123"){
        $_SESSION['logado'] = true;
        header("Location: home.php");
        exit;
    } else {
        $erro = "Login ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">

    <h2>Login</h2>

    <form method="post">

        <label>Usuário</label>
        <input type="text" name="usuario" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <button type="submit" class="btn btn-primary" name="entrar">
            Entrar
        </button>

    </form>

    <?php
    if(isset($erro)){
        echo "<p style='color:red; margin-top:10px;'>$erro</p>";
    }
    ?>

</div>

</body>
</html>
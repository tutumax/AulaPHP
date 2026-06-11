<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa";

    try {
        // Conexão com suporte a UTF-8
        $conn = new PDO("mysql:host=$server_name;dbname=$dbname;charset=utf8", $username, $password);  
        
        // Configura o PDO para lançar exceções em caso de erros
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $erro) {
        // CORREÇÃO: Usando die() para mostrar o erro e parar a execução do script
        die("Ocorreu o seguinte erro na conexão: " . $erro->getMessage());
    }
?>
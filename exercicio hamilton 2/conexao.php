<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa";

    try{
        $conm = new PDO();
        
    }
    catch(PDOException $erro){
        header("Ocorreu o seguinte erro:" .$erro->getMessage());
    }
?>
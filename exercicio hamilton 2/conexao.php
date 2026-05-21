<?php
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa";

    try{
        $conn = new PDO("mysql:host=$server_name;dbname=$dbname;charset=UTF8",$username , $password);  
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $erro){
        header("Ocorreu o seguinte erro:" .$erro->getMessage());
    }
?>

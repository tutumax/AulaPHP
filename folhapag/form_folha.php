<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
    <form name="sistema" method="POST" action="form_folha.php">
        <p>Digite seu nome</p><br>
        <input type="text" name="nome">

        <p>Digite seu salário base:</p><br>
        <input type="text" name="salarioB">

        <p>Digite seu número de horas extras:</p><br>
        <input type="text" name="numeroHE">

        <p>Digite o valor das horas extras:</p><br>
        <input type="text" name="valorHE">

        <p>Digite o número de dependentes:</p><br>
        <input type="text" name="numeroD">

        <input type="submit" value="enviar" name="enviar">
    </form>
    </fieldset>
</body>
<?php 
    require_once "conexao.php";

if(isset($_REQUEST['enviar'])){

    $nome =($_REQUEST['nome']);
    $salariob = ($_REQUEST['salarioB']);
    $horas = ($_REQUEST['numeroHE']);
    $valorh = ($_REQUEST['valorHE']);
    $dependentes = ($_REQUEST['numeroD']);
    $salariobru = ($salariob + ($horas * $valorh) + ($dependentes * 45));
    
    if ($salariobru < 1659.38){
        $inss = $salariob * (0.08);
    } else if ($salariobru >= 1659.38 && $salariobru < 2765.66) {
        $inss = $salariob * (0.09);
    } else if ($salariobru >= 2765.67 && $salariobru <= 5531.31) {
        $inss = $salariob * (0.11);
    } else if ($salariobru == 5531.31) {
        $inss = 608.44;
    }

    if ($salariobru < 1903.98) {
     $Irenda = 0;
    } else if ($salariobru >= 1903.99 && $salariobru < 2826.65) {
        $Irenda = $salariob * (0.075);
    } else if ($salariobru >= 2826.65 && $salariobru < 3751.05) {
        $Irenda = $salariob * (0.15);
    } else if ($salariobru >= 3751.06 && $salariobru < 4664.68) {
        $Irenda = $salariob * (0.225);
    } else if ($salariobru > 4664.68){
        $Irenda = $salariob * (0.275);
    };
    

    $salarioliq = $salariobru - $inss - $Irenda;
    echo "Olá $nome, seu salário base é $salariob, seu número de horas extras é $horas, <Br>o valor delas é $valorh, o número de dependentes é 
    $dependentes, seu salário bruto é $salariobru, o INSS é $inss, o imposto de renda é $Irenda, e o salário líquido é $salarioliq";
    
    try{
        $sqlInsert = $conn->prepare("insert into empresa(id_funcionarios,nome,salariob,horas,valorh,dependentes,salariobru,salarioliq,Irenda,inss)
        values(:id_funcionarios,:nome,:salariob,:horas,:valorh,:dependentes,:salariobru,:salarioliq,:Irenda,:inss)");

        $sqlInsert->bindValue(":id_funcionarios",null);
        $sqlInsert->bindValue(":nome", $nome);
        $sqlInsert->bindValue(":salariob", $salariob);
        $sqlInsert->bindValue(":horas", $horas);
        $sqlInsert->bindValue(":valorh", $valorh);
        $sqlInsert->bindValue(":dependentes", $dependentes);
        $sqlInsert->bindValue(":salariobru", $salariobru);
        $sqlInsert->bindValue(":salarioliq", $salarioliq);
        $sqlInsert->bindValue(":Irenda", $Irenda);
        $sqlInsert->bindValue(":inss", $inss);

        $sqlInsert -> execute();

        echo "<script language=javascript>
                alert('Dados gravados com sucesso!!!');
                location.href = home.php;
                </script>"
                
                ;

    }
    catch(PDOException $erro){
        echo $erro->getMessage();
    }


}
    //$conn = null;
?>

<h1>Consulta de RFuncionários</h1>
<table border="1">
    <tr>
        <th scope= "col">Id</th>
        <th scope= "col">Nome</th>
        <th scope= "col">Salario_b</th>
        <th scope= "col">horas</th>
        <th scope= "col">valorh</th>
        <th scope= "col">dependentes</th>
        <th scope= "col">salariobru</th>
        <th scope= "col">salarioliq</th>
        <th scope= "col">Irenda</th>
        <th scope= "col">inss</th>
        <th scope="col">Opções</th>

    </tr>

    <?php
        try{
        $sqlSelect = $conn -> prepare("select * from empresa"); 
        $sqlSelect -> execute();

        while($row = $sqlSelect->fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                    <td><?php echo $row["id_funcionarios"]?></td>
                    <td><?php echo $row["nome"]?></td>
                    <td><?php echo $row["salariob"]?></td>
                    <td><?php echo $row["horas"]?></td>
                    <td><?php echo $row["valorh"]?></td>
                    <td><?php echo $row["dependentes"]?></td>
                    <td><?php echo $row["salariobru"]?></td>
                    <td><?php echo $row["salarioliq"]?></td>
                    <td><?php echo $row["Irenda"]?></td>
                    <td><?php echo $row["inss"]?></td>
                    <td>
                        <a href="form_folha.php?ex=<?php echo $row["id_funcionarios"]?>">Excluir</a>
                        <a href="alterar.php?al=<?php echo $row["id_funcionarios"]?>">Alterar</a>
                    </td>

                </tr>
            <?php
        }
        }
        catch(PDOException $erro)
        {
            echo $erro->getMessage();
        }
        try{
            if(isset($_REQUEST["ex"])){
                $id_funcionarios = $_REQUEST["ex"];
                $sqlDelete = $conn->prepare("delete from empresa where id_funcionarios = :id_funcionarios");
                $sqlDelete->bindValue(":id_funcionarios",$id_funcionarios);
                $sqlDelete->execute();
                header("location:form_folha.php");
            }
        }
        catch(PDOException $erro)
        {
            echo $erro->getMessage();
        }
        //$conn = null;
    ?>
</table>
</html>
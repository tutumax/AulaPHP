<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="cadastro.php">

<div class="form-grid">

    <div class="form-group">
        <label>Nome</label>
        <input type="text" name="nome">
    </div>

    <div class="form-group">
        <label>Data de Nascimento</label>
        <input type="date" name="data_nascimento">
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
        <select name="escola">
            <option value="">---</option>
            <option value="DGG COC">DGG COC</option>
            <option value="Doutor Candido Rodrigues">Doutor Candido Rodrigues</option>
            <option value="Etec Professor Rodolpho José Del Guerra">Etec Professor Rodolpho José Del Guerra</option>
            <option value="Colégio Lumen">Colégio Lumen</option>
            <option value="Colégio Santa Ines">Colégio Santa Ines</option>
        </select>
    </div>

    <div class="form-group">
        <label>Endereço</label>
        <input type="text" name="endereco">
    </div>

</div>

    <input type="submit" value="enviar" name="enviar">

</form>

</body>
<?php 
    require_once "conexao.php";

if(isset($_REQUEST['enviar'])){
    
    try{

        $nome =($_REQUEST['nome']);
        $data_nascimento =($_REQUEST['data_nascimento']);
        $serie =($_REQUEST['serie']);
        $cpf =($_REQUEST['cpf']);
        $rg =($_REQUEST['rg']);
        $telefone =($_REQUEST['telefone']);
        $responsavel =($_REQUEST['responsavel']);
        $escola =($_REQUEST['escola']);
        $endereco =($_REQUEST['endereco']);
        





        $sqlInsert = $conn->prepare("insert into pacientes(id,nome,data_nascimento,serie,cpf,rg,telefone,responsavel,escola,endereco)
        values(:id,:nome,:data_nascimento,:serie,:cpf,:rg,:telefone,:responsavel,:escola,:endereco)");

        $sqlInsert->bindValue(":id",null);
        $sqlInsert->bindValue(":nome", $nome);
        $sqlInsert->bindValue(":data_nascimento", $data_nascimento);
        $sqlInsert->bindValue(":serie", $serie);
        $sqlInsert->bindValue(":cpf", $cpf);
        $sqlInsert->bindValue(":rg", $rg);
        $sqlInsert->bindValue(":telefone", $telefone);
        $sqlInsert->bindValue(":responsavel", $responsavel);
        $sqlInsert->bindValue(":escola", $escola);
        $sqlInsert->bindValue(":endereco", $endereco);

        $sqlInsert -> execute();

        echo "<script language=javascript>
                alert(Dados gravados com sucesso!!!);
                location.href = cadastro.php;
                </script>";

    }
    catch(PDOException $erro){
        echo $erro->getMenssage();
    }


}
    //$conn = null;
?>

<h1>Consulta de Pacientes</h1>
<table border="1">
    <tr>
        <th scope= "col">Id</th>
        <th scope= "col">Nome</th>
        <th scope= "col">Data de Nascimento</th>
        <th scope= "col">Serie</th>
        <th scope= "col">CPF</th>
        <th scope= "col">RG</th>
        <th scope= "col">Telefone</th>
        <th scope= "col">salarioliq</th>
        <th scope= "col">Responsável</th>
        <th scope= "col">Escola</th>
        <th scope="col">Endereço</th>

    </tr>

    <?php
        try{
        $sqlSelect = $conn -> prepare("select * from pacientes"); 
        $sqlSelect -> execute();

        while($row = $sqlSelect->fetch(PDO::FETCH_ASSOC)){
            ?>
                <tr>
                    <td><?php echo $row["id"]?></td>
                    <td><?php echo $row["nome"]?></td>
                    <td><?php echo $row["data_nascimento"]?></td>
                    <td><?php echo $row["serie"]?></td>
                    <td><?php echo $row["cpf"]?></td>
                    <td><?php echo $row["rg"]?></td>
                    <td><?php echo $row["telefone"]?></td>
                    <td><?php echo $row["responsavel"]?></td>
                    <td><?php echo $row["escola"]?></td>
                    <td><?php echo $row["endereco"]?></td>
                    <td>
                        <a href="cadastro.php?ex=<?php echo $row["id"]?>">Excluir</a>
                        <a href="alterar.php?al=<?php echo $row["id"]?>">Alterar</a>
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
                $id = $_REQUEST["ex"];
                $sqlDelete = $conn->prepare("delete from pacientes where id = :id");
                $sqlDelete->bindValue(":id",$id);
                $sqlDelete->execute();
                header("location:cadastro.php");
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
    

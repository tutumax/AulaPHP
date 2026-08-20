<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Funcionários</title>
</head>
<?php
    require_once "conexao.php";

    try{
        if(isset($_REQUEST["al"])){
            $id = $_REQUEST["al"];

            $sqlSelect = $conn->prepare("select * from bd_cadastro where id
            = :id");
            $sqlSelect->bindValue(":id",$id);
            $sqlSelect->execute();
            $row = $sqlSelect->fetch(PDO::FETCH_ASSOC);
        }
    }
    catch(PDOException $erro){
            echo $erro->getMessage();
        }
?>
<?php
    try{
    if(isset($_REQUEST["Alterar"])){
        $sqlUpdate = $conn->prepare("update empresa set nome =:nome,
        data_nascimento = :data_nascimento, serie = :serie, cpf = :cpf,
        rg = :rg, telefone = :telefone,
        responsavel = :responsavel, escola = :escola, endereco = :endereco where id = 
        :id");
        $sqlUpdate->bindValue(':id',$id);
        $sqlUpdate->bindValue(':nome',$nome);
        $sqlUpdate->bindValue(':data_nascimento',$data_nascimento);
        $sqlUpdate->bindValue(':serie',$serie);
        $sqlUpdate->bindValue(':cpf',$cpf);
        $sqlUpdate->bindValue(':rg',$rg);
        $sqlUpdate->bindValue(':telefone',$telefone);
        $sqlUpdate->bindValue(':responsavel',$responsavel);
        $sqlUpdate->bindValue(':escola',$escola);
        $sqlUpdate->bindValue(':endereco',$endereco);
        $sqlUpdate->execute();

        echo "<script language=javascript>
            alert('Alteração efetuada com sucesso!!!');
            location.href='alterar.php? al=$id';
        </script>";
        }
        }
        catch(PDOException $erro){
                echo $erro->getMessage();
        }
        
?>
<body>
    <h2>Alterar Informações do usuario</h2>
    <fieldset>
    <form name="Alterar" method="POST" action="alterar.php">

        <p>ID do funcionario</p><br>
        <input type="text" name="id" value="<?php echo $row['id'];?>"
        readoly>

        <p>Digite seu nome</p><br>
        <input type="text" name="nome" value="<?php echo $row['nome'];?>"
        require>

        <p>Sua data de Nascimento:</p><br>
        <input type="text" name="data_nascimento" value="<?php echo $row['data_nascimento'];?>"
        require>

        <p>Sua série::</p><br>
        <input type="text" name="serie" value="<?php echo $row['serie'];?>"
        require>

         <p>Seu CPF:</p><br>
        <input type="text" name="cpf" value="<?php echo $row['cpf'];?>"
        require>

        <p>Seu RG:</p><br>
        <input type="text" name="rg" value="<?php echo $row['rg'];?>"
        require>

        <p>Seu Telefone:</p><br>
        <input type="text" name="telefone" value="<?php echo $row['telefone'];?>"
        require>

         <p>Seu Responsavel:</p><br>
        <input type="text" name="responsavel" value="<?php echo $row['responsavel'];?>"
        require>

         <p>Sua Escola:</p><br>
        <input type="text" name="escola" value="<?php echo $row['escola'];?>"
        require>

         <p>Seu Endereço:</p><br>
        <input type="text" name="endereco" value="<?php echo $row['endereco'];?>"
        require>
        <br>
        <br>
        <input type="submit" value="Alterar" name="Alterar">
        <br>
        <br>
        <a href="cadastro.php">Voltar</a>
    </form>
    </fieldset>
</body>
</html>
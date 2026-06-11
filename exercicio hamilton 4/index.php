<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cálculo de Folha de Pagamento</title>
</head>
<body>
    <h2>Formulário de Cadastro de Salário</h2>
    <form method='POST' name='formulario' action='index.php'>
        <p>Digite o seu salário base?</p>
        <input type='text' name='salario' required><br>

        <p>Digite as suas horas extras?</p>
        <input type='text' name='horasextras' required><br>

        <p>Digite o valor das horas extras?</p>
        <input type='text' name='valorextras' required><br>

        <p>Digite número de dependentes?</p>
        <input type='text' name='numero' required><br>

        <p>Digite o nome dos funcionários?</p>
        <input type='text' name='nome' required><br><br>

        <input type='submit' value='enviar' name='enviar'>
    </form>

    <br><hr><br>

<?php
if (isset($_POST['enviar'])) {
    
    $server_name = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empresa";

    try {
        $conn = new PDO("mysql:host=$server_name;dbname=$dbname;charset=utf8", $username, $password);  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $erro) {
        die("<p style='color: red;'>Erro na conexão com o banco de dados: " . $erro->getMessage() . "</p>");
    }

    $salario = $_POST['salario'];
    $horasextras = $_POST['horasextras'];
    $valorextras = $_POST['valorextras'];
    $numero = $_POST['numero'];
    $nome = $_POST['nome'];

    // Cálculo do Salário Bruto
    $salario_bruto = $salario + ($horasextras * $valorextras) + ($numero * 45.00);

    // Cálculo do INSS
    if ($salario_bruto <= 1659.38) {
        $inss = $salario_bruto * 0.08;
    }
    elseif ($salario_bruto > 1659.38 && $salario_bruto <= 2765) {
        $inss = $salario_bruto * 0.09;
    }
    elseif ($salario_bruto > 2765 && $salario_bruto <= 5531) {
        $inss = $salario_bruto * 0.11;
    }
    else {
        $inss = 608.44; 
    }

    // Cálculo do Imposto de Renda (IR)
    if ($salario_bruto <= 1903.98) {
        $ir = 0;
    }
    elseif ($salario_bruto > 1903.98 && $salario_bruto <= 2826) {
        $ir = $salario_bruto * 0.075;
    }
    elseif ($salario_bruto > 2826 && $salario_bruto <= 3751) {
        $ir = $salario_bruto * 0.15;
    }
    elseif ($salario_bruto > 3751 && $salario_bruto <= 4664.68) {
        $ir = $salario_bruto * 0.225;
    }
    else {
        $ir = $salario_bruto * 0.275;
    }

    $salarioliquido = $salario_bruto - $inss - $ir;

    echo "<div style='background-color: #f4f4f4; padding: 15px; border: 1px solid #ddd; border-radius: 5px; font-family: sans-serif;'>";
    echo "<h3>Resumo do Cálculo para: " . htmlspecialchars($nome) . "</h3>";
    echo "<strong>Salário Base:</strong> R$ " . number_format($salario, 2, ',', '.') . "<br>";
    echo "<strong>Horas Extras:</strong> $horasextras (Valor p/ hora: R$ " . number_format($valorextras, 2, ',', '.') . ")<br>";
    echo "<strong>Dependentes:</strong> $numero (Bônus: R$ " . number_format($numero * 45, 2, ',', '.') . ")<br>";
    echo "<strong>Salário Bruto:</strong> R$ " . number_format($salario_bruto, 2, ',', '.') . "<br>";
    echo "<strong>Desconto INSS:</strong> R$ " . number_format($inss, 2, ',', '.') . "<br>";
    echo "<strong>Desconto IR:</strong> R$ " . number_format($ir, 2, ',', '.') . "<br><hr>";
    echo "<strong style='color: green;'>Salário Líquido Final:</strong> R$ " . number_format($salarioliquido, 2, ',', '.') . "<br>";
    echo "</div>";

    try {
        $sqlInsert = $conn->prepare("INSERT INTO dados (id_funcionario, nome, salario_bruto, salario, salarioliquido, numero, horasextras, valorextras, inss, ir)
        VALUES (:id_funcionario, :nome, :salario_bruto, :salario, :salarioliquido, :numero, :horasextras, :valorextras, :inss, :ir)"); 
        
        $sqlInsert->bindValue(':id_funcionario', null, PDO::PARAM_NULL);
        $sqlInsert->bindValue(':nome', $nome);
        $sqlInsert->bindValue(':salario_bruto', $salario_bruto);
        $sqlInsert->bindValue(':salario', $salario);
        $sqlInsert->bindValue(':salarioliquido', $salarioliquido);
        $sqlInsert->bindValue(':numero', $numero);
        $sqlInsert->bindValue(':horasextras', $horasextras);
        $sqlInsert->bindValue(':valorextras', $valorextras);
        $sqlInsert->bindValue(':inss', $inss);
        $sqlInsert->bindValue(':ir', $ir);

        $sqlInsert->execute();

        echo "<script>alert('Dados gravados com sucesso!!!');</script>";
    }
    catch(PDOException $erro){
        echo "<p style='color: red;'>Erro ao salvar no banco de dados: " . $erro->getMessage() . "</p>";
    }
}
?>
</body>
</html>
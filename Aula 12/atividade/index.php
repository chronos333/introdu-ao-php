<?php
// Conexão com o banco
$host = "localhost";
$dbname = "atendentes";
$user = "postgres";
$pass = "postgres";

try {
    $conexao = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Inserir novo vendedor se o formulário for enviado
$mensagem = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $funcao = $_POST['funcao'];
    $salario = $_POST['salario'];

    try {
        $sql = "INSERT INTO vendedores (nome, funcao, salario) 
                VALUES (:nome, :funcao, :salario)";
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':funcao', $funcao);
        $stmt->bindValue(':salario', $salario);
        $stmt->execute();
        $mensagem = "Vendedor inserido com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro ao inserir vendedor: " . $e->getMessage();
    }
}

// Buscar todos os vendedores
try {
    $stmt = $conexao->query("SELECT * FROM vendedores ORDER BY id");
    $vendedores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar vendedores: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Vendedores</title>
    <style>
        table { border-collapse: collapse; width: 50%; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        form { margin-top: 20px; }
    </style>
</head>
<body>
<h1>Vendedores</h1>

<?php if ($mensagem) echo "<p><strong>$mensagem</strong></p>"; ?>

<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Função</th>
        <th>Salário</th>
    </tr>
    <?php foreach ($vendedores as $v): ?>
    <tr>
        <td><?= $v['id'] ?></td>
        <td><?= htmlspecialchars($v['nome']) ?></td>
        <td><?= htmlspecialchars($v['funcao']) ?></td>
        <td><?= number_format($v['salario'], 2, ',', '.') ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h2>Adicionar novo vendedor</h2>
<form method="post">
    <label>Nome: <input type="text" name="nome" required></label><br><br>
    <label>Função: <input type="text" name="funcao" required></label><br><br>
    <label>Salário: <input type="number" step="0.01" name="salario" required></label><br><br>
    <button type="submit">Adicionar</button>
</form>
</body>
</html>
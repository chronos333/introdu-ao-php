<?php
session_start();
include "conexao.php";

// inicializa carrinho
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// ADICIONAR ITEM
if (isset($_GET['add'])) {
    $id = (int) $_GET['add'];

    // busca jogo no banco
    $sql = "SELECT * FROM jogos WHERE id = $1";
    $result = pg_query_params($conn, $sql, [$id]);
    $jogo = pg_fetch_assoc($result);

    if ($jogo) {
        $_SESSION['carrinho'][$id] = $jogo;
    }

    header("Location: carrinho.php");
    exit();
}

// REMOVER ITEM
if (isset($_GET['remove'])) {
    $id = (int) $_GET['remove'];
    unset($_SESSION['carrinho'][$id]);

    header("Location: carrinho.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Carrinho</title>
<link rel="stylesheet" href="./css/style.css">
</head>
<body>

<h1>🛒 Seu Carrinho</h1>

<?php if (empty($_SESSION['carrinho'])) { ?>
    <p>Carrinho vazio</p>
<?php } else { ?>

    <?php
    $total = 0;
    foreach ($_SESSION['carrinho'] as $item) {
        $total += $item['preco'];
    ?>
        <div class="card">
            <img src="<?= $item['imagem'] ?>">
            <h3><?= $item['nome'] ?></h3>
            <p>R$ <?= number_format($item['preco'], 2, ',', '.') ?></p>

            <a href="carrinho.php?remove=<?= $item['id'] ?>">Remover</a>
        </div>
    <?php } ?>

    <h2>Total: R$ <?= number_format($total, 2, ',', '.') ?></h2>

<?php } ?>

</body>
</html>
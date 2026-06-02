<?php
include "auth_check.php";
include "conexao.php";

$result  = pg_query($conn, "SELECT * FROM jogos ORDER BY id DESC");
$isAdmin = !empty($_SESSION['is_admin']);
$nome    = htmlspecialchars($_SESSION['usuario_nome']);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GameIntel</title>
<link rel="stylesheet" href="./css/style.css">
<link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>

<body>
<div class="home">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="#" class="btn btn-inicial">
                🛒 Loja
            </a>
            <a href="#" class="btn btn-inicial">
                📚 Biblioteca
            </a>
            <a href="carrinho.php?add=<?= $jogo['id'] ?>" class="btn btn-inicial">
                🛒 Adicionar ao carrinho
            </a>
            <?php if ($isAdmin): ?>
                <a href="adicionar_jogo.php">➕ Adicionar Jogo</a>
                <a href="admin.php" class="btn-admin-nav">⚙️ Painel Admin</a>
            <?php endif; ?>
            <span class="usuario-nav">👤 <?= $nome ?></span>
            <a href="logout.php" class="btn-logout-nav">Sair</a>
        </div>
    </div>

    <!-- BANNER -->
    <div class="banner">
        <h2>Bem-vindo<?= $isAdmin ? ' (Admin)' : '' ?>, <?= $nome ?>!</h2>
        <p>Descubra os melhores jogos para PC, promoções exclusivas e lançamentos.</p>
    </div>

    <h1>Jogos em Destaque</h1>

    <!-- JOGOS -->
    <div class="jogos">
    <?php while ($jogo = pg_fetch_assoc($result)): ?>
        <div class="card">
            <img
                src="<?= htmlspecialchars($jogo['imagem'] ?: 'https://via.placeholder.com/300x200') ?>"
                alt="<?= htmlspecialchars($jogo['nome']) ?>"
            >
            <div class="card-content">
                <h3><?= htmlspecialchars($jogo['nome']) ?></h3>
                <p class="genero"><?= htmlspecialchars($jogo['genero']) ?></p>
                <div class="preco">R$ <?= number_format($jogo['preco'], 2, ',', '.') ?></div>
                <button>Adicionar ao Carrinho</button>
                <?php if ($isAdmin): ?>
                    <a
                        href="excluir_jogos.php?id=<?= $jogo['id'] ?>"
                        onclick="return confirm('Tem certeza que deseja excluir este jogo?');"
                        class="btn-excluir"
                    >🗑 Excluir</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endwhile; ?>
    </div>

    <footer>© 2026 GameIntel - Todos os direitos reservados.</footer>
</div>
</body>
</html>

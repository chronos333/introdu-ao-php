<?php
include "auth_check.php";
include "conexao.php";

if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit();
}

$id     = (int)$_GET['id'];
$result = pg_query_params($conn, "SELECT * FROM jogos WHERE id = $1", [$id]);

if (!$result || pg_num_rows($result) === 0) {
    header("Location: home.php");
    exit();
}

$jogo    = pg_fetch_assoc($result);
$isAdmin = !empty($_SESSION['is_admin']);

// Monta estrelas com base na avaliação (0–5)
function renderEstrelas(float $nota): string {
    $html  = '';
    $cheia = floor($nota);
    $meia  = ($nota - $cheia) >= 0.5 ? 1 : 0;
    $vazia = 5 - $cheia - $meia;
    for ($i = 0; $i < $cheia; $i++) $html .= '<span class="estrela cheia">★</span>';
    if ($meia)                        $html .= '<span class="estrela meia">★</span>';
    for ($i = 0; $i < $vazia; $i++) $html .= '<span class="estrela vazia">★</span>';
    return $html;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($jogo['nome']) ?> — GameIntel</title>
<link rel="stylesheet" href="./css/style.css">
<link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>

<body>
<div class="home">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="home.php">← Voltar à Loja</a>
            <?php if ($isAdmin): ?>
                <a href="adicionar_jogo.php">➕ Adicionar Jogo</a>
                <a href="admin.php" class="btn-admin-nav">⚙️ Painel Admin</a>
            <?php endif; ?>
            <span class="usuario-nav">👤 <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a href="logout.php" class="btn-logout-nav">Sair</a>
        </div>
    </div>

    <!-- PÁGINA DO JOGO -->
    <div class="jogo-page">

        <!-- HERO: imagem + info principal -->
        <div class="jogo-hero">
            <div class="jogo-cover">
                <img
                    src="<?= htmlspecialchars($jogo['imagem'] ?: 'https://via.placeholder.com/600x380') ?>"
                    alt="<?= htmlspecialchars($jogo['nome']) ?>"
                >
            </div>

            <div class="jogo-info">
                <span class="jogo-genero-tag"><?= htmlspecialchars($jogo['genero'] ?: 'Sem gênero') ?></span>
                <h1 class="jogo-titulo"><?= htmlspecialchars($jogo['nome']) ?></h1>

                <!-- Avaliação -->
                <div class="jogo-avaliacao">
                    <?= renderEstrelas((float)($jogo['avaliacao'] ?? 0)) ?>
                    <span class="nota-numero"><?= number_format((float)($jogo['avaliacao'] ?? 0), 1) ?> / 5.0</span>
                </div>

                <!-- Preço e compra -->
                <div class="jogo-compra">
                    <div class="jogo-preco">R$ <?= number_format($jogo['preco'], 2, ',', '.') ?></div>
                    <button class="btn-comprar">🛒 Comprar Agora</button>
                </div>

                <?php if ($isAdmin): ?>
                    <a
                        href="excluir_jogos.php?id=<?= $jogo['id'] ?>"
                        onclick="return confirm('Excluir este jogo permanentemente?');"
                        class="btn-excluir"
                        style="margin-top:12px; display:inline-block;"
                    >🗑 Excluir Jogo</a>
                <?php endif; ?>
            </div>
        </div>

        <!-- DETALHES -->
        <div class="jogo-detalhes">

            <!-- Descrição -->
            <div class="jogo-bloco">
                <h2 class="bloco-titulo">📖 Descrição</h2>
                <p class="bloco-texto">
                    <?= ($jogo['descricao'] ?? null)
                    ? nl2br(htmlspecialchars($jogo['descricao']))
                    : '<em class="sem-info">Nenhuma descrição disponível.</em>' ?>
                </p>
            </div>

            <!-- Requisitos do sistema -->
            <div class="jogo-bloco">
                <h2 class="bloco-titulo">🖥️ Requisitos do Sistema</h2>
                <?php if ($jogo['requisitos'] ?? null): ?>
                    <div class="requisitos-grid">
                        <?php
                        // Formata linhas como "Chave: valor"
                        $linhas = array_filter(array_map('trim', explode("\n", $jogo['requisitos'])));
                        foreach ($linhas as $linha):
                            $partes = explode(":", $linha, 2);
                        ?>
                            <div class="req-item">
                                <span class="req-chave"><?= htmlspecialchars(trim($partes[0])) ?></span>
                                <span class="req-valor"><?= isset($partes[1]) ? htmlspecialchars(trim($partes[1])) : '—' ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="sem-info">Requisitos não informados.</p>
                <?php endif; ?>
            </div>

        </div>

    </div>

    <footer>© 2026 GameIntel - Todos os direitos reservados.</footer>
</div>
</body>
</html>

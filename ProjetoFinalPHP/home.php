<?php
session_start();
include "auth_check.php";
include "conexao.php";

/* UPDATE COM PROTEÇÃO CONTRA SQL INJECTION */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar'])) {

    $id     = (int) $_POST['id'];
    $nome   = pg_escape_string($conn, $_POST['nome']);
    $genero = pg_escape_string($conn, $_POST['genero']);
    $preco  = (float) $_POST['preco'];
    $imagem = pg_escape_string($conn, $_POST['imagem']);

    pg_query($conn, "
        UPDATE jogos SET
            nome   = '$nome',
            genero = '$genero',
            preco  = '$preco',
            imagem = '$imagem'
        WHERE id = $id
    ");

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$result  = pg_query($conn, "SELECT * FROM jogos ORDER BY id DESC");
$isAdmin = !empty($_SESSION['is_admin']);
$nome    = htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameIntel</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="home">
    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="#">🛒 carrinho</a>
            <a href="#">Filtros</a>
            <?php if ($isAdmin): ?>
                <a href="adicionar_jogo.php">➕ Adicionar Jogo</a>
                <a href="admin.php">⚙️ Painel Admin</a>
            <?php endif; ?>

            <span class="usuario-nav">👤 <?= $nome ?></span>
            <a href="logout.php">Sair</a>
        </div>
    </div>
    <!-- BANNER -->
    <div class="banner">
        <h2>Bem-vindo<?= $isAdmin ? ' (Admin)' : '' ?>, <?= $nome ?>!</h2>
        <p>Descubra os melhores jogos para PC</p>
    </div>
    <h1>Jogos em Destaque</h1>
    <!-- JOGOS -->
    <div class="jogos">
    <?php while ($jogo = pg_fetch_assoc($result)): ?>
        <div class="card">
            <img src="<?= htmlspecialchars($jogo['imagem'] ?: 'https://placehold.co/300x200/0F172A/60A5FA?text=Sem+Imagem') ?>"
                 alt="<?= htmlspecialchars($jogo['nome']) ?>">
            <div class="card-content">
                <h3><?= htmlspecialchars($jogo['nome']) ?></h3>
                <p><?= htmlspecialchars($jogo['genero']) ?></p>
                <div class="preco">
                    R$ <?= number_format((float)$jogo['preco'], 2, ',', '.') ?>
                </div>
                <div class="card-acoes">
                    <a href="jogo.php?id=<?= $jogo['id'] ?>" class="btn-ver-mais">Ver mais</a>
                    <?php if ($isAdmin): ?>
                        <a href="#"
                           class="btn-editar"
                           onclick="abrirCard(
                                '<?= $jogo['id'] ?>',
                                '<?= htmlspecialchars($jogo['nome'], ENT_QUOTES) ?>',
                                '<?= htmlspecialchars($jogo['genero'], ENT_QUOTES) ?>',
                                '<?= $jogo['preco'] ?>',
                                '<?= htmlspecialchars($jogo['imagem'], ENT_QUOTES) ?>'
                           ); return false;">
                            ✏️ Editar
                        </a>

                        <a href="excluir_jogos.php?id=<?= $jogo['id'] ?>"
                           class="btn-excluir"
                           onclick="return confirm('Excluir <?= htmlspecialchars($jogo['nome'], ENT_QUOTES) ?>?')">
                            🗑 Excluir
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
    </div>
    <footer>© 2026 GameIntel</footer>
</div>
<!-- MODAL EDITAR -->
<div id="cardEditar" class="card-editar-overlay">

    <div class="card-editar">

        <h2>Editar Jogo</h2>

        <form method="POST">

            <input type="hidden" name="id"     id="edit_id">
            <input type="hidden" name="editar" value="1">

            <label>Nome</label>
            <input type="text"   name="nome"   id="edit_nome"   required>

            <label>Gênero</label>
            <input type="text"   name="genero" id="edit_genero" required>

            <label>Descrição</label>
            <input type="text" name="descricao" id="edit_descricao" required>

            <label>Preço</label>
            <input type="number" name="preco"  id="edit_preco"  step="0.01" min="0" required>

            <label>URL da Imagem</label>
            <input type="url"    name="imagem" id="edit_imagem" placeholder="https://...">

            <button type="submit">💾 Salvar</button>
            <button type="button" class="btn-fechar" onclick="fecharCard()">✕ Cancelar</button>

        </form>

    </div>
</div>

<script>
function abrirCard(id, nome, genero, preco, imagem) {
    document.getElementById('edit_id').value     = id;
    document.getElementById('edit_nome').value   = nome;
    document.getElementById('edit_genero').value = genero;
    document.getElementById('edit_preco').value  = preco;
    document.getElementById('edit_imagem').value = imagem;

    document.getElementById('cardEditar').style.display = 'flex';
}

function fecharCard() {
    document.getElementById('cardEditar').style.display = 'none';
}

window.addEventListener('click', function(e) {
    if (e.target === document.getElementById('cardEditar')) {
        fecharCard();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fecharCard();
});
</script>

</body>
</html>
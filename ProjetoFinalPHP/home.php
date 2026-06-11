<?php
session_start();
include "auth_check.php";
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['editar'])) {
    $id         = (int) $_POST['id'];
    $nome       = pg_escape_string($conn, $_POST['nome']);
    $genero     = pg_escape_string($conn, $_POST['genero']);
    $preco      = (float) $_POST['preco'];
    $imagem     = pg_escape_string($conn, $_POST['imagem']);
    $descricao  = pg_escape_string($conn, $_POST['descricao'] ?? '');
    $requisitos = pg_escape_string($conn, $_POST['requisitos'] ?? '');

    pg_query($conn, "
        UPDATE jogos SET
            nome        = '$nome',
            genero      = '$genero',
            preco       = '$preco',
            imagem      = '$imagem',
            descricao   = '$descricao',
            requisitos  = '$requisitos'
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
    <link rel="icon" type="image/x-icon" href="./img/logo.png">
</head>
<body>
<div class="home">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="carrinho.php" class="btn-carrinho-nav">
                🛒 Carrinho <span id="carrinho-badge" style="display:none"></span>
            </a>
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

<!-- FILTRO POR GÊNERO -->
<div class="filtro-container">
    <?php
    $genres = pg_query($conn, "SELECT DISTINCT genero FROM jogos WHERE genero IS NOT NULL ORDER BY genero");
    ?>
    <button class="filtro-btn ativo" onclick="filtrar('todos', this)">Todos</button>
    <?php while ($g = pg_fetch_assoc($genres)): ?>
        <button class="filtro-btn" onclick="filtrar('<?= htmlspecialchars($g['genero'], ENT_QUOTES) ?>', this)">
            <?= htmlspecialchars($g['genero']) ?>
        </button>
    <?php endwhile; ?>
</div> 

    <!-- JOGOS -->
    <div class="jogos">
    <?php while ($jogo = pg_fetch_assoc($result)): ?>
        <div class="card" data-genero="<?= htmlspecialchars($jogo['genero'], ENT_QUOTES) ?>">
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
                    <button class="btn-carrinho"
                        onclick="adicionarCarrinho(
                            <?= $jogo['id'] ?>,
                            '<?= htmlspecialchars($jogo['nome'], ENT_QUOTES) ?>',
                            <?= $jogo['preco'] ?>
                        )">🛒 Adicionar
                    </button>
                    <?php if ($isAdmin): ?>
                        <a href="#" class="btn-editar"
                           onclick="abrirCard(
                                '<?= $jogo['id'] ?>',
                                '<?= htmlspecialchars($jogo['nome'], ENT_QUOTES) ?>',
                                '<?= htmlspecialchars($jogo['genero'], ENT_QUOTES) ?>',
                                '<?= $jogo['preco'] ?>',
                                '<?= htmlspecialchars($jogo['imagem'], ENT_QUOTES) ?>',
                                '<?= htmlspecialchars($jogo['descricao'] ?? '', ENT_QUOTES) ?>',
                                '<?= htmlspecialchars($jogo['requisitos'] ?? '', ENT_QUOTES) ?>'
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
            <input type="text" name="nome" id="edit_nome" required>

            <label>Gênero</label>
            <input type="text" name="genero" id="edit_genero" required>

            <label>Descrição</label>
            <input type="text" name="descricao" id="edit_descricao">

            <label>Requisitos</label>
            <input type="text" name="requisitos" id="edit_requisitos">

            <label>Preço</label>
            <input type="number" name="preco" id="edit_preco" step="0.01" min="0" required>

            <label>URL da Imagem</label>
            <input type="url" name="imagem" id="edit_imagem" placeholder="https://...">

            <button type="submit">💾 Salvar</button>
            <button type="button" class="btn-fechar" onclick="fecharCard()">✕ Cancelar</button>
        </form>
    </div>
</div>

<div id="toast"></div>

<script>
/* MODAL */
function abrirCard(id, nome, genero, preco, imagem, descricao, requisitos) {
    document.getElementById('edit_id').value         = id;
    document.getElementById('edit_nome').value       = nome;
    document.getElementById('edit_genero').value     = genero;
    document.getElementById('edit_preco').value      = preco;
    document.getElementById('edit_imagem').value     = imagem;
    document.getElementById('edit_descricao').value  = descricao;
    document.getElementById('edit_requisitos').value = requisitos;
    document.getElementById('cardEditar').style.display = 'flex';
}

function fecharCard() {
    document.getElementById('cardEditar').style.display = 'none';
}

window.addEventListener('click', function(e) {
    if (e.target === document.getElementById('cardEditar')) fecharCard();
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') fecharCard();
});

/* CARRINHO */
function adicionarCarrinho(id, nome, preco) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');

    const existe = carrinho.find(i => i.id === id);
    if (existe) {
        existe.qtd++;
    } else {
        carrinho.push({ id, nome, preco, qtd: 1 });
    }

    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    atualizarContador();
    mostrarToast(`"${nome}" adicionado ao carrinho!`);
}

function atualizarContador() {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    const total  = carrinho.reduce((acc, i) => acc + i.qtd, 0);
    const badge  = document.getElementById('carrinho-badge');
    if (badge) {
        badge.textContent = total;
        badge.style.display = total > 0 ? 'inline-flex' : 'none';
    }
}

function mostrarToast(msg) {
    const toast = document.getElementById('toast');
    toast.textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 2500);
}

atualizarContador();

/* FILTRO */
function filtrar(genero, btn) {
    document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('ativo'));
    btn.classList.add('ativo');

    document.querySelectorAll('.card').forEach(card => {
        if (genero === 'todos' || card.dataset.genero === genero) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
</body>
</html>
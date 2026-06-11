<?php
session_start();
include "auth_check.php";
include "conexao.php";

$isAdmin    = !empty($_SESSION['is_admin']);
$nome       = htmlspecialchars($_SESSION['usuario_nome'] ?? 'Usuário');
$usuario_id = (int)($_SESSION['usuario_id'] ?? 1);

/* FINALIZAR COMPRA — recebe JSON do localStorage via POST */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['finalizar'])) {
    $itens = json_decode($_POST['itens'], true);

    if (!empty($itens)) {
        foreach ($itens as $item) {
            $jogo_id = (int)   $item['id'];
            $qtd     = (int)   $item['qtd'];
            $preco   = (float) $item['preco'];

            pg_query($conn, "
                INSERT INTO pedidos (usuario_id, jogo_id, quantidade, preco_unitario, data_pedido)
                VALUES ($usuario_id, $jogo_id, $qtd, $preco, NOW())
            ");
        }
    }

    header("Location: carrinho.php?sucesso=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrinho — GameIntel</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" type="image/x-icon" href="./img/logo.png">

</head>
<body>
<div class="home">

    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="home.php">← Voltar à Loja</a>
            <span class="usuario-nav">👤 <?= $nome ?></span>
            <a href="logout.php">Sair</a>
        </div>
    </div>

    <h1>🛒 Meu Carrinho</h1>

    <?php if (isset($_GET['sucesso'])): ?>
        <div class="alerta-sucesso">✅ Compra finalizada! Obrigado, <?= $nome ?>!</div>
    <?php endif; ?>

    <div class="carrinho-container">
        <div id="carrinho-itens"></div>

        <div class="carrinho-resumo" id="carrinho-resumo" style="display:none">
            <h2>Resumo</h2>
            <div class="resumo-linha">
                <span>Total</span>
                <strong id="resumo-total">R$ 0,00</strong>
            </div>

            <form method="POST" id="form-finalizar">
                <input type="hidden" name="finalizar" value="1">
                <input type="hidden" name="itens"     id="input-itens">
                <button type="submit" class="btn-finalizar">✅ Finalizar Compra</button>
            </form>

            <button class="btn-limpar" onclick="limparCarrinho()">🗑 Limpar Carrinho</button>
        </div>
    </div>

    <footer>© 2026 GameIntel</footer>
</div>

<script>
function formatarPreco(v) {
    return 'R$ ' + parseFloat(v).toFixed(2).replace('.', ',');
}

function renderCarrinho() {
    const carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    const container = document.getElementById('carrinho-itens');
    const resumo    = document.getElementById('carrinho-resumo');
    container.innerHTML = '';

    if (carrinho.length === 0) {
        container.innerHTML = `
            <div class="carrinho-vazio">
                <p>Seu carrinho está vazio.</p>
                <a href="home.php" class="btn-ver-mais">Voltar à loja</a>
            </div>`;
        resumo.style.display = 'none';
        return;
    }

    let total = 0;

    carrinho.forEach((item, index) => {
        total += item.preco * item.qtd;
        container.innerHTML += `
            <div class="carrinho-card">
                <div class="carrinho-info">
                    <h3>${item.nome}</h3>
                    <p>${formatarPreco(item.preco)} × ${item.qtd}</p>
                </div>
                <div class="carrinho-acoes">
                    <button onclick="mudarQtd(${index}, -1)">−</button>
                    <span>${item.qtd}</span>
                    <button onclick="mudarQtd(${index}, +1)">+</button>
                    <button class="btn-remover" onclick="remover(${index})">🗑</button>
                </div>
                <div class="carrinho-subtotal">
                    ${formatarPreco(item.preco * item.qtd)}
                </div>
            </div>`;
    });

    document.getElementById('resumo-total').textContent = formatarPreco(total);
    document.getElementById('input-itens').value = JSON.stringify(carrinho);
    resumo.style.display = 'block';
}

function mudarQtd(index, delta) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    carrinho[index].qtd += delta;
    if (carrinho[index].qtd <= 0) carrinho.splice(index, 1);
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    renderCarrinho();
}

function remover(index) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho') || '[]');
    carrinho.splice(index, 1);
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    renderCarrinho();
}

function limparCarrinho() {
    if (!confirm('Limpar todo o carrinho?')) return;
    localStorage.removeItem('carrinho');
    renderCarrinho();
}

// Limpa localStorage após compra finalizada
<?php if (isset($_GET['sucesso'])): ?>
localStorage.removeItem('carrinho');
<?php endif; ?>

renderCarrinho();
</script>
</body>
</html>
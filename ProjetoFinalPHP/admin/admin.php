<?php
include "../includes/auth_check.php";
requireAdmin();
include "../includes/conexao.php";

$msg = "";

// Promover / rebaixar usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['promover'])) {
        $id  = (int)$_POST['user_id'];
        $sql = "UPDATE usuarios SET is_admin = TRUE WHERE id = $1";
        pg_query_params($conn, $sql, [$id]);
        $msg = "Usuário promovido a admin!";
    }

    if (isset($_POST['rebaixar'])) {
        $id = (int)$_POST['user_id'];
        // Não deixa rebaixar a si mesmo
        if ($id === (int)$_SESSION['usuario_id']) {
            $msg = "Você não pode remover seu próprio acesso admin.";
        } else {
            $sql = "UPDATE usuarios SET is_admin = FALSE WHERE id = $1";
            pg_query_params($conn, $sql, [$id]);
            $msg = "Permissão admin removida.";
        }
    }

    if (isset($_POST['excluir_usuario'])) {
        $id = (int)$_POST['user_id'];
        if ($id === (int)$_SESSION['usuario_id']) {
            $msg = "Você não pode excluir sua própria conta por aqui.";
        } else {
            pg_query_params($conn, "DELETE FROM usuarios WHERE id = $1", [$id]);
            $msg = "Usuário excluído.";
        }
    }
}

// Busca dados
$usuarios = pg_query($conn, "SELECT id, nome, is_admin FROM usuarios ORDER BY is_admin DESC, nome ASC");
$jogos    = pg_query($conn, "SELECT id, nome, preco, genero FROM jogos ORDER BY id DESC");

$total_usuarios = pg_num_rows($usuarios);
$total_jogos    = pg_num_rows($jogos);

// Conta admins
$admins_result = pg_query($conn, "SELECT COUNT(*) as total FROM usuarios WHERE is_admin = TRUE");
$total_admins  = pg_fetch_assoc($admins_result)['total'];

// Rebobina resultado para usar no loop depois
pg_result_seek($usuarios, 0);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Painel Admin — GameIntel</title>
<link rel="stylesheet" href="../public/css/style.css">
<link rel="icon" type="image/x-icon" href="../public/img/logo.png">
</head>
<body>
<div class="home">

    <!-- NAVBAR -->
    <div class="navbar">
        <div class="logo">🎮 GameIntel</div>
        <div class="menu">
            <a href="../pages/home.php">← Voltar à Loja</a>
            <span class="usuario-nav">⚙️ Admin: <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
            <a href="../pages/logout.php" class="btn-logout-nav">Sair</a>
        </div>
    </div>

    <!-- TÍTULO -->
    <div class="banner">
        <h2>⚙️ Painel de Administração</h2>
        <p>Gerencie usuários e jogos da plataforma.</p>
    </div>

    <?php if ($msg): ?>
        <p class="msg-admin <?= str_contains($msg, 'não pode') ? 'msg-erro' : 'msg-sucesso' ?>">
            <?= htmlspecialchars($msg) ?>
        </p>
    <?php endif; ?>

    <!-- CARDS DE RESUMO -->
    <div class="admin-stats">
        <div class="stat-card">
            <span class="stat-numero"><?= $total_usuarios ?></span>
            <span class="stat-label">Usuários</span>
        </div>
        <div class="stat-card">
            <span class="stat-numero"><?= $total_admins ?></span>
            <span class="stat-label">Admins</span>
        </div>
        <div class="stat-card">
            <span class="stat-numero"><?= $total_jogos ?></span>
            <span class="stat-label">Jogos</span>
        </div>
        <div class="stat-card stat-action">
            <a href="../pages/jogo/adicionar_jogo.php">➕ Novo Jogo</a>
        </div>
    </div>

    <!-- TABELA DE USUÁRIOS -->
    <div class="admin-section">
        <h2 class="admin-section-title">👥 Usuários Cadastrados</h2>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Perfil</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($u = pg_fetch_assoc($usuarios)): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= htmlspecialchars($u['nome']) ?>
                            <?php if ($u['id'] == $_SESSION['usuario_id']): ?>
                                <span class="badge-voce">você</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($u['is_admin'] === 't'): ?>
                                <span class="badge-admin">Admin</span>
                            <?php else: ?>
                                <span class="badge-user">Usuário</span>
                            <?php endif; ?>
                        </td>
                        <td class="acoes">
                            <?php if ($u['is_admin'] !== 't'): ?>
                                <form method="POST" style="display:inline">
                                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                    <button type="submit" name="promover" class="btn-promover">⬆ Promover</button>
                                </form>
                            <?php elseif ($u['id'] != $_SESSION['usuario_id']): ?>
                                <form method="POST" style="display:inline">
                                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                    <button type="submit" name="rebaixar" class="btn-rebaixar">⬇ Rebaixar</button>
                                </form>
                            <?php endif; ?>

                            <?php if ($u['id'] != $_SESSION['usuario_id']): ?>
                                <form method="POST" style="display:inline" onsubmit="return confirm('Excluir usuário <?= htmlspecialchars($u['nome']) ?>?')">
                                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                                    <button type="submit" name="excluir_usuario" class="btn-excluir">🗑 Excluir</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABELA DE JOGOS -->
    <div class="admin-section">
        <h2 class="admin-section-title">🎮 Jogos Cadastrados</h2>
        <div class="table-wrapper">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Gênero</th>
                        <th>Preço</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($j = pg_fetch_assoc($jogos)): ?>
                    <tr>
                        <td><?= $j['id'] ?></td>
                        <td><?= htmlspecialchars($j['nome']) ?></td>
                        <td><?= htmlspecialchars($j['genero']) ?></td>
                        <td>R$ <?= number_format($j['preco'], 2, ',', '.') ?></td>
                        <td>
                            <a
                                href="../pages/jogo/excluir_jogos.php?id=<?= $j['id'] ?>"
                                onclick="return confirm('Excluir <?= htmlspecialchars($j['nome']) ?>?');"
                                class="btn-excluir"
                            >🗑 Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer>© 2026 GameIntel - Painel Administrativo</footer>
</div>
</body>
</html>

<?php
// Inclua este arquivo em qualquer página protegida
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function redirectToAppPath(string $relativePath): string {
    $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
    $segments   = explode('/', trim($scriptName, '/'));
    $depth      = max(0, count($segments) - 1);
    return str_repeat('../', $depth) . ltrim($relativePath, '/');
}

// Redireciona para login se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: " . redirectToAppPath('public/index.php'));
    exit();
}

// Bloqueia acesso admin se não for admin
function requireAdmin() {
    if (empty($_SESSION['is_admin'])) {
        header("Location: " . redirectToAppPath('pages/home.php'));
        exit();
    }
}
?>

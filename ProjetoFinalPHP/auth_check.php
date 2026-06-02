<?php
// Inclua este arquivo em qualquer página protegida
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redireciona para login se não estiver logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

// Bloqueia acesso admin se não for admin
function requireAdmin() {
    if (empty($_SESSION['is_admin'])) {
        header("Location: home.php");
        exit();
    }
}

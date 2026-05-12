<?php
session_start();

// Remove todas as sessões
session_destroy();

// Redireciona para a página inicial
header("Location: index.php");
exit();
?>
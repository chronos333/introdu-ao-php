<?php

// Inicia a sessão
session_start();

// Remove todos os dados da sessão
session_destroy();

// Redireciona para a página inicial
header("Location: index.php");
exit();
?>
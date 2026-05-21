<?php
// Tema padrão
$tema = "Claro";

// Verifica se existe cookie salvo
if (isset($_COOKIE["tema"])) {

    // Recebe o tema salvo no cookie
    $tema = $_COOKIE["tema"];
}

?>
<!-- Cabeçalho do sistema -->
<header>
    <h2>Empresa XYZ</h2>                                  
    <!-- Menu de navegação -->
    <nav>
        <a href="home.php">Home</a>
        <a href="logout.php">Sair</a>
    </nav>
    <!-- Exibe o tema salvo -->
    <p>Tema escolhido: <?php echo htmlspecialchars($tema); ?></p>
</header>
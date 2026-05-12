<?php

// Tema salvo no cookie
$tema = "Claro";

if (isset($_COOKIE["tema"])) {
    $tema = $_COOKIE["tema"];
}
?>

<header>
    <h2>Empresa XYZ</h2>

    <nav>
        <a href="home.php">Home</a>
        <a href="logout.php">Sair</a>
    </nav>

    <p>Tema escolhido: <?php echo $tema; ?></p>
</header>
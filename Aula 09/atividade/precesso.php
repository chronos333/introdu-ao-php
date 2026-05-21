<?php
    echo "<main>";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $compartilhamento = $_POST["compartilhamento"];

   //Exibindo as informaçoes
    echo "Nome: $nome <br>";
    echo "E-mail: $email <br>";
    echo "Como nos conheceu: $compartilhamento";
    }
    echo "</main>";
    ?>
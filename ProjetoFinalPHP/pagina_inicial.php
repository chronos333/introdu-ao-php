<?php

session_start();

require_once "conexao.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST['nome'];
    $credencial = $_POST['credencial'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM funcionarios
            WHERE credencial = :credencial
            AND senha = :senha";

    $resultado = $conexao->prepare($sql);

    $resultado->bindParam(":credencial", $credencial);
    $resultado->bindParam(":senha", $senha);

    $resultado->execute();

    $funcionario = $resultado->fetch(PDO::FETCH_ASSOC);

    if($funcionario){

        $_SESSION['usuario'] = $funcionario['nome'];

    }else{

        die("Credenciais inválidas");

    }

}else{

    die("Acesso inválido");

}

?>
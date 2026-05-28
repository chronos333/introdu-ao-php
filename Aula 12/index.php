<?php
require_once __DIR__ . "/connect_postgres.php"; // garante que o arquivo seja encontrado

try {
    $sql = "INSERT INTO alunos( 
        nome, 
        sobrenome,
        data_nascimento,
        turma
    ) VALUES (
        :nome,
        :sobrenome,
        :data_nascimento,
        :turma
    )";

    // Prepara a consulta
    $stmt = $conexao->prepare($sql);

    // Associa os valores
    $stmt->bindValue(":nome", "Lionel");
    $stmt->bindValue(":sobrenome", "Messi");
    $stmt->bindValue(":data_nascimento", "2026-04-14");
    $stmt->bindValue(":turma", "I2D35");

    // Executa a inserção
    $stmt->execute();

    echo "Aluno inserido com sucesso!";

} catch (PDOException $e) {
    echo "Erro ao inserir aluno: " . $e->getMessage();
}
?>
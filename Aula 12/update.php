<?php
require_once 'connect_postgres.php';

try {
    $id = 1;
    $novoSobrenome = 'Ronaldo';

    $sql = 'UPDATE alunos
            SET sobrenome = :sobrenome
            WHERE id = :id';

    $stmt = $conexao->prepare($sql);
    $stmt->bindValue(':sobrenome', $novoSobrenome);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    echo 'Aluno atualizado com sucesso. Linhas afetadas: ' . $stmt->rowCount();
} catch (PDOException $e) {
    echo 'Erro ao atualizar aluno: ' . $e->getMessage();
}
?>
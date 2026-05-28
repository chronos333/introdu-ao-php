<?php
require_once 'connect_postgres.php';

$id = 1;
$sql = 'SELECT * FROM alunos WHERE id = :id';

try {
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($aluno) {
        echo "ID: {$aluno['id']}<br>";
        echo "Nome: {$aluno['nome']}<br>";
        echo "Sobrenome: {$aluno['sobrenome']}<br>";
        echo "Data Nascimento: {$aluno['data_nascimento']}<br>";
        echo "Turma: {$aluno['turma']}<br>";
        echo "Ativo: " . ($aluno['ativo'] ? "Ativo" : "Inativo") . "<br><hr>";
    } else {
        echo 'Aluno não encontrado.';
    }
} catch (PDOException $e) {
    echo 'Erro na consulta: ' . $e->getMessage();
}
?>

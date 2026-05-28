<?php
require_once 'connect_postgres.php';

try {
    $sql = 'SELECT * FROM alunos';
    $stmt = $conexao->prepare($sql);
    $stmt->execute();

    $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($alunos) {
        foreach ($alunos as $aluno) {
            echo "ID: {$aluno['id']}<br>";
            echo "Nome: {$aluno['nome']}<br>";
            echo "Sobrenome: {$aluno['sobrenome']}<br>";
            echo "Data Nascimento: {$aluno['data_nascimento']}<br>";
            echo "Turma: {$aluno['turma']}<br>";
            echo "Ativo: " . ($aluno['ativo'] ? "Ativo" : "Inativo") . "<br><hr>";
        }
    } else {
        echo "Nenhum aluno encontrado.";
    }

} catch (PDOException $e) {
    echo "Erro na consulta: " . $e->getMessage();
}
?>
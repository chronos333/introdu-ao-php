<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <?php
        $funcionarios = [
    ["nome" => "Ana", "cargo" => "Analista", "salario" => 3500],

    ["nome" => "Carlos", "cargo" => "Desenvolvedor", "salario" => 4000],

    ["nome" => "Mariana", "cargo" => "Gerente", "salario" => 5000]

];

echo "<h1>Tabela funcionarios</h1>";
echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Nome</th>";
    echo "<th>Cargo</th>"; 
    echo "<th>salario</th>";
    echo "</tr>";
    foreach ($funcionarios as $f) {
        echo "<tr>";
        echo "<td>" . $f["nome"] . "</td>";
        echo "<td>" . $f["cargo"] . "</td>";
        echo "<td>" . $f["salario"] . "</td>";
        echo "</tr>";
    }
?>
</body>
</html>


<?php

// Lista de funcionários
$funcionarios = ["Ana", "Carlos", "João", "Maria", "Lucas"];
// FOR - repetição automática
for ($i = 0; $i < count($funcionarios); $i++) {
    // IF - lógica integrada
    if ($funcionarios[$i] == "Maria") {
        echo $funcionarios[$i] . " - Gerente<br>";
    } else {
        echo $funcionarios[$i] . " - Funcionário<br>";
    }
}

?>
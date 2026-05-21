<?php

echo "<h1>Classificaçao de vendas e lucros</h1>";

function classificarVendas($itensVendidos) {
    if ($itensVendidos <120) {
        return "Venda baixa";
    } elseif ($itensVendidos > 120 && $itensVendidos < 500) {
        return "Venda média";
    } else {
        return "Venda alta";
    }
} 
function classificarLucros($lucro) {
    if ($lucro < 10000) {
        return "Lucro baixo";
    } else {
        return "Bom lucro";
    }
} 

echo classificarVendas(120) . "<br>";
echo classificarLucros(15000) . "<br>";

?>
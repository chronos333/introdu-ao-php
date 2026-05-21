<?php

function calcularTempoEmpresa($anoFundacao, $anoAtual) {
    return $anoAtual - $anoFundacao;   
}
$tempoEmpresa = calcularTempoEmpresa(2010,2026);

    echo "Tempo de empresa: $tempoEmpresa anos";

?>
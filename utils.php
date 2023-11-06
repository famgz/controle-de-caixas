<?php 

// tratamento numerico para o DB
function saldo_str_to_float($saldo_inicial) {
    $saldo_inicial = str_replace('.', '', $saldo_inicial);  // remover pontos
    $saldo_inicial = str_replace(',', '.', $saldo_inicial);  // trocar virgulas por pontos
    return $saldo_inicial;
}

function debug($x) {
    echo '<pre>';
    var_dump($x);
    echo '<pre>';
}

?>

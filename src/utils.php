<?php 

// formatar string para float
function saldo_str_to_float($saldo_inicial) {
    $saldo_inicial = str_replace('.', '', $saldo_inicial);  // remover pontos
    $saldo_inicial = str_replace(',', '.', $saldo_inicial);  // trocar virgulas por pontos
    return $saldo_inicial;
}

// formatar float para string
function saldo_float_to_str($valor) {
    return number_format($valor, 2, ',', '.');
}

// formatar string date para timestamp
function string_to_date($string) {
    // formatar para timestamp
    $timestamp = strtotime($string);
    return date('d/m/Y', $timestamp);
}

function debug($x) {
    echo '<pre>';
    var_dump($x);
    echo '<pre>';
}

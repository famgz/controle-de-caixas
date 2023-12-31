<?php
include_once "library.php";
session_start();

$rpp = filter_input(INPUT_GET, "rpp", FILTER_DEFAULT); // rpp -> resultados por pagina
$busca = filter_input(INPUT_GET, "busca", FILTER_SANITIZE_SPECIAL_CHARS);

$query = $busca ? "WHERE nome LIKE :busca" : "";
$busca_todos = "SELECT id, nome, saldo_inicial FROM caixas $query";

// Medida de segurança para evitar slq injection se receber diretamente $busca em $query
$caixas = $db->prepare($busca_todos);
if ($busca) {
    $caixas->bindValue(":busca", "%" . $busca . "%");
}
$caixas->execute();

$todos = $caixas;
$limit = $todos->rowCount();

$p = 1;
$offset = 0;

if ($rpp != 'todos') {
    if (!$rpp) {
        $limit = 10;
    } else {
        $limit = $rpp;
    }

    $pagina = filter_input(INPUT_GET, 'p', FILTER_DEFAULT);
    if (!$pagina) {
        $p = 1;
    } else {
        $p = $pagina;
    }

    $offset = $p - 1;
    $offset = $offset * $limit;

    $caixas = $db->prepare("$busca_todos LIMIT $offset, $limit");
    if ($busca) {
        $caixas->bindValue(":busca", "%" . $busca . "%");
    }
    $caixas->execute();

    $todos = $db->prepare($busca_todos);
    if ($busca) {
        $todos->bindValue(":busca", "%" . $busca . "%");
    }
    $todos->execute();
}

$qt_registros = $todos->rowCount();
$qt_paginas = $qt_registros > 0 ? ceil($qt_registros / $limit) : 0; // evitar divisao por zero

<?php
include_once "library.php";
include_once "calcular-lancamentos.php";
session_start();

date_default_timezone_set("America/Recife");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

$location = 'Location: index.php';

// Checar se id foi passado como parametro
if (!$id) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! ID do caixa não informado.
        </p>
    ";
    header($location);
    exit;
}

$data_ini = filter_input(INPUT_GET, "data-ini", FILTER_DEFAULT);
$data_fin = filter_input(INPUT_GET, "data-fin", FILTER_DEFAULT);

// fallback para o mes atual
// $data_ini = $data_ini ? $data_ini : date('Y-m-01');
// $data_fin = $data_fin ? $data_fin : date('Y-m-t');

// fallback para o mes atual
$data_ini = $data_ini ? $data_ini : "";
$data_fin = $data_fin ? $data_fin : "";

// Obter dados do caixa atual
$sql = $db->prepare("
    SELECT id, nome, saldo_inicial 
    FROM caixas
    WHERE id = :id;
");
$sql->bindValue(':id', $id);
$sql->execute();

if (!$sql->rowCount()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa #{$id} não encontrado.
        </p>
    ";
    header($location);
    exit;
}

$caixa = $sql->fetch(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC -> avoid duplicated values

$msg = '';
if (!empty($_SESSION['msg'])) {
    $msg = $_SESSION['msg'];
    unset($_SESSION['msg']);
}

// Obter lancamentos do caixa atual
$lancamentos = calcular_lancamentos($caixa, $data_ini, $data_fin);

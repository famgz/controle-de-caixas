<?php

include_once "library.php";
session_start();

$dados = filter_input_array(INPUT_POST);

$location = 'Location: show-caixa.php?id=' . $dados["id_caixa"];

// debug($dados);
// exit;

// checar campos vazios
$campo_vazio = false;
foreach ($dados as $item) {
    if ($item == "") {
        $campo_vazio = true;
    }
}

// Erro, campo vazio encontrado
if ($campo_vazio) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Todos os campos devem estar preenchidos!
        </p>
    ";
    header($location);
    exit;
}

// formatar numero
$dados['valor_movimento'] = saldo_str_to_float($dados['valor_movimento']);

// debug($dados);
// exit;

$sql = $db->prepare("
    INSERT INTO caixas_lancamentos 
    SET id_caixa = :id_caixa,
        discriminacao_movimento = :discriminacao_movimento,
        data_movimento = :data_movimento,
        valor_movimento = :valor_movimento,
        movimento = :movimento
");


foreach ($dados as $key => $value) {
    $sql->bindValue(":{$key}", $value);
}

// Erro ao executar SQL
if (!$sql->execute()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro ao executar comando SQL!
        </p>
    ";
    header($location);
    exit;
}

// Sucesso, dados adicionados
$_SESSION['msg'] = "
    <p class='alert alert-success'>
        {$success_icon}
        Lançamento adicionado com sucesso!
    </p>
    ";
header($location);
exit;


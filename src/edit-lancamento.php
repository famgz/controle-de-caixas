<?php

session_start();
include_once "library.php";

$dados = filter_input_array(INPUT_POST);

// debug($dados);

$location = 'Location: show-caixa.php?id=' . $dados["id_caixa"];

$campo_vazio = false;

foreach ($dados as $item) {
    if (!$item) {
        $campo_vazio = true;
    }
}

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

$sql = $db->prepare("
    UPDATE caixas_lancamentos
    SET
        movimento = :movimento,
        data_movimento = :data_movimento,
        valor_movimento = :valor_movimento,
        discriminacao_movimento = :discriminacao_movimento
    WHERE id = :id;
");
$sql->bindValue(":movimento", $dados['movimento']);
$sql->bindValue(":data_movimento", $dados['data_movimento']);
$sql->bindValue(":valor_movimento", saldo_str_to_float($dados['valor_movimento']));
$sql->bindValue(":discriminacao_movimento", $dados['discriminacao_movimento']);
$sql->bindValue(":id", $dados['id_lancamento']);

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

// Sucesso, dados editados
$_SESSION['msg'] = "
    <p class='alert alert-success'>
        {$success_icon}
        Lançamento editado com sucesso!
    </p>
    ";
header($location);
exit;
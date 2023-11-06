<?php
session_start();
include_once("db.php");
require_once("icons.php");

$dados = filter_input_array(INPUT_POST, $_POST, FILTER_DEFAULT);

// checagem de valor do campo nome * já está sendo feita dentro do html
if ($dados['nome'] == '') {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! O campo nome é obrigatório.
        </p>
    ";
    header('Location: index.php');
    exit;
}

// tratamento numerico para o DB
$dados['saldo_inicial'] = str_replace('.', '', $dados['saldo_inicial']);  // remover pontos
$dados['saldo_inicial'] = str_replace(',', '.', $dados['saldo_inicial']);  // trocar virgulas por pontos

$sql = $db->prepare('SELECT id FROM caixas WHERE nome = :nome');
$sql->bindValue(':nome', $dados['nome']);
$sql->execute();

// checagem de duplicidade do campo nome
if($sql->rowCount() > 0) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa \"{$dados['nome']}\" já existe.
            Tente novamente com outro nome.
        </p>
    ";
    header('Location: index.php');
    exit;
}

$sql = $db->prepare('INSERT INTO caixas SET nome = :nome, saldo_inicial = :saldo_inicial');
$sql->bindValue(':nome', $dados['nome']);
$sql->bindValue(':saldo_inicial', $dados['saldo_inicial']);

if(!$sql->execute()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa não criado.
        </p>
    ";
    header('Location: index.php');
    exit;
}

$_SESSION['msg'] = "
    <p class='alert alert-success'>
        {$success_icon}
        Caixa criado com sucesso!
    </p>
";
header('Location: index.php');
exit;
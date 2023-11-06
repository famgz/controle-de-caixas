<?php 
include_once "library.php";
session_start();

$dados = filter_input_array(INPUT_POST);

// Mensagem erro `nome` vazio
if(!$dados['nome']) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! O campo nome deve ser preenchido.
        </p>
    ";
    header('Location: index.php');
    exit;
}

$dados['saldo_inicial'] = saldo_str_to_float($dados['saldo_inicial']);

// Validar duplicidade de `nome`
$sql = $db->prepare("SELECT id FROM caixas WHERE nome = :nome AND id <> :id");  // selecionar entradas com mesmo nome mas ids diferentes
$sql->bindValue(":nome", $dados["nome"]);
$sql->bindValue(":id", $dados["id"]);
$sql->execute();

// Mensagem de erro campo `nome` duplicado
if($sql->rowCount()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa com nome \"{$dados['nome']}\" já existe.
        </p>
    ";
    header('Location: index.php');
    exit;
}

// debug($dados);

// Atualizar DB
$sql = $db->prepare("UPDATE caixas SET nome = :nome, saldo_inicial = :saldo_inicial WHERE id = :id");
$sql->bindValue(":id", $dados["id"]);
$sql->bindValue(":nome", $dados["nome"]);
$sql->bindValue(":saldo_inicial", $dados["saldo_inicial"]);

// Mensagem de falha na execução do comando
if(!$sql->execute()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa não editado.
        </p>
    ";
    header('Location: index.php');
    exit;
}

// Mensagem de sucesso na execução do comando
$_SESSION['msg'] = "
    <p class='alert alert-success'>
        {$success_icon}
        Caixa \"{$dados['nome']}\" atualizado com sucesso!
    </p>
";
header('Location: index.php');
exit;


?>
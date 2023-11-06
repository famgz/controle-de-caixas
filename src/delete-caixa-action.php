<?php
include_once "library.php";
session_start();

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

debug($id);

// Mensagem erro id inválido
if(!$id) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! ID inválido.
        </p>
        ";
    header('Location: index.php');
    exit;
}

$sql = $db->prepare("DELETE FROM caixas WHERE id = :id");
$sql->bindValue(":id", $id);

// Mensagem erro id não encontrado
if(!$sql->execute()) {
    $_SESSION['msg'] = "
    <p class='alert alert-danger'>
        {$error_icon}
        Erro! Caixa #{$id} já excluído ou inexistente.
    </p>
    ";
    header('Location: index.php');
    exit;
}

// Mensagem sucesso
$_SESSION['msg'] = "
    <p class='alert alert-success'>
        {$success_icon}
        Caixa #{$id} excluído com sucesso!
    </p>
";
header('Location: index.php');
exit;

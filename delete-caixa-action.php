<?php
session_start();
include_once("db.php");

$id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);

$error_icon = "<i class='fa-solid fa-circle-exclamation'></i>";
$success_icon = "<i class='fa-solid fa-circle-check'></i>";

if($id) {
    $sql = $db->prepare("DELETE FROM caixas WHERE id = :id");
    $sql->bindValue(":id", $id);
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

    $_SESSION['msg'] = "
        <p class='alert alert-success'>
            {$success_icon}
            Caixa #{$id} excluído com sucesso!
        </p>
    ";
    header('Location: index.php');
    exit;
}

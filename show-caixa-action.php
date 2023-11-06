<?php 
session_start();
require_once("db.php");
require_once("icons.php");

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if(!$id) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa não existe.
        </p>
    ";
    header('Location: index.php');
    exit;
}

?>
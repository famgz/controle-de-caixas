<?php 
include_once "library.php";
session_start();

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

// Checar se id foi passado como parametro
if(!$id) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! ID do caixa não informado.
        </p>
    ";
    header('Location: index.php');
    exit;
}

$sql = $db->prepare('SELECT id, nome, saldo_inicial FROM caixas WHERE id = :id');
$sql->bindValue(':id', $id);
$sql->execute();

if(!$sql->rowCount()) {
    $_SESSION['msg'] = "
        <p class='alert alert-danger'>
            {$error_icon}
            Erro! Caixa #{$id} não encontrado.
        </p>
    ";
    header('Location: index.php');
    exit;
}

$caixa = $sql->fetch(PDO::FETCH_ASSOC);  // PDO::FETCH_ASSOC -> avoid duplicated values





// echo '<pre>';
// var_dump($caixa);
// echo '<pre>';

?>
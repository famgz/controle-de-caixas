t
<?php
include_once "library.php";
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


// Obter caixas_lancamentos do caixa
$sql = $db->prepare("
    SELECT 
        id,
        id_caixa,
        movimento,
        data_movimento,
        valor_movimento,
        discriminacao_movimento
    FROM caixas_lancamentos 
    WHERE id_caixa = :id
    ORDER BY data_movimento ASC;
");
$sql->bindValue(':id', $id);


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

$lancamentos = $sql->fetchAll();

// debug($lancamentos);

// atualizar saldo ate aquela data e lancamento
$saldo = $caixa['saldo_inicial'];
foreach($lancamentos as &$item) {  // `&` antes do $item garante modificar o proprio array ao inves de uma copia
    $entrada = $item['movimento'] == 'entrada' ? $item['valor_movimento'] : 0;
    $saida = $item['movimento'] == 'saida' ? $item['valor_movimento'] : 0;

    $saldo += $entrada - $saida;
    $item['saldo'] = $saldo;
}

unset($item);
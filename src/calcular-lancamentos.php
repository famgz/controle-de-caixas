<?php

function calcular_lancamentos(&$caixa, $data_ini='', $data_fin='') {

    include_once "library.php";
    
    date_default_timezone_set("America/Recife");
    
    $location = 'Location: index.php';
    
    global $db;

    // Transformar datas para extremos caso esteja vazia
    $data_ini = $data_ini ? $data_ini : '0';
    $data_fin = $data_fin ? $data_fin : '9999-12-31';

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
        AND (data_movimento BETWEEN :data_ini AND :data_fin)
        ORDER BY data_movimento ASC;
    ");
    $sql->bindValue(':id', $caixa['id']);
    $sql->bindValue(':data_ini', $data_ini);
    $sql->bindValue(':data_fin', $data_fin);
    
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

    // atualizar saldos ate datas dos lancamentos
    $saldo = $caixa['saldo_inicial'];
    foreach($lancamentos as &$lancamento) {  // `&` antes do $item garante modificar o proprio array ao inves de uma copia
        $entrada = $lancamento['movimento'] == 'entrada' ? $lancamento['valor_movimento'] : 0;
        $saida = $lancamento['movimento'] == 'saida' ? $lancamento['valor_movimento'] : 0;
        
        $saldo += $entrada - $saida;
        $lancamento['saldo'] = $saldo;
    }

    unset($lancamento);

    $caixa['saldo_atual'] = $saldo;

    return $lancamentos;
}

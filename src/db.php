<?php 

$host = 'localhost';
$dbname = 'controle_caixas';
$user = 'root';
$pass = '';
$sqlFile = "controle_caixas.sql";

try {
    $db = new PDO("mysql:host=$host", $user, $pass);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Checar se database já existe
    $databasesExistentes = $db->query("SHOW DATABASES")->fetchAll(PDO::FETCH_COLUMN);
    if (in_array($dbname, $databasesExistentes)) {
        // echo "Database já existe.\n";
        $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        return;
    }

    // Criar database
    $db->exec("CREATE DATABASE IF NOT EXISTS $dbname");

    $db->exec("USE $dbname");

    // Criar tables
    $sql = file_get_contents($sqlFile);
    $db->exec($sql);
    // echo "Script SQL executado com sucesso\n";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}

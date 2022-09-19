<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];
$PkRendimento = $_GET['PkRendimento'];

try {
    $Pc = 'CALL PcExcluiRendimentos(?, ?)';
    $Conn = $Pdo->prepare($Pc);
    $Conn->bindValue(1, $PkUsuario, PDO::PARAM_INT);
    $Conn->bindValue(2, $PkRendimento, PDO::PARAM_INT);

    if ($Conn->execute()) {
        header("location:Index.php");
    } else {
        echo 'Erro.';
    }
} catch (PDOException $Erro) {
    echo $Erro->getMessage();
}
exit;

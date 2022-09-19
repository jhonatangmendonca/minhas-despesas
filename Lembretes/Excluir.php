<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];
$PkLembrete = $_GET['PkLembrete'];

try {
    $Pc = 'CALL PcExcluiLembretes(?, ?)';
    $Conn = $Pdo->prepare($Pc);
    $Conn->bindValue(1, $PkLembrete, PDO::PARAM_INT);
    $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);

    if ($Conn->execute()) {
        header("location:Index.php");
    } else {
        echo 'Erro.';
    }
} catch (PDOException $Erro) {
    echo $Erro->getMessage();
}
exit;

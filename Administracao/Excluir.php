<?php
session_start();

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];
$Pk = $_GET['Pk'];

try {
    $Pc = 'CALL PcExcluiUsuarios(?, ?)';
    $Conn = $Pdo->prepare($Pc);
    $Conn->bindValue(1, $Pk, PDO::PARAM_INT);
    $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);

    if ($Conn->execute()) {
    } else {
        echo 'Erro.';
    }
} catch (PDOException $Erro) {
    echo $Erro->getMessage();
}

header("location:Index.php");
exit;

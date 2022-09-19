
<?php
session_start();

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkDespesa = $_GET["PkDespesa"];
$PkUsuario = $_GET["PkUsuario"];
$Tipo = $_GET["Tipo"];
try {
    $Pc = 'CALL PcPagaEstornaDespesa(?, ?, ?)';
    $Conn = $Pdo->prepare($Pc);
    $Conn->bindValue(1, $PkDespesa, PDO::PARAM_INT);
    $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
    $Conn->bindValue(3, $Tipo, PDO::PARAM_INT);

    if ($Conn->execute()) {
    } else {
        echo 'Erro.';
    }
} catch (PDOException $Erro) {
    echo $Erro->getMessage();
}

header("location:Index.php");
exit;

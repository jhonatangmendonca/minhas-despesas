<?php
session_start();

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

echo "<BR>" . $PkUsuario = $_SESSION['user_id'];
echo "<BR>" . $PkDespesa = $_GET['PkDespesa'];
echo "<BR>" . $Parcelado = $_GET['Parcelado'];
echo "<BR>" . $Fixa = $_GET['DespesaFixa'];
echo "<BR>" . $ExcluiTodas = $_GET['ExcluiTodas'];

try {
    $Pc = 'CALL PcExcluiDespesas(?, ?, ?, ?, ?)';
    $Conn = $Pdo->prepare($Pc);
    $Conn->bindValue(1, $PkDespesa, PDO::PARAM_INT);
    $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
    $Conn->bindValue(3, $Fixa, PDO::PARAM_STR);
    $Conn->bindValue(4, $Parcelado, PDO::PARAM_STR);
    $Conn->bindValue(5, $ExcluiTodas, PDO::PARAM_STR);
    if ($Conn->execute()) {
        header("location:Index.php");
    } else {
        echo 'Erro.';
    }
} catch (PDOException $Erro) {
    echo $Erro->getMessage();
}

exit;

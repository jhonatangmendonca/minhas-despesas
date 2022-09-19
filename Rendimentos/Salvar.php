<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set("display_errors", "on");

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];
$Descricao = $_POST['Descricao'];
$Valor = $_POST["Valor"];
$DataRendimento = $_POST["DataRendimento"];
$Observacao = $_POST["Observacao"];

if (empty($_POST["PkRendimento"])) {
  $PkRendimento = 0;
} else {
  $PkRendimento = $_POST["PkRendimento"];
}

if (empty($_POST["RendimentoFixo"])) {
  $RendimentoFixo = 'Não';
} else if ($_POST["RendimentoFixo"] == 0) {
  $RendimentoFixo = 'Não';
} else {
  $RendimentoFixo = 'Sim';
}

try {
  $Pc = 'CALL PcSalvaRendimentos(?, ?, ?, ?, ?, ?, ?)';
  $Conn = $Pdo->prepare($Pc);
  $Conn->bindValue(1, $PkRendimento, PDO::PARAM_INT);
  $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
  $Conn->bindValue(3, $Descricao, PDO::PARAM_STR);
  $Conn->bindValue(4, $DataRendimento, PDO::PARAM_STR);
  $Conn->bindValue(5, $Valor, PDO::PARAM_STR);
  $Conn->bindValue(6, $Observacao, PDO::PARAM_STR);
  $Conn->bindValue(7, $RendimentoFixo, PDO::PARAM_STR);

  if ($Conn->execute()) {
    header("location:Index.php");
  } else {
    echo 'Erro.';
  }
} catch (PDOException $Erro) {
  echo $Erro->getMessage();
}
exit;

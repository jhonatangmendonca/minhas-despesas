<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

echo $PkUsuario = $_SESSION['user_id'];
echo $Titulo = $_POST["Titulo"];
echo $Descricao = $_POST["Descricao"];
echo $Cor = $_POST["Cor"];

if (empty($_POST["PkLembrete"])) {
  echo  $PkLembrete = 0;
} else {
  echo  $PkLembrete = $_POST["PkLembrete"];
}

try {
  $Pc = 'CALL PcSalvaLembretes(?, ?, ?, ?, ?)';
  $Conn = $Pdo->prepare($Pc);
  $Conn->bindValue(1, $PkLembrete, PDO::PARAM_INT);
  $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
  $Conn->bindValue(3, $Titulo, PDO::PARAM_STR);
  $Conn->bindValue(4, $Descricao, PDO::PARAM_STR);
  $Conn->bindValue(5, $Cor, PDO::PARAM_STR);

  if ($Conn->execute()) {
  } else {
    echo 'Erro.';
  }
} catch (PDOException $Erro) {
  echo $Erro->getMessage();
}

header("location:Index.php");
exit;

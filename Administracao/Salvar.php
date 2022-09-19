<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];
$Pk = $_POST['Pk'];
$NomeUsuario = $_POST['NomeUsuario'];
$Email = $_POST['Email'];
$Senha = base64_encode($_POST['Senha']);

if (empty($_POST["Senha2"])) {
  $Senha2 = "";
} else {
  echo  $Senha2 = base64_encode($_POST['Senha2']);
}

if ($Senha != $Senha2) {
  header('location:Adicionar.php?senhas-diferentes');
  exit;
}

try {
  $Pc = 'CALL PcSalvaUsuarios(?, ?, ?, ?)';
  $Conn = $Pdo->prepare($Pc);
  $Conn->bindValue(1, $Pk, PDO::PARAM_INT);
  $Conn->bindValue(2, $NomeUsuario, PDO::PARAM_STR);
  $Conn->bindValue(3, $Senha, PDO::PARAM_STR);
  $Conn->bindValue(4, $Email, PDO::PARAM_STR);

  if ($Conn->execute()) {
  } else {
    echo 'Erro.';
  }
} catch (PDOException $Erro) {
  echo $Erro->getMessage();
}

header("location:Index.php");
exit;

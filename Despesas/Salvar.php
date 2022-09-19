<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
ini_set("display_errors", "on");
require './../Login/check.php';
require './../Conexao/ConexaoDB.php';
$Descricao = "";
echo '<br> PkUsuario: ' . $PkUsuario = $_SESSION['user_id'];
echo '<br> Descricao: ' . $Descricao = $_POST['Descricao'];
echo '<br> Valor: ' . $Valor = $_POST["Valor"];
echo '<br> Data Vencimento: ' . $DataVencimento = $_POST["DataVencimento"];
echo '<br> Observacao: ' . $Observacao = $_POST["Observacao"];

if (empty($_POST["DataPagamento"])) {
  echo '<br> Data Pagamento: ' . $DataPagamento = NULL;
} else {
  echo '<br> Data Pagamento: ' . $DataPagamento = $_POST["DataPagamento"];
}

if (empty($_POST["PkDespesa"])) {
  echo '<br> PkDespesa:'  . $PkDespesa = 0;
} else {
  echo '<br> PkDespesa: ' . $PkDespesa = $_POST["PkDespesa"];
}

if (empty($_POST["IdFixoParcelado"])) {
  echo '<br> Fixa:' . $Fixa = 'Não';
  echo '<br> Repetir:' . $Repetir = 'Não';
  echo '<br> Parcelar:' . $Parcelar = 'Não';
} else if ($_POST["IdFixoParcelado"] == 1) {
  echo '<br> Fixa:' . $Fixa = 'Sim';
  echo '<br> Repetir:' . $Repetir = 'Não';
  echo '<br> Parcelar:' . $Parcelar = 'Não';
} else if ($_POST["IdFixoParcelado"] == 2) {
  echo '<br> Fixa:' . $Fixa = 'Não';
  echo '<br> Repetir:' . $Repetir = 'Sim';
  echo '<br> Parcelar:' . $Parcelar = 'Não';
} else {
  echo '<br> Fixa:' . $Fixa = 'Não';
  echo '<br> Repetir:' . $Repetir = 'Não';
  echo '<br> Parcelar:' . $Parcelar = 'Sim';
}

if (empty($_POST["IdQntParcelas"])) {
  $QuantidadeParcelas = 0;
} else {
  $QuantidadeParcelas = $_POST["IdQntParcelas"];
}

if ($QuantidadeParcelas == 0) {
  if (empty($_POST["IdQntParcelasFixas"])) {
    $QuantidadeParcelas = 0;
  } else {
    $QuantidadeParcelas = $_POST["IdQntParcelasFixas"];
  }
}

echo '<br> Numero de Parcelas: ' . ABS($QuantidadeParcelas);

if (!empty($_POST["Status"])) {
  echo '<br> Status: ' . $Status = $_POST["Status"];
} else {
  echo '<br> Status: ' . $Status = 'NãoPaga';
}

try {
  $Pc = 'CALL PcSalvaDespesas(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
  $Conn = $Pdo->prepare($Pc);
  $Conn->bindValue(1, $PkDespesa, PDO::PARAM_INT);
  $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
  $Conn->bindValue(3, $Descricao, PDO::PARAM_STR);
  $Conn->bindValue(4, $DataVencimento, PDO::PARAM_STR);
  $Conn->bindValue(5, $DataPagamento, PDO::PARAM_STR);
  $Conn->bindValue(6, $Valor, PDO::PARAM_STR);
  $Conn->bindValue(7, $Observacao, PDO::PARAM_STR);
  $Conn->bindValue(8, $Status, PDO::PARAM_STR);
  $Conn->bindValue(9, $Fixa, PDO::PARAM_STR);
  $Conn->bindValue(10, $Repetir, PDO::PARAM_STR);
  $Conn->bindValue(11, $Parcelar, PDO::PARAM_STR);
  $Conn->bindValue(12, ABS($QuantidadeParcelas), PDO::PARAM_INT);

  if ($Conn->execute()) {
    header("location:Index.php");
  } else {
    echo 'Erro.';
  }
} catch (PDOException $Erro) {
  echo $Erro->getMessage();
}
exit;

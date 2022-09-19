<?php
session_start();
require './../Login/check.php';
include "../../Config/Config.php";

$usuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];
$idUsuario = $_SESSION['user_id'];
$Senha = base64_encode($_POST["Senha"]);

$query = "UPDATE Usuarios SET Senha = '" . $Senha . "', Senha2 = '" . $Senha . "'  WHERE Pk = '" . $idUsuario . "';";

$resultado = $CONEXAO->query($query);
if ($resultado) {
} else {
  die("ERRO AO GRAVAR EDITAR");
}
$CONEXAO->close();
header('Location:Index.php');
exit;

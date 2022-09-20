<?php

$SERVIDOR = "127.0.0.1";
$USUARIO = "root";
$SENHA = "";
$BANCO = "MinhasDespesas";

$CONEXAO = mysqli_connect($SERVIDOR, $USUARIO, $SENHA, $BANCO);

if (!$CONEXAO) {
    echo "Erro: Não foi possível conectar ao MySQL.<br/>";
    echo "Código de erro: " . mysqli_connect_errno() . "<br/>";
    echo "Erro: " . mysqli_connect_error() . "<br/>";
    exit;
}

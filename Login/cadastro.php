<?php
require '../Config/config.php';

$nome =  $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senha2 = $_POST['senha2'];
$aux = 0;
if ($senha != $senha2) {
    header('Location: cadastrar.php?senhas-diferentes');
    exit;
}

// cria o hash da senha
$senhaHash = base64_encode($senha);
$senhaHash2 = base64_encode($senha2);

$query = "SELECT * FROM Usuarios 
WHERE Email = '$email' Or NomeUsuario = '$nome'";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        header('Location: cadastrar.php?login-duplicado');
    } else {
        $var = 1;
    }
} else {
    die("ERRO AO PEGAR DADOS DO BANCO");
}

if ($var == 1) {
    include "../Config/Config.php";
    $query = "INSERT INTO Usuarios(NomeUsuario, Email, Senha, Senha2) 
    VALUES ('" . $nome . "', '" . $email . "', '" . $senhaHash . "', '" . $senhaHash2 . "');";
    $resultado = $CONEXAO->query($query);
    if ($resultado) {
    } else {
        echo ("ERRO AO CADASTRAR");
    }
    header('Location: login.php?cadastro-realizado');
    // $idInserido = mysqli_insert_id($CONEXAO);
    // include "../Config/Config.php";
    // $query = "INSERT INTO usuariosPreferencia(FkUsuario, Campo, Valor) VALUES('" . $idInserido . "', 'Grid', 'Grid');";
    // $resultado = $CONEXAO->query($query);
    // if ($resultado) {
    //     header('Location: login.php?cadastro-realizado');
    // } else {
    //     echo ("ERRO AO CADASTRAR3");
    // }
}
$CONEXAO->close();
exit;

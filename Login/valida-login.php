<?php
require '../Config/config.php';

// resgata variáveis do formulário
$email = isset($_POST['email']) ? $_POST['email'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
$senhaUsuario = base64_encode($senha);

if (empty($email) || empty($senha)) {
    header('Location: login.php?informe-dados');
    exit;
}

// // cria o hash da senha
// $senhaHash = make_hash($senha);

// $PDO = db_connect();

$query = "SELECT Pk, NomeUsuario FROM Usuarios Where Email = '$email' and Senha = '$senhaUsuario'";
$resultado = $CONEXAO->query($query);
if ($resultado) {
    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $id = $linha["Pk"];
            $nome = $linha["NomeUsuario"];
        }
    } else {
        header('Location: login.php?senha-invalida');
        exit;
    }
}

session_start();
$_SESSION['logged_in'] = true;
$_SESSION['user_id'] =  $id;
$_SESSION['user_name'] = $nome;
$_SESSION['tema'] = $tema;

header('Location: ../Index.php');

?>

<!-- $sql = "SELECT id, nome FROM usuarios WHERE login = :email AND senha = :senha";
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':email', $email);
$stmt->bindParam(':senha', $senhaHash);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) <= 0) { header('Location: login.php?senha-invalida'); exit; } // pega o primeiro usuário $user=$users[0]; session_start(); $_SESSION['logged_in']=true; $_SESSION['user_id']=$user['id']; $_SESSION['user_name']=$user['nome']; header('Location: ../MinhasDespesas/Index.php'); -->
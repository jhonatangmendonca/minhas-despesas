<?php
$Host = 'localhost';
$Banco = 'MinhasDespesas';
$Usuario = 'localhost';
$Senha = 'localhost';

try {
    $Pdo = new PDO('mysql:host=' . $Host . ';dbname=' . $Banco . '', $Usuario, $Senha);
    $Pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

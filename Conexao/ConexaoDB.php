<?php
$Host = 'localhost';
$Banco = 'MinhasDespesas';
//$Usuario = 'root';
//$Senha = 'Jhon@2441MySql';
$Usuario = 'localhost';
$Senha = 'localhost@mysql';

try {
    $Pdo = new PDO('mysql:host=' . $Host . ';dbname=' . $Banco . '', $Usuario, $Senha);
    $Pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}

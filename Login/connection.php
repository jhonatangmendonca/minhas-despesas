<?php 
require '../config.php';
//Dados do banco de dados
define("DB_HOST", $SERVIDOR);
define("DB_NAME", $BANCO);
define("DB_USER", $USUARIO);
define("DB_PASS", $SENHA);

//Conexao com Banco de Dados
return new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USER, DB_PASS);

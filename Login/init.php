<?php
require 'Config.php';
// constantes com as credenciais de acesso ao banco MySQL
define('DB_HOST', $SERVIDOR);
define('DB_USER', $USUARIO);
define('DB_PASS', $SENHA);
define('DB_NAME', $BANCO);
 
// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);
 
// inclui o arquivo de funçõees
require_once 'functions.php';
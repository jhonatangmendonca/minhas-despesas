<?php
session_start();
require './../Login/check.php';
date_default_timezone_set('America/Sao_Paulo');
$usuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Minhas Despesas - Início</title>
</head>

<body>
    <?php
    if ($_GET['status'] == 'sum') {
        $data = $_COOKIE['DataCorrente'];
        $array = explode("/", $data);
        $dia = $array[0];
        $mes = $array[1];
        $ano = $array[2];
        $dates = mktime(0, 0, 0, $mes, $dia, $ano);
        $somarMes = strtotime('+ 1 Months', $dates);
        $arrayss = explode("/", date('d/n/Y', $somarMes));
        $dia = $arrayss[0];
        $mes = $arrayss[1];
        $ano = $arrayss[2];
        setcookie('mes', $mes);
        setcookie('ano', $ano);
        setcookie('DataCorrente', date('d/n/Y', $somarMes));
        header("location:Index.php");
    } else if ($_GET['status'] == 'sub') {
        echo $data = $_COOKIE['DataCorrente'];
        $array = explode("/", $data);
        $dia = $array[0];
        $mes = $array[1];
        $ano = $array[2];
        $dates = mktime(0, 0, 0, $mes, $dia, $ano);
        $subtrairMes = strtotime("- 1 Months", $dates);
        $arrayss = explode("/", date('d/n/Y', $subtrairMes));
        $dia = $arrayss[0];
        $mes = $arrayss[1];
        $ano = $arrayss[2];
        setcookie('mes', $mes);
        setcookie('ano', $ano);
        setcookie('DataCorrente', date('d/n/Y', $subtrairMes));
        header("location:Index.php");
    } else {
        $mes = date('n');
        $ano = date('Y');
        setcookie('mes', $mes);
        setcookie('ano', $ano);
        setcookie('DataCorrente',  date('d/n/Y'));
        header("location:Index.php");
    }
    ?>
</body>

</html>
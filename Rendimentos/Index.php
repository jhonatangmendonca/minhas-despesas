<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$NomeUsuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];
$Periodo = str_replace("/", "-", $_COOKIE['DataCorrente']);
$Periodo = date('Y-m-d', strtotime($Periodo));
$Mes = $_COOKIE['mes'];
$Ano = $_COOKIE['ano'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- TITLE  -->
    <title>Meus Rendimentos</title>
    <!-- META -->
    <meta charset="utf-8">
    <meta name="theme-color" content="#303f9f">
    <meta name="apple-mobile-web-app-status-bar-style" content="#303f9f">
    <meta name="msapplication-navbutton-color" content="#303f9f">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- FAVICON  -->
    <link rel="shortcut icon" href="./../Public/IMG/favicon.png" type="image/x-icon" />
    <!-- CSS  -->
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link type="text/css" rel="stylesheet" href="./../Public/CSS/Menu.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/CSS/classes.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="./../Public/SCSS/buttons.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <!-- SCRIPT -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="./../Public/JS/Script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</head>

<body>
    <ul id="slide-out" class="side-nav fixed z-depth-2">
        <li class="center no-padding">
            <div class="indigo darken-2 white-text" style="height: 180px;">
                <div class="row">
                    <img style="margin-top: 15%;" width="100" height="100" src="https://i.imgur.com/QMq4fE5.png" class="circle responsive-img" />
                </div>
            </div>
        </li>

        <li id="dash_users">
            <a href="./../Index.php" style="padding-right: 32px;">
                <b>Painel de Controle</b>
                <i style="float: right; line-height: 64px;" class="material-icons">dashboard</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./../Despesas/Index.php" style="padding-right: 32px;">
                <b>Despesas</b>
                <i style="float: right; line-height: 64px;" class="material-icons">shopping_cart</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./../Rendimentos/Index.php" style="padding-right: 32px;">
                <b>Rendimentos</b>
                <i style="float: right; line-height: 64px;" class="material-icons">local_atm</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./../Lembretes/Index.php" style="padding-right: 32px;">
                <b>Lembretes</b>
                <i style="float: right; line-height: 64px;" class="material-icons">event_note</i>
            </a>
        </li>

        <li id="dash_users">
            <a href="./../Usuario/Index.php" style="padding-right: 32px;">
                <b>Configurações</b>
                <i style="float: right; line-height: 64px;" class="material-icons">settings</i>
            </a>
        </li>

        <?php if ($PkUsuario == 1) { ?>
            <li id="dash_users">
                <a href="./../Administracao/Index.php" style="padding-right: 32px;">
                    <b>Usuários</b>
                    <i style="float: right; line-height: 64px;" class="material-icons">person</i>
                </a>
            </li>
        <?php }  ?>

        <li id="dash_users">
            <a onclick="fnFazLogout();" style="padding-right: 30px;"><b>Sair</b>
                <i style="float: right; line-height: 64px; padding-left: 10px;" class="material-icons">logout</i>
            </a>
        </li>
    </ul>

    <header style="position: fixed; z-index: 905; width: 100vw; top:0">
        <nav class="indigo" role="navigation">
            <a style="margin-left: 15px;" href="#" data-target="slide-out" data-activates="slide-out" class="sidenav-trigger  button-collapse"><i class="mdi-navigation-menu"></i></a>
            <div class=" indigo darken-2">
                <a style="margin-left: 20px;" class="breadcrumb white-text" href="./../Index.php">Início</a>
                <span class="breadcrumb gray-text lighten-5">Meus Rendimentos</span>
                <div style="margin-right: 20px;" id="timestamp" class="right">
                </div>
            </div>
        </nav>
        <nav>
            <div class="valign-wrapper indigo darken-5" id="DataAnoDespesas">
                <ul class="center-align" style="margin: 0 auto;">
                    <li> <a class="waves-effect waves-teal btn btn-small tooltipped" onclick="reload('subtrair');" data-position="bottom" data-tooltip="Ir Para o Mês Anterior"><i style="line-height: 125%;" class="material-icons">chevron_left</i></a></li>
                    <li> <a style="width: 180px; margin: 0 auto;" class="waves-effect waves-light btn tooltipped" onblur="fnMostraMesData();" onclick="reload('corrente');" data-position="bottom" data-tooltip="Ir Para o Mês Corrente"><input class="white-text center" style="cursor: pointer; height: 100%" type="text" id="LabelMesAnoCorrente" value="" disabled onblur="fnMostraMesData();"></a></li>
                    <li> <a class="waves-effect waves-light btn btn-small tooltipped" onclick="reload('somar');" data-position="bottom" data-tooltip="Ir Para o Próximo Mês"><i style="line-height: 125%;" class="material-icons">chevron_right</i></a></li>
                </ul>
            </div>
        </nav>
    </header>
    <main style="margin-top: 140px; margin-bottom: 150px;">
        <div class="row">
            <?php
            echo    "<input type='hidden' id='mesDespesa' value='$Mes'>";
            echo    "<input type='hidden' id='anoDespesa' value='$Ano'>";
            $Total = 0;
            try {
                $Pc = 'CALL PcSelectRendimentos(?, ?, ?)';
                $Conn = $Pdo->prepare($Pc);
                $Conn->bindValue(1, 0, PDO::PARAM_INT);
                $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
                $Conn->bindValue(3, $Periodo, PDO::PARAM_STR);
                if ($Conn->execute()) {
                    while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                        $PkRendimento = $Result->Pk;
                        $Descricao = $Result->Descricao;
                        $DataVencimento = $Result->DataRendimento;
                        $ValorDespesa = $Result->Valor;
                        $Observacao = $Result->Observacao;
                        $Total = $Total + $ValorDespesa;
            ?>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="<?php echo $Class ?> no-margin">
                                </div>
                                <div class="card-content">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span data-position="top" data-tooltip="<?php echo $Descricao; ?>" class="card-title indigo-text text-darken-2 truncate tooltipped"><?php echo $Descricao; ?></span>
                                        <i class="activator material-icons right" style="cursor: pointer;">more_vert</i>
                                    </div>
                                    <a href="Detalhamento.php?Pk=<?php echo $PkRendimento ?>" data-position="right" data-tooltip="Ver Detalhes / Alterar" class="btn-floating halfway-fab waves-effect waves-light blue darken-4 tooltipped"><i class="material-icons btn-ver-detalhes">remove_red_eye</i></a>
                                    <a href="Excluir.php?PkRendimento=<?php echo $PkRendimento ?>" data-position="right" data-tooltip="Excluir Rendimento" class="btn-floating halfway-fab waves-effect waves-light red darken-4 tooltipped"><i class="material-icons btn-excluir-item">delete</i></a>

                                    <p class="collection-item right-align indigo-text text-darken-2">R$ <?php echo number_format($ValorDespesa, 2, ",", "."); ?></p>
                                    <p class="right-align indigo-text text-darken-2"><?php echo date('d/m/Y', strtotime($DataVencimento)); ?></p>
                                </div>

                                <div class=" card-reveal">
                                    <span class="card-title indigo-text text-darken-2">Observação:<i class="material-icons right">close</i></span>
                                    <hr>
                                    <p class="indigo-text text-darken-2"><?php echo nl2br($Observacao); ?></p>
                                </div>
                            </div>
                        </div>
            <?php

                    }
                } else {
                    echo 'Erro.';
                }
            } catch (PDOException $Erro) {
                echo $Erro->getMessage();
            }
            ?>
        </div>
        <div class="fixed-action-btn click-to-toggle tooltipped" data-position="left" data-tooltip="Novo Rendimento" style="bottom: 90px; right: 24px;">
            <a href="./Adicionar.php" class="btn-floating btn-large teal lighten-1 waves-effect waves-light">
                <i class="large material-icons">add</i>
            </a>
        </div>
    </main>
    <?php
    $ValorDespesas = 0;
    try {
        $Pc = 'CALL PcSelectValorDespesas(?, ?)';
        $Conn = $Pdo->prepare($Pc);
        $Conn->bindValue(1, $PkUsuario, PDO::PARAM_INT);
        $Conn->bindValue(2, $Periodo, PDO::PARAM_STR);
        if ($Conn->execute()) {
            while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                $ValorDespesas = $Result->ValorDespesas;
            }
        } else {
            echo 'Erro.';
        }
    } catch (PDOException $Erro) {
        echo $Erro->getMessage();
    }
    ?>
    <footer class="indigo darken-2 white-text" style="position: fixed; width: 100vw; bottom: 0; z-index: 900;padding-bottom: 10px;padding-top: 10px;">
        <div class="container">
            <div class="row" style="margin-bottom: 0px;">
                <div class="left"><span Class="text-label text-white" style="font-weight: 900;">Total dos Rendimentos: </span></div>
                <div class="right"><span Class="text-label">R$ <?php echo number_format($Total, 2, ",", "."); ?></span></div>
            </div>
            <div class="row" style="margin-bottom: 0px;">
                <div class="left"><span Class="text-label" style="font-weight: 900;">Saldo Disponível: </span></div>
                <div class="right"><span Class="text-label text-white">R$ <?php echo number_format($Total - $ValorDespesas, 2, ",", "."); ?></span></div>
            </div>
        </div>
    </footer>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../Public/JS/Script.js"></script>

</html>
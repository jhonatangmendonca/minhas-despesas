<?php
session_start();

require_once './../Login/functions.php';
require_once './../Login/check.php';
require_once './../Conexao/ConexaoDB.php';

$NomeUsuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- TITLE  -->
    <title>Administração</title>
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
            <div class="indigo darken-2">
                <a style="margin-left: 20px;" class="breadcrumb white-text" href="./../Index.php">Início</a>
                <span class="breadcrumb gray-text lighten-5">Usuários</span>
                <div style="margin-right: 20px;" id="timestamp" class="right">
                </div>
            </div>
        </nav>
    </header>
    <main style="margin-top: 70px; margin-bottom: 50px;">
        <div Class="row">
            <?php
            try {
                $Pc = 'CALL PcSelectUsuarios(?)';
                $Conn = $Pdo->prepare($Pc);
                $Conn->bindValue(1, 0, PDO::PARAM_INT);
                if ($Conn->execute()) {
                    while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                        $Pk = $Result->Pk;
                        $NomeUsuario = $Result->NomeUsuario;
                        $Email = $Result->Email;
                        $Senha = $Result->Senha;
                        $DataHora = $Result->DataHora;

                        if (strtotime($DataHora)) {
                            $DataHora = date("d/m/Y H:i:s", strtotime($DataHora));
                        }
            ?>
                        <div class="col s12 m6 l4">
                            <div class="card">
                                <div class="card-content">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span data-position="top" data-tooltip="<?php echo $NomeUsuario; ?>" class="card-title indigo-text text-darken-2 truncate tooltipped"><?php echo $NomeUsuario; ?></span>
                                        <i data-position="left" data-tooltip="Ver Detalhes / Alterar" class="activator material-icons right tooltipped" style="cursor: pointer;">more_vert</i>
                                    </div>
                                    <a href="Detalhamento.php?Pk=<?php echo $Pk ?>" data-position="right" data-tooltip="Ver Detalhes / Alterar" class="btn-floating halfway-fab waves-effect waves-light blue darken-4 tooltipped"><i class="material-icons btn-ver-detalhes">remove_red_eye</i></a>
                                    <a href="Excluir.php?Pk=<?php echo $Pk ?>" data-position="right" data-tooltip="Excluir Lembrete" class="btn-floating halfway-fab waves-effect waves-light red darken-4 tooltipped"><i class="material-icons btn-excluir-item">delete</i></a>
                                    <p class="collection-item right-align text-destaque indigo-text text-darken-2"><?php echo $DataHora; ?></p>
                                </div>

                                <div class="card-reveal">
                                    <span class="card-title indigo-text text-darken-2">Detalhes:<i class="material-icons right">close</i></span>
                                    <hr>
                                    <p class=" indigo-text text-darken-2"><?php echo $Email ?></p>
                                    <p class=" indigo-text text-darken-2"><?php echo base64_decode($Senha) ?></p>
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
    <footer class="indigo darken-2 white-text" style="position: fixed; width: 100vw; bottom: 0; z-index: 900;padding-bottom: 10px;padding-top: 10px;">
        <div class="container">
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
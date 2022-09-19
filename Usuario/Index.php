<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

include './../Config/Config.php';
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
    <title>Configurações de Usuário</title>
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
            <a href="./Index.php" style="padding-right: 32px;">
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
                <span class="breadcrumb gray-text lighten-5">Usuário</span>
                <div style="margin-right: 20px;" id="timestamp" class="right">
                </div>
            </div>
        </nav>
    </header>
    <form name="FormConfigUsuario" method="post">
        <main class="container" style="margin-top: 90px;margin-bottom: 70px;">
            <div class="form-group new-form">
                <?php
                $query = "SELECT U.* FROM Usuarios U Where U.Pk = $PkUsuario";
                $resultado = $CONEXAO->query($query);
                if ($resultado) {
                    if ($resultado->num_rows > 0) {
                        while ($linha = $resultado->fetch_assoc()) {
                            $usuario = $linha["NomeUsuario"];
                            $senha = base64_decode($linha["Senha"]);
                            $email = $linha["Email"];
                ?>
                            <br>
                            <br>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="Email" name="Email" type="text" class="validate" value="<?php echo $email ?>" disabled>
                                    <label class="active" for="Email">E-Mail:</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="Usuario" name="Usuario" type="text" class="validate" value="<?php echo $usuario ?>" disabled>
                                    <label class="active" for="Usuario">Usuário:</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="Senha" name="Senha" type="text" class="validate" value="<?php echo $senha ?>" minlength="8" maxlength="12">
                                    <label class="active" for="Senha">Senha:</label>
                                </div>
                            </div>
                <?php
                        }
                    }
                } else {
                    die("Erro!");
                }
                $CONEXAO->close();
                ?>
            </div>
        </main>
        <footer class="indigo darken-2" style="position: fixed; width: 100vw; bottom: 0; z-index: 900; padding-top: 0px; padding-bottom: 0px">
            <div class="row">
                <div class="input-field col s12 center-align">
                    <input type="submit" name="BntSalvarSenha" id="BntSalvarSenha" onclick="fnProcessaEdicaoConfigUsuario(2);" class="ml-1 item-hide btn btn-sm btn-success" value="Alterar Senha">
                </div>
            </div>
        </footer>
    </form>
    </div>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../Public/JS/Script.js"></script>

</html>
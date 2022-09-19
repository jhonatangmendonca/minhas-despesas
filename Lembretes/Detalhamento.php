<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$NomeUsuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];
$usuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- TITLE  -->
    <title>Meus Lembretes - Detalhes</title>
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
        <nav>
            <nav class="indigo" role="navigation">
                <a style="margin-left: 15px;" href="#" data-target="slide-out" data-activates="slide-out" class="sidenav-trigger  button-collapse"><i class="mdi-navigation-menu"></i></a>
                <div class=" indigo darken-2">
                    <a style="margin-left: 20px;" class="breadcrumb white-text" href="./Index.php">Meus Lembretes</a>
                    <span class="breadcrumb gray-text lighten-5">Detalhes</span>
                    <div style="margin-right: 20px;" id="timestamp" class="right">
                    </div>
                </div>
            </nav>
    </header>
    <br>
    <form action="Salvar.php" method="post">
        <main class="container" style="margin-top: 70px;margin-bottom: 120px;">
            <?php
            if (empty($_GET["Pk"])) {
                header("location:Index.php");
            } else {
                $PkLembrete = $_GET["Pk"];
            }
            try {
                $Pc = 'CALL PcSelectLembretes(?, ?)';
                $Conn = $Pdo->prepare($Pc);
                $Conn->bindValue(1, $PkLembrete, PDO::PARAM_INT);
                $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);

                if ($Conn->execute()) {
                    while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                        $Titulo = $Result->Titulo;
                        $Descricao = $Result->Descricao;
                        $Cor = $Result->Cor;
                    }
                } else {
                    echo 'Erro.';
                }
            } catch (PDOException $Erro) {
                echo $Erro->getMessage();
            }
            ?>
            <input type="hidden" id="PkLembrete" name="PkLembrete" class="form-control form-control-sm" value="<?php echo $PkLembrete ?>">

            <div class="form-group new-form">
                <div>
                    <a class="btn waves-effect waves-light red lighten-2" href="Index.php" title="Voltar a página anterior"><span class="text-white">Voltar</span></a>
                </div>
                <br>
                <br>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="Titulo" name="Titulo" type="text" class="validate" value="<?php echo $Titulo; ?>" required="">
                        <label class="active" for="Titulo">Descrição</label>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="Descricao" name="Descricao" class="materialize-textarea"><?php echo $Descricao ?></textarea>
                        <label for="Descricao">Detalhes</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col s12">
                        <label for="Descricao">Cor</label>
                    </div>
                    <div class="input-field col s12">
                        <select class="browser-default" id="Cor" name="Cor" required="">
                            <option value="Padrao" <?= ($Cor == 'Padrao') ? 'selected' : '' ?>>Padrão</option>
                            <option value="Azul" <?= ($Cor == 'Azul') ? 'selected' : '' ?>>Azul</option>
                            <option value="Cinza" <?= ($Cor == 'Cinza') ? 'selected' : '' ?>>Cinza</option>
                            <option value="Laranja" <?= ($Cor == 'Laranja') ? 'selected' : '' ?>>Laranja</option>
                            <option value="Preto" <?= ($Cor == 'Preto') ? 'selected' : '' ?>>Preto</option>
                            <option value="Rosa" <?= ($Cor == 'Rosa') ? 'selected' : '' ?>>Rosa</option>
                            <option value="Roxo" <?= ($Cor == 'Roxo') ? 'selected' : '' ?>>Roxo</option>
                            <option value="Verde" <?= ($Cor == 'Verde') ? 'selected' : '' ?>>Verde</option>
                            <option value="Vermelha" <?= ($Cor == 'Vermelha') ? 'selected' : '' ?>>Vermelha</option>
                        </select>
                    </div>
                </div>
            </div>
        </main>
        <footer class="indigo darken-2" style="position: fixed; width: 100vw; bottom: 0; z-index: 900; padding-top: 0px; padding-bottom: 0px">
            <div class="row">
                <div class="input-field col s12 center-align">
                    <button class="btn waves-effect waves-light pl-2" id="BntSalvar" type="submit" name="action">Salvar
                        <i class="material-icons right">save</i>
                    </button>
                    <a href="Excluir.php?PkLembrete=<?php echo $PkLembrete ?>" class="btn waves-effect waves-light red lighten-2" id="BtnExcluir"> Excluir<i class="material-icons right">delete</i></a>
                </div>
            </div>
        </footer>
    </form>
</body>

<!-- SCRIPTS -->
<script type="text/javascript">
    $(".button-collapse").sideNav();
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
<script type="text/javascript" src="./../Public/JS/Script.js"></script>

</html>
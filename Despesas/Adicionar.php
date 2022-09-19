<?php
session_start();
require './../Login/check.php';

$usuario = $_SESSION['user_name'];
$PkUsuario = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- TITLE  -->
    <title>Minhas Despesas - Adicionar</title>
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
                    <a style="margin-left: 20px;" class="breadcrumb white-text" href="./Index.php">Minhas Despesas</a>
                    <span class="breadcrumb gray-text lighten-5">Adicionar</span>
                    <div style="margin-right: 20px;" id="timestamp" class="right">
                    </div>
                </div>
            </nav>
    </header>
    <br>
    <main class="container" style="margin-top: 70px;margin-bottom: 70px;">
        <form class="form-group new-form" action="Salvar.php" method="post">
            <div>
                <a class="btn waves-effect waves-light red lighten-2" href="Index.php" title="Voltar a página anterior"><span class="text-white">Voltar</span></a>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="input-field col s6">
                    <input id="Descricao" name="Descricao" type="text" class="validate" required="">
                    <label class="active" for="Descricao">Descrição</label>
                </div>

                <div class="input-field col s6">
                    <input id="Valor" name="Valor" type="text" class="validate" required="">
                    <label class="active" for="Descricao" onKeyUp="maskIt(this, event, '###.###.###,##', true)">Valor</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="DataVencimento" name="DataVencimento" type="date" class="validate" value="<?php echo $DataVencimento ?>" required="">
                    <label class="active" for="DataVencimento">Data de Vencimento</label>
                </div>

                <div class="input-field col s6">
                    <input id="DataPagamento" disabled name="DataPagamento" type="date" class="validate" onchange="fnSetaDespesaPaga();" value="<?php echo $DataPagamento ?>">
                    <label class="active" for="DataPagamento">Data de Pagamento</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="Observacao" name="Observacao" class="materialize-textarea"></textarea>
                    <label for="Observacao">Detalhes</label>
                </div>
            </div>

            <div>
                <input type="checkbox" class="checkbox" onclick="fnAtivaParcelamento()" value="1" name="Repetir" id="Repetir">
                <label class="container-check pl-4 text-label" for="Repetir" title="Mostrar outras opções">Outras Opções</label>
            </div>
            <div id="repetirDespesas" class="item-hide">
                <div>
                    <input type="radio" checked="checked" id="IdFixo" value="1" name="IdFixoParcelado" checked disabled onclick="fnDesativaQuantidadeParcelas()">
                    <label class="container-check pl-4 text-label" for="IdFixo">Despesa Fixa</label> <small class="text-label">(A despera irá se repetir todo mês)</small>
                </div>

                <div>
                    <input type="radio" id="IdParceladoFixo" value="2" name="IdFixoParcelado" onclick="fnAtivaRepetirParcelado()">
                    <label class="container-check pl-4 text-label" for="IdParceladoFixo">Repetir Parcelado</label> <span class="helper-text" data-error="wrong" data-success="right"><small class="text-label">(A despera irá se repetir a quantidade informada)</small></span>
                </div>

                <div class="row item-hide" id="InputParcelas">
                    <div class="col s4">
                        <div class="input-field inline">
                            <input id="IdQntParcelasFixas" name="IdQntParcelasFixas" type="number" class="validate">
                            <label for="IdQntParcelasFixas">Nº de Parcelas:&nbsp;&nbsp;</label>
                        </div>
                    </div>
                </div>

                <div>
                    <input type="radio" id="IdParcelado" value="3" name="IdFixoParcelado" onclick="fnAtivaQuantidadeParcelas()">
                    <label class="container-check pl-4 text-label" for="IdParcelado">Parcelar Despesa</label> <span class="helper-text" data-error="wrong" data-success="right"><small class="text-label">(O sistema irá calcular as parcelas automaticamente)</small></span>
                </div>

                <div class="row item-hide" id="InputParcelas2">
                    <div class="col s4">
                        <div class="input-field inline">
                            <input id="IdQntParcelas" name="IdQntParcelas" type="number" class="validate">
                            <label for="IdQntParcelas">Nº de Parcelas:&nbsp;&nbsp;</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input type="submit" name="BntCadastrar" id="BntCadastrar" class="btn btn-sm btn-danger center" value="Salvar">
                </div>
            </div>
        </form>
    </main>
    <footer class="indigo" style="position: fixed; width: 100vw; bottom: 0; z-index: 900; padding-top: 15px; padding-bottom: 15px">
        <div class="footer-copyright">
            <div class="container center">
                <span>® <?php echo date("Y"); ?> - Minhas Despesas</a></span>
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
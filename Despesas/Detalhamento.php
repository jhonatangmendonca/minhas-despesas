<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

require './../Login/check.php';
require './../Conexao/ConexaoDB.php';

$PkUsuario = $_SESSION['user_id'];

if (empty($_GET["Pk"])) {
    header("location:Index.php");
} else {
    $PkDespesa = $_GET["Pk"];
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- TITLE  -->
    <title>Minhas Despesas - Detalhes</title>
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
                    <span class="breadcrumb gray-text lighten-5">Detalhes</span>
                    <div style="margin-right: 20px;" id="timestamp" class="right">
                    </div>
                </div>
            </nav>
    </header>
    <br>

    <form action="Salvar.php" method="post">
        <main class="container" style="margin-top: 70px;margin-bottom: 70px;">
            <?php
            $Periodo = str_replace("/", "-", $_COOKIE['DataCorrente']);
            $Periodo = date('Y-m-d', strtotime($Periodo));
            $ClassPagamento = '';
            $ClassCssDespesaParcelada = 'item-hide';
            $ClassCssDespesaFixa = 'item-hide';

            try {
                $Pc = 'CALL PcSelectDespesas(?, ?, ?)';
                $Conn = $Pdo->prepare($Pc);
                $Conn->bindValue(1, $PkDespesa, PDO::PARAM_INT);
                $Conn->bindValue(2, $PkUsuario, PDO::PARAM_INT);
                $Conn->bindValue(3, $Periodo, PDO::PARAM_STR);
                if ($Conn->execute()) {
                    while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                        $PkDespesa = $Result->Pk;
                        $Descricao = $Result->Descricao;
                        $DataVencimento = $Result->DataVencimento;
                        $DataPagamento = $Result->DataPagamento;
                        $ValorDespesa = $Result->Valor;
                        $Observacao = $Result->Observacao;
                        $StatusDespesa = $Result->StatusDespesa;
                        $DespesaFixa = $Result->DespesaFixa;
                        $DespesaParcelada = $Result->DespesaParcelada;
                        $DataUltimaParcela = $Result->DataUltimaParcela;

                        if ($StatusDespesa == 'Paga') {
                            $ClassStatusDespesa = "teal-text";
                            $StatusDescricao = "ESTA DESPESA ESTÁ PAGA";
                            $ClasseCssStatus = "green-text";
                            $ClassPagamento = "item-hide";
                            $Pago = "checked";
                        } else if ($StatusDespesa == 'Vencida') {
                            $ClassStatusDespesa = "red-text";
                            $StatusDescricao = "ESTA DESPESA ESTÁ ATRASADA";
                            $ClasseCssStatus = "red-text";
                            $Pago = "";
                        } else if ($StatusDespesa == 'VenceHoje') {
                            $ClassStatusDespesa = "despesa-vence-hoje";
                            $StatusDescricao = "ESTA DESPESA ESTÁ VENCENDO HOJE";
                            $ClasseCssStatus = "blue-grey-text";
                            $Pago = "";
                        } else if ($StatusDespesa == 'Congelada') {
                            $ClassStatusDespesa = "light-blue-text";
                            $StatusDescricao = "ESTA DESPESA ESTÁ CONGELADA";
                            $ClasseCssStatus = "light-blue-text";
                            $Pago = "";
                        } else {
                            $ClassStatusDespesa = "despesa-em-dia";
                            $StatusDescricao = "ESTA DESPESA ESTÁ EM DIA";
                            $ClasseCssStatus = "grey-text";
                            $Pago = "";
                        }

                        if ($DespesaParcelada == 'Sim') {
                            $ClassCssDespesaParcelada = '';
                            $Parcelado = 1;
                        } else if ($DespesaFixa == 'Sim') {
                            $ClassCssDespesaFixa = '';
                            $Parcelado = 2;
                        } else {
                            $Parcelado = 0;
                        }
            ?>
                        <div class="form-group new-form">
                            <a class="btn waves-effect waves-light red lighten-2" href="Index.php" title="Voltar a página anterior"><span class="text-white">Voltar</span></a>
                            <br>
                            <br>
                            <input type="hidden" id="PkDespesa" name="PkDespesa" class="form-control form-control-sm" value="<?php echo $PkDespesa ?>">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="Descricao" name="Descricao" type="text" class="validate" value="<?php echo $Descricao ?>" required="">
                                    <label class="active" for="Descricao">Descrição</label>
                                </div>

                                <div class="input-field col s6">
                                    <input id="Valor" name="Valor" type="text" class="validate" value="<?php echo $ValorDespesa ?>" required="">
                                    <label class="active" for="Descricao" onKeyUp="maskIt(this, event, '###.###.###,##', true)">Valor</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="DataVencimento" name="DataVencimento" type="date" class="validate" value="<?php echo $DataVencimento ?>" required="">
                                    <label class="active" for="DataVencimento">Data de Vencimento</label>
                                </div>

                                <div class="input-field col s6">
                                    <input id="DataPagamento" name="DataPagamento" type="date" class="validate" onchange="fnSetaDespesaPaga();" value="<?php echo $DataPagamento ?>">
                                    <label class="active" for="DataPagamento">Data de Pagamento</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="Observacao" name="Observacao" class="materialize-textarea"><?php echo $Observacao ?></textarea>
                                    <label for="Observacao">Detalhes</label>
                                </div>
                            </div>

                            <div class="col" id="LabelStatusDespesa">
                                <div class="pt-3 pb-1 center-align <?php echo $ClassStatusDespesa ?>">
                                    <span><?php echo $StatusDescricao ?></span>
                                </div>

                                <div class="center-align deep-orange-text <?php echo $ClassCssDespesaParcelada ?>">
                                    <?php if ($DataVencimento == date("Y-m-d")) {
                                        echo '<span>HOJE É A ULTIMA PARCELA DESTA DESPESA</span>';
                                    } else {
                                        echo "<span>ESTA É UMA DESPESA PARCELADA E TERMINA EM " . date('d/m/Y', strtotime($DataUltimaParcela)) . "</span>";
                                    }
                                    ?>
                                </div>

                                <div class="center-align <?php echo $ClassCssDespesaFixa ?>">
                                    <p>ESTA É UMA DESPESA FIXA</p>
                                </div>
                            </div>
                            <br>
                            <div>
                                <input type="radio" id="Paga" value="Paga" name="Status" <?= ($StatusDespesa == 'Paga') ? 'checked' : '' ?>>
                                <label for="Paga" value="Paga">Despesa Paga</label> <span class="helper-text" data-error="wrong" data-success="right"></span>
                            </div>

                            <div>
                                <input type="radio" id="NPago" value="NãoPaga" name="Status" onclick="fnSetaDespesaNaoPaga();" <?php if (($StatusDespesa != 'Paga') && ($StatusDespesa != 'Congelada')) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                <label for="NPago" value="NãoPaga">Despesa Não Paga</label> <span class="helper-text" data-error="wrong" data-success="right"></span>
                            </div>

                            <div>
                                <input type="radio" id="Congelada" value="Congelada" name="Status" onclick="fnSetaDespesaNaoPaga();" <?= ($StatusDespesa == 'Congelada') ? 'checked' : '' ?>>
                                <label for="Congelada" value="Paga">Despesa Congelada</label> <span class="helper-text" data-error="wrong" data-success="right"></span>
                                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small>(Ao congelar uma despesa, seu valor não é somado as despesas no mês.)</small>
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
        </main>
        <footer class="indigo" style="position: fixed; width: 100vw; bottom: 0; z-index: 900; padding-top: 0px; padding-bottom: 0px">
            <div class="row">
                <div class="input-field col s12 center-align">
                    <button class="btn waves-effect waves-light" id="BntSalvar" type="submit" name="action">Salvar
                        <i class="material-icons right">save</i>
                    </button>

                    <a onclick="fnConfirmExcluirDespesa('<?php echo $PkDespesa ?>', '<?php echo $DespesaFixa ?>', '<?php echo $DespesaParcelada ?>')" data-position="right" data-tooltip="Excluir Despesa" class="tooltipped">
                        <button class="btn waves-effect waves-light red lighten-2" type="button" id="BtnExcluir">Excluir
                            <i class="material-icons right">delete</i>
                        </button>
                    </a>

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
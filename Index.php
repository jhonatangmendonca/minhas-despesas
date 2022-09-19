 <?php
    if ("$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" == 'gerador.amigos-share.club/') {
        header('Location: https://gerador.amigos-share.club/Gerador/');
    }

    session_start();
    date_default_timezone_set('America/Sao_Paulo');
    require_once './Login/functions.php';
    require_once './Login/check.php';
    require_once './Conexao/ConexaoDB.php';

    if (!isLoggedIn()) {
        $Redireciona = './Login/login.php';
    } else {
        $Redireciona = './Despesas/Index.php';
    }
    header("$Redireciona");

    if (!isset($_COOKIE["DataCorrente"])) {
        $mes = date('n');
        $ano = date('Y');
        setcookie('mes', $mes);
        setcookie('ano', $ano);
        setcookie('DataCorrente', date('d/n/Y'));
    }

    $NomeUsuario = $_SESSION['user_name'];
    $PkUsuario = $_SESSION['user_id'];
    $PkUsuario = $_SESSION['user_id'];
    $PkUsuario = $_SESSION['user_id'];
    $ExisteLogin = 0;
    $DataHoraLogin = date('Y-m-d H:i:s');

    if ($PkUsuario != 1 && $PkUsuario != 0) {
        include "./Config/Config.php";
        $query = "SELECT * FROM Login Where FkUsuario = $PkUsuario";
        $resultado = $CONEXAO->query($query);
        if ($resultado) {
            if ($resultado->num_rows > 0) {
                while ($linha = $resultado->fetch_assoc()) {
                    $ExisteLogin = 1;
                }
            }
        }

        if ($ExisteLogin == 1) {
            include "./Config/Config.php";
            $query = "UPDATE Login SET DataHora = '" . $DataHoraLogin . "' Where FkUsuario = $PkUsuario";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
            } else {
                die("ERRO Update Login");
            }
        } else {
            include "./Config/Config.php";
            $query = "INSERT INTO Login(FkUsuario, DataHora) VALUES('" . $PkUsuario . "','" . $DataHoraLogin . "');";
            $resultado = $CONEXAO->query($query);
            if ($resultado) {
            } else {
                die("ERRO Insert Login");
            }
        }
    }

    try {
        $Pc = 'CALL PcSelectInfoInicias(?)';
        $Conn = $Pdo->prepare($Pc);
        $Conn->bindValue(1, $PkUsuario, PDO::PARAM_INT);
        if ($Conn->execute()) {
            while ($Result = $Conn->fetch(PDO::FETCH_OBJ)) {
                $ValorDespesas = $Result->ValorDespesas;
                $ValorDespesasNaoPagas = $Result->ValorDespesasNaoPagas;
                $ValorDespesasPagas = $Result->ValorDespesasPagas;
                $ValorRendimentos = $Result->ValorRendimentos;
                $QndDespesas = $Result->Despesas;
                $QndDespesasNaoPagas = $Result->DespesasNaoPagas;
                $QndDespesasPagas = $Result->DespesasPagas;
                $QndRendimentos = $Result->Rendimentos;
                $QndLembretes = $Result->Lembretes;
            }
        } else {
            echo 'Erro.';
        }
    } catch (PDOException $Erro) {
        echo $Erro->getMessage();
    }
    ?>

 <html>

 <head>
     <!-- TITLE  -->
     <title>Painel de Controle</title>
     <meta charset="utf-8">
     <meta name="theme-color" content="#303f9f">
     <meta name="apple-mobile-web-app-status-bar-style" content="#303f9f">
     <meta name="msapplication-navbutton-color" content="#303f9f">
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />

     <!-- FAVICON  -->
     <link rel="shortcut icon" href="./Public/IMG/favicon.png" type="image/x-icon" />
     <!-- CSS  -->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
     <link type="text/css" rel="stylesheet" href="./Public/CSS/Menu.css" media="screen,projection" />
     <link type="text/css" rel="stylesheet" href="./Public/CSS/Classes.css" media="screen,projection" />
     <link type="text/css" rel="stylesheet" href="./Public/SCSS/buttons.css" media="screen,projection" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
     <!-- SCRIPT -->
     <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
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
             <a href="./Despesas/Index.php" style="padding-right: 32px;">
                 <b>Despesas</b>
                 <i style="float: right; line-height: 64px;" class="material-icons">shopping_cart</i>
             </a>
         </li>

         <li id="dash_users">
             <a href="./Rendimentos/Index.php" style="padding-right: 32px;">
                 <b>Rendimentos</b>
                 <i style="float: right; line-height: 64px;" class="material-icons">local_atm</i>
             </a>
         </li>

         <li id="dash_users">
             <a href="./Lembretes/Index.php" style="padding-right: 32px;">
                 <b>Lembretes</b>
                 <i style="float: right; line-height: 64px;" class="material-icons">event_note</i>
             </a>
         </li>

         <li id="dash_users">
             <a href="./Usuario/Index.php" style="padding-right: 32px;">
                 <b>Configurações</b>
                 <i style="float: right; line-height: 64px;" class="material-icons">settings</i>
             </a>
         </li>

         <?php if ($PkUsuario == 1) { ?>
             <li id="dash_users">
                 <a href="./Administracao/Index.php" style="padding-right: 32px;">
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

     <header style="position: fixed; height: 56px !important; z-index: 10; width: 100vw; top:0">
         <nav style="background-color: transparent; box-shadow: none;">
             <div class=" indigo darken-2">
                 <a style="margin-left: 15px;" href="#" data-target="slide-out" data-activates="slide-out" class="sidenav-trigger  button-collapse"><i class="mdi-navigation-menu"></i></a>

                 <a style="margin-left: 20px;" class="white-text" href="./Index.php">Painel de Controle</a>
             </div>
         </nav>
     </header>

     <main style="margin-top: 70px; margin-bottom: 165px;">
         <div class="row">
             <div class="col s12 m12"> <a href="./Despesas/Index.php">
                     <div style="padding: 35px;" align="center" class="card">
                         <div class="row">
                             <div class="center card-title">
                                 <b class="indigo-text">Minhas Despesas</b>
                             </div>
                         </div>
                         <div class="row">
                             <div class="card-content">
                                 <b class="left indigo-text"> Total de Despesas: &nbsp; </b><span class="left blue-text text-destaque"> <?php echo $QndDespesas ?> - R$<?php echo  number_format($ValorDespesas, 2, ",", "."); ?></span>
                                 <br />
                                 <b class=" left indigo-text"> Total de Despesas Não Pagas: &nbsp; </b><span class="left red-text text-destaque"> <?php echo $QndDespesasNaoPagas ?> - R$<?php echo  number_format($ValorDespesasNaoPagas, 2, ",", "."); ?></span>
                                 <br />
                                 <b class="left indigo-text"> Total de Despesas Pagas: &nbsp; </b><span class="left green-text text-destaque"> <?php echo $QndDespesasPagas ?> - R$<?php echo  number_format($ValorDespesasPagas, 2, ",", "."); ?></span>
                             </div>
                         </div>
                     </div>
                 </a>
             </div>
         </div>

         <div class=" row">
             <div class="col s12 m12">
                 <div style="padding: 35px;" align="center" class="card">
                     <a href="./Rendimentos/Index.php">
                         <div class="row">
                             <div class="center card-title">
                                 <b class="indigo-text">Meus Rendimentos</b>
                             </div>
                         </div>
                         <div class="row">
                             <div class="left card-content">
                                 <b class="indigo-text"> Total de Rendimentos:</b><span class="blue-text text-destaque"> <?php echo $QndRendimentos ?> - R$<?php echo  number_format($ValorRendimentos, 2, ",", "."); ?></span>
                             </div>
                         </div>
                     </a>
                 </div>
             </div>
         </div>

         <div class=" row">
             <div class="col s12 m12">
                 <div style="padding: 35px;" align="center" class="card">
                     <a href="./Lembretes/Index.php">
                         <div class="row">
                             <div class="center card-title">
                                 <b class="indigo-text">Meus Lembretes</b>
                             </div>
                         </div>
                         <div class="row">
                             <div class="left card-content">
                                 <b class="indigo-text"> Total de Lembretes:</b><span class="blue-text text-destaque"> <?php echo $QndLembretes ?></span>
                             </div>
                         </div>
                     </a>
                 </div>
             </div>
         </div>
     </main>

     <footer class=" indigo darken-2 white-text" style="position: fixed; width: 100vw; bottom: 0; z-index: 900;padding-bottom: 0px;padding-top: 10px;">
         <div class="container center-align">
             <div class="row">
                 <div class="col s12">
                     <ul id='credits'>
                         <li>
                             <a target="_blank" class="tooltipped" data-position="top" data-tooltip="Facebook" href="https://www.facebook.com/jhonatangmendonca"><img width="30px" src="./Public/IMG/Botoes/Facebook.svg"></a>
                             <a target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Linkedin" href="https://www.linkedin.com/in/jhongomes/"><img width="30px" src="./Public/IMG/Botoes/Linkedin.svg"></a>
                             <a target="_blank" class="tooltipped" data-position="top" data-tooltip="Instagram" href="https://www.instagram.com/jhonhgomes/"><img width="30px" src="./Public/IMG/Botoes/Instagram.svg"></a>
                             <a target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Youtube" href="https://www.youtube.com/channel/UCvMB2Lz2NgTcAb3hVLZqe8w"><img width="30px" src="./Public/IMG/Botoes/Youtube.svg"></a>
                         </li>
                     </ul>
                     <ul id='credits'>
                         <li>
                             Sistema de Gestão de Despesas
                         </li>
                     </ul>
                     <ul id='credits'>
                         <li>
                             <span>® <?php echo date("Y"); ?> - Minhas Despesas
                                 </a>
                             </span>
                         </li>
                     </ul>
                 </div>
             </div>
         </div>
     </footer>

 </body>

 <!--  Scripts-->
 <script type="text/javascript">
     $(".button-collapse").sideNav();
 </script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
 <script type="text/javascript" src="./Public/JS/Script.js"></script>

 </html>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../Public/IMG/favicon.png" type="image/x-icon">
    <meta name="theme-color" content="#345D7E">
    <meta name="apple-mobile-web-app-status-bar-style" content="#345D7E">
    <meta name="msapplication-navbutton-color" content="#345D7E">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Despesas - Login</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        body {
            background: #fff;
        }

        .input-field input[type=date]:focus+label,
        .input-field input[type=text]:focus+label,
        .input-field input[type=email]:focus+label,
        .input-field input[type=password]:focus+label {
            color: #e91e63;
        }

        .input-field input[type=date]:focus,
        .input-field input[type=text]:focus,
        .input-field input[type=email]:focus,
        .input-field input[type=password]:focus {
            border-bottom: 2px solid #e91e63;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="section"></div>
    <main>
        <center>
            <?php
            if (isset($_GET['informe-dados']) && empty($_GET['informe-dados'])) {
                echo '<div class="alert text-center alert-warning" role="alert">Digite o e-mail e senha!</div> ';
            }
            if (isset($_GET['senha-invalida']) && empty($_GET['senha-invalida'])) {
                echo '<div class="alert text-center alert-danger" role="alert">E-mail ou senha incorretos!</div>';
            }
            if (isset($_GET['cadastro-realizado']) && empty($_GET['cadastro-realizado'])) {
                echo '<div class="alert text-center alert-success" role="alert">Cadastro realizado com sucesso!</div> ';
            }
            ?>
            <div class="container">
                <div class="z-depth-1 grey lighten-4 row" style="width: 90%; display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #FFF;">
                    <form class="col s12" method="post" action="valida-login.php">

                        <img class="responsive-img" style="width: 250px;" src="./../Public/IMG/logo-png.png" />
                        <div class='row'>
                            <div class='col s12'>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <!-- <input class='validate' type='email' name='email' id='email' /> -->
                                <input class='validate' type='text' name='email' id='email' />
                                <label for='email'>Insira seu e-mail</label>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='input-field col s12'>
                                <input class='validate' type='password' name='senha' id='senha' />
                                <label for='password'>Insira sua senha</label>
                            </div>

                            <!-- <div class='input-field col login-text'>
                                <input type='checkbox' id='remember-me' />
                                <label for='remember-me' style='left: 0;'>Permanecer logado</label>
                            </div> -->

                            <label style='padding-right:10px; float: right;'>
                                <a class='pink-text' href='#!'><b>Esqueceu a senha?</b></a>
                            </label>
                        </div>

                        <br />
                        <center>
                            <div class='row'>
                                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Login</button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
            <a class="indigo-text" href="cadastrar.php">Criar conta</a>
        </center>

        <div class="section"></div>
        <div class="section"></div>
    </main>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
</body>

</html>
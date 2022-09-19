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
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="../Public/CSS/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../Public/CSS/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../Public/SCSS/login.css">
    <title>Minhas Despesas - Cadastro</title>
</head>

<body>
    <div class="new-form">
        <main>
            <form action="cadastro.php" method="post">
                <div>
                    <img src="../Public/IMG/cadastrar.png">
                    <?php
                    if (isset($_GET['login-duplicado']) && empty($_GET['login-duplicado'])) {
                        echo '<div class="alert alert-danger" role="alert">E-mail ou Nome de Usuário já cadastrados</div>';
                    }
                    if (isset($_GET['senhas-diferentes']) && empty($_GET['senhas-diferentes'])) {
                        echo '<div class="alert alert-success" role="alert">As senhas não são iguais!</div> ';
                    }
                    ?>
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="Digite o nome de usuário" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite seu nome completo'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="email" name="email" placeholder="Digite seu e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite seu e-mail'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="password" name="senha" maxlength="16" size="16" minlength="8" placeholder="Digite sua senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite sua senha'" required class="form-control form-control-sm">
                    </div>

                    <div class="form-group">
                        <input type="password" name="senha2" maxlength="16" size="16" minlength="8" placeholder="Digite novamente sua senha" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Digite novamente sua senha'" required class="form-control form-control-sm">
                    </div>

                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-sucesso">Salvar</button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</body>

</html>
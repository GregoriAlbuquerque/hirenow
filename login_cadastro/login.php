<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
    <style>
        a#cadastro{
            line-height: 3.1vh;
            height: 3.1vh;
        }
    </style>
</head>
<body>
    <div id="content-login">
        <form action="autenticacao_login.php" method="post">
            <figure id="logo">
                <img src="../imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo">
                <img src="../imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>
            
<!-- Email -->
            <label for="email">Endereço de email</label>
            <div class="input-box">
                <input type="email" name="email" placeholder="E-mail" required>
                <span class="icon"><i class='bx bx-envelope' style='color:#ffffff'></i></span>
            </div>

<!-- Senha -->
            <label for="password" id="label-senha">Senha</label>
            <div class="input-box">
                <input type="password" name="senha" placeholder="Senha" id="senha" required>
                <div id="icon" onclick="showHide()"><i class='bx bx-show'></i></div>
                <span class="icon"><i class='bx bx-lock'  style='color:#ffffff'></i></span>
            </div>
            <script src="script_password.js"></script>
            <span id="senha">
                <a href="#" id="recuperar-senha">Esquceu a senha?</a>
            </span>

<!-- Recaptcha -->
            <div class="g-recaptcha" data-sitekey="6Lff9KMpAAAAAB2v3b0nbNrSLx9uza-6sI-Wj1lk"></div>
            
<!-- Submit -->
            <button type="submit" onclick="return valida()" name="submit">Login</button>

<!-- Função JS Validar Recaptcha -->
            <script src="../recaptcha/script.js"> </script>

<!-- Validação PHP -->
            <?php
                include '../recaptcha/recaptcha.php';
            ?>

            <div class="line">
                <div id="line1"></div>
                <p>ou</p>
                <div id="line2"></div>
            </div> 
        </form>
        
        <a href="opcao_cadastro.php" id="cadastro">Cadastre-se</a>      
    </div>

    <figure id="fundo-login">
        <img src="../imagens/computer-login-animate.svg" alt="" title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>
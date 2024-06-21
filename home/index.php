<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="../rodape/rodape.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>Hirenow</title>
</head>

<body>
    <header>
        <div class="logo-home">
            <img src="../Imagens/logos/hirenow_word.png" alt="" id="logo-text">
        </div>
        <nav>
            <ul type="none">
                <li id="li-login"><a href="../login_cadastro/login.php" class="a-btn">Login</a></li>
                <li><a href="../login_cadastro/opcao_cadastro.php" class="a-btn">Cadastro</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="home">
            <div id="home-texto">
                <h2>Trabalhe de Casa</h2>
                <p>Você está em busca de uma carreira gratificante, flexível e repleta de oportunidades de crescimento?
                </p>
                <p>Em nossa plataforma oferecemos oportunidades de emprego home office que podem transformar sua maneira
                    de trabalhar e de vida.</p>

                <a href="../amostra_vagas/estrutura_vagas.php" id="acesso-vagas">Oportunidades</a>

            </div>

            <figure>
                <img src="../Imagens/task-animate.svg" title="https://storyset.com/work Work illustrations by Storyset"
                    alt="">
            </figure>
        </div>
        <!--home-->
        <!-- https://storyset.com/research Research illustrations by Storyset -->
    </main>

    <?php
        include '../rodape/rodape.php';
    ?>
</body>

</html>
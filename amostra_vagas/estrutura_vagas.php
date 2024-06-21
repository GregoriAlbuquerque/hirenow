<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="vagas.css">
    <link rel="stylesheet" href="../rodape/rodape.css">
    <title>Encontre oportunidades</title>

    <style>
        .content-propostas-enviadas{
            width: 100vw;
            margin-top: 30px;
            text-align: center;
        }

        a.propostas-enviadas{
            line-height: 5.5vh;
            text-align: center;
            font-size: 1em;
            padding: 7px;
            width: 100%;
            height: 5.5vh;
            border-radius: 5px;
            border: none;
            margin-top: 4vh;
            background-color: #459A96;
            color: #fff;
            cursor: pointer;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            transition-duration: 0.5s;
        }

        a.propostas-enviadas:hover{
            background-color: #484450;
        }
    </style>
</head>
<body>
    <?php
        include '../config/config.php';

        $query = "SELECT * FROM hirenow.vagas WHERE status_vaga = 0";
        $stmt = $conexao->query($query);
        $list_vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
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
    <div class="vagas">
    <?php foreach($list_vagas as $vagas): ?>
        <div class="content-vaga">
            <div class="vaga">
                <div class="topo-vaga">
                    <h3><?= $vagas["titulo"] ?></h3>
                    <h3>R$ <?= $vagas["pagamento"] ?></h3>
                </div>
                <!--Fim div topo-vaga-->
                <br>
                <h4 style="display: inline-block;">Área: </h4>
                <p style="display: inline-block;"><?= $vagas["area"] ?></p>
                <br>
                <br>
                <h4>Descrição:</h4>
                <p style="text-align: justify;"><?= $vagas["descricao"] ?></p>
                <br>
                <div class="requisitos-content">
                    <h4>Requisitos</h4>
                    <p><?= $vagas["requisitos"] ?></p>
                </div><!--requisitos-content-->
                <div class="contetnt-btn-vaga">
                    <a href="../login_cadastro/login.php" class="btn-proposta">Enviar proposta</a>
                </div>
                <!--Fim div contetnt-btn-vaga-->
            </div>
            <!--Fim div vaga-->
        </div>
    <?php endforeach; ?>
    <!--Fim content vaga-->
    </div>
    <?php
        include '../rodape/rodape.php';
    ?>
    <!-- script menu hamburquer -->
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>
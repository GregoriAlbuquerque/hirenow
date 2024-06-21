<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="propostas_enviadas.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Encontre oportunidades</title>

     <style>
        .content-propostas-desativadas{
            width: 100vw;
            margin-top: 30px;
            text-align: center;
        }

        a.propostas-desativadas{
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

        a.propostas-desativadas:hover{
            background-color: #484450;
        }
    </style>
</head>
<body>
    <?php
        include '../../../config/config.php';
        include '../../header/header.php';
    ?>
    <div class="content-propostas-desativadas">
        <a href="../reativar_proposta/estrutura_proposta_desativadas.php" class="propostas-desativadas">Visualizar Propostas Desativadas</a>
    </div>
    <?php
        include 'propostas_enviadas.php';
        include '../../../rodape/rodape.php';
    ?>
    

<!-- script menu hamburquer -->
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="update_vaga.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Gerenciamento de Vagas</title>
    <style>
        .content-vagas-desativadas{
            width: 100vw;
            margin-top: 30px;
            text-align: center;
        }

        a.vagas-desativadas{
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

        a.vagas-desativadas:hover{
            background-color: #484450;
        }
    </style>
</head>
<body>
    <?php
        include '../../../config/config.php';
        include '../../header_emp/header_emp.php';
        
        if($_SERVER['HTTP_REFERER']){
            $redirecionamento = $_SERVER['HTTP_REFERER'];
            $palavra = "login.php";
            if(strpos($redirecionamento, $palavra) == true){
                echo "<script>alert('Login efetuado com sucesso!');</script>";
            }
        }
    ?>
        <div class="content-vagas-desativadas">
            <a href="../reativar_vaga/estrutura_vagas_desativadas.php" class="vagas-desativadas">Visualizar Vagas Desativadas</a>
        </div>
    <?php
        include 'update_vaga.php';
        include '../../../rodape/rodape.php';
    ?>
    
    <!-- script menu hamburquer -->
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>
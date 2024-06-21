<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="visualizar_curriculo.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Visualizar</title>
</head>

<body>
<?php
    include '../../../config/config.php';
    include '../../header_emp/header_emp.php';

    $id_candidato = $_GET["id"];

    if (!isset($_SESSION['user_id'])) {
        // Redirecionar para a página de login se o usuário não estiver logado
        header("Location: ../../../login_cadastro/login.php");
        exit();
    }

    $query = "SELECT * FROM hirenow.curriculo INNER JOIN hirenow.usuarios ON id_candidato = idUsuarios WHERE id_candidato = $id_candidato";
    $stmt = $conexao->query($query);
    $list_curriculo = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($list_curriculo) > 0) {
        $curriculo = $list_curriculo[0];

        // Adicionar espaço após cada vírgula
        $curriculo["linguas_estrangeiras"] = str_replace(",", ", ", $curriculo["linguas_estrangeiras"]);
        $curriculo["habilidades_interpessoais"] = str_replace(",", ", ", $curriculo["habilidades_interpessoais"]);
    } else {
        // Lidar com o caso onde não há dados retornados pela consulta
        echo "Currículo não encontrado.";
        exit();
    }
?>

<div class="curriculo">
    <div class="container-dados">
        <div class="conatiner">
            <h4 style="margin-right: 5px;">Nome do Candidato: </h4>
            <h4 style="font-weight:400;"><?=$curriculo["nome"]?></h4>
        </div>
        <br>
        <div class="conatiner">
            <h4 style="margin-right: 5px;">Escolaridade: </h4>
            <h4 style="font-weight:400;"><?=$curriculo["escolaridade"]?></h4>
        </div>
        <br>
        <div class="conatiner">
            <h4 style="margin-right: 5px;">Sexo: </h4>
            <h4 style="font-weight:400;"><?=$curriculo["sexo"]?></h4>
        </div>
        <br>
        <div class="conatiner">
            <h4 style="margin-right: 5px;">Linguas estrangeiras: </h4>
            <h4 style="font-weight:400;"><?=$curriculo["linguas_estrangeiras"]?></h4>
        </div>
        <br>
        <div class="conatiner">
            <h4 style="margin-right: 5px;">Habilidades Interpessoais: </h4>
            <h4 style="font-weight:400;"><?=$curriculo["habilidades_interpessoais"]?></h4>
        </div>
        <br>
        <h4>Descrição</h4>
        <p style="margin-bottom: 4vh;"><?=$curriculo["descricao"]?></p>
    </div>
</div>

<?php
    include '../../../rodape/rodape.php';
?>
<!-- script menu hamburquer -->
<script src="../../header/menu_hamburguer.js"></script>
</body>

</html>
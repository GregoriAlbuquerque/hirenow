<?php
include '../../../config/config.php';
include '../../header/header.php';

if($_SERVER['HTTP_REFERER']){
    $redirecionamento = $_SERVER['HTTP_REFERER'];
    $palavra = "login.php";
    if(strpos($redirecionamento, $palavra) == true){
        echo "<script>alert('Login efetuado com sucesso!');</script>";
    }
}

if (isset($_GET['submit_clean'])) {
    // Redireciona para a mesma página sem parâmetros de query
    header("Location: estrutura_vagas.php");
    exit;
}

$area = isset($_GET['area']) ? $_GET['area'] : '';
$remuneracao_maior = isset($_GET['remuneracao_maior']) ? $_GET['remuneracao_maior'] : '';
$remuneracao_menor = isset($_GET['remuneracao_menor']) ? $_GET['remuneracao_menor'] : '';
$interessados = isset($_GET['interessados']) ? $_GET['interessados'] : '';

$query = "SELECT * FROM hirenow.interessados RIGHT JOIN hirenow.vagas ON interessados.id_vaga = idVagas WHERE status_vaga = 0";
$params = [];

if ($area != '') {
    $query .= " AND area = :area";
    $params[':area'] = $area;
}
if ($remuneracao_maior != '') {
    $query .= " AND pagamento >= :remuneracao_maior";
    $params[':remuneracao_maior'] = $remuneracao_maior;
}
if ($remuneracao_menor != '') {
    $query .= " AND pagamento <= :remuneracao_menor";
    $params[':remuneracao_menor'] = $remuneracao_menor;
}

$stmt = $conexao->prepare($query);
foreach ($params as $key => &$val) {
    $stmt->bindParam($key, $val);
}
$stmt->execute();
$list_vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="../../filtro_vagas/filtro_vagas.css">
    <link rel="stylesheet" href="vagas.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
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
    <div class="content-propostas-enviadas">
        <a href="../propostas_enviadas/estrutura_propostas_enviadas.php" class="propostas-enviadas">Propostas enviadas</a>
    </div>
    <div style="display: flex; justify-content: space-around; margin: 0 15px;">
        <?php include '../../filtro_vagas/filtro_vagas.php'; ?>
        <div class="vagas">
            <?php foreach($list_vagas as $vagas): ?>
                <?php if ($vagas["id_candidato"] != $id_candidato || ($vagas["id_candidato"] == $id_candidato && $vagas["status_interesse"] != 0)): ?>
                    <div class="content-vaga">
                        <div class="vaga">
                            <div class="topo-vaga">
                                <h3><?= htmlspecialchars($vagas["titulo"]) ?></h3>
                                <h3>R$ <?= htmlspecialchars($vagas["pagamento"]) ?></h3>
                            </div>
                            <br>
                            <h4 style="display: inline-block;">Área: </h4>
                            <p style="display: inline-block;"><?= htmlspecialchars($vagas["area"]) ?></p>
                            <br>
                            <br>
                            <h4>Descrição:</h4>
                            <p style="text-align: justify;"><?= htmlspecialchars($vagas["descricao"]) ?></p>
                            <br>
                            <div class="requisitos-content">
                                <h4>Requisitos</h4>
                                <p><?= htmlspecialchars($vagas["requisitos"]) ?></p>
                            </div>
                            <div class="contetnt-btn-vaga">
                                <a href="../proposta/estrutura_proposta.php?id=<?= urlencode($vagas['idVagas']) ?>" class="btn-proposta">Enviar proposta</a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php include '../../../rodape/rodape.php'; ?>
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>

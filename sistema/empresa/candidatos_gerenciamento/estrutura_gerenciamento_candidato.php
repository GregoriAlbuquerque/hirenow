<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="update_candidato.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Gerenciamento de Candidatos</title>
</head>
<body>

<?php
include '../../../config/config.php';
include '../../header_emp/header_emp.php';

$id_empresa = $_SESSION['user_id'];
$id_vaga = (int)$_GET["id"];

$query = "SELECT *, DATE_FORMAT(data_nasc, '%d/%m/%Y') AS data_nasc_formatada 
          FROM hirenow.interessados 
          INNER JOIN hirenow.vagas ON interessados.id_vaga = idVagas 
          INNER JOIN hirenow.candidatos ON id_candidato = id_usuario_candidato 
          INNER JOIN hirenow.usuarios ON id_candidato = idUsuarios 
          WHERE id_vaga = :id_vaga AND status_vaga = 0 AND id_empresa = :id_empresa AND status_interesse != 1";
$stmt = $conexao->prepare($query);
$stmt->execute(['id_vaga' => $id_vaga, 'id_empresa' => $id_empresa]);
$list_vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach($list_vagas as $vagas): ?>
    <div class="content-candidato">
        <div class="candidato">
            <p style="display:none;"><?= $id_vaga ?></p>
            <div class="topo-candidato">
                <h4 style="margin-right: 3px;">Nome: </h4>
                <h4 style="font-weight:400;"><?= $vagas["nome"] ?></h4>
            </div>
            <br>
            <h4 style="display: inline-block;">Data de Nascimento:</h4>
            <p style="display: inline-block;"><?= $vagas["data_nasc_formatada"] ?></p>
            <br>
            <br>
            <h4 style="display: inline-block;">Email: </h4>
            <p style="display: inline-block;"><?= $vagas["email"] ?></p>
            <br>
            <br>
            <h4>Proposta do candidato:</h4>
            <br>
            <p><?= $vagas["proposta"] ?></p>
            <div class="content-btn-contratar">
                <a href="download_portifolio.php?id_candidato=<?= $vagas['id_candidato'] ?>" class="btn-update" style="display: flex; justify-content: center; align-items: center;">
                    <i class='bx bx-download' style="color: #484450"></i> Portfólio
                </a>
                <a href="visualizar_curriculo.php?id=<?= $vagas['id_candidato'] ?>" class="btn-update">Currículo</a>
                <a href="contratar.php?id_candidato=<?= $vagas['id_candidato'] ?>&id_vaga=<?= $id_vaga ?>" class="btn-update" onclick="return confirm('O candidato contratado receberá uma notificação de que foi selecionado. Basta enviar um email para ele especificando mais detalhes.')">Contratar</a>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php include '../../../rodape/rodape.php'; ?>
<script src="../../header/menu_hamburguer.js"></script>
</body>
</html>

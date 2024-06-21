<?php
include '../../../config/config.php';
include '../../header_emp/header_emp.php';

if (!isset($_SESSION['user_id'])) {
    // Redirecionar para a página de login se o usuário não estiver logado
    header("Location: ../../../login_cadastro/login.php");
    exit();
}

$id_empresa = $_SESSION['user_id'];

// Verifique se o parâmetro 'id' está definido no GET
if (!isset($_GET["id"])) {
    echo "ID da vaga não especificado.";
    exit();
}

$id_vaga = (int)$_GET["id"];

// Verificar a conexão com o banco de dados
if (!$conexao) {
    die("Conexão falhou: " . $conexao->errorInfo()[2]);
}

$query = "SELECT * FROM hirenow.vagas WHERE id_empresa = :id_empresa AND idVagas = :id_vaga";
$stmt = $conexao->prepare($query);
$stmt->bindParam(':id_empresa', $id_empresa, PDO::PARAM_INT);
$stmt->bindParam(':id_vaga', $id_vaga, PDO::PARAM_INT);
$stmt->execute();
$list_vagas = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$list_vagas) {
    echo "Vaga não encontrada ou você não tem permissão para editar esta vaga.";
    exit();
}

if (isset($_POST['submit'])) {
    $titulo = $_POST['titulo'] ?? '';
    $area = $_POST['area'] ?? '';
    $tipo = $_POST['tipo_vaga'] ?? '';
    $requisitos = $_POST['requisitos'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $remuneracao = $_POST['remuneracao'] ?? '';

    // Mapear os valores numéricos para os nomes das áreas
    $areas = [
        "0" => "Administração",
        "1" => "Direito",
        "2" => "Edição audiovisual",
        "3" => "Engenharia",
        "4" => "Finanças",
        "5" => "Marketing",
        "6" => "Saúde",
        "7" => "Tecnologia (TI)"
    ];

    $area_nome = $areas[$area] ?? '';

    if ($titulo && $area_nome && $tipo && $requisitos && $descricao && $remuneracao) {
        try {
            // Preparar a declaração SQL
            $stmt = $conexao->prepare("UPDATE hirenow.vagas SET titulo = :titulo, area = :area, tipo = :tipo, requisitos = :requisitos, descricao = :descricao, pagamento = :remuneracao WHERE idVagas = :id_vaga");
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':area', $area_nome);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':requisitos', $requisitos);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':remuneracao', $remuneracao);
            $stmt->bindParam(':id_vaga', $id_vaga, PDO::PARAM_INT);
            $stmt->execute();

            // Verificar se a consulta foi executada corretamente
            if ($stmt->rowCount() > 0) {
                header("Location: ../update_vaga/estrutura_gerenciamento_vagas.php");
                exit(); // Terminar o script após redirecionamento
            } else {
                echo "<script>alert('Nenhum registro foi atualizado.');</script>";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage() . "<br>";
        }
    } else {
        echo "Preencha todos os campos.<br>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="editar_vaga.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Criação de Vaga</title>
</head>
<body>
    <div class="content-form">
        <form action="estrutura_editar_vaga.php?id=<?= $id_vaga ?>" method="post">

            <input type="hidden" name="id" value="<?= $id_vaga ?>">
            <h4>Título da vaga</h4>
            <input type="text" name="titulo" placeholder="Insira o título da vaga" style="width: 50%;" required value="<?= htmlspecialchars($list_vagas["titulo"]) ?>">
            
            <h4>Área</h4>
            <select name="area" id="" style="text-indent: 3px;" required>
                <option value="0" <?= ($list_vagas["area"] == 'Administração') ? 'selected' : '' ?> >Administração</option>
                <option value="1" <?= ($list_vagas["area"] == 'Direito') ? 'selected' : '' ?> >Direito</option>
                <option value="2" <?= ($list_vagas["area"] == 'Edição audiovisual') ? 'selected' : '' ?> >Edição audiovisual</option>
                <option value="3" <?= ($list_vagas["area"] == 'Engenharia') ? 'selected' : '' ?> >Engenharia</option>
                <option value="4" <?= ($list_vagas["area"] == 'Finanças') ? 'selected' : '' ?> >Finanças</option>
                <option value="5" <?= ($list_vagas["area"] == 'Marketing') ? 'selected' : '' ?> >Marketing</option>
                <option value="6" <?= ($list_vagas["area"] == 'Saúde') ? 'selected' : '' ?> >Saúde</option>
                <option value="7" <?= ($list_vagas["area"] == 'Tecnologia (TI)') ? 'selected' : '' ?> >Tecnologia (TI)</option>
            </select>

            <div class="content-fundo-form">
                <div class="content-inputs-fundo">
                    <h4>Tipo de Vaga</h4>
                    <input type="radio" name="tipo_vaga" value="1" <?= ($list_vagas["tipo"] == '1') ? 'checked' : '' ?> >Online
                    <input type="radio" name="tipo_vaga" value="2" <?= ($list_vagas["tipo"] == '2') ? 'checked' : '' ?> >Presencial

                    <h4>Requisitos</h4>
                    <div class="input-requisitos">
                        <textarea name="requisitos" id="" cols="30" rows="13" placeholder="Digite os requisitos de seu projeto."><?= htmlspecialchars($list_vagas["requisitos"]) ?></textarea>
                    </div><!--Fim input-requisitos-->
                </div><!--Fim content-inputs-fundo-->

                <!--Imagem de fundo-->
                <div class="img-fundo-form">
                    <img src="../../../imagens/grammar-correction-animate.svg" alt="">
                </div>
            </div><!--content-fundo-form-->

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."><?= htmlspecialchars($list_vagas["descricao"]) ?></textarea>

            <h4>Remuneração</h4>
            <input type="number" name="remuneracao" value="<?= htmlspecialchars($list_vagas["pagamento"]) ?>">

            <div class="content-submit">
                <button type="submit" name="submit" onclick="return confirm('Tem certeza que deseja editar a vaga?')">Editar</button>
            </div>

        </form>
    </div><!--content-form-->

    <?php include '../../../rodape/rodape.php'; ?>
    <!-- script menu hamburquer -->
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>

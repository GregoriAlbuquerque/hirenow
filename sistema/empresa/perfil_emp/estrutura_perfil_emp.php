<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="perfil_emp.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Criação de Vaga</title>
</head>
<body>
    <?php
        include '../../../config/config.php';
        include '../../header_emp/header_emp.php';
    ?>
    <?php
        if (!isset($_SESSION['user_id'])) {
            // Redirecionar para a página de login se o usuário não estiver logado
            header("Location: ../../../login_cadastro/login.php");
            exit();
        }

        $id_empresa = $_SESSION['user_id'];

        $query = "SELECT * FROM hirenow.usuarios INNER JOIN hirenow.empresas ON idUsuarios = id_usuarios_empresa WHERE idUsuarios = :id_empresa";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_empresa', $id_empresa);
        $stmt->execute();
        $list_vagas = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="content-form">
        <form action="editar_perfil.php" method="post">
            <h4>Empresa</h4>
            <input type="text" placeholder="Nome da empresa" style="width: 50%;" value="<?= $list_vagas["nome"] ?>">
            
            <h4>Área</h4>
            <p>Selecione a área de atuação de sua empresa</p>
            <select name="area" required>
                <option value="0" <?= ($list_vagas["area_atuacao"] == 'Administração') ? 'selected' : '' ?> >Administração</option>
                <option value="1" <?= ($list_vagas["area_atuacao"] == 'Direito') ? 'selected' : '' ?> >Direito</option>
                <option value="2" <?= ($list_vagas["area_atuacao"] == 'Edição audiovisual') ? 'selected' : '' ?> >Edição audiovisual</option>
                <option value="3" <?= ($list_vagas["area_atuacao"] == 'Engenharia') ? 'selected' : '' ?> >Engenharia</option>
                <option value="4" <?= ($list_vagas["area_atuacao"] == 'Finanças') ? 'selected' : '' ?> >Finanças</option>
                <option value="5" <?= ($list_vagas["area_atuacao"] == 'Marketing') ? 'selected' : '' ?> >Marketing</option>
                <option value="6" <?= ($list_vagas["area_atuacao"] == 'Saúde') ? 'selected' : '' ?> >Saúde</option>
                <option value="7" <?= ($list_vagas["area_atuacao"] == 'Tecnologia (TI)') ? 'selected' : '' ?> >Tecnologia (TI)</option>
            </select>

            <h4>Descrição</h4>
            <textarea name="descricao" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."><?= $list_vagas["descricao_empresa"] ?></textarea>
            
            <div class="content-submit">
                <button type="submit" name="submit">Criar perfil</button>
            </div>
        </form>
    </div><!--content-form-->
    <?php
        include '../../../rodape/rodape.php';
    ?>
    <!-- script menu hamburquer -->
    <script src="../../header/menu_hamburguer.js"></script>
</body>
</html>
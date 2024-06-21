<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="../../header_emp/header_emp.css">
    <link rel="stylesheet" href="new_vaga.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Criação de Vaga</title>
</head>
<body>
    <?php
        include '../../../config/config.php';
        include '../../header_emp/header_emp.php';

        if (!isset($_SESSION['user_id'])) {
            // Redirecionar para a página de login se o usuário não estiver logado
            header("Location: ../../../login_cadastro/login.php");
            exit();
        }
        
        if (isset($_POST['submit'])) {
            $id_empresa = $_SESSION['user_id'];
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
        
            if ($id_empresa && $titulo && $area_nome && $tipo && $requisitos && $descricao && $remuneracao) {
                try {
                    // Preparar a declaração SQL
                    $stmt = $conexao->prepare("INSERT INTO hirenow.vagas (id_empresa, titulo, area, tipo, requisitos, descricao, pagamento) VALUES (:id_empresa, :titulo, :area, :tipo, :requisitos, :descricao, :remuneracao)");
                    $stmt->bindParam(':id_empresa', $id_empresa);
                    $stmt->bindParam(':titulo', $titulo);
                    $stmt->bindParam(':area', $area_nome);
                    $stmt->bindParam(':tipo', $tipo);
                    $stmt->bindParam(':requisitos', $requisitos);
                    $stmt->bindParam(':descricao', $descricao);
                    $stmt->bindParam(':remuneracao', $remuneracao);
                    $stmt->execute();
        
                    // Executar a declaração
                    if ($stmt) {
                        header("Location: ../update_vaga/estrutura_gerenciamento_vagas.php");
                        exit(); // Terminar o script após redirecionamento
                    } else {
                        echo "Erro ao executar a declaração<br>";
                    }
                } catch (PDOException $e) {
                    echo "Erro: " . $e->getMessage() . "<br>";
                }
            } else {
                echo "Preencha todos os campos.<br>";
            }
        }
    ?>

    <div class="content-form">
        <form action="estrutura_new_vaga.php" method="post">

            <h4>Título da vaga</h4>
            <input type="text"name="titulo" placeholder="Insira o título da vaga" style="width: 50%;" required>
            
            <h4>Área</h4>
            <select name="area" id="" style="text-indent: 3px;" required>
                <option value="0" selected>Administração</option>
                <option value="1">Direito</option>
                <option value="2">Edição audiovisual</option>
                <option value="3">Engenharia</option>
                <option value="4">Finanças</option>
                <option value="5">Marketing</option>
                <option value="6">Saúde</option>
                <option value="7">Tecnologia (TI)</option>
            </select>

            <div class="content-fundo-form">
                <div class="conetnt-inputs-fundo">
                <h4>Tipo de Vaga</h4>
                <input type="radio" name="tipo_vaga" value="1" checked>Online
                <input type="radio" name="tipo_vaga" value="2">Presencial

                <h4>Requisitos</h4>
                <div class="input-requisitos">
                    <textarea name="requisitos" id="" cols="30" rows="13" placeholder="Digite os requisitos de seu projeto."></textarea>
                </div><!--Fim input-requisitos-->
                </div>
    <!--Imagem de fundo-->
                <div class="img-fundo-form">
                    <img src="../../../imagens/grammar-correction-animate.svg" alt="">
                </div>
            </div><!--content-fundo-form-->

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui as necessidades de seu projeto, bem como os objetivos que você espera alcançar."></textarea>

            <h4>Remuneração</h4>
            <input type="number" name="remuneracao">

            <div class="content-submit">
                <button type="submit" name="submit">Criar Vaga</button>
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
<?php
        include '../../../config/config.php';
        include '../../header/header.php';

        if($_SERVER['HTTP_REFERER']){
            $redirecionamento = $_SERVER['HTTP_REFERER'];
            $palavra = "cadastro_candidato.php";
            if(strpos($redirecionamento, $palavra) == true){
                echo "<script>alert('Cadastro efetuado com sucesso!');</script>";
            }
        }

        if (!isset($_SESSION['user_id'])) {
            // Redirecionar para a página de login se o usuário não estiver logado
            header("Location: ../../../login_cadastro/login.php");
            exit();
        }

        $id_candidato = $_SESSION['user_id'];

        if (isset($_POST['submit'])) {
            $escolaridade = $_POST['escolaridade'] ?? '';
            $sexo = $_POST['sexo'] ?? '';
            $linguas = isset($_POST['linguas']) ? implode(',', $_POST['linguas']) : '';
            $interpessoais = isset($_POST['interpessoais']) ? implode(',', $_POST['interpessoais']) : '';
            $descricao = $_POST['descricao'] ?? '';
            $portifolio_name = $_FILES['portifolio']['name'] ?? '';
            $portifolio_tmp_name = $_FILES['portifolio']['tmp_name'] ?? '';
            $portifolio_size = $_FILES['portifolio']['size'] ?? '';
            $portifolio_type = $_FILES['portifolio']['type'] ?? '';

            // Variável para armazenar o caminho do arquivo de portfólio
            $portifolio_destination = '';

            if ($portifolio_name) {
                // Verifica se o arquivo é .zip ou .rar
                $allowed_extensions = array('zip', 'rar');
                $file_extension = strtolower(pathinfo($portifolio_name, PATHINFO_EXTENSION));

                if (!in_array($file_extension, $allowed_extensions)) {
                    echo "<script>alert('Formato de arquivo inválido. Envie apenas arquivos .ZIP ou .RAR.');</script>";
                } elseif ($portifolio_size > 10000000) { // Verifica se o tamanho do arquivo é maior que 10 MB
                    echo "<script>alert('O tamanho do arquivo excede o limite permitido (10MB).');</script>";
                } else {
                    // Gerar um ID único para concatenar ao nome do arquivo
                    $unique_id = uniqid();
                    $new_portifolio_name = $unique_id . '_' . $portifolio_name;
                    $portifolio_destination = '../../arquivos_portifolio/' . $new_portifolio_name;

                    // Move o arquivo para o destino especificado
                    if (!move_uploaded_file($portifolio_tmp_name, $portifolio_destination)) {
                        echo "<script>alert('Erro ao mover o arquivo.');</script>";
                        $portifolio_destination = '';
                    }
                }
            }

            // Mapear os valores numéricos para os nomes das escolaridades
            $escolaridades = [
                "0" => "Regular do Ensino Fundamental",
                "1" => "Regular do Ensino Médio",
                "2" => "EJA do Ensino Fundamental",
                "3" => "EJA do Ensino Médio",
                "4" => "Ensino superior",
                "5" => "Pós Graduação",
                "6" => "Mestrado",
                "7" => "Doutorado"
            ];

            $escolaridade_nome = $escolaridades[$escolaridade] ?? '';

            if ($id_candidato && $escolaridade_nome && $sexo && $descricao) {
                try {
                    // Preparar a declaração SQL
                    $stmt = $conexao->prepare("INSERT INTO hirenow.curriculo (id_candidato, escolaridade, sexo, linguas_estrangeiras, habilidades_interpessoais, descricao, portifolio) VALUES (:id_candidato, :escolaridade, :sexo, :linguas, :interpessoais, :descricao, :portifolio)");
                    $stmt->bindParam(':id_candidato', $id_candidato);
                    $stmt->bindParam(':escolaridade', $escolaridade_nome);
                    $stmt->bindParam(':sexo', $sexo);
                    $stmt->bindParam(':linguas', $linguas);
                    $stmt->bindParam(':interpessoais', $interpessoais);
                    $stmt->bindParam(':descricao', $descricao);
                    $stmt->bindParam(':portifolio', $portifolio_destination);
                    $stmt->execute();

                    // Executar a declaração
                    if ($stmt->rowCount() > 0) {
                        header("Location: ../vagas/estrutura_vagas.php");
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="curriculo.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Currículo</title>
</head>

<body>

    <div class="content-form">
        <form action="new_curriculo.php" method="post" enctype="multipart/form-data">
            
            <h4>Escolaridade</h4>
            <select name="escolaridade" id="" style="text-indent: 5px;" required>
                <option value="0">Regular do Ensino Fundamental</option>
                <option value="1" selected>Regular do Ensino Médio</option>
                <option value="2">EJA do Ensino Fundamental</option>
                <option value="3">EJA do Ensino Médio</option>
                <option value="4">Ensino superior</option>
                <option value="5">Pós Graduação</option>
                <option value="6">Mestrado</option>
                <option value="7">Doutorado</option>
            </select>
            
            <h4>Sexo</h4>
            <input type="radio" name="sexo" value="Masculino" checked>Masculino
            <input type="radio" name="sexo" value="Feminino">Feminino

            <h4>Habilidades Linguísticas</h4>
            <input type="checkbox" name="linguas[]" value="Inglês">Inglês<br>
            <input type="checkbox" name="linguas[]" value="Espanhol">Espanhol<br>
            <input type="checkbox" name="linguas[]" value="Francês">Francês<br>

            <h4>Habilidades Interpessoais</h4>
            <input type="checkbox" name="interpessoais[]" value="Liderança">Liderança<br>
            <input type="checkbox" name="interpessoais[]" value="Confiança">Confiança<br>
            <input type="checkbox" name="interpessoais[]" value="Disposição">Disposição<br>
            <input type="checkbox" name="interpessoais[]" value="Comunicação">Comunicação<br>
            <input type="checkbox" name="interpessoais[]" value="Criatividade">Criatividade<br>
            <input type="checkbox" name="interpessoais[]" value="Proatividade">Proatividade<br>
            <input type="checkbox" name="interpessoais[]" value="Trabalho em equipe">Trabalho em equipe<br>

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui sua experiência profissional, objetivo profissional e metas."></textarea>
            
            <!--Upload de arquivos-->
            <h4>Portfólio</h4>
            <p>Envio somente de arquivos .ZIP ou .RAR (máximo de 10mb)<br></p>
            <input type="file" name="portifolio" accept=".zip,.rar"><br>

            <div class="content-submit">
                <button type="submit" name="submit">Criar Currículo</button>
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

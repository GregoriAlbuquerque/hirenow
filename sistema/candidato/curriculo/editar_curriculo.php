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
    <?php
        include '../../../config/config.php';
        include '../../header/header.php';

        if (!isset($_SESSION['user_id'])) {
            // Redirecionar para a página de login se o usuário não estiver logado
            header("Location: ../../../login_cadastro/login.php");
            exit();
        }
    
        $id_candidato = $_SESSION['user_id'];
    
        $query = "SELECT * FROM hirenow.curriculo WHERE id_candidato = :id_candidato";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_candidato', $id_candidato);
        $stmt->execute();
        $list_curriculo = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if (isset($_POST['submit'])) {
            $escolaridade = $_POST['escolaridade'] ?? '';
            $sexo = $_POST['sexo'] ?? '';
            $linguas = isset($_POST['linguas']) ? implode(',', $_POST['linguas']) : '';
            $interpessoais = isset($_POST['interpessoais']) ? implode(',', $_POST['interpessoais']) : '';
            $descricao = $_POST['descricao'] ?? '';
            $portifolio = $_FILES['arquivos']['name'] ?? '';
    
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
                    $stmt = $conexao->prepare("UPDATE hirenow.curriculo SET id_candidato = :id_candidato, escolaridade = :escolaridade, sexo = :sexo, linguas_estrangeiras = :linguas, habilidades_interpessoais = :interpessoais, descricao = :descricao WHERE id_candidato = $id_candidato");
                    $stmt->bindParam(':id_candidato', $id_candidato);
                    $stmt->bindParam(':escolaridade', $escolaridade_nome);
                    $stmt->bindParam(':sexo', $sexo);
                    $stmt->bindParam(':linguas', $linguas);
                    $stmt->bindParam(':interpessoais', $interpessoais);
                    $stmt->bindParam(':descricao', $descricao);
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

    <div class="content-form">
        <form action="editar_curriculo.php" method="post">
            
            <h4>Escolaridade</h4>
            <select name="escolaridade" id="" style="text-indent: 5px;" required>
                <option value="0" <?= ($list_curriculo["escolaridade"] == 'Regular do Ensino Fundamental') ? 'selected' : '' ?>>Regular do Ensino Fundamental</option>
                <option value="1" <?= ($list_curriculo["escolaridade"] == 'Regular do Ensino Médio') ? 'selected' : '' ?>>Regular do Ensino Médio</option>
                <option value="2" <?= ($list_curriculo["escolaridade"] == 'EJA do Ensino Fundamental') ? 'selected' : '' ?>>EJA do Ensino Fundamental</option>
                <option value="3" <?= ($list_curriculo["escolaridade"] == 'EJA do Ensino Médio') ? 'selected' : '' ?>>EJA do Ensino Médio</option>
                <option value="4" <?= ($list_curriculo["escolaridade"] == 'Ensino superior') ? 'selected' : '' ?>>Ensino superior</option>
                <option value="5" <?= ($list_curriculo["escolaridade"] == 'Pós Graduação') ? 'selected' : '' ?>>Pós Graduação</option>
                <option value="6" <?= ($list_curriculo["escolaridade"] == 'Mestrado') ? 'selected' : '' ?>>Mestrado</option>
                <option value="7" <?= ($list_curriculo["escolaridade"] == 'Doutorado') ? 'selected' : '' ?>>Doutorado</option>
            </select>
            
            <h4>Sexo</h4>
            <input type="radio" name="sexo" value="Masculino" <?= ($list_curriculo["sexo"] == 'Masculino') ? 'checked' : '' ?>>Masculino
            <input type="radio" name="sexo" value="Feminino" <?= ($list_curriculo["sexo"] == 'Feminino') ? 'checked' : '' ?>>Feminino

            <h4>Habilidades Linguísticas</h4>
            <input type="checkbox" name="linguas[]" value="Inglês" <?= in_array('Inglês', explode(',', $list_curriculo["linguas_estrangeiras"])) ? 'checked' : '' ?>>Inglês<br>
            <input type="checkbox" name="linguas[]" value="Espanhol" <?= in_array('Espanhol', explode(',', $list_curriculo["linguas_estrangeiras"])) ? 'checked' : '' ?>>Espanhol<br>
            <input type="checkbox" name="linguas[]" value="Francês" <?= in_array('Francês', explode(',', $list_curriculo["linguas_estrangeiras"])) ? 'checked' : '' ?>>Francês<br>

            <h4>Habilidades Interpessoais</h4>
            <input type="checkbox" name="interpessoais[]" value="Liderança" <?= in_array('Liderança', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Liderança<br>
            <input type="checkbox" name="interpessoais[]" value="Confiança" <?= in_array('Confiança', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Confiança<br>
            <input type="checkbox" name="interpessoais[]" value="Disposição" <?= in_array('Disposição', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Disposição<br>
            <input type="checkbox" name="interpessoais[]" value="Comunicação" <?= in_array('Comunicação', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Comunicação<br>
            <input type="checkbox" name="interpessoais[]" value="Criatividade" <?= in_array('Criatividade', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Criatividade<br>
            <input type="checkbox" name="interpessoais[]" value="Proatividade" <?= in_array('Proatividade', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Proatividade<br>
            <input type="checkbox" name="interpessoais[]" value="Trabalho em equipe" <?= in_array('Trabalho em equipe', explode(',', $list_curriculo["habilidades_interpessoais"])) ? 'checked' : '' ?>>Trabalho em equipe<br>

            <h4>Descrição</h4>
            <textarea name="descricao" id="" cols="30" rows="10" required placeholder="Descreva aqui sua experiência profissional, objetivo profissional e metas."><?= $list_curriculo["descricao"] ?></textarea>
            
            <h4 style="display: none;">Portifólio</h4>
            <input type="file" name="arquivos" style="display: none;"><br>

            <div class="content-submit">
                <button type="submit" name="submit" onclick="return confirm('Tem certeza que deseja editar o curriculo?')">Editar</button>
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
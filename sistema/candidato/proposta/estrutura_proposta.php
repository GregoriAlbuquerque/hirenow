<?php
    include '../../../config/config.php';
    include '../../header/header.php';

//Proposta        
    if (!isset($_SESSION['user_id'])) {
        // Redirecionar para a página de login se o usuário não estiver logado
        header("Location: ../../../login_cadastro/login.php");
        exit();
    }
    
    $id_vaga = (int)$_GET["id"];
    $id_candidato = $_SESSION['user_id'];

    if(isset($_POST['submit'])){
        $id_vaga = (int)$_POST["id"];
        $proposta = $_POST['proposta'] ?? '';

        if($id_vaga && $id_candidato && $proposta){
            try{
                $query = "SELECT * FROM hirenow.curriculo INNER JOIN hirenow.usuarios ON id_candidato = idUsuarios WHERE id_candidato = :id_candidato";
                $stmt_curriculo = $conexao->prepare($query);
                $stmt_curriculo->bindParam(':id_candidato', $id_candidato);
                $stmt_curriculo->execute();
                $result = $stmt_curriculo->fetch(PDO::FETCH_ASSOC);
                $id_curriculo = $result['idCurriculo'];
                $id_candidato_proposta = $result['nome'];

                $stmt = $conexao->prepare("INSERT INTO hirenow.interessados (id_vaga, id_candidato,nome_interessado, proposta, curriculo_candidato) VALUES (:id_vaga, :id_candidato, :nome_interessado, :proposta, :curriculo_candidato)");
                $stmt->bindParam(':id_vaga', $id_vaga);
                $stmt->bindParam(':id_candidato', $id_candidato);
                $stmt->bindParam(':nome_interessado', $id_candidato_proposta);
                $stmt->bindParam(':proposta', $proposta);
                $stmt->bindParam(':curriculo_candidato', $id_curriculo);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    header("Location: ../vagas/estrutura_vagas.php");
                    exit(); // Terminar o script após redirecionamento
                } else {
                    echo "Erro ao executar a declaração<br>";
                }
            }catch (PDOException $e) {
                echo "Erro: " . $e->getMessage() . "<br>";
            }
        }else{
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
    <link rel="stylesheet" href="../../header/header.css">
    <link rel="stylesheet" href="proposta.css">
    <link rel="stylesheet" href="../../../rodape/rodape.css">
    <title>Proposta</title>
</head>
<body>
    <div class="content-form">
        <form action="estrutura_proposta.php" method="post">
            <input type="hidden" name="id" value="<?=$id_vaga?>">
            <h4>Proposta</h4>
            <textarea name="proposta" id="" cols="30" rows="10" placeholder="Descreva aqui o porquê você deve ser contratado para essa proposta de emprego." required></textarea>

            <div class="content-submit">
                <button type="submit" name="submit">Enviar Proposta</button>
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
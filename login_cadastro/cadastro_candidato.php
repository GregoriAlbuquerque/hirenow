<?php
// Configuração do banco de dados
    include '../config/config.php';
    session_start();

    try {
        // Criação de uma instância PDO
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Conectado com sucesso<br>";
    } catch (PDOException $e) {
        die("Conexão falhou: " . $e->getMessage());
    }

    // Processamento do envio do formulário
    if (isset($_POST['submit'])) {
        // Obter os dados do formulário
        $nome_cand = $_POST['nome_cand'] ?? '';
        $email_cand = $_POST['email_cand'] ?? '';
        $senha_cand = md5($_POST['senha_cand'] ?? '');
        $data_nascimento = $_POST['nascimento'] ?? '';
        $tipo_usuario = 2  ?? '';

        // Verificar se todos os campos foram preenchidos
        if ($nome_cand && $email_cand && $senha_cand && $data_nascimento && $tipo_usuario) {
            try {
                // Preparar a declaração SQL
                $stmt = $conexao->prepare("INSERT INTO hirenow.usuarios (nome, email, senha, tipo) VALUES (:nome_cand, :email_cand, :senha_cand, :tipo_usuario)");
                $stmt->bindParam(':nome_cand', $nome_cand);
                $stmt->bindParam(':email_cand', $email_cand);
                $stmt->bindParam(':senha_cand', $senha_cand);
                $stmt->bindParam(':tipo_usuario', $tipo_usuario);
                $stmt->execute();
                $id_usuario_candidato = $conexao->lastInsertId();

                // Vincular parâmetros à declaração
                $query = $conexao->prepare("INSERT INTO hirenow.candidatos (id_usuario_candidato, data_nasc) VALUES (:id_usuario_candidato, :data_nascimento)");
                $query->bindParam(':id_usuario_candidato', $id_usuario_candidato);
                $query->bindParam(':data_nascimento', $data_nascimento);
                $query->execute();

                $_SESSION['user_id'] = $id_usuario_candidato;
                
                // Executar a declaração
                if ($stmt && $query) {
                    header("Location: ../sistema/candidato/curriculo/new_curriculo.php");
                    exit(); // Terminar o script após redirecionamento
                } else {
                    echo "Erro ao executar a declaração<br>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage() . "<br>";
            }
        } else{
            echo "Preencha todos os campos.<br>";
        }
    }

// Fechar conexão PDO (opcional, pois a conexão será fechada automaticamente no fim do script)
$pdo = null;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="../Imagens/logos/favicon/hirenow_favicon.ico" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Cadastro</title>
    <style>
        label{
            margin-top: 3vh;
        }

        input[type="date"]{
            text-indent: 0.2vw;
            color: #797979;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
        display: none;
        }
        
        button:hover{
            letter-spacing: 0.5em;
        }

        a#cadastro{
            line-height: 3.2vh;
            height: 3.2vh;
        }

        a#cadastro:hover{
            letter-spacing: 0.5em;
        }

        img#fundo-login-svg{
            width: 80%;
        }
    </style>
</head>
<body>
    <div id="content-login">
        <form action="cadastro_candidato.php" method="POST">
            <figure id="logo">
                <!-- <img src="../Imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo"> -->
                <img src="../imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>

<!-- Nome Completo -->
            <label for="nome">Nome Completo</label>
            <div class="input-box">
                <input type="text" name="nome_cand" placeholder="Nome" required>
                <span class="icon"><i class='bx bx-user' style='color:#ffffff'  ></i></i></span>
            </div>

<!-- Data de Nascimento -->
            <label for="data-nasc">Data de Nascimento</label>
            <div class="input-box">
                <input type="date" name="nascimento" placeholder="Data de Nascimento" required>
                <span class="icon"><i class='bx bx-calendar' style='color:#ffffff' ></i></span>
            </div>
            
<!-- Email -->
            <label for="email">Endereço de email</label>
            <div class="input-box">
                <input type="email" name="email_cand" placeholder="E-mail" required>
                <span class="icon"><i class='bx bx-envelope' style='color:#ffffff'></i></span>
            </div>

<!-- Senha -->
            <label for="password" id="label-senha">Senha</label>
            <div class="input-box">
                <input type="password" name="senha_cand" placeholder="Senha" id="senha" required>
                <div id="icon" onclick="showHide()"><i class='bx bx-show'></i></div>
                <span class="icon"><i class='bx bx-lock'  style='color:#ffffff'></i></span>
            </div>
            <script src="script_password.js"></script>
            <span id="senha">
                <a href="#" id="recuperar-senha">Esquceu a senha?</a>
            </span>

<!-- Recaptcha -->
            <div class="g-recaptcha" data-sitekey="6Lff9KMpAAAAAB2v3b0nbNrSLx9uza-6sI-Wj1lk"></div>

<!-- Submit -->
            <button type="submit" onclick="return valida()" name="submit">Criar conta</button>

<!-- Função JS Validar Recaptcha -->
<script src="../recaptcha/script.js"> </script>

            <div class="line">
                <div id="line1"></div>
                <p>ou</p>
                <div id="line2"></div>
            </div> 
        </form>
        
        <a href="login.php" id="cadastro">Já tem uma Conta?</a>      
    </div>

    <figure id="fundo-login">
        <img src="../imagens/job-hunt-animate (1).svg" alt="" title="https://storyset.com/work User illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>
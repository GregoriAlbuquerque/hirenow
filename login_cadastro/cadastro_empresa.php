<?php
    session_start();
    
    // Configuração do banco de dados
    include '../config/config.php';

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
        $nome_emp = $_POST['nome_emp'] ?? '';
        $email_emp = $_POST['email_emp'] ?? '';
        $senha_emp = md5($_POST['senha_emp'] ?? '');
        $cnpj = $_POST['cnpj'] ?? '';
        $tipo_usuario = 3  ?? '';

        // Verificar se todos os campos foram preenchidos
        if ($nome_emp && $email_emp && $senha_emp && $cnpj && $tipo_usuario) {
            try {
                // Preparar a declaração SQL
                $stmt = $conexao->prepare("INSERT INTO hirenow.usuarios (nome, email, senha, tipo) VALUES (:nome_emp, :email_emp, :senha_emp, :tipo_usuario)");
                $stmt->bindParam(':nome_emp', $nome_emp);
                $stmt->bindParam(':email_emp', $email_emp);
                $stmt->bindParam(':senha_emp', $senha_emp);
                $stmt->bindParam(':tipo_usuario', $tipo_usuario);
                $stmt->execute();
                $id_usuarios_empresa = $conexao->lastInsertId();
                $_SESSION['user_id'] = $id_usuarios_empresa;

                // Vincular parâmetros à declaração
                $query = $conexao->prepare("INSERT INTO hirenow.empresas (id_usuarios_empresa, cnpj) VALUES (:id_usuarios_empresa, :cnpj)");
                $query->bindParam(':id_usuarios_empresa', $id_usuarios_empresa);
                $query->bindParam(':cnpj', $cnpj);
                $query->execute();


                // Executar a declaração
                if ($stmt && $query) {
                    header("Location: ../sistema/empresa/perfil_emp/estrutura_perfil_emp.php");
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
        <form action="cadastro_empresa.php" method="post">
            <figure id="logo">
                <!-- <img src="../Imagens/logos/hirenow_logo.png" alt="Logo Ícone" id="logo"> -->
                <img src="../imagens/logos/hirenow_word.png" alt="Logo" id="logo">
            </figure>

<!-- Nome da Empresa -->
            <label for="nome">Nome da empresa</label>
            <div class="input-box">
                <input type="text" name="nome_emp" placeholder="Nome da Empresa" required>
                <span class="icon"><i class='bx bx-user' style='color:#ffffff'  ></i></i></span>
            </div>

<!-- CNPJ -->
            <label for="data-nasc">CNPJ</label>
            <div class="input-box">
                <input type="number" name="cnpj" placeholder="CNPJ" required>
                <span class="icon"><i class='bx bx-store-alt' style='color:#ffffff'  ></i></span>
            </div>
            
<!-- Email -->
            <label for="email">Endereço de email</label>
            <div class="input-box">
                <input type="email" name="email_emp" placeholder="E-mail" required>
                <span class="icon"><i class='bx bx-envelope' style='color:#ffffff'></i></span>
            </div>

<!-- Senha -->
            <label for="password" id="label-senha">Senha</label>
            <div class="input-box">
                <input type="password" name="senha_emp" placeholder="Senha" id="senha" required>
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
        <img src="../imagens/on-the-office-animate.svg" alt="" title="https://storyset.com/work Work illustrations by Storyset" id="fundo-login-svg">
    </figure>
</body>
</html>
<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include '../config/config.php';
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    // Preparar a declaração SQL para evitar SQL injection
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $valida = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($valida) {
        $user_id = $valida['idUsuarios'];
        $_SESSION['user_id'] = $user_id;

        switch ($valida['tipo']) {
            case 1:
                header('location: ../sistema/administrador/vagas_gerenciamento/estrutura_gerenciamento_vagas.php');
                break;
            case 2:
                header('location: ../sistema/candidato/vagas/estrutura_vagas.php');
                break;
            case 3:
                header('location: ../sistema/empresa/update_vaga/estrutura_gerenciamento_vagas.php');
                break;
            default:
                header('location: login.php');
                break;
        }
        exit(); // Terminar o script após redirecionamento
    } else {
        header('location: login.php');
        exit(); // Terminar o script após redirecionamento
    }
}
?>
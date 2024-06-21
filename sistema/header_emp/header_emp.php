<?php
    session_start();
    include '../../../config/config.php';

    $id_empresa = $_SESSION['user_id'];

    // Query para obter as informações do usuário e notificações
    $query_user = $conexao->query("SELECT * FROM hirenow.usuarios INNER JOIN hirenow.vagas ON idUsuarios = id_empresa INNER JOIN hirenow.interessados ON idVagas = id_vaga WHERE idUsuarios = $id_empresa");
    $list_user = $query_user->fetchAll(PDO::FETCH_ASSOC);

    $notification_count = count($list_user);

    // Obtendo informações do perfil do usuário
    $query_profile = $conexao->query("SELECT nome, email FROM hirenow.usuarios WHERE idUsuarios = $id_empresa");
    $user_profile = $query_profile->fetch(PDO::FETCH_ASSOC);
?>

<header>
    <img src="../../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header"/>

    <div class="nav-link">
        <span class="nav-span">
        <i class="bx bx-briefcase"></i>
        <a href="../update_vaga/estrutura_gerenciamento_vagas.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span">
        <i class="bx bx-conversation"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <div class="icon" onclick="toggleNotifi()">
            <i class="bx bx-bell" style="color: black; font-size: 1.5rem;"></i> <span style="  display: flex; justify-content: center; align-items: center;"><?= $notification_count ?></span>
            <p style="color: black; transform: translateX(-10px); font-size: 1.4em;">Notificações</p>
            <!--box notificações-->
            <div class="notifi-box" id="box">
                <h2>Notificações <?= $notification_count ?></h2>
                <!--Mensagem da notificação-->
                <?php foreach($list_user as $user_notifi): ?>
                    <div class="notifi-item">
                        <img src="../../../imagens/notificacoes/avatar3.png" alt="img">
                        <div class="text">
                            <h4><?= $user_notifi["nome_interessado"] ?></h4>
                            <p>Você recebeu uma proposta para a realização das atividades da vaga <strong><?= $user_notifi["titulo"] ?></strong></p>
                        </div><!--Fim div text--> 
                    </div><!--Fim div notifi-item-->
                <?php endforeach; ?>
            </div>
        </div>
        <script>
            var box  = document.getElementById('box');
            var down = false;

            function toggleNotifi(){
                if (down) {
                    box.style.height  = '0px';
                    box.style.opacity = 0;
                    down = false;
                }else {
                    box.style.height  = '510px';
                    box.style.opacity = 1;
                    down = true;
                }
            }
        </script>
    </div><!--nav-link-->

    <nav class="navegation">
        <span class="nav-span-menu">
        <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
        <a href="../update_vaga/estrutura_update_vaga.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span-menu">
        <i class="bx bx-conversation" style="margin-top: 7px;"></i>
        <a href="#" class="nav-link">Mensagens</a>
        </span>

        <span class="nav-span-menu" style="margin-bottom: 10px;">
        <i class="bx bx-bell" style="margin-top: 7px;"></i>
        <a href="#" class="nav-link">Notificações</a>
        </span>
        <div class="content-perfi">

        <!-- Perfil -->
        <div class="info-perfil">
          <h3>Perfil da Empresa</h3>
          <img src="../../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" style="border: 2px solid black;"/>
          <h4>Nome</h4>
          <p><?= $user_profile["nome"] ?></p>
          <h4>E-mail</h4>
          <p><?= $user_profile["email"] ?></p>
          <a href="../new_vaga/estrutura_new_vaga.php" id="btn-new-vaga">Criar Nova Vaga</a>
          <a href="../perfil_emp/estrutura_perfil_emp.php" class="link-nav-hamb">Editar Perfil</a><br />
          <a href="../../../login_cadastro/logout.php" class="link-nav-hamb">Sair</a>
        </div>
      </div><!--content-perfi-->
    </nav>

    
<div class="menu-toggle" onclick="toggleMenu()">
    <span id="menu-icon" class="icon-transition"><button style="border: 2px solid black; padding: 8px; border-radius: 10px; font-size: 1.2rem; margin-top: 1.5vh;"><strong> Perfil</strong></button></span>
    <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
</div>

</header>

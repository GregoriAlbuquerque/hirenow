<?php
session_start();
$id_candidato = $_SESSION['user_id'];

// Consulta para obter os dados do candidato e seu currículo
$stmt = $conexao->prepare("SELECT * FROM hirenow.usuarios LEFT JOIN hirenow.curriculo ON idUsuarios = id_candidato WHERE idUsuarios = :id_candidato");
$stmt->execute(['id_candidato' => $id_candidato]);
$list_vagas = $stmt->fetch(PDO::FETCH_ASSOC);

// Consulta para obter as notificações do candidato
$stmt = $conexao->prepare("SELECT * FROM hirenow.usuarios INNER JOIN hirenow.interessados ON idUsuarios = id_candidato INNER JOIN hirenow.vagas ON id_vaga = idVagas WHERE idUsuarios = :id_candidato AND selecionado = 1");
$stmt->execute(['id_candidato' => $id_candidato]);
$list_user = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Verifica se o id do currículo é nulo
$curriculo_id = isset($list_vagas['id_candidato']) ? $list_vagas['id_candidato'] : null;
$notification_count = count($list_user);
?>

<header>
    <img src="../../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

    <div class="nav-link">
        <span class="nav-span">
            <i class="bx bx-briefcase"></i>
            <a href="../vagas/estrutura_vagas.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span">
            <i class="bx bx-conversation"></i>
            <a href="#" class="nav-link">Mensagens</a>
        </span>

        <div class="icon" onclick="toggleNotifi()">
            <i class="bx bx-bell" style="color: black; font-size: 1.5rem;"></i> 
            <span style="display: flex; justify-content: center; align-items: center;"><?= $notification_count ?></span>
            <p style="color: black; transform: translateX(-10px); font-size: 1.4em;">Notificações</p>
            <!--box notificações-->
            <div class="notifi-box" id="box">
                <h2>Notificações <?= $notification_count ?></h2>
                <!--Mensagem da notificação-->
                <?php foreach($list_user as $user_notifi): ?>
                    <div class="notifi-item">
                        <img src="../../../imagens/notificacoes/avatar3.png" alt="img">
                        <div class="text">
                            <h4><?= $user_notifi['nome_empresa']?></h4>
                            <?php
                                $stmt = $conexao->prepare("SELECT email FROM hirenow.usuarios WHERE nome = :nome");
                                $stmt->execute(['nome' => $user_notifi['nome_empresa']]);
                                $list_emp = $stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <p>Você foi contratado para a realização das atividades da vaga <strong><?= $user_notifi["titulo"] ?></strong>. Aguarde o contato da empresa via email.</p>
                        </div>
                    </div>
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
                } else {
                    box.style.height  = '510px';
                    box.style.opacity = 1;
                    down = true;
                }
            }
        </script>
    </div>
    <!--nav-link-->

    <nav class="navegation">
        <span class="nav-span-menu">
            <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
            <a href="../vagas/estrutura_vagas.php" class="nav-link">Vagas</a>
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
                <h3>Perfil do Candidato</h3>
                <img src="../../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil" style="border: 2px solid black;" />
                <h4>Nome</h4>
                <p><?= $list_vagas["nome"] ?></p>
                <h4>E-mail</h4>
                <p><?= $list_vagas["email"] ?></p>
                <a href="<?= $curriculo_id ? '../curriculo/editar_curriculo.php' : '../curriculo/new_curriculo.php' ?>" class="link-nav-hamb">
                    <?= $curriculo_id ? 'Editar Currículo' : 'Criar Currículo' ?>
                </a><br />
                <a href="../../../login_cadastro/logout.php" class="link-nav-hamb">Sair</a>
            </div>
        </div>
        <!--content-perfi-->
    </nav>

    <div class="menu-toggle" onclick="toggleMenu()">
        <span id="menu-icon" class="icon-transition">
            <button style="border: 2px solid black; padding: 8px; border-radius: 10px; font-size: 1.2rem; margin-top: 1.5vh;">
                <strong> Perfil</strong>
            </button>
        </span>
        <span id="close-icon" class="icon-transition" style="display: none;">
            <i class='bx bx-x'></i>
        </span>
    </div>
</header>

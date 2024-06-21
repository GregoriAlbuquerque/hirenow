<?php
    
    $query_user = $conexao->query("SELECT * FROM hirenow.usuarios WHERE idUsuarios = 1");
    $list_vagas = $query_user->fetch(PDO::FETCH_ASSOC);

?>

<header>
    <img src="../../../imagens/logos/hirenow_word.png" alt="Logo" id="logo-word-header" />

    <div class="nav-link">
        <span class="nav-span">
            <i class="bx bx-briefcase"></i>
            <a href="../vagas_gerenciamento/estrutura_gerenciamento_vagas.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span">
            <i class='bx bx-body'></i>
            <a href="../candidatos_gerenciamento/estrutura_gerenciamento_candidato.php" class="nav-link">Candidatos</a>
        </span>

        <span class="nav-span">
            <i class='bx bxs-building'></i>
            <a href="../empresas_gerenciamento/estrutura_gerenciamento_empresas.php" class="nav-link">Empresas</a>
        </span>
    </div>
    <!--nav-link-->

    <nav class="navegation">
        <span class="nav-span-menu">
            <i class="bx bx-briefcase" style="margin-top: 7px;"></i>
            <a href="../vagas_gerenciamento/estrutura_gerenciamento_vagas.php" class="nav-link">Vagas</a>
        </span>

        <span class="nav-span-menu">
            <i class='bx bx-body' style="margin-top: 7px;"></i>
            <a href="../candidatos_gerenciamento/estrutura_gerenciamento_candidato.php" class="nav-link">Candidatos</a>
        </span>

        <span class="nav-span-menu" style="margin-bottom: 10px;">
        <i class='bx bxs-building' style="margin-top: 7px;"></i>
            <a href="../empresas_gerenciamento/estrutura_gerenciamento_empresas.php" class="nav-link">Empresas</a>
        </span>
        <div class="content-perfi">

<!-- Perfil -->
            <div class="info-perfil">
                <h3>Perfil do Administrador</h3>
                <img src="../../../imagens/perfil/perfil.png" alt="Foto de Perfil" id="img_perfil"
                    style="border: 2px solid black;" />
                <h4>Nome</h4>
                <p><?= $list_vagas["nome"] ?></p>
                <h4>E-mail</h4>
                <p><?= $list_vagas["email"] ?></p>
                <a href="../../../login_cadastro/logout.php" class="link-nav-hamb">Sair</a>
            </div>
        </div>
        <!--content-perfi-->
    </nav>


    <div class="menu-toggle" onclick="toggleMenu()">
        <span id="menu-icon" class="icon-transition"><button style="border: 2px solid black; padding: 8px; border-radius: 10px; font-size: 1.2rem; margin-top: 1.5vh;"><strong> Perfil</strong></button></span>
        <span id="close-icon" class="icon-transition" style="display: none;"><i class='bx bx-x'></i></span>
    </div>

</header>
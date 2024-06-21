<?php
    include '../../../config/config.php';
    if($_GET["id_candidato"] && $_GET["id_vaga"]){ 
        $id_candidato = (int)$_GET["id_candidato"];
        $id_vaga = (int)$_GET["id_vaga"];

        $sql = "UPDATE hirenow.interessados SET selecionado = 1 WHERE id_candidato = $id_candidato and id_vaga = $id_vaga";
        $desativar=$conexao->query($sql);

        $sql_vaga = "UPDATE hirenow.vagas SET status_vaga = 1 WHERE idVagas = $id_vaga";
        $desativar_vaga=$conexao->query($sql_vaga);
        header('location: ../update_vaga/estrutura_gerenciamento_vagas.php');
    }
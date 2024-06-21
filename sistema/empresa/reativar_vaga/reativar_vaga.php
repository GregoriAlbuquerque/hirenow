<?php
    include '../../../config/config.php';
    if($_GET["id"]){ 
        $id_vaga = $_GET["id"];
        $sql = "UPDATE hirenow.vagas SET status_vaga = 0 WHERE idVagas = $id_vaga";
        $desativar=$conexao->query($sql);
        header('location: estrutura_vagas_desativadas.php');
    }
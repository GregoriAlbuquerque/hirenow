<?php
    include '../../../config/config.php';
    if($_GET["id"]){ 
        $id_vaga = $_GET["id"];
        $sql = "UPDATE hirenow.interessados SET status_interesse = 1 WHERE id_vaga = $id_vaga";
        $desativar=$conexao->query($sql);
    header('location: estrutura_propostas_enviadas.php');
    }
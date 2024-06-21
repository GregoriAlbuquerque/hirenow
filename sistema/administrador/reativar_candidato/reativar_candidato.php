<?php
    include '../../../config/config.php';
    if($_GET["id"]){ 
        $id_candidato = $_GET["id"];
        $sql = "UPDATE hirenow.usuarios SET status_usuario = 0 WHERE idUsuarios = $id_candidato";
        $desativar=$conexao->query($sql);
    header('location: estrutura_reativar_candidato.php');
    }
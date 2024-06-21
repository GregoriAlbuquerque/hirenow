<?php
    include '../../../config/config.php';
    if($_GET["id"]){ 
        $id_candidato = $_GET["id"];
        $sql = "UPDATE hirenow.usuarios SET status_usuario = 2 WHERE idUsuarios = $id_candidato";
        $desativar=$conexao->query($sql);
    header('location: estrutura_gerenciamento_candidato.php');
    }
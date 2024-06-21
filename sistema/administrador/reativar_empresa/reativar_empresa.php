<?php
    include '../../../config/config.php';
    if($_GET["id"]){ 
        $id_empresa = $_GET["id"];
        $sql = "UPDATE hirenow.usuarios SET status_usuario = 0 WHERE idUsuarios = $id_empresa";
        $desativar=$conexao->query($sql);
    header('location: estrutura_reativar_empresas.php');
    }
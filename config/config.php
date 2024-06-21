<?php

    $dsn = 'mysql:host=localhost;dbname=hirenow';
    $usuario = 'root';
    $senha = '';

    $conexao = new PDO($dsn, $usuario, $senha);

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
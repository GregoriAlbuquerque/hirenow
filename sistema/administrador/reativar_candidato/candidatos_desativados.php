<?php

$query = "SELECT * FROM hirenow.usuarios INNER JOIN hirenow.candidatos
ON usuarios.idUsuarios = candidatos.id_usuario_candidato WHERE status_usuario = 2";
$stmt = $conexao->query($query);
$list_usuarios_candidatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($list_usuarios_candidatos as $candidato): ?>
    <?php if ($candidato["tipo"] == 2): ?>
        <div class="content-candidato">
            <div class="candidato">
                <div class="topo-candidato">
                    <h4 style="margin-right: 3px;">Nome: </h4>
                    <h4 style="font-weight:400;"><?= $candidato["nome"] ?></h4>
                </div><!--Fim div topo-vaga-->
                <br>
                <h4 style="display: inline-block;">Data de Nascimento:</h4>
                <p style="display: inline-block;">
                    <?php
                    $data_nasc = new DateTime($candidato["data_nasc"]);
                    echo $data_nasc->format('d/m/Y');
                    ?>
                </p>
                <br>
                <br>
                <h4 style="display: inline-block;">Email: </h4>
                <p style="display: inline-block;"><?= $candidato["email"] ?></p>
                <div class="content-btn-delete">
                    <a href=<?="reativar_candidato.php?id={$candidato['idUsuarios']}"?> class="btn-delete" class="btn-update" onclick="return confirm('Tem certeza que deseja Reativar o candidato?')">Reativar</a>
                </div>
                <!--Fim div content-btn-delete-->
            </div>
            <!--Fim div vaga-->
        </div>
        <!--Fim content vaga-->
    <?php endif; ?>
<?php endforeach; ?>

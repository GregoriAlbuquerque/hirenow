<?php

    $query = "SELECT * FROM hirenow.usuarios INNER JOIN hirenow.empresas
    ON usuarios.idUsuarios = empresas.id_usuarios_empresa WHERE status_usuario = 2";
    $stmt = $conexao->query($query);
    $list_usuarios_empresas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($list_usuarios_empresas as $empresas): ?>
    <?php if ($empresas["tipo"] == 3): ?>
        <div class="content-empresa">
            <div class="empresa">
                <div class="topo-empresa">
                <h4 style="display: inline-block; margin-right: 3px;">Nome: </h4>
                <h4 style="display: inline-block; font-weight:400;"><?= $empresas["nome"] ?></h4>
                </div>
                <!--Fim div topo-vaga-->
                <br>
                <h4 style="display: inline-block;">CNPJ:</h4>
                <p style="display: inline-block;"><?= $empresas["cnpj"] ?></p>
                <br>
                <br>
                <h4 style="display: inline-block;">Email: </h4>
                <p style="display: inline-block;"><?= $empresas["email"] ?></p>
                <br>
                <br>
                <h4 style="display: inline-block;">Área de atuação: </h4>
                <p style="display: inline-block;"><?= $empresas["area_atuacao"] ?></p>
                <div class="content-btn-delete">
                    <a href=<?="reativar_empresa.php?id={$empresas['idUsuarios']}"?> class="btn-delete" class="btn-update" onclick="return confirm('Tem certeza que deseja reativar a empresa?')">Reativar</a>
                </div>
                <!--Fim div contetnt-btn-delete-->
            </div>
            <!--Fim div vaga-->
        </div>
        <!--Fim content vaga-->
    <?php endif; ?>
<?php endforeach; ?>
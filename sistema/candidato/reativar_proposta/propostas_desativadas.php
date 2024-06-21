<?php

    $id_candidato = $_SESSION['user_id'];

    $query = "SELECT * FROM hirenow.interessados INNER JOIN hirenow.vagas
    ON interessados.id_vaga = idVagas WHERE id_candidato = $id_candidato and status_vaga = 0 and status_interesse = 1";
    $stmt = $conexao->query($query);
    $list_vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($list_vagas as $vagas): ?>
    <div class="content-vaga">
        <div class="vaga">
            <div class="topo-vaga">
                <h3><?= $vagas["titulo"] ?></h3>
                <h3>R$ <?= $vagas["pagamento"] ?></h3>
            </div>
            <!--Fim div topo-vaga-->
            <br>
            <h4 style="display: inline-block;">Área: </h4>
            <p style="display: inline-block;"><?= $vagas["area"] ?></p>
            <br>
            <br>
            <h4>Descrição:</h4>
            <p style="text-align: justify;"><?= $vagas["descricao"] ?></p>
            <br>
            <div class="requisitos-content">
                <h4>Requisitos</h4>
                <p><?= $vagas["requisitos"] ?></p>
            </div>
            <br>
            <div class="requisitos-content">
                <h4>Proposta enviada</h4>
                <p style="text-align: justify;"><?= $vagas["proposta"] ?></p>
            </div>
            <!--requisitos-content-->
            <div class="contetnt-btn-vaga">
                <a href=<?="reativar_proposta.php?id={$vagas['idVagas']}"?> class="btn-proposta" onclick="return confirm('Tem certeza que deseja reativar a proposta?')">Reativar proposta</a>
            </div>
            <!--Fim div contetnt-btn-vaga-->
        </div>
        <!--Fim div vaga-->
    </div>
    <!--Fim content vaga-->
<?php endforeach; ?>
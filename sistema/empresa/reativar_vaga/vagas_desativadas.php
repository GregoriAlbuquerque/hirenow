<?php
    if (!isset($_SESSION['user_id'])) {
        // Redirecionar para a página de login se o usuário não estiver logado
        header("Location: ../../../login_cadastro/login.php");
        exit();
    }
    $id_empresa = $_SESSION['user_id'];
    $query = "SELECT * FROM hirenow.vagas WHERE id_empresa = $id_empresa and status_vaga = 1";
    $stmt = $conexao->query($query);
    $list_vagas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php foreach($list_vagas as $vagas): ?>
<div class="content-vaga">
    <div class="vaga">
        <h5 style="display:none;">Id: <?= $vagas["idVagas"] ?></h5>
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
        </div><!--requisitos-content-->
        <div class="content-btn-update">
            <a href=<?="reativar_vaga.php?id={$vagas['idVagas']}"?> class="btn-update" onclick="return confirm('Tem certeza que deseja reativar a vaga?')">Reativar</a>
        </div><!--Fim div contetnt-btn-delete-->
    </div>
    <!--Fim div vaga-->
</div>
<?php endforeach; ?>
<!--Fim content vaga-->
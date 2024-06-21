<?php
include '../../../config/config.php';

if (isset($_GET['id_candidato'])) {
    $id_candidato = (int)$_GET['id_candidato'];

    try {
        // Consulta ao banco de dados para obter o nome do arquivo de portfólio
        $stmt = $conexao->prepare("SELECT portifolio FROM hirenow.curriculo WHERE id_candidato = :id_candidato");
        $stmt->bindParam(':id_candidato', $id_candidato);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $portifolio_path = $result['portifolio'];

            // Verifica se o arquivo existe antes de iniciar o download
            if (file_exists($portifolio_path)) {
                // Define headers para forçar o download
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($portifolio_path) . '"');
                header('Content-Length: ' . filesize($portifolio_path));
                readfile($portifolio_path);
                exit;
            } else {
                echo "O arquivo de portfólio não existe.";
            }
        } else {
            echo "Nenhum portfólio encontrado para o candidato.";
        }
    } catch (PDOException $e) {
        echo "Erro ao consultar o banco de dados: " . $e->getMessage();
    }
} else {
    echo "ID do candidato não especificado.";
}
?>

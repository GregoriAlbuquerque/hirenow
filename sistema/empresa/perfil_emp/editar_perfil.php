<?php
include '../../../config/config.php';
session_start();
$id_empresa = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
                $area = $_POST['area'] ?? '';
                $descricao = $_POST['descricao'] ?? '';
                
                // Mapear os valores numéricos para os nomes das áreas
                $areas = [
                    "0" => "Administração",
                    "1" => "Direito",
                    "2" => "Edição audiovisual",
                    "3" => "Engenharia",
                    "4" => "Finanças",
                    "5" => "Marketing",
                    "6" => "Saúde",
                    "7" => "Tecnologia (TI)"
                ];
                
                $area_nome = $areas[$area] ?? '';
                
                if ($id_empresa && $area_nome && $descricao) {
                    try {
                        // Preparar a declaração SQL
                        $stmt = $conexao->prepare("UPDATE hirenow.empresas SET area_atuacao = :area, descricao_empresa = :descricao WHERE id_usuarios_empresa = :id_empresa");
                        $stmt->bindParam(':area', $area_nome);
                        $stmt->bindParam(':descricao', $descricao);
                        $stmt->bindParam(':id_empresa', $id_empresa);
                        $stmt->execute();
                
                        // Executar a declaração
                        if ($stmt) {
                            header("Location: ../update_vaga/estrutura_gerenciamento_vagas.php");
                            exit(); // Terminar o script após redirecionamento
                        } else {
                            echo "Erro ao executar a declaração<br>";
                        }
                    } catch (PDOException $e) {
                        echo "Erro: " . $e->getMessage() . "<br>";
                    }
                } else {
                    echo "Preencha todos os campos.<br>";
                }
            }
            ?>
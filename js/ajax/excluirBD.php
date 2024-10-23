<?php
include_once '../../_conexao/conexao.php';  // Inclui a conexão com o banco de dados

if (isset($_POST['id'], $_POST['image'])) {
    $idURL = $_POST['id'];
    $caminhoImagem = $_POST['image']; // Recebe o caminho da imagem via POST

    // 1. Verifica se o arquivo da imagem existe e tenta excluir
    if (file_exists($caminhoImagem)) {
        unlink($caminhoImagem); // Exclui a imagem do servidor
    }

    // 2. Excluir o registro do banco de dados
    $sqlDelete = "DELETE FROM url WHERE idURL = :id";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $idURL, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        echo 'success'; // Resposta de sucesso
    } else {
        echo 'error'; // Erro ao excluir o registro do banco de dados
    }
}
?>

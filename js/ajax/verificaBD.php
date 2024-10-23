<?php
include_once '../../_conexao/conexao.php';


if (isset($_POST['url'])) {
    $url = $_POST['url'];

    // Consulta SQL para verificar se a URL já existe
    $sql = "SELECT * FROM url WHERE urlURL = ?";
    
    // Preparar a consulta usando PDO
    $stmt = $conn->prepare($sql);
    
    // Executar a consulta passando o valor da URL
    $stmt->execute([$url]);
    
    // Verificar se houve resultados
    if ($stmt->rowCount() > 0) {
        echo 'exists'; // URL já cadastrada
    } else {
        echo 'not_exists'; // URL não encontrada
    }
}
?>

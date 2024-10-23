<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
include_once '../../_conexao/conexao.php';

if (isset($_POST['url'], $_POST['descricao'], $_POST['categoria']) && isset($_FILES['uploadBtn'])) {
    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL); 
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);

    
    if (strpos($url, 'https://') !== 0) {
        $url = 'https://' . $url;
    }

    $targetDir = '../../img/bd/';

    $fileName = $_FILES['uploadBtn']['name'];
    $fileTmp = $_FILES['uploadBtn']['tmp_name'];
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

    // Extensões permitidas
    $allowedExt = array('jpg', 'jpeg', 'png', 'gif');

    if (in_array($fileExt, $allowedExt)) {
        // Nome da imagem será o nome original enviado pelo usuário
        $newFileName = $fileName;

        // Caminho completo para salvar o arquivo
        $targetFile = $targetDir . $newFileName;
        if (move_uploaded_file($fileTmp, $targetFile)) {
            // Inserir dados no banco
            $sql = "INSERT INTO `url`
                        (`idURL`, `urlURL`, `descricaoURL`, `capaURL`, `categoriaURL`, `dataCadastroURL`) 
                    VALUES 
                        (NULL, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$url, $descricao, $newFileName, $categoria, date('Y-m-d')])) {
                echo 'success'; // Cadastro realizado com sucesso
            } else {
                // Exibe erro do PDO
                $errorInfo = $stmt->errorInfo();
                echo 'Erro ao cadastrar no banco: ' + $errorInfo[2];
            }
        } else {
            echo 'error_upload'; // Erro ao mover o arquivo
        }
    } else {
        echo 'invalid_file'; // Extensão de arquivo inválida
    }
}
?>

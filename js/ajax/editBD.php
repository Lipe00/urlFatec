<?php
include_once '../../_conexao/conexao.php'; 

if (!empty($_POST)){
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT); 
    $oldImg = filter_input(INPUT_POST, 'oldImg', FILTER_SANITIZE_SPECIAL_CHARS); 
    $url = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL); 
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $categoria = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_SPECIAL_CHARS);
    if(isset($_FILES['uploadBtn'])){
        $targetDir = '../../img/bd/';

        $fileName = $_FILES['uploadBtn']['name'];
        $fileTmp = $_FILES['uploadBtn']['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); 

        // Extensões permitidas
        $allowedExt = array('jpg', 'jpeg', 'png', 'gif');

        if (in_array($fileExt, $allowedExt)) {
            
            $newFileName = $fileName;

            
            $targetFile = $targetDir . $newFileName;

            if (move_uploaded_file($fileTmp, $targetFile)) {
                
                $sql = "UPDATE `url`
                            SET `urlURL` = ?, 
                                `descricaoURL` = ?, 
                                `capaURL` = ?, 
                                `categoriaURL` = ?
                            WHERE 
                                `idURL` = ?";
                $stmt = $conn->prepare($sql);
                if ($stmt->execute([$url, $descricao, $newFileName, $categoria, $id])) {
                    if (file_exists($targetDir . $oldImg)) {
                        unlink($targetDir . $oldImg); 
                    }
                    echo 'success';
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
    }else{
        $sql = "UPDATE `url`
        SET `urlURL` = ?, 
            `descricaoURL` = ?, 
            `capaURL` = ?, 
            `categoriaURL` = ?
        WHERE 
            `idURL` = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute([$url, $descricao, $oldImg, $categoria, $id])) {
            echo 'success';
            } else {
            // Exibe erro do PDO
            $errorInfo = $stmt->errorInfo();
            echo 'Erro ao cadastrar no banco: ' + $errorInfo[2];
}
    }
}

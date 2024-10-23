<?php
include_once '../../_conexao/conexao.php'; 
if(empty($_POST)){
    // Consulta SQL para buscar os dados
    $sql = "SELECT * FROM url";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se encontrou resultados
    if ($result) {
        echo json_encode($result); // Retorna os dados como JSON
    } else {
        echo json_encode([]); // Retorna um array vazio caso não tenha resultados
    }
}else{
    $pesquisa =  filter_input(INPUT_POST, "pesq", FILTER_SANITIZE_SPECIAL_CHARS);
    // Consulta SQL para buscar os dados
    $sql = "SELECT *
            FROM url
            WHERE urlURL LIKE :parametro
                OR descricaoURL LIKE :parametro
                OR categoriaURL LIKE :parametro";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':parametro', "%".$pesquisa."%", PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se encontrou resultados
    if ($result) {
        echo json_encode($result); // Retorna os dados como JSON
    } else {
        echo json_encode([]); // Retorna um array vazio caso não tenha resultados
    }
}

?>

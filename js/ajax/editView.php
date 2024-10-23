<?php
include_once '../../_conexao/conexao.php'; 
// header('Content-Type: application/json');
if (!empty($_POST)) {
    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);

    if ($id === null) {
        echo json_encode(['error' => 'ID inválido.']);
        exit;
    }

    // Consulta SQL para buscar os dados
    $sql = "SELECT * FROM url WHERE idURL = :id"; // Mudei LIKE para = para busca exata
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if (!$stmt->execute()) {
        echo json_encode(['error' => 'Erro na execução da consulta.']);
        exit;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Verifica se encontrou resultados
    if ($result) {
        echo json_encode($result); // Retorna os dados como JSON
    } else {
        echo json_encode([]); // Retorna um array vazio caso não tenha resultados
    }
} else {
    echo json_encode(['error' => 'Dados não recebidos.']);
}
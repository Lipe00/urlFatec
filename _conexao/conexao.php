<?php
$dns = "mysql:host=localhost;dbname=urlfatec;charset=utf8";
$user = "root";
$pass = "";

try{
    $conn = new PDO($dns, $user, $pass);
    // echo("A conexão com o banco foi um sucesso!");
}catch(PDOException $erro){
    echo("Erro ao conectar com a base de dados <br>");
}
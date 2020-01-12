<?php
//Váriaveis de configuração
$server = "localhost";
$dbname = "db_crud";
$user = "root";
$pwd = "";

try {
    //Efetuar coenxão
    $pdo = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8", $user, $pwd);

} catch (PDOException $erro) {
    //Capturar erro de conexão
    echo $erro->getMessage();
    exit;
}
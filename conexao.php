<?php
    $servidor = 'localhost';
    $banco = 'upload';
    $usuario = 'root';
    $senha = '';

    try {

    $pdo = new PDO ("mysql:host=$servidor;dbname=$banco;charset=utf8", $usuario, $senha);
    } catch (PDOException $erro) {

    $msg = $erro->getMessage();

    echo "<p>Erro a conectar no banco de dados: $msg</p>";
    }
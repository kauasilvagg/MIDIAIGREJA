<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $stmt = $conn->prepare("INSERT INTO eventos (nome, descricao, data, hora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $descricao, $data, $hora);

    if ($stmt->execute()) {
        header("Location: eventos.php");
        exit;
    } else {
        echo "Erro ao salvar evento: " . $stmt->error;
    }
}

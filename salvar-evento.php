<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include 'conexao.php';

$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$data_evento = $_POST['data_evento'];
$hora_evento = $_POST['hora_evento'];

$stmt = $conn->prepare("INSERT INTO eventos (titulo, descricao, data_evento, hora_evento) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $titulo, $descricao, $data_evento, $hora_evento);
$stmt->execute();
$stmt->close();

header("Location: painel.php");
exit;

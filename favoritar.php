<?php
include 'conexao.php';

$versiculo_id = $_POST['versiculo_id'] ?? null;
$ip = $_SERVER['REMOTE_ADDR'];

if ($versiculo_id) {
    $stmt = $conn->prepare("INSERT INTO favoritos (versiculo_id, ip_usuario) VALUES (?, ?)");
    $stmt->execute([$versiculo_id, $ip]);
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;

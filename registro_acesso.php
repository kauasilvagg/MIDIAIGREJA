<?php
include 'conexao.php'; // Este arquivo define $conn como mysqli

function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
    return $_SERVER['REMOTE_ADDR'];
}

$ip = getUserIP();

$stmt = $conn->prepare("INSERT INTO acessos (ip) VALUES (?)");

if ($stmt) {
    $stmt->bind_param("s", $ip);
    $stmt->execute();
    $stmt->close();
} else {
    echo "Erro na preparação da query: " . $conn->error;
}
?>

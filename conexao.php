<?php
$host = "localhost";
$user = "root";
$password = ""; // ou coloque a senha real, se existir
$dbname = "igreja_shalom";
$port = "3306";

$conn = new mysqli($host, $user, $password, $dbname);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>

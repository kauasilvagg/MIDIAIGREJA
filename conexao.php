<?php
$servername = "localhost";
$username = "root";
$password = "13032005"; // ← sem senha como está no phpMyAdmin
$dbname = "Igreja_Shalom";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>

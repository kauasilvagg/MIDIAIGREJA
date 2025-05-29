<?php
// Configurações do banco de dados
$host = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'igreja_shalom';
$porta = 3306; // Altere aqui se estiver usando uma porta diferente

// Cria conexão
$conn = new mysqli($host, $usuario, $senha, $banco, $porta);

// Verifica se houve erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Define o charset para evitar problemas com acentuação
$conn->set_charset("utf8");
?>
 
<?php
$host = "localhost";
$user = "root";
$pass = "13032005";
$dbname = "igreja_shalom";

// Conexão
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "DELETE FROM eventos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redireciona de volta com sucesso
        header("Location: eventos.php?msg=excluido com sucesso");
        exit;
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
} else {
    echo "ID não recebido.";
}

$conn->close();
?>

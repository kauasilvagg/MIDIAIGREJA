<?php
session_start();
include 'conexao.php';

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
        $erro = "Erro ao cadastrar evento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Cadastrar Novo Evento</h2>
    <?php if (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Evento</label>
            <input type="text" class="form-control" name="nome" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea class="form-control" name="descricao" rows="4" required></textarea>
        </div>
        <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" name="data" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" name="hora" required>
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="eventos.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
</body>
</html>

<?php
session_start();
include 'conexao.php';

// Verifica se o usuário é admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$mensagem = "";
$erro = "";

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];

    $stmt = $conn->prepare("INSERT INTO eventos (nome, descricao, data, hora) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $descricao, $data, $hora);

    if ($stmt->execute()) {
        $mensagem = "✅ Evento cadastrado com sucesso!";
    } else {
        $erro = "❌ Erro ao cadastrar evento: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(170, 189, 234), #f0f7ff);
        }
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .form-title {
            font-weight: bold;
            color: #2c3e50;
        }
        .btn-custom {
            background-color: #3498db;
            color: white;
        }
        .btn-custom:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="form-container">
                <h2 class="mb-4 text-center form-title">Cadastrar Novo Evento</h2>

                <?php if ($mensagem): ?>
                    <div class="alert alert-success"><?= $mensagem ?></div>
                <?php elseif ($erro): ?>
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
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-custom">Salvar Evento</button>
                        <a href="eventos.php" class="btn btn-outline-secondary">Ver Eventos</a>
                        <a href="logout.php" class="btn btn-danger">Sair</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

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
        $sucesso = "Evento cadastrado com sucesso!";
    } else {
        $erro = "Erro ao cadastrar evento: " . $conn->error;
    }
}

// Buscar eventos para exibição
$resultado = $conn->query("SELECT * FROM eventos ORDER BY data ASC, hora ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .evento-card {
    opacity: 0;
    transform: translateY(20px);
    animation: aparecer 0.8s ease forwards;
}

    @keyframes aparecer {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}


        body {
            background-color: #f8f9fa;
        }
        .evento-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .evento-header {
            background-color: #0d6efd;
            color: white;
            padding: 10px;
            border-radius: 15px 15px 0 0;
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Cadastrar Novo Evento</h2>

    <?php if (isset($sucesso)): ?>
        <div class="alert alert-success"><?= $sucesso ?></div>
    <?php elseif (isset($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post" class="mb-5">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome do Evento</label>
                <input type="text" class="form-control" name="nome" required>
            </div>
            <div class="col-md-6">
                <label for="data" class="form-label">Data</label>
                <input type="date" class="form-control" name="data" required>
            </div>
            <div class="col-md-6">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" class="form-control" name="hora" required>
            </div>
            <div class="col-12">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="4" required></textarea>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Salvar Evento</button>
            <a href="logout.php" class="btn btn-danger float-end">Sair</a>
        </div>
    </form>

    <hr>
    <h3 class="mb-4 text-center">Eventos Cadastrados</h3>
    <div class="row">
        <?php while ($evento = $resultado->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card evento-card" data-aos="fade-up">
                    <div class="evento-header">
                        <h5 class="card-title mb-0"><?= htmlspecialchars($evento['nome']) ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                        <p class="text-muted">
                            📅 <?= date('d/m/Y', strtotime($evento['data'])) ?><br>
                            ⏰ <?= date('H:i', strtotime($evento['hora'])) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script>
  AOS.init({
    duration: 800, // duração da animação em ms
    once: true // anima apenas uma vez
  });
</script>

</body>
</html>

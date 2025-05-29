<?php
session_start();
include 'conexao.php';

// Verifica se é admin
$isAdmin = isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'admin';

// Consulta eventos
$result = $conn->query("SELECT * FROM eventos ORDER BY data ASC, hora ASC");

if (!$result) {
    die("Erro ao buscar eventos: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Eventos da Igreja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .evento-card {
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 15px;
        }
        .evento-header {
            background-color: #007bff;
            color: white;
            border-radius: 15px 15px 0 0;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">📅 Eventos da Igreja Shalom</h1>

    <?php if ($isAdmin): ?>
        <div class="text-end mb-4">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEvento">➕ Novo Evento</button>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php while ($evento = $result->fetch_assoc()): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card evento-card">
                    <div class="card-header evento-header">
                        <h5 class="card-title mb-0"><?= htmlspecialchars($evento['nome']) ?></h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                        <p class="text-muted">
                            📅 <strong>Data:</strong> <?= date('d/m/Y', strtotime($evento['data'])) ?><br>
                            ⏰ <strong>Hora:</strong> <?= date('H:i', strtotime($evento['hora'])) ?>
                        </p>
                        <?php if ($isAdmin): ?>
                            <a href="editar_evento.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="excluir_evento.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!-- Modal para adicionar evento -->
<div class="modal fade" id="modalEvento" tabindex="-1" aria-labelledby="modalEventoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="registrar_evento.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Novo Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Evento</label>
                        <input type="text" class="form-control" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" name="descricao" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="data" class="form-label">Data</label>
                        <input type="date" class="form-control" name="data" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" name="hora" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

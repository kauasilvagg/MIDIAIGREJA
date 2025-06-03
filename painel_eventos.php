<?php
session_start();
include 'conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Excluir evento se solicitado
if (isset($_GET['excluir'])) {
    $id = intval($_GET['excluir']);
    $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: painel_eventos.php");
    exit;
}

$result = $conn->query("SELECT * FROM eventos ORDER BY data ASC, hora ASC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Painel de Administração - Eventos</h2>
    <a href="cadastrar_evento.php" class="btn btn-success mb-3">+ Novo Evento</a>
    <a href="logout.php" class="btn btn-danger mb-3 float-end">Sair</a>

    <?php if ($result->num_rows > 0): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($evento = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($evento['nome']) ?></td>
                        <td><?= nl2br(htmlspecialchars($evento['descricao'])) ?></td>
                        <td><?= date('d/m/Y', strtotime($evento['data'])) ?></td>
                        <td><?= date('H:i', strtotime($evento['hora'])) ?></td>
                        <td>
                            <a href="?excluir=<?= $evento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este evento?')">Excluir</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Nenhum evento cadastrado.</div>
    <?php endif; ?>
</div>
</body>
</html>

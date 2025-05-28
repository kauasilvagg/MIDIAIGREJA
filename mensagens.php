<?php
include 'conexao.php';

$result = $conn->query("SELECT * FROM mensagens ORDER BY data_envio DESC");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagens Recebidas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

<div class="container">
    <h2 class="mb-4">📬 Mensagens Recebidas</h2>
    <a href="admin.php" class="btn btn-secondary mb-3">← Voltar ao Painel</a>

    <?php if ($result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($msg = $result->fetch_assoc()): ?>
                <div class="list-group-item <?= !$msg['lida'] ? 'list-group-item-warning' : '' ?>">
                    <h5><?= htmlspecialchars($msg['nome']) ?> <small class="text-muted">em <?= date("d/m/Y H:i", strtotime($msg['data_envio'])) ?></small></h5>
                    <p><?= nl2br(htmlspecialchars($msg['mensagem'])) ?></p>
                    <form action="marcar_lida.php" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                        <?php if (!$msg['lida']): ?>
                            <button class="btn btn-sm btn-success">Marcar como lida</button>
                        <?php else: ?>
                            <span class="badge bg-success">Lida</span>
                        <?php endif; ?>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Nenhuma mensagem recebida.</p>
    <?php endif; ?>
</div>
</body>
</html>

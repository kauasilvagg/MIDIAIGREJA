<?php include 'registro_acesso.php'; ?>
<?php
include 'conexao.php';
$result = $conn->query("SELECT * FROM contatos ORDER BY data_envio DESC");

?>
<?php
// Upload do PDF calendário
$uploadDir = 'uploads/';
$uploadError = '';
$uploadSuccess = '';
$uploadedFilePath = '';

// Caminho do arquivo PDF salvo (pode ser fixo, tipo calendário.pdf)
$calendarioFile = $uploadDir . 'calendario.pdf';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf_calendario'])) {
    $file = $_FILES['pdf_calendario'];

    // Verificar se é PDF
    $fileType = mime_content_type($file['tmp_name']);
    if ($fileType !== 'application/pdf') {
        $uploadError = "Erro: Apenas arquivos PDF são permitidos.";
    } elseif ($file['error'] !== UPLOAD_ERR_OK) {
        $uploadError = "Erro no upload do arquivo.";
    } else {
        // Move o arquivo para o destino, sobrescrevendo se já existir
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        if (move_uploaded_file($file['tmp_name'], $calendarioFile)) {
            $uploadSuccess = "Arquivo PDF do calendário enviado com sucesso!";
        } else {
            $uploadError = "Erro ao salvar o arquivo no servidor.";
        }
    }
}

// Verifica se o arquivo calendário existe para mostrar link
if (file_exists($calendarioFile)) {
    $uploadedFilePath = $calendarioFile;
}
?>

<!-- Dentro do corpo da página admin.php, onde quiser colocar o upload -->


<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <h5>📅 Upload do Calendário da Igreja (PDF)</h5>
    </div>
    <div class="card-body">
        <?php if ($uploadError): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($uploadError) ?></div>
        <?php elseif ($uploadSuccess): ?>
            <div class="alert alert-success"><?= htmlspecialchars($uploadSuccess) ?></div>
        <?php endif; ?>

        <?php if ($uploadedFilePath): ?>
            <p>Calendário atual disponível para visualização: 
                <a href="<?= htmlspecialchars($uploadedFilePath) ?>" target="_blank" class="btn btn-sm btn-info">Abrir PDF</a>
            </p>
        <?php else: ?>
            <p class="text-muted">Nenhum arquivo PDF do calendário foi enviado ainda.</p>
        <?php endif; ?>
        
            

                <form action="upload_pdf.php" method="POST" enctype="multipart/form-data" class="mb-4">
                <div class="mb-3">
                <label for="arquivo" class="form-label">📅 Enviar PDF do Calendário:</label>
                <input type="file" name="arquivo" id="arquivo" accept="application/pdf" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
                
                <li class="nav-item">
        <a class="nav-link btn btn-info text-black my-2 mx-3" href="dashboard.php" style="text-align: left;">
        📊 Dashboard de Acessos
    </a>
</li>
        </form>
     </div>
    </div>
                



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
    <a href="index.php" class="btn btn-secondary mb-3">← Voltar ao Painel</a>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($msg = $result->fetch_assoc()): ?>
                <div class="list-group-item">
                    <h5><?= htmlspecialchars($msg['nome']) ?> <small class="text-muted">em <?= date("d/m/Y H:i", strtotime($msg['data_envio'])) ?></small></h5>
                    <p><?= nl2br(htmlspecialchars($msg['mensagem'])) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p class="text-muted">Nenhuma mensagem recebida.</p>
    <?php endif; ?>
</div>
</body>
</html>



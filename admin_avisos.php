<?php include('conexao.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aviso</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .btn-success {
            background-color: #198754;
            font-weight: 600;
        }
        .form-control {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card p-4">
            <h2 class="mb-4 text-primary"><i class="bi bi-megaphone-fill"></i> Cadastrar Aviso no Mural</h2>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título:</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem:</label>
                    <textarea class="form-control" name="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-success"><i class="bi bi-check-circle"></i> Cadastrar Aviso</button>
                <a href="mural_avisos.php" class="btn btn-secondary ms-2"><i class="bi bi-arrow-left-circle"></i> Voltar</a>
            </form>

            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $titulo = mysqli_real_escape_string($conn, $_POST['titulo']);
                $mensagem = mysqli_real_escape_string($conn, $_POST['mensagem']);
                $query = "INSERT INTO mural_avisos (titulo, mensagem, data_publicacao) VALUES ('$titulo', '$mensagem', NOW())";
                if (mysqli_query($conn, $query)) {
                    echo "<div class='alert alert-success mt-3'><i class='bi bi-check-circle-fill'></i> Aviso cadastrado com sucesso!</div>";
                } else {
                    echo "<div class='alert alert-danger mt-3'><i class='bi bi-exclamation-triangle-fill'></i> Erro ao cadastrar: " . mysqli_error($conn) . "</div>";
                }
            }
            ?>
        </div>
    </div>

    <!-- Ícones do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>

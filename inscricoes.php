<?php include('conexao.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inscrição para Eventos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">Igreja Shalom</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="eventos.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link" href="inscricoes.php">Inscrições</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-5">
    <h2 class="text-center text-primary mb-4">Formulário de Inscrição</h2>

    <form method="POST" enctype="multipart/form-data" class="shadow p-4 bg-white rounded">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="evento" class="form-label">Evento</label>
            <input type="text" class="form-control" id="evento" name="evento" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail de contato</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="comprovante" class="form-label">Comprovante de pagamento</label>
            <input type="file" class="form-control" id="comprovante" name="comprovante" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="text-muted">Formatos aceitos: JPG, PNG, PDF</small>
        </div>

        <button type="submit" class="btn btn-success">Confirmar Inscrição</button>
    </form>

    <!-- Mensagem de resultado -->
    <div class="mt-3">
        <?php
        // Criar diretório se não existir
        $comprovanteDir = 'comprovantes/';
        if (!is_dir($comprovanteDir)) {
            mkdir($comprovanteDir, 0777, true);
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = mysqli_real_escape_string($conn, $_POST['nome']);
            $evento = mysqli_real_escape_string($conn, $_POST['evento']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $status = 'pendente';

            if (isset($_FILES['comprovante']) && $_FILES['comprovante']['error'] === 0) {
                $nomeArquivo = uniqid() . "_" . basename($_FILES['comprovante']['name']);
                $destino = $comprovanteDir . $nomeArquivo;

                if (move_uploaded_file($_FILES['comprovante']['tmp_name'], $destino)) {
                    $query = "INSERT INTO inscricoes (nome, evento, email, comprovante, status, data_inscricao)
                              VALUES ('$nome', '$evento', '$email', '$destino', '$status', NOW())";

                    if (mysqli_query($conn, $query)) {
                        echo "<div class='alert alert-success'>Inscrição realizada com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao salvar no banco de dados: " . mysqli_error($conn) . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Erro ao mover o arquivo para o servidor.</div>";
                }
            } else {
                echo "<div class='alert alert-warning'>Você precisa anexar um comprovante válido.</div>";
            }
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

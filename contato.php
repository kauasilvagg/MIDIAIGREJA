<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';
$erro = '';
$sucesso = '';
$caminhoImagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($nome)) throw new Exception("Nome é obrigatório");
        if (empty($email)) throw new Exception("E-mail é obrigatório");
        if (empty($mensagem)) throw new Exception("Mensagem é obrigatória");

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Formato de e-mail inválido");
        }

        if (!empty($_FILES['imagem']['name'])) {
            $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            $permitidas = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array(strtolower($extensao), $permitidas)) {
                throw new Exception("Tipo de imagem não permitido. Use JPG, PNG ou GIF.");
            }

            $pasta = "uploads/";
            if (!is_dir($pasta)) {
                mkdir($pasta, 0777, true);
            }

            $nomeImagem = uniqid() . "." . $extensao;
            $caminhoImagem = $pasta . $nomeImagem;

            if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
                throw new Exception("Erro ao salvar a imagem.");
            }
        }

        $conn = new mysqli("localhost", "root", "13032005", "igreja_shalom");
        if ($conn->connect_error) throw new Exception("Erro de conexão: " . $conn->connect_error);

        $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem, imagem, data_envio) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $nome, $email, $mensagem, $caminhoImagem);
        if ($stmt->execute()) {
            $sucesso = "Mensagem enviada com sucesso!";
            $nome = $email = $mensagem = '';
        } else {
            throw new Exception("Erro ao enviar: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

    } catch (Exception $e) {
        $erro = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Contato</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="text-center mb-4">Entre em Contato</h2>

    <style>
    body {
      background: linear-gradient(to right, #f2f9ff, #e6f0ff);
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    nav a {
      color: white !important;
      font-weight: bold;
    }

    footer {
      text-align: center;
      background-color: #f0f0f0;
      padding: 1rem;
      font-size: 0.9rem;
      color: #555;
      margin-top: 4rem;
    }
  </style>


    <?php if ($sucesso): ?>
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" fill="currentColor">
                <use xlink:href="#check-circle-fill"/>
            </svg>
            <div><?= $sucesso ?></div>
        </div>
        <?php if ($caminhoImagem): ?>
            <div class="text-center mb-3">
                <p>📎 Imagem enviada:</p>
                <img src="<?= $caminhoImagem ?>" alt="Imagem enviada" class="img-thumbnail" style="max-height: 250px;">
            </div>
        <?php endif; ?>
    <?php elseif ($erro): ?>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" fill="currentColor">
                <use xlink:href="#exclamation-triangle-fill"/>
            </svg>
            <div><?= $erro ?></div>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="bg-white p-4 shadow rounded">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo</label>
            <input type="text" name="nome" id="nome" class="form-control" required value="<?= htmlspecialchars($nome) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($email) ?>">
        </div>

        <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea name="mensagem" id="mensagem" class="form-control" rows="4" required><?= htmlspecialchars($mensagem) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="imagem" class="form-label">Enviar uma imagem (opcional)</label>
            <input type="file" name="imagem" id="imagem" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success w-100">📤 Enviar</button>
    </form>

    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">← Voltar ao Início</a>
    </div>
</div>

<!-- Ícones SVG para mensagens -->
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 11.001 8a8 8 0 0115.998 0zM6.97 11.03a.75.75 0 001.06 0l4.292-4.292a.75.75 0 10-1.06-1.06L7.5 9.44 5.78 7.72a.75.75 0 00-1.06 1.06l2.25 2.25z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 100 16A8 8 0 008 0zM7.002 5a1 1 0 112 0v3a1 1 0 11-2 0V5zm.998 6a1.25 1.25 0 110 2.5 1.25 1.25 0 010-2.5z"/>
    </symbol>
</svg>

</body>
</html>

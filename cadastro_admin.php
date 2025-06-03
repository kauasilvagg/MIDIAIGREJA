<?php
include 'conexao.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $verifica = $conn->prepare("SELECT id FROM administradores WHERE usuario = ?");
    $verifica->bind_param("s", $usuario);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        $mensagem = "⚠️ Este nome de usuário já está cadastrado!";
    } else {
        $stmt = $conn->prepare("INSERT INTO administradores (usuario, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $senha);

        if ($stmt->execute()) {
            header("Location: login.php?sucesso=1");
            exit;
        } else {
            $mensagem = "❌ Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right,rgb(180, 214, 241), #ffffff);
            font-family: 'Segoe UI', sans-serif;
        }
        .card {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 16px;
        }
        .form-label {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card p-4" style="width: 100%; max-width: 450px;">
        <h3 class="text-center mb-4">Cadastro de Administrador</h3>

        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-warning text-center"><?= $mensagem ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" name="usuario" required placeholder="Digite o nome de usuário">
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" name="senha" required placeholder="Digite a senha">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <a href="login.php" class="btn btn-outline-secondary">Voltar ao Login</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>

<?php
include 'conexao.php';

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Verifica se o usuário já existe
    $check = $conn->prepare("SELECT id FROM administradores WHERE usuario = ?");
    $check->bind_param("s", $usuario);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $mensagem = "❌ Usuário já existe!";
    } else {
        $stmt = $conn->prepare("INSERT INTO administradores (usuario, senha) VALUES (?, ?)");
        $stmt->bind_param("ss", $usuario, $senha);
        if ($stmt->execute()) {
            $mensagem = "✅ Administrador cadastrado com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #007bff, #00c6ff);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3 class="text-center mb-4">Cadastrar Novo Administrador</h3>
    
    <?php if (!empty($mensagem)): ?>
        <div class="alert <?= str_starts_with($mensagem, '✅') ? 'alert-success' : 'alert-danger' ?>">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        <a href="login.php" class="btn btn-link w-100 mt-2">Voltar para o Login</a>
    </form>
</div>

</body>
</html>

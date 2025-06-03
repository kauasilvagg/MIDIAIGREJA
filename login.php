<?php
session_start();
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT * FROM administradores WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $admin = $resultado->fetch_assoc();
        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['usuario'] = 'admin';
            header("Location: cadastrar_evento.php");
            exit;
        } else {
            $erro = "❌ Senha incorreta.";
        }
    } else {
        $erro = "❌ Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg,rgb(50, 101, 156),rgb(84, 136, 151));
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: #fff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 0 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }
        .btn-cadastro {
            background-color: #6c757d;
            color: white;
        }
        .btn-cadastro:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3 class="text-center mb-4">🔐 Login do Administrador</h3>

    <?php if (isset($erro)): ?>
        <div class="alert alert-danger text-center"><?= $erro ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="mb-3">
            <label for="usuario" class="form-label">Usuário</label>
            <input type="text" class="form-control" name="usuario" required>
        </div>
        <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <div class="d-grid gap-2 mb-2">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        <div class="d-grid gap-2 mb-2">
            <a href="cadastro_admin.php" class="btn btn-cadastro">Cadastrar Novo Administrador</a>
        </div>
        <div class="text-center mt-2">
            <a href="index.php" class="btn btn-link">Voltar ao site</a>
        </div>
    </form>
</div>

</body>
</html>

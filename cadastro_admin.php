<?php
include('conexao.php');

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $query = "INSERT INTO administradores (usuario, senha) VALUES ('$usuario', '$senha')";

    if (mysqli_query($conn, $query)) {
        header("Location: login_admin.php?cadastro=sucesso");
        exit();
    } else {
        $mensagem = "Erro ao cadastrar: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4>Cadastrar Novo Administrador</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($mensagem)) echo "<div class='alert alert-danger'>$mensagem</div>"; ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Cadastrar</button>
                </form>
                <div class="text-center mt-3">
                    <a href="login_admin.php" class="btn btn-secondary">← Voltar ao Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

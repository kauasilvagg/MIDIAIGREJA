<?php
session_start();
include('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['entrar'])) {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $senha = $_POST['senha'];

    $query = "SELECT * FROM administradores WHERE usuario = '$usuario'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);

        if (password_verify($senha, $admin['senha'])) {
            $_SESSION['admin'] = $usuario;
            header("Location: admin_inscricoes.php");
            exit();
        } else {
            $erro = "Usuário ou senha inválidos.";
        }
    } else {
        $erro = "Usuário ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 col-md-6">
        <div class="card shadow">
            <div class="card-header bg-dark text-white text-center">
                <h4>Login do Administrador</h4>
            </div>
            <div class="card-body">
                <?php if (isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
                <?php if (isset($_GET['cadastro']) && $_GET['cadastro'] == 'sucesso') {
                    echo "<div class='alert alert-success'>Cadastro realizado com sucesso! Faça login abaixo.</div>";
                } ?>

                
                <form method="POST">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" name="usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="entrar">Entrar</button>
                </form>

                <div class="text-center mt-3">
                    <a href="cadastro_admin.php" class="btn btn-outline-primary">Cadastrar novo administrador</a>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-secondary">← Voltar ao Início</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

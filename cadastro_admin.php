<?php include('conexao.php'); ?>



<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center text-primary">Cadastro de Administrador</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $query = "INSERT INTO administradores (usuario, senha) VALUES ('$usuario', '$senha')";
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

            $query = "SELECT * FROM administradores WHERE usuario = '$usuario'";
            if (mysqli_query($conn, $query)) {
                echo "<div class='alert alert-success'>Cadastro realizado com sucesso! <a href='login_admin.php'>Clique aqui para fazer login</a>.</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao cadastrar: " . mysqli_error($conn) . "</div>";
            }
        }
    
    ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">Usuário:</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        <a href="login_admin.php" class="btn btn-secondary w-100 mt-2">Voltar</a>
    </form>
</div>
</body>
</html>

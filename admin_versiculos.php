<?php
include 'conexao.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = mysqli_real_escape_string($conn, $_POST['texto']);
    $referencia = mysqli_real_escape_string($conn, $_POST['referencia']);
    $livro = mysqli_real_escape_string($conn, $_POST['livro']);

    if (!empty($texto) && !empty($referencia) && !empty($livro)) {
        $sql = "INSERT INTO versiculos (texto, referencia, livro) VALUES ('$texto', '$referencia', '$livro')";
        if (mysqli_query($conn, $sql)) {
            $msg = "<div class='alert alert-success'>Versículo cadastrado com sucesso!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Erro ao cadastrar: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>Preencha todos os campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Versículos - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f9f9f9;
      padding-top: 40px;
    }
    .container {
      max-width: 700px;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 12px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
  </style>
</head>
<body>
<div class="container">
  <h2 class="mb-4 text-primary">Cadastro de Versículos</h2>

  <?php echo $msg; ?>

  <form method="POST" action="">
    <div class="mb-3">
      <label class="form-label">Texto do Versículo</label>
      <textarea name="texto" class="form-control" rows="4" required></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Referência (ex: João 3:16)</label>
      <input type="text" name="referencia" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Livro</label>
      <input type="text" name="livro" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Cadastrar Versículo</button>
    <a href="versiculos.php" class="btn btn-secondary">Ver Versículos</a>
  </form>
</div>
</body>
</html>

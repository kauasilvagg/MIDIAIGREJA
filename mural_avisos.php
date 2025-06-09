<?php
include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Mural de Avisos - Igreja Shalom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #eef4f7, #d6e6f2);
      font-family: 'Segoe UI', sans-serif;
    }

    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
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
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">Igreja Shalom</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="eventos.php">Eventos</a></li>
        <li class="nav-item"><a class="nav-link" href="versiculos.php">Versículo do Dia</a></li>
        <li class="nav-item"><a class="nav-link active" href="#">Mural</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-5">
  <h2 class="text-primary mb-4 text-center">Mural de Avisos</h2>

  <div class="row">
    <?php
    $avisos = mysqli_query($conn, "SELECT * FROM mural_avisos ORDER BY id DESC");

    if (mysqli_num_rows($avisos) > 0) {
      while ($aviso = mysqli_fetch_assoc($avisos)) {
        echo '
        <div class="col-md-6 mb-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title text-info">' . htmlspecialchars($aviso['titulo']) . '</h5>
              <p class="card-text">' . nl2br(htmlspecialchars($aviso['mensagem'])) . '</p>
              <p class="text-muted"><small>Publicado em: ' . date('d/m/Y', strtotime($aviso['data_publicacao'])) . '</small></p>
            </div>
          </div>
        </div>';
      }
    } else {
      echo '<div class="alert alert-warning text-center">Nenhum aviso foi publicado ainda.</div>';
    }
    ?>
  </div>
</div>

<!-- Rodapé -->
<footer>
  © <?php echo date("Y"); ?> Igreja Assembleia de Deus Shalom - Todos os direitos reservados
</footer>

</body>
</html>

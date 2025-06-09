<?php include('conexao.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Versículos - Igreja Shalom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #f0f8ff, #e6f0ff);
      font-family: 'Segoe UI', sans-serif;
    }

    .versiculo-dia {
      background: #d1ecf1;
      padding: 20px;
      border-left: 5px solid #0c5460;
      border-radius: 10px;
      margin-bottom: 30px;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
    }

    footer {
      background-color: #f1f1f1;
      text-align: center;
      padding: 1rem;
      margin-top: 50px;
      color: #666;
    }

    nav a {
      color: white !important;
      font-weight: bold;
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
        <li class="nav-item"><a class="nav-link active" href="#">Versículos</a></li>
        <li class="nav-item"><a class="nav-link" href="mural_avisos.php">Mural</a></li>
        <li class="nav-item"><a class="nav-link" href="admin_versiculos.php">Cadastrar Versículo</a></li>

      </ul>
    </div>
  </div>
</nav>

<!-- Conteúdo -->
<div class="container mt-5">
  <h2 class="text-center text-primary mb-4">Versículos Bíblicos</h2>

  <!-- Versículo do Dia -->
  <div class="versiculo-dia">
    <h5 class="text-dark">📖 <strong>Versículo do Dia</strong></h5>
    <?php
      $versiculo_dia = mysqli_query($conn, "SELECT texto, referencia, livro FROM versiculos ORDER BY id DESC LIMIT 1");
      if ($row = mysqli_fetch_assoc($versiculo_dia)) {
        echo "<p class='mb-0'><em>\"{$row['texto']}\"</em></p>";
        echo "<p class='text-end text-secondary'><small>- {$row['livro']} {$row['referencia']}</small></p>";
      } else {
        echo "<p>Ainda não há versículo cadastrado.</p>";
      }
    ?>
  </div>

  <!-- Filtros -->
  <form method="GET" class="row g-3 mb-4">
    <div class="col-md-6">
      <input type="text" name="busca" class="form-control" placeholder="Buscar palavra-chave" value="<?= $_GET['busca'] ?? '' ?>">
    </div>
    <div class="col-md-4">
      <select name="livro" class="form-select">
        <option value="">Filtrar por Livro</option>
        <?php
        $livros = mysqli_query($conn, "SELECT DISTINCT livro FROM versiculos ORDER BY livro");
        while ($l = mysqli_fetch_assoc($livros)) {
          $selected = ($_GET['livro'] ?? '') === $l['livro'] ? 'selected' : '';
          echo "<option value='{$l['livro']}' $selected>{$l['livro']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="col-md-2">
      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
  </form>

  <!-- Lista de Versículos -->
  <div class="row">
    <?php
      $filtro = "WHERE 1=1";
      if (!empty($_GET['busca'])) {
        $busca = mysqli_real_escape_string($conn, $_GET['busca']);
        $filtro .= " AND texto LIKE '%$busca%'";
      }
      if (!empty($_GET['livro'])) {
        $livro = mysqli_real_escape_string($conn, $_GET['livro']);
        $filtro .= " AND livro = '$livro'";
      }

      $versiculos = mysqli_query($conn, "SELECT * FROM versiculos $filtro ORDER BY id DESC LIMIT 30");
      if (mysqli_num_rows($versiculos) > 0) {
        while ($v = mysqli_fetch_assoc($versiculos)) {
          echo '
          <div class="col-md-6 mb-4">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <blockquote class="blockquote mb-2">
                  <p class="mb-0">"' . htmlspecialchars($v['texto']) . '"</p>
                </blockquote>
                <footer class="blockquote-footer">' . htmlspecialchars($v['livro']) . ' ' . htmlspecialchars($v['referencia']) . '</footer>
              </div>
            </div>
          </div>';
        }
      } else {
        echo '<div class="alert alert-warning text-center">Nenhum versículo encontrado com os filtros aplicados.</div>';
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

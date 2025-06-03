<?php include 'registro_acesso.php'; ?>

<?php include('conexao.php'); include('../includes/header.php'); ?>

<div class="container mt-4">
    <h1 class="text-primary">Bem-vindo ao Portal da Igreja Shalom</h1>

    <div class="alert alert-info mt-4" role="alert">
        <strong>Versículo do Dia:</strong>
        <?php
         $versiculo = mysqli_query($conn, "SELECT texto FROM versiculos ORDER BY id DESC LIMIT 1");

            echo ($row = mysqli_fetch_assoc($versiculo)) ? $row['texto'] : "Ainda não há versículo para hoje.";
        ?>
    </div>

    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            Mural de Avisos
        </div>
        <div class="card-body">
            <?php
            $avisos = mysqli_query($conn, "SELECT * FROM mural_avisos ORDER BY data_publicacao DESC LIMIT 5");

                while ($aviso = mysqli_fetch_assoc($avisos)) {
                    echo "<p><strong>{$aviso['titulo']}:</strong> {$aviso['mensagem']}</p>";
                }
            ?>
        </div>
    </div>
</div>

<?php include('../includes/footer.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Início - Igreja Assembleia de Deus Shalom</title>
  <style>
    .card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}



  body {
  background: url('https://2.bp.blogspot.com/-6u3yysSx-G4/VCC74auXZ7I/AAAAAAAAJcI/j9eIpV4iKY4/s1600/_EDP1244edt1a.jpg') no-repeat center center fixed;
  background-size: cover;
}

  main {
  background-color: rgba(255, 255, 255, 0.95);
  border-radius: 15px;
  margin: 2rem;
  padding: 2rem;
}


.botao-eventos {
    display: inline-block;
    padding: 0.9rem 2rem;
    background: linear-gradient(135deg,rgb(42, 0, 251), #0066cc);
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(141, 174, 208, 0.3);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.botao-eventos:hover {
    background: linear-gradient(135deg, #0066cc, #004080);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
}


    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e6f0ff, #f0f8ff);
      color:rgb(0, 128, 255);
    }

    header {
      background-color:rgb(152, 197, 241);
      color: white;
      padding: 1.2rem 0;
      text-align: center;
    }

    nav {
      background-color:rgb(19, 111, 204);
      padding: 0.6rem 0;
      text-align: center;
    }

    nav a {
      color: white;
      margin: 0 1rem;
      text-decoration: none;
      font-weight: bold;
    }

    nav a:hover {
      text-decoration: underline;
    }

    main {
      text-align: center;
      padding: 4rem 2rem;
    }

    h1 {
      font-size: 2.5rem;
      margin-bottom: 1rem;
    }

    p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: auto;
      margin-bottom: 2rem;
    }

    .botao-login:hover {
      background-color: #002d5c;
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

<header>
  <h1>Igreja Assembleia de Deus Shalom</h1>
</header>

<nav>
  <a href="index.php">Início</a>
  <a href="eventos.php">Eventos</a>
  <a href="contato.php">Contato</a>
  <a href="sobre.php">Sobre</a>
  <a href="biblia.php">Bíblia</a>
</nav>

<?php include 'header.php'; ?>

<main class="bg-light py-5">
  <div class="container text-center">
    <h1 class="mb-4 text-primary">Seja bem-vindo à Assembleia de Deus Shalom</h1>
    <p class="lead text-secondary">Conheça nossos eventos, cultos e área administrativa</p>

    <div class="row mt-5 g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Eventos</h5>
            <p class="card-text">Veja todos os cultos e eventos programados para nossa igreja.</p>
            <a href="eventos.php" class="btn btn-primary">Ver Eventos</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Fale Conosco</h5>
            <p class="card-text">Envie uma mensagem ou tire suas dúvidas com a nossa equipe.</p>
            <a href="contato.php" class="btn btn-success">Entrar em Contato</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Área Administrativa</h5>
            <p class="card-text">Acesse a área restrita para gerenciar eventos e mensagens.</p>
            <a href="admin.php" class="btn btn-dark">Administrar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<footer>
  © <?php echo date("Y"); ?> Igreja Assembleia de Deus Shalom - Todos os direitos reservados
</footer>

<?php
include('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Início - Igreja Assembleia de Deus Shalom</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Igreja Shalom</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="eventos.php">Eventos</a></li>
                <li class="nav-item"><a class="nav-link" href="mural_avisos.php">Mural</a></li>
                <li class="nav-item"><a class="nav-link" href="versiculos.php">Versículo do Dia</a></li>
                <li class="nav-item"><a class="nav-link" href="inscricoes.php">Inscrições</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_versiculos.php">Cadastrar Versículo</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_inscricoes.php">Ver Inscrições</a></li>
                <li class="nav-item"><a class="nav-link" href="admin_avisos.php">Avisos</a></li>

            </ul>
        </div>
    </div>
</nav>

<!-- Conteúdo principal -->
<main class="container">
    <h1 class="text-primary">Bem-vindo ao Portal da Igreja Shalom do Parque Vitória</h1>

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
            $avisos = mysqli_query($conn, "SELECT * FROM mural_avisos ORDER BY id DESC LIMIT 5");
            while ($aviso = mysqli_fetch_assoc($avisos)) {
                echo "<p><strong>{$aviso['titulo']}:</strong> {$aviso['mensagem']}</p>";
            }
            ?>
        </div>
    </div>

    <div class="row mt-5 g-4">
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Eventos</h5>
                    <p class="card-text">Veja todos os cultos e eventos programados.</p>
                    <a href="eventos.php" class="btn btn-primary">Ver Eventos</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Fale Conosco</h5>
                    <p class="card-text">Envie uma mensagem ou tire dúvidas com a equipe.</p>
                    <a href="contato.php" class="btn btn-success">Entrar em Contato</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Área Administrativa</h5>
                    <p class="card-text">Gerencie eventos e mensagens da igreja.</p>
                    <a href="admin.php" class="btn btn-dark">Acessar Painel</a>
                </div>
            </div>
        </div>
    </div>
</main>

<footer>
    © <?php echo date("Y"); ?> Igreja Assembleia de Deus Shalom - Todos os direitos reservados
</footer>

</body>
</html>

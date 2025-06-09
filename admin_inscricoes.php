<?php
include('conexao.php'); // Isso é essencial para definir $conn
session_start();

// Aqui você pode verificar se o admin está logado (opcional)
if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Painel Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_inscricoes.php">Inscrições</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_avisos.php">Mural de Avisos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_versiculos.php">Versículos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Bem-vindo ao Painel de Administração</h2>
        <p>Escolha uma opção no menu para administrar o sistema.</p>
    </div>
</body>
</html>


<!-- CONTEÚDO -->
<div class="container mt-5">
    <h3 class="mb-4 text-center text-primary">Inscrições Pendentes de Pagamento</h3>

    <?php
    // Atualizar status da inscrição
    if (isset($_GET['confirmar_id'])) {
        $id = intval($_GET['confirmar_id']);
        $update = mysqli_query($conn, "UPDATE inscricoes SET status = 'confirmado' WHERE id = $id");

        if ($update) {
            echo "<div class='alert alert-success'>Inscrição confirmada com sucesso.</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao confirmar inscrição.</div>";
        }
    }

    // Buscar inscrições pendentes
    $result = mysqli_query($conn, "SELECT * FROM inscricoes WHERE status = 'pendente'");


    if (mysqli_num_rows($result) > 0) {
        echo "<div class='table-responsive'>";
        echo "<table class='table table-bordered table-hover'>";
        echo "<thead class='table-dark'>
                <tr>
                    <th>Nome</th>
                    <th>Evento</th>
                    <th>Email</th>
                    <th>Comprovante</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
              </thead><tbody>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['nome']) . "</td>
                    <td>" . htmlspecialchars($row['evento']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td><a class='btn btn-sm btn-outline-primary' target='_blank' href='" . $row['comprovante'] . "'>Ver Comprovante</a></td>
                    <td><span class='badge bg-warning text-dark'>Pendente</span></td>
                    <td>
                        <a href='admin_inscricoes.php?confirmar_id=" . $row['id'] . "' class='btn btn-success btn-sm'>Confirmar</a>
                    </td>
                </tr>";
        }
        echo "</tbody></table></div>";
    } else {
        echo "<div class='alert alert-info text-center'>Nenhuma inscrição pendente no momento.</div>";
    }
    ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

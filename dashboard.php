<?php
include 'conexao.php';
include 'header.php';

// Consulta de acessos por dia
$sql = "SELECT DATE(data_acesso) as dia, COUNT(*) as total FROM acessos GROUP BY dia ORDER BY dia DESC LIMIT 7";
$result = $conn->query($sql);

$datas = [];
$totais = [];

while ($row = $result->fetch_assoc()) {
    $datas[] = $row['dia'];
    $totais[] = $row['total'];
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Acessos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">📈 Dashboard de Acessos ao Site</h2>
    <a href="admin.php" class="btn btn-secondary mb-4">← Voltar ao Painel</a>

    <div class="card">
        <div class="card-body">
            <canvas id="graficoAcessos"></canvas>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('graficoAcessos').getContext('2d');
    const graficoAcessos = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_reverse($datas)) ?>,
            datasets: [{
                label: 'Acessos por dia',
                data: <?= json_encode(array_reverse($totais)) ?>,
                backgroundColor: 'rgba(0, 64, 128, 0.7)'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</body>
</html>

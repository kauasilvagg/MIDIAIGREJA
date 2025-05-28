<?php
// capitulo.php
include 'conexao.php';  // <— garante $conn

$id_livro = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 1) Buscar nome do livro
$stmtLivro = $conn->prepare("SELECT nome FROM livros WHERE id = ?");
$stmtLivro->bind_param("i", $id_livro);
$stmtLivro->execute();
$resLivro = $stmtLivro->get_result();
$livro    = $resLivro->fetch_assoc();
$stmtLivro->close();

// 2) Buscar capítulos disponíveis
$stmtCap = $conn->prepare("
    SELECT DISTINCT capitulo 
    FROM versiculos 
    WHERE livro_id = ?
    ORDER BY capitulo ASC
");
$stmtCap->bind_param("i", $id_livro);
$stmtCap->execute();
$resCap = $stmtCap->get_result();

$capitulos = [];
while ($row = $resCap->fetch_assoc()) {
    $capitulos[] = $row['capitulo'];
}
$stmtCap->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Capítulos de <?= htmlspecialchars($livro['nome'] ?? '—') ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
  <div class="container">
    <a href="biblia.php" class="btn btn-secondary mb-3">← Voltar para Livros</a>

    <h2 class="text-primary mb-4">
      📖 <?= htmlspecialchars($livro['nome'] ?? 'Livro não encontrado') ?>
    </h2>

    <?php if (!empty($capitulos)): ?>
      <div class="row g-2">
        <?php foreach ($capitulos as $cap): ?>
          <div class="col-md-2 col-4">
            <a href="versiculo.php?livro_id=<?= $id_livro ?>&capitulo=<?= $cap ?>"
               class="btn btn-outline-primary w-100 mb-2">
              Capítulo <?= $cap ?>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <div class="alert alert-warning">Nenhum capítulo encontrado para este livro.</div>
    <?php endif; ?>
  </div>
</body>
</html>

<?php
// Simulando alguns versículos de Gênesis 1
$livros = [
    'Genesis' => [
        1 => [
            "1 No princípio criou Deus os céus e a terra.",
            "2 E a terra era sem forma e vazia...",
            "3 E disse Deus: Haja luz; e houve luz."
        ],
        2 => [
            "1 Assim foram concluídos os céus e a terra...",
            "2 No sétimo dia Deus terminou a obra..."
        ]
    ]
];

$livroSelecionado = $_GET['livro'] ?? 'Genesis';
$capituloSelecionado = $_GET['capitulo'] ?? 1;
$versiculos = $livros[$livroSelecionado][$capituloSelecionado] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Leitura Bíblica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <h2 class="mb-4 text-primary">📖 Leitura da Bíblia</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-6">
            <label for="livro" class="form-label">Livro</label>
            <select name="livro" id="livro" class="form-select" onchange="this.form.submit()">
                <?php foreach ($livros as $nome => $capitulos): ?>
                    <option value="<?= $nome ?>" <?= $nome == $livroSelecionado ? 'selected' : '' ?>><?= $nome ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-6">
            <label for="capitulo" class="form-label">Capítulo</label>
            <select name="capitulo" id="capitulo" class="form-select" onchange="this.form.submit()">
                <?php for ($i = 1; $i <= count($livros[$livroSelecionado]); $i++): ?>
                    <option value="<?= $i ?>" <?= $i == $capituloSelecionado ? 'selected' : '' ?>><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title"><?= $livroSelecionado ?> <?= $capituloSelecionado ?></h4>
            <ul class="list-group list-group-flush mt-3">
                <?php foreach ($versiculos as $versiculo): ?>
                    <li class="list-group-item"><?= $versiculo ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <a href="index.php" class="btn btn-secondary mt-4">← Voltar ao Início</a>
</div>

</body>
</html>

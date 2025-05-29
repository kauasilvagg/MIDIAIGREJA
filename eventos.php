<?php include 'header.php'; ?>
<?php include 'conexao.php'; ?>

<?php
$result = $conn->query("SELECT * FROM eventos ORDER BY `data` ASC, `hora` ASC");
?>

<main>
    <nav>
  <a href="index.php">Início</a>
  <a href="eventos.php">Eventos</a>
  <a href="contato.php">Contato</a>
  <a href="sobre.php">Sobre</a>
  <a href="biblia.php">Bíblia</a>
</nav>
    <?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 1): ?>
    <div class="mensagem-sucesso">
        ✅ Evento cadastrado com sucesso!
    </div>
<?php endif; ?>

    <div class="container-principal">
        <h1>Eventos e Cultos da Igreja</h1>
        <p>Acompanhe e gerencie os próximos cultos e eventos da Assembleia de Deus Shalom.</p>

        <div class="botoes-gerais">
            <a href="cadastrar-evento.php" class="botao-cadastrar">+ Cadastrar Novo Evento</a>
        </div>

    <div class="eventos-lista">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($evento = $result->fetch_assoc()): ?>
            <div class="container-evento">
                <div class="evento">
                    <h3><?= htmlspecialchars($evento['titulo']) ?></h3>
                    <p><strong>Data:</strong> <?= date("d/m/Y", strtotime($evento['data'])) ?> às <?= substr($evento['hora'], 0, 5) ?></p>
                    <p><?= nl2br(htmlspecialchars($evento['descricao'])) ?></p>
                    <a href="processa-evento.php?excluir=<?= $evento['id'] ?>" class="botao-excluir" onclick="return confirm('Tem certeza que deseja excluir este evento?')">Excluir</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align:center; color: #666;">Nenhum evento cadastrado no momento.</p>
    <?php endif; ?>
</div>


</main>
<div class="botoes-gerais">
    <a href="index.php" class="botao-voltar">← Voltar para Início</a>
</div>


<style>
.botao-voltar {
    display: inline-block;
    background-color: #888;
    color: red;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    margin-left: 1rem;
    transition: background-color 0.3s;
    font-weight: bold;
}

.botao-voltar:hover {
    background-color: red;
}


.botao-voltar {
    display: inline-block;
    background-color: #888;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    margin-left: 1rem;
    transition: background-color 0.3s;
    font-weight: bold;
}

.botao-voltar:hover {
    background-color: #555;
}


.mensagem-sucesso {
    background-color: #d4edda;
    color: #155724;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    animation: fadeIn 0.5s ease-in;
}


main {
    background: #f5f9fc;
    padding: 3rem 1rem;
    min-height: 80vh;
}

.container-principal {
    max-width: 900px;
    margin: auto;
    background: white;
    padding: 2rem 3rem;
    border-radius: 20px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    animation: fadeIn 0.8s ease-in;
}

.container-principal h1 {
    color: #004080;
    margin-bottom: 1rem;
    text-align: center;
}

.container-principal p {
    font-size: 1.1rem;
    color: #444;
    text-align: center;
}

.botoes-gerais {
    text-align: center;
    margin-bottom: 2rem;
}

.botao-cadastrar {
    background-color: #004080;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 8px;
    transition: background-color 0.3s;
    font-weight: bold;
}

.botao-cadastrar:hover {
    background-color:rgb(0, 92, 6);
}

.eventos-lista .evento {
    background: #eaf2fb;
    border-left: 5px solid #004080;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    margin: 1rem 0;
    position: relative;
}

.evento h3 {
    color: #003366;
    margin-bottom: 0.5rem;
}

.botao-excluir {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background-color: #c62828;
    color: white;
    padding: 5px 12px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background-color 0.3s;
}

.botao-excluir:hover {
    background-color: #a71d1d;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.container-evento {
    max-width: 700px;
    margin: 0 auto 1.5rem auto;
    padding: 0 1rem;
}

@media (max-width: 768px) {
    .container-evento {
        padding: 0 0.5rem;
    }
}

</style>
<?php include 'footer.php'; ?>

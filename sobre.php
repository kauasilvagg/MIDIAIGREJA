<?php include 'header.php'; ?>
<main>
    <div class="container-principal">
        <h1>Sobre a Igreja Assembleia de Deus Shalom</h1>
        <p>A Igreja Assembleia de Deus Shalom é um lugar de comunhão, louvor, ensino da Palavra e transformação de vidas. Estamos localizados em um ambiente acolhedor e familiar, onde buscamos viver em unidade e santidade.</p>
        <p>Nossa missão é propagar o evangelho de Jesus Cristo, promover a edificação espiritual dos irmãos e ajudar nossa comunidade através de ações sociais e evangelísticas.</p>
        <p>Venha nos visitar e fazer parte dessa família de fé!</p>

        <!-- Botão de voltar -->
        <a href="index.php" class="btn-voltar">← Voltar para Início</a>
    </div>
</main>

<style>
main {
    background:rgb(58, 145, 211);
    padding: 3rem 1rem;
    min-height: 80vh;
}

.container-principal {
    max-width: 800px;
    margin: auto;
    background: white;
    padding: 2rem 3rem;
    border-radius: 20px;
    box-shadow: 0 0 15px rgba(229, 58, 58, 0.1);
    text-align: center;
    animation: fadeIn 0.8s ease-in;
}

.container-principal h1 {
    color: #004080;
    margin-bottom: 1rem;
}

.container-principal p {
    font-size: 1.1rem;
    color: #333;
}

.btn-voltar {
    display: inline-block;
    margin-top: 2rem;
    background-color: #888;
    color: white;
    padding: 0.8rem 1.5rem;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 600;
    transition: background-color 0.3s;
}

.btn-voltar:hover {
    background-color: #555;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
<?php include 'footer.php'; ?>

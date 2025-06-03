<?php include 'header.php'; ?>
<main>
    <div class="container-principal">
        <h1>Sobre a Igreja Assembleia de Deus Shalom</h1>
        <p>A Igreja Assembleia de Deus Shalom é um lugar de comunhão, louvor, ensino da Palavra e transformação de vidas. Estamos localizados em um ambiente acolhedor e familiar, onde buscamos viver em unidade e santidade.</p>
        <p>Nossa missão é propagar o evangelho de Jesus Cristo, promover a edificação espiritual dos irmãos e ajudar nossa comunidade através de ações sociais e evangelísticas.</p>
        <p>Venha nos visitar e fazer parte dessa família de fé!</p>

        <!-- Botão de voltar -->
        <a href="index.php" class="btn-voltar">← Voltar para Início</a>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d370.66912336458216!2d-44.20553500361856!3d-2.5196126855948213!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7f691772939efbd%3A0x13b3b5f4c8dda21f!2sAssembleia%20de%20Deus%20Cristo%20para%20Todos!5e0!3m2!1spt-BR!2sbr!4v1748889111217!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</main>

<style>
    .mapa-container {
    margin-top: 2rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}


main {
    background:rgb(140, 194, 236);
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

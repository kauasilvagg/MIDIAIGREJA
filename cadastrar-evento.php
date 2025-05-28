<?php include 'header.php'; ?>
<nav>
  <a href="index.php">Início</a>
  <a href="eventos.php">Eventos</a>
  <a href="contato.php">Contato</a>
  <a href="sobre.php">Sobre</a>
</nav>

<main>
    <div class="form-container">
        <h2>Cadastro de Evento</h2>
    <form action="processa-evento.php" method="POST">
    <input type="hidden" name="acao" value="inserir">
            <label for="titulo">Título do Evento:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Ex: Culto de Jovens" required>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="hora">Horário:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" placeholder="Detalhes sobre o evento..." required></textarea>

            <button type="submit">Cadastrar Evento</button>
        </form>

        <a href="eventos.php" class="voltar">← Voltar para Eventos</a>
    </div>
</main>

<style>
main {
    background: linear-gradient(rgba(245, 249, 252, 0.9), rgba(245, 249, 252, 0.9)), url('img/fundo-igreja.jpg') no-repeat center center fixed;
    background-size: cover;
    padding: 4rem 1rem;
    min-height: 100vh;
}

.form-container {
    max-width: 600px;
    background: white;
    margin: auto;
    padding: 2rem 2.5rem;
    border-radius: 20px;
    box-shadow: 0 0 20px rgba(0,0,0,0.15);
    animation: fadeIn 0.8s ease-in;
}

.form-container h2 {
    text-align: center;
    color: #004080;
    margin-bottom: 1.5rem;
}

form label {
    display: block;
    margin-top: 1rem;
    color: #333;
    font-weight: bold;
}

form input,
form textarea {
    width: 100%;
    padding: 0.8rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-top: 0.4rem;
    font-size: 1rem;
}

form button {
    width: 100%;
    padding: 0.8rem;
    background-color: #004080;
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 10px;
    margin-top: 1.5rem;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #002d5c;
}

.voltar {
    display: block;
    text-align: center;
    margin-top: 1.5rem;
    color: #004080;
    text-decoration: none;
    font-weight: bold;
}

.voltar:hover {
    text-decoration: underline;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
<?php include 'footer.php'; ?>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Variáveis para persistência de dados
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$mensagem = $_POST['mensagem'] ?? '';
$erro = '';
$sucesso = '';
?>

<?php include 'header.php'; ?>
<nav>
  <a href="index.php">Início</a>
  <a href="eventos.php">Eventos</a>
  <a href="contato.php">Contato</a>
  <a href="sobre.php">Sobre</a>
</nav>

<main class="main-contato">
    <div class="form-container-contato">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validação
                if (empty($_POST['nome']))   throw new Exception("Nome é obrigatório");
                if (empty($_POST['email'])) throw new Exception("E-mail é obrigatório");
                if (empty($_POST['mensagem'])) throw new Exception("Mensagem é obrigatória");

                // Sanitização
                $nome = htmlspecialchars($_POST['nome']);
                $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                $mensagem = htmlspecialchars($_POST['mensagem']);

                // Validação de e-mail
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Formato de e-mail inválido");
                }

                // Conexão com banco
                $conn = new mysqli("localhost", "root", "13032005", "igreja_shalom");
                if ($conn->connect_error) {
                    throw new Exception("Erro de conexão: " . $conn->connect_error);
                }

                // Inserção
                $stmt = $conn->prepare("INSERT INTO contatos (nome, email, mensagem, data_envio) VALUES (?, ?, ?, NOW())");
                $stmt->bind_param("sss", $nome, $email, $mensagem);

                if ($stmt->execute()) {
                    $sucesso = "Mensagem enviada com sucesso!";
                    // Limpa campos após sucesso
                    $nome = $email = $mensagem = '';
                } else {
                    throw new Exception("Erro ao enviar: " . $stmt->error);
                }

                $stmt->close();
                $conn->close();

            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }
        ?>
            

        <!-- Mensagens -->
        <?php if ($sucesso): ?>
            <div class="sucesso">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M20 12a8 8 0 11-16 0 8 8 0 0116 0zm-3-7a1 1 0 00-1.414 0L10 10.586 7.707 8.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7A1 1 0 0017 5z"/>
                </svg>
                <span><?= $sucesso ?></span>
            </div>
        <?php elseif ($erro): ?>
            <div class="erro">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M13 13h-2V7h2v6zm0 4h-2v-2h2v2zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                </svg>
                <span><?= $erro ?></span>
            </div>
        <?php endif; ?>

        <!-- Formulário -->
        <form method="POST" class="form-contato">
            <div class="form-group">
                <label for="nome">Nome Completo:</label>
                <input type="text" id="nome" name="nome" required 
                       value="<?= htmlspecialchars($nome) ?>"
                       placeholder="Digite seu nome">
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($email) ?>"
                       placeholder="exemplo@email.com">
            </div>

            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" required
                          placeholder="Escreva sua mensagem aqui..."><?= htmlspecialchars($mensagem) ?></textarea>
            </div>

            <button type="submit" class="btn-enviar">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
                Enviar Mensagem
            </button>
        </form>
        <a href="index.php" class="btn-voltar">
    ← Voltar para Início
    </a>

    </div>
</main>

<style>
/* Layout principal */
.main-contato {
    background: linear-gradient(to right, #e0f2f1, #f1f8e9);
    padding: 4rem 1rem;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Container do formulário */
.form-container-contato {
    background: #ffffff;
    padding: 3rem;
    border-radius: 20px;
    max-width: 720px;
    width: 100%;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    animation: fadeInUp 0.8s ease forwards;
}

/* Estilo do formulário */
.form-contato {
    display: grid;
    gap: 1.5rem;
}

.form-group label {
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 0.9rem;
    border: 1px solid #ccc;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #4caf50;
    box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
    outline: none;
}

/* Botão Enviar */
.btn-enviar {
    background: #4caf50;
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: bold;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem;
    font-size: 1.05rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
}

.btn-enviar:hover {
    background: #388e3c;
    transform: translateY(-2px);
}

.btn-enviar svg {
    width: 22px;
    height: 22px;
    fill: white;
}

/* Botão Voltar */
.btn-voltar {
    display: inline-block;
    background-color: #9e9e9e;
    color: white;
    padding: 0.8rem 1.5rem;
    text-decoration: none;
    border-radius: 10px;
    margin-top: 2rem;
    font-weight: 600;
    transition: background-color 0.3s, transform 0.2s;
    text-align: center;
}

.btn-voltar:hover {
    background-color: #616161;
    transform: scale(1.03);
}

/* Mensagens de feedback */
.sucesso, .erro {
    padding: 1.2rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 1rem;
}

.sucesso {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #81c784;
}

.erro {
    background: #ffebee;
    color: #c62828;
    border: 1px solid #ef9a9a;
}

.icon {
    width: 24px;
    height: 24px;
}

/* Animação */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsivo */
@media (max-width: 768px) {
    .form-container-contato {
        padding: 2rem;
        margin: 1rem;
    }
}


<?php include 'footer.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mensagem Enviada</title>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?church') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mensagem-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 2rem 3rem;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 550px;
            color: #003366;
            animation: fadeInUp 1s ease forwards;
            transform: translateY(20px);
            opacity: 0;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mensagem-container h2 {
            color: #004080;
            margin-bottom: 1rem;
        }

        .mensagem-container p {
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .btn-voltar {
            display: inline-block;
            margin-top: 2rem;
            padding: 10px 20px;
            background-color: #004080;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .btn-voltar:hover {
            background-color: #002d5c;
        }
    </style>
</head>
<body>
    <div class="mensagem-container">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nome = htmlspecialchars($_POST['nome']);
            $email = htmlspecialchars($_POST['email']);
            $mensagem = htmlspecialchars($_POST['mensagem']);

            echo "<h2>Mensagem Recebida!</h2>";
            echo "<p>Obrigado, <strong>$nome</strong>, por entrar em contato conosco.</p>";
            echo "<p>Recebemos sua mensagem e responderemos o mais breve possível.</p>";
        } else {
            echo "<h2>Erro ao enviar</h2>";
            echo "<p>Por favor, volte e tente novamente.</p>";
        }
        ?>
        <a href="contato.php" class="btn-voltar">Voltar para o Contato</a>
    </div>
</body>
</html>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<h2>Painel do Administrador</h2>
<p>Bem-vindo ao painel! Aqui você pode gerenciar eventos, mensagens, membros etc.</p>
<a href="logout.php">Sair</a>

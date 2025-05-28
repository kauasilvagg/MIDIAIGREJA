<?php
include 'conexao.php';

if (isset($_POST['id'])) {
    $id = (int)$_POST['id'];
    $conn->query("UPDATE mensagens SET lida = 1 WHERE id = $id");
}

header("Location: mensagens.php");
exit;

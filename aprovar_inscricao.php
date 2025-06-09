<?php
include('conexao.php');

$id = $_POST['id'];
$email = $_POST['email'];

$query = "UPDATE inscricoes SET status = 'confirmado' WHERE id = $id";
if (mysqli_query($conn, $query)) {
    mail($email, "Inscrição Confirmada", "Sua inscrição foi confirmada com sucesso. Deus abençoe!", "From: igreja@shalom.com");
    echo "Inscrição confirmada e e-mail enviado!";
} else {
    echo "Erro ao confirmar: " . mysqli_error($conn);
}
?>
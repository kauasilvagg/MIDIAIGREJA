<?php
include('conexao.php');

$nome = $_POST['nome'];
$evento = $_POST['evento'];
$arquivo = $_FILES['comprovante'];

if ($arquivo['error'] === 0) {
    $destino = 'comprovantes/' . uniqid() . '_' . basename($arquivo['name']);
    move_uploaded_file($arquivo['tmp_name'], $destino);

    $sql = "INSERT INTO inscricoes (nome, evento, comprovante, status) VALUES ('$nome', '$evento', '$destino', 'pendente')";
    if (mysqli_query($conn, $sql)) {
        echo "Inscrição enviada com sucesso!";
    } else {
        echo "Erro ao salvar: " . mysqli_error($conn);
    }
} else {
    echo "Erro no upload do arquivo.";
}
?>

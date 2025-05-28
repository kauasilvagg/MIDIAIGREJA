<?php
include 'conexao.php';

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $nomeOriginal = $_FILES['arquivo']['name'];
    $nomeSalvo = uniqid() . '-' . basename($nomeOriginal);
    $destino = 'uploads/' . $nomeSalvo;

    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $destino)) {
        $stmt = $conn->prepare("INSERT INTO calendario_pdf (nome_arquivo, caminho_arquivo) VALUES (?, ?)");
        $stmt->bind_param("ss", $nomeOriginal, $destino);
        $stmt->execute();

        header("Location: admin.php?upload=sucesso");
        exit;
    } else {
        echo "Erro ao mover o arquivo.";
    }
} else {
    echo "Erro no envio do arquivo.";
}

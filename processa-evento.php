<?php
include 'conexao.php'; // Certifique-se que este arquivo conecta corretamente ao MySQL

// CADASTRAR NOVO EVENTO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'inserir') {
    $titulo = $_POST['titulo'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $descricao = $_POST['descricao'];

    $stmt = $conn->prepare("INSERT INTO eventos (titulo, data, hora, descricao) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $titulo, $data, $hora, $descricao);

    if ($stmt->execute()) {
        header("Location: eventos.php?sucesso=1");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}

// EDITAR EVENTO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['acao']) && $_POST['acao'] === 'editar') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $descricao = $_POST['descricao'];

    $stmt = $conn->prepare("UPDATE eventos SET titulo=?, data=?, hora=?, descricao=? WHERE id=?");
    $stmt->bind_param("ssssi", $titulo, $data, $hora, $descricao, $id);

    if ($stmt->execute()) {
        header("Location: eventos.php?sucesso=2");
        exit;
    } else {
        echo "Erro ao editar: " . $conn->error;
    }
}

// EXCLUIR EVENTO
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];

    $stmt = $conn->prepare("DELETE FROM eventos WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: eventos.php?sucesso=3");
        exit;
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }
}
?>

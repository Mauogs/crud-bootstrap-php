<?php
include "../config.php";
include DBAPI;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_POST['usuario']) || empty($_POST['senha'])) {
    $_SESSION['message'] = "Por favor, preencha todos os campos.";
    $_SESSION['type'] = "danger";
    header('Location: ' . BASEURL . 'index.php');
    exit;
}

try {
    $bd = open_database();
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, usuario, senha, foto FROM usuarios WHERE usuario = :usuario LIMIT 1";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $dados = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dados && password_verify($senha, $dados['senha'])) {
        $_SESSION['message'] = "Bem-vindo " . htmlspecialchars($dados['nome']) . "!";
        $_SESSION['type'] = "info";
        $_SESSION['id'] = $dados['id'];
        $_SESSION['usuario'] = $dados['usuario'];
        $_SESSION['foto'] = $dados['foto'];
        header('Location: ' . BASEURL . 'index.php');
        exit;
    }

    throw new Exception("Usuário ou senha inválidos.");

} catch (Exception $e) {
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";
    header('Location: ' . BASEURL . 'index.php');
    exit;
}

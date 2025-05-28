<?php
include "functions.php";
if (!isset($_SESSION))
    session_start();
if (isset($_SESSION['usuario'])) {
    if ($_SESSION['usuario'] != "admin") {
        $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        header("Location: " . BASEURL . "index.php");
        exit;
    }
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $usuario = find("usuarios", $id);

        if ($usuario) {
            delete($id);

            if (!empty($usuario['foto']) && $usuario['foto'] !== "semimagem.png") {
                $caminhoArquivo = "fotos/" . $usuario["foto"];
                if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
                }
            }

            $_SESSION['message'] = "Usuário excluído com sucesso!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Usuário não encontrado.";
            $_SESSION['type'] = "danger";
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Não foi possível realizar a operação: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
} else {
    $_SESSION['message'] = "ERRO: ID não definido.";
    $_SESSION['type'] = "danger";
}

header("Location: index.php");
exit();
?>
<?php
include "functions.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario'])) {
    $_SESSION['message'] = "Você precisa estar logado para acessar esta página.";
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        $cliente = find("clientes", $id);

        if ($cliente) {
            delete($id);

            if (!empty($cliente['foto']) && $cliente['foto'] !== "semimagem.png") {
                $caminhoArquivo = "fotos/" . $cliente["foto"];
                if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
                }
            }

            $_SESSION['message'] = "Cliente excluído com sucesso!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Cliente não encontrado.";
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
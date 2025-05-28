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
        $carro = find("carros", $id);

        if ($carro) {
            delete($id);

            if (!empty($carro['foto']) && $carro['foto'] !== "semimagem.png") {
                $caminhoArquivo = "fotos/" . $carro["foto"];
                if (file_exists($caminhoArquivo)) {
                    unlink($caminhoArquivo);
                }
            }

            $_SESSION['message'] = "Carro excluído com sucesso!";
            $_SESSION['type'] = "success";
        } else {
            $_SESSION['message'] = "Carro não encontrado.";
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
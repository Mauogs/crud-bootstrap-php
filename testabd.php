<?php
include "config.php";

try {
    $db = open_database();
    echo '<h1>Banco de Dados Conectado!</h1>';
    $db = null;
} catch (Exception $e) {
    echo '<h1>ERRO: Não foi possível Conectar!</h1>';
    echo '<p>Erro: ' . $e->getMessage() . '</p>';
}
?>
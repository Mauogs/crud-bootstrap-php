<?php
function open_database()
{
    try {
        $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        return $conn;
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
        return null;
    }
}

function close_database(&$conn)
{
    $conn = null;
}

function find($table = null, $id = null)
{
    $database = open_database();
    if (!$database)
        return null;

    try {
        if ($id) {
            $stmt = $database->prepare("SELECT * FROM $table WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $stmt = $database->query("SELECT * FROM $table");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
        return null;
    } finally {
        close_database($database);
    }
}

function find_all($table)
{
    return find($table);
}

function filter($table = null, $p = null, $limit = 10, $offset = 0)
{
    if (!$p) {
        $_SESSION['message'] = "Parâmetro de busca não foi informado!";
        $_SESSION['type'] = "danger";
        return null;
    }

    $database = open_database();
    if (!$database)
        return null;

    try {
        $stmt = $database->prepare("SELECT * FROM $table WHERE $p LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
        return null;
    } finally {
        close_database($database);
    }
}
function save($table = null, $data = null)
{
    if (empty($data) || empty($table))
        return;
    $database = open_database();
    if (!$database)
        return;

    $columns = implode(",", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));
    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = $database->prepare($sql);

    try {
        $stmt->execute($data);
        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    } finally {
        close_database($database);
    }
}

function update($table = null, $id = 0, $data = null)
{
    if (empty($data) || empty($table) || $id <= 0)
        return;
    $database = open_database();
    if (!$database)
        return;

    $items = "";
    foreach ($data as $key => $value) {
        $items .= "$key=:$key,";
    }
    $items = rtrim($items, ',');
    $sql = "UPDATE $table SET $items WHERE id=:id";
    $stmt = $database->prepare($sql);
    $data['id'] = $id;

    try {
        $stmt->execute($data);
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = 'Não foi possível realizar a operação: ' . $e->getMessage();
        $_SESSION['type'] = 'danger';
    } finally {
        close_database($database);
    }
}

function remove($table = null, $id = null)
{
    if (empty($table) || $id === null)
        return;
    $database = open_database();
    if (!$database)
        return;

    try {
        $stmt = $database->prepare("DELETE FROM $table WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $_SESSION['message'] = "Registro removido com sucesso.";
        $_SESSION['type'] = 'success';
    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();
        $_SESSION['type'] = 'danger';
    } finally {
        close_database($database);
    }
}

function criptografia($senha)
{
    return password_hash($senha, PASSWORD_BCRYPT);
}

function clear_messages()
{
    unset($_SESSION['message'], $_SESSION['type']);
}

function formatadata($data, $formato)
{
    $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
    return $dt->format($formato);
}

function find_with_limit($table, $limit = 10, $offset = 0)
{
    $database = open_database();
    try {
        $stmt = $database->prepare("SELECT * FROM $table LIMIT :limit OFFSET :offset");
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        $_SESSION['message'] = "Erro ao buscar com limite: " . $e->getMessage();
        $_SESSION['type'] = "danger";
        return null;
    } finally {
        close_database($database);
    }
}

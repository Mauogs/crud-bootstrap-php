<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CRUD - Bootstrap</title>
    <meta name="description" content="CRUD - Bootstrap">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?= BASEURL ?>icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL ?>css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>css/fontawesome/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL ?>css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.1/cookieconsent.min.css" />
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="<?= BASEURL ?>">
                <i class="fa-solid fa-house-chimney me-2"></i>CRUD - Bootstrap
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-users me-1"></i>Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= BASEURL ?>clientes/add.php"><i
                                        class="fa-solid fa-user-plus me-1"></i>Novo</a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL ?>clientes"><i
                                        class="fa-solid fa-users me-1"></i>Gerenciar</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-car-side me-1"></i>Carros
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?= BASEURL ?>carros/add.php"><i
                                        class="fa-solid fa-car me-1"></i>Novo</a></li>
                            <li><a class="dropdown-item" href="<?= BASEURL ?>carros"><i
                                        class="fa-solid fa-car-side me-1"></i>Gerenciar</a></li>
                        </ul>
                    </li>

                    <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] === "admin"): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user-lock me-1"></i>Usuários
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= BASEURL ?>usuarios/add.php"><i
                                            class="fa-solid fa-user-tie me-1"></i>Novo</a></li>
                                <li><a class="dropdown-item" href="<?= BASEURL ?>usuarios"><i
                                            class="fa-solid fa-user-lock me-1"></i>Gerenciar</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex align-items-center">
                    <?php if (isset($_SESSION["usuario"])):
                        $foto = !empty($_SESSION["foto"]) ? $_SESSION["foto"] : "semimagem.jpg"; ?>
                        <div class="dropdown">
                            <a href="#" class="d-block text-decoration-none dropdown-toggle" id="userDropdown"
                                data-bs-toggle="dropdown">
                                <img src="<?= BASEURL . 'usuarios/fotos/' . $foto ?>" alt="Foto" width="40" height="40"
                                    class="rounded-circle border border-light shadow-sm">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end text-center shadow-sm"
                                aria-labelledby="userDropdown">
                                <li class="py-2">
                                    <img src="<?= BASEURL . 'usuarios/fotos/' . $foto ?>" alt="Foto" width="60"
                                        class="rounded-circle shadow-sm mb-2">
                                    <p class="mb-0 fw-semibold"><?= $_SESSION["usuario"] ?></p>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="<?= BASEURL ?>inc/logout.php"><i
                                            class="fa-solid fa-right-from-bracket me-1"></i> Sair</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="loginDropdown" role="button"
                                data-bs-toggle="dropdown">
                                <i class="fa-solid fa-user-circle fa-2x text-light"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end shadow p-4 w-100" aria-labelledby="loginDropdown"
                                style="min-width: 280px; max-width: 100%;">
                                <h5 class="text-center mb-3 text-dark">Login</h5>
                                <form action="<?= BASEURL ?>inc/valida.php" method="post">
                                    <div class="mb-3">
                                        <label for="usuario" class="form-label text-dark">
                                            <i class="fa-solid fa-user me-1"></i>Usuário
                                        </label>
                                        <input type="text" class="form-control form-control-sm bg-light border-dark"
                                            name="usuario" id="usuario" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="senha" class="form-label text-dark">
                                            <i class="fa-solid fa-lock me-1"></i>Senha
                                        </label>
                                        <input type="password" class="form-control form-control-sm bg-light border-dark"
                                            name="senha" id="senha" required>
                                    </div>
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-dark btn-sm">
                                            <i class="fa-solid fa-right-to-bracket me-1"></i> Entrar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
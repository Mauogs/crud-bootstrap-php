<?php
include "config.php";
include DBAPI;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include HEADER_TEMPLATE;

$db = open_database();
?>

<h1 class="mt-2 text-center">Dashboard</h1>

<hr>

<?php if (!empty($_SESSION['message'])): ?>
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast show border-0 text-white bg-secondary" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex w-100 justify-content-center align-items-center">
                    <div class="toast-body text-center">
                        <?php echo htmlspecialchars($_SESSION['message']); ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white ms-2 me-2" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<?php if ($db): ?>
    <div class="container">
        <div class="row gy-3 justify-content-center">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="<?php echo BASEURL; ?>clientes/add.php" class="btn btn-secondary w-100">
                    <div class="text-center">
                        <i class="fa-solid fa-user-plus fa-5x"></i>
                        <p>Novo Cliente</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="<?php echo BASEURL; ?>clientes" class="btn btn-light w-100">
                    <div class="text-center">
                        <i class="fa-solid fa-users fa-5x"></i>
                        <p>Clientes</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="row gy-3 justify-content-center mt-4">
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="<?php echo BASEURL; ?>carros/add.php" class="btn btn-secondary w-100">
                    <div class="text-center">
                        <i class="fa-solid fa-car fa-5x"></i>
                        <p>Novo Carro</p>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                <a href="<?php echo BASEURL; ?>carros" class="btn btn-light w-100">
                    <div class="text-center">
                        <i class="fa-solid fa-car-side fa-5x"></i>
                        <p>Carros</p>
                    </div>
                </a>
            </div>
        </div>

        <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario'] === "admin"): ?>
            <div class="row gy-3 justify-content-center mt-4">
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="<?php echo BASEURL; ?>usuarios/add.php" class="btn btn-secondary w-100">
                        <div class="text-center">
                            <i class="fa-solid fa-user-tie fa-5x"></i>
                            <p>Novo Usuário</p>
                        </div>
                    </a>
                </div>
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <a href="<?php echo BASEURL; ?>usuarios" class="btn btn-light w-100">
                        <div class="text-center">
                            <i class="fa-solid fa-user-lock fa-5x"></i>
                            <p>Usuários</p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="alert alert-danger text-center" role="alert">
        <p><strong>ERRO:</strong> Não foi possível conectar ao Banco de Dados!</p>
    </div>
<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>
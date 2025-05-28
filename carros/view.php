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
    view($_GET['id']);
} else {
    $_SESSION["message"] = "ERRO: ID do cliente não definido.";
    $_SESSION["type"] = "danger";
    header("Location: index.php");
    exit();
}

include HEADER_TEMPLATE;
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white text-center">
            <h2 class="mb-0">Carro <?php echo htmlspecialchars($carro['id']); ?></h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Marca:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($carro['marca']); ?></dd>
                        <dt class="col-sm-4">Modelo:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($carro['modelo']); ?></dd>
                        <dt class="col-sm-4">Ano:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($carro['ano']); ?></dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-5">Data de Cadastro:</dt>
                        <dd class="col-sm-7">
                            <?php echo htmlspecialchars(formatadata($carro['datacad'], "d/m/Y - H:i:s")); ?>
                        </dd>
                        <dt class="col-sm-5">Data de Alteração:</dt>
                        <dd class="col-sm-7">
                            <?php echo htmlspecialchars(formatadata($carro['modificacao'], "d/m/Y - H:i:s")); ?>
                        </dd>
                    </dl>
                </div>
            </div>

            <div class="text-center my-3">
                <label class="form-label">Foto:</label>
                <?php
                $foto = !empty($carro['foto']) ? $carro['foto'] : "semimagem.png";
                ?>
                <div>
                    <img src="fotos/<?php echo htmlspecialchars($foto); ?>"
                        class="img-fluid shadow p-2 bg-light rounded" alt="Foto do carro" style="max-width:300px;">
                </div>
            </div>

            <div class="text-center">
                <a href="edit.php?id=<?php echo htmlspecialchars($carro['id']); ?>" class="btn btn-secondary me-2">
                    <i class="fa fa-pencil"></i> Editar
                </a>
                <a href="index.php" class="btn btn-light">
                    <i class="fa-solid fa-rotate-left"></i> Voltar
                </a>
            </div>
        </div>
    </div>
</div>

<?php include FOOTER_TEMPLATE; ?>
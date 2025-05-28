<?php
session_start();
include "functions.php";

if (!isset($_SESSION["usuario"])) {
    $_SESSION["message"] = "Você deve estar logado para acessar esse recurso!";
    $_SESSION["type"] = "danger";
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    view($_GET['id']);
} else {
    $_SESSION["message"] = "ERRO: ID do usuário não definido.";
    $_SESSION["type"] = "danger";
    header("Location: index.php");
    exit();
}

include HEADER_TEMPLATE;
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white text-center">
            <h2 class="mb-0">Usuário <?php echo htmlspecialchars($usuario['id']); ?></h2>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Nome:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($usuario['nome']); ?></dd>
                        <dt class="col-sm-4">Login:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($usuario['usuario']); ?></dd>
                        <dt class="col-sm-4">Senha:</dt>
                        <dd class="col-sm-8"><?php echo htmlspecialchars($usuario['senha']); ?></dd>
                    </dl>
                </div>
                <div class="col-md-6 text-center">
                    <label class="form-label">Foto:</label>
                    <?php
                    $foto = !empty($usuario['foto']) ? $usuario['foto'] : "semimagem.png";
                    ?>
                    <div>
                        <img src="fotos/<?php echo htmlspecialchars($foto); ?>"
                            class="img-small img-fluid shadow p-2 bg-light rounded" alt="Foto do usuário">
                    </div>
                </div>
            </div>
            <div class="text-center">
                <a href="edit.php?id=<?php echo htmlspecialchars($usuario['id']); ?>" class="btn btn-secondary me-2">
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
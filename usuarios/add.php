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

add();
include HEADER_TEMPLATE;
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white text-center">
            <h2 class="mb-0">Novo Usuário</h2>
        </div>
        <div class="card-body">
            <form action="add.php" method="post" enctype="multipart/form-data">
                <div class="row gy-3">
                    <div class="col-lg-8 col-md-12">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="usuario[nome]" maxlength="50"
                                placeholder="Digite o nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <input type="text" class="form-control" id="usuario" name="usuario[usuario]" maxlength="50"
                                placeholder="Digite o usuário" required>
                        </div>
                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="usuario[senha]" maxlength="100"
                                placeholder="Digite a senha" required>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 text-center d-flex flex-column align-items-center">
                        <label for="imgPreview" class="form-label">Pré-visualização:</label>
                        <img class="img-fluid shadow p-2 bg-light rounded" id="imgPreview" src="fotos/semimagem.png"
                            alt="Foto do usuário" style="max-width: 300px;">
                    </div>
                </div>
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-secondary me-2">
                        <i class="fa-solid fa-sd-card"></i> Salvar
                    </button>
                    <a href="index.php" class="btn btn-light">
                        <i class="fa-solid fa-rotate-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include FOOTER_TEMPLATE; ?>

<script>
    document.getElementById('foto').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (event) {
                document.getElementById('imgPreview').src = event.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
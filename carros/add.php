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

add();
include HEADER_TEMPLATE;
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white text-center">
            <h2 class="mb-0">Novo Carro</h2>
        </div>
        <div class="card-body">
            <form action="add.php" method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="marca" name="carro[marca]" maxlength="30"
                            placeholder="Digite a marca" required>
                    </div>
                    <div class="col-md-6">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="modelo" name="carro[modelo]" maxlength="50"
                            placeholder="Digite o modelo" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="ano" class="form-label">Ano</label>
                        <input type="number" class="form-control" id="ano" name="carro[ano]" min="1900"
                            max="<?php echo date('Y'); ?>" placeholder="Digite o ano" required>
                    </div>
                    <div class="col-md-6">
                        <label for="datacad" class="form-label">Data de Cadastro</label>
                        <input type="date" class="form-control" id="datacad" name="carro[datacad]"
                            value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>
                <div class="mb-3 text-center">
                    <label for="imgPreview" class="form-label">Pré-visualização:</label>
                    <img class="img-fluid img-preview" id="imgPreview" src="fotos/semimagem.png" alt="Foto do carro">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-secondary me-2"><i class="fa-solid fa-save"></i>
                        Salvar</button>
                    <a href="index.php" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
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
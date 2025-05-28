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

edit();
include HEADER_TEMPLATE;
?>

<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white text-center">
            <h2 class="mb-0">Atualizar Cliente</h2>
        </div>
        <div class="card-body">
            <form action="edit.php?id=<?php echo htmlspecialchars($cliente['id']); ?>" method="post"
                enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-7">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="cliente[nome]"
                            value="<?php echo htmlspecialchars($cliente['nome']); ?>" maxlength="100"
                            placeholder="Digite o nome" required>
                    </div>
                    <div class="col-md-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" name="cliente[cpf]"
                            value="<?php echo htmlspecialchars($cliente['cpf']); ?>" placeholder="Digite o cpf"
                            required>
                    </div>
                    <div class="col-md-2">
                        <label for="aniversario" class="form-label">Data de Nascimento</label>
                        <input type="text" class="form-control" name="cliente[aniversario]"
                            value="<?php echo htmlspecialchars($cliente['aniversario']); ?>"
                            placeholder="Digite a data de nascimento" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control" name="cliente[cep]"
                            value="<?php echo htmlspecialchars($cliente['cep']); ?> " placeholder="Digite o CEP"
                            required>
                    </div>
                    <div class="col-md-5">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" name="cliente[endereco]"
                            value="<?php echo htmlspecialchars($cliente['endereco']); ?>" maxlength="100"
                            placeholder="Digite o endereço" required>
                    </div>
                    <div class="col-md-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" name="cliente[bairro]"
                            value="<?php echo htmlspecialchars($cliente['bairro']); ?>" maxlength="100"
                            placeholder="Digite o bairro" required>
                    </div>
                    <div class="col-md-2">
                        <label for="datacad" class="form-label">Data de Cadastro</label>
                        <input type="text" class="form-control"
                            value="<?php echo htmlspecialchars(formatadata($cliente['datacad'], "d/m/Y - H:i:s")); ?>"
                            readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-5">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" name="cliente[cidade]"
                            value="<?php echo htmlspecialchars($cliente['cidade']); ?>" maxlength="100"
                            placeholder="Digite a cidade" required>
                    </div>
                    <div class="col-md-2">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="tel" class="form-control" name="cliente[telefone]"
                            value="<?php echo htmlspecialchars($cliente['telefone']); ?>"
                            placeholder="Digite o telefone" required>
                    </div>
                    <div class="col-md-2">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="tel" class="form-control" name="cliente[celular]"
                            value="<?php echo htmlspecialchars($cliente['celular']); ?>" placeholder="Digite o celular"
                            required>
                    </div>
                    <div class="col-md-1">
                        <label for="estado" class="form-label">UF</label>
                        <input type="text" class="form-control" name="cliente[estado]"
                            value="<?php echo htmlspecialchars($cliente['estado']); ?>" minlength="2" maxlength="2"
                            placeholder="Digite o estado" required>
                    </div>
                    <div class="col-md-2">
                        <label for="ie" class="form-label">Inscrição Estadual</label>
                        <input type="text" class="form-control" name="cliente[ie]"
                            value="<?php echo htmlspecialchars($cliente['ie']); ?>"
                            placeholder="Digite a inscrição estadual" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>

                <div class="text-center mb-3">
                    <label for="imgPreview" class="form-label">Visualização:</label>
                    <?php $foto = empty($cliente['foto']) ? "semimagem.png" : $cliente['foto']; ?>
                    <div>
                        <img class="img-fluid shadow p-2 bg-light rounded" id="imgPreview"
                            src="fotos/<?php echo htmlspecialchars($foto); ?>" alt="Foto do cliente">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-secondary me-2">
                        <i class="fa-solid fa-save"></i> Salvar
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
<?php
include "functions.php";

if (isset($_GET['pdf'])) {
    if ($_GET['pdf'] == "ok") {
        pdf_carros();
    } else {
        pdf_carros($_GET['pdf']);
    }
}

index();

include HEADER_TEMPLATE;
?>

<header class="mt-2">
    <div class="row align-items-center">
        <div class="col-12 col-md-6 mb-2 mb-md-0">
            <h2>Carros</h2>
        </div>
        <div class="col-12 col-md-6 text-md-end">
            <a class="btn btn-secondary me-2 mb-2" href="add.php">
                <i class="fa fa-plus"></i> Novo Carro
            </a>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <a class="btn btn-danger me-2 mb-2" href="index.php?pdf=<?php echo $_POST['carros']; ?>">
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php else: ?>
                <a class="btn btn-danger me-2 mb-2" href="index.php?pdf=ok">
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php endif; ?>
            <a class="btn btn-light me-2 mb-2" href="index.php">
                <i class="fa fa-refresh"></i> Atualizar
            </a>
        </div>
    </div>
</header>

<hr>

<form name="filtro" action="index.php" method="post" class="mt-3">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" maxlength="100" name="carros" placeholder="Pesquisar carros..."
                    required>
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search"></i> Consultar
                </button>
            </div>
        </div>
    </div>
</form>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo htmlspecialchars($_SESSION['type']); ?> alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<div class="table-responsive">
    <table class="table table-hover mt-3 text-center">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Ano</th>
                <th>Atualizado em</th>
                <th>Foto</th>
                <th>Opções</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($carros): ?>
                <?php foreach ($carros as $carro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($carro['id']); ?></td>
                        <td><?php echo htmlspecialchars($carro['marca']); ?></td>
                        <td><?php echo htmlspecialchars($carro['modelo']); ?></td>
                        <td><?php echo htmlspecialchars($carro['ano']); ?></td>
                        <td><?php echo formatadata($carro['modificacao'], "d/m/Y - H:i:s"); ?></td>
                        <td>
                            <?php
                            $foto = !empty($carro['foto']) ? $carro['foto'] : "semimagem.png";
                            echo "<img src=\"fotos/" . htmlspecialchars($foto) . "\" class=\"img-fluid shadow p-1 bg-body rounded\" width=\"100\">";
                            ?>
                        </td>
                        <td class="actions">
                            <a href="view.php?id=<?php echo htmlspecialchars($carro['id']); ?>" class="btn btn-sm btn-dark">
                                <i class="fa fa-eye"></i> Visualizar
                            </a>
                            <a href="edit.php?id=<?php echo htmlspecialchars($carro['id']); ?>"
                                class="btn btn-sm btn-secondary">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                            <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#delete-modal-carro"
                                data-carro="<?php echo htmlspecialchars($carro['id']); ?>">
                                <i class="fa fa-trash"></i> Excluir
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhum registro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include "modal.php"; ?>

<?php
$paginaAtual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;

$totalRegistros = count(find_all("carros"));
$totalPaginas = ceil($totalRegistros / 10);
?>

<nav aria-label="Navegação de página" class="mt-4">
    <ul class="pagination justify-content-center">
        <?php if ($paginaAtual > 1): ?>
            <li class="page-item">
                <a class="page-link" href="?pagina=<?php echo $paginaAtual - 1; ?>">Anterior</a>
            </li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
            <li class="page-item <?php if ($i == $paginaAtual)
                echo 'active'; ?>">
                <a class="page-link" href="?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($paginaAtual < $totalPaginas): ?>
            <li class="page-item">
                <a class="page-link" href="?pagina=<?php echo $paginaAtual + 1; ?>">Próxima</a>
            </li>
        <?php endif; ?>
    </ul>
</nav>

<?php include FOOTER_TEMPLATE; ?>
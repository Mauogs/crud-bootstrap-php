<?php
include "../config.php";
include DBAPI;

$carro = null;
$carros = null;

function index()
{
    global $carros;

    $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 10;
    $offset = ($pagina - 1) * $porPagina;

    if (!empty($_POST['carros'])) {
        $busca = addslashes($_POST['carros']);
        $carros = filter("carros", "modelo LIKE '%$busca%'", $porPagina, $offset);
    } else {
        $carros = find_with_limit("carros", $porPagina, $offset);
    }
}

function upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo)
{
    try {
        $nomeArquivo = basename($arquivoDestino);

        if (!getimagesize($tmpNome)) {
            throw new Exception("O arquivo não é uma imagem!");
        }

        if (file_exists($arquivoDestino)) {
            throw new Exception("Desculpe, o arquivo já existe!");
        }

        if ($tamanhoArquivo > 5000000) {
            throw new Exception("Desculpe, mas o arquivo é muito grande!");
        }

        if (!in_array($tipoArquivo, ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new Exception("Desculpe, somente imagens JPG, JPEG, PNG e GIF são permitidas!");
        }

        if (!move_uploaded_file($tmpNome, $arquivoDestino)) {
            throw new Exception("Desculpe, mas o arquivo não pode ser enviado.");
        }

        $_SESSION["message"] = "O arquivo " . htmlspecialchars($nomeArquivo) . " foi armazenado.";
        $_SESSION["type"] = "success";
    } catch (Exception $e) {
        $_SESSION["message"] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION["type"] = "danger";
    }
}

function add()
{
    if (!empty($_POST['carro'])) {
        try {
            $carro = $_POST['carro'];
            $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
            $dataAtual = $hoje->format("Y-m-d H:i:s");
            $carro['datacad'] = $dataAtual;
            $carro['modificacao'] = $dataAtual;

            if (!empty($_FILES["foto"]["name"])) {
                $destino = "fotos/";
                $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                $tmpNome = $_FILES["foto"]["tmp_name"];
                $tamanhoArquivo = $_FILES["foto"]["size"];
                $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                $carro['foto'] = basename($_FILES["foto"]["name"]);
            }

            save('carros', $carro);
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

function edit()
{
    global $carro;
    $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    try {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            if (isset($_POST['carro'])) {
                $carro = $_POST['carro'];
                $carro['modificacao'] = $hoje->format("Y-m-d H:i:s");

                if (!empty($_FILES["foto"]["name"])) {
                    $destino = "fotos/";
                    $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                    $tmpNome = $_FILES["foto"]["tmp_name"];
                    $tamanhoArquivo = $_FILES["foto"]["size"];
                    $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                    $existingCarro = find('carros', $id);
                    if (!empty($existingCarro['foto']) && $existingCarro['foto'] !== 'semimagem.png') {
                        @unlink($destino . $existingCarro['foto']);
                    }

                    upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                    $carro['foto'] = basename($_FILES["foto"]["name"]);
                }

                update('carros', $id, $carro);
                header('Location: index.php');
                exit();
            } else {
                $carro = find('carros', $id);
            }
        } else {
            header('Location: index.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

function view($id = null)
{
    global $carro;
    $carro = find('carros', intval($id));
}

function delete($id = null)
{
    global $carros;

    if ($id) {
        $carro = find('carros', intval($id));

        if (!empty($carro['foto']) && $carro['foto'] !== 'semimagem.png') {
            $caminhoFoto = "fotos/" . $carro['foto'];
            if (file_exists($caminhoFoto)) {
                @unlink($caminhoFoto);
            }
        }

        $carros = remove('carros', intval($id));
    }

    header('Location: index.php');
    exit();
}

function pdf_carros($p = null)
{
    require PDF;
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Titulo("Lista de Carros");

    $larguras = [15, 40, 60, 25, 30];
    $pdf->Cabecalho(['ID', 'Marca', 'Modelo', 'Ano', 'Foto'], $larguras);

    $carros = $p ? filter("carros", "modelo LIKE '%$p%'") : find_all("carros");

    foreach ($carros as $c) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(($pdf->GetPageWidth() - array_sum($larguras)) / 2);

        $pdf->Cell($larguras[0], 30, $c['id'], 1, 0, 'C');
        $pdf->Cell($larguras[1], 30, $pdf->converteTexto($c['marca']), 1, 0, 'C');
        $pdf->Cell($larguras[2], 30, $pdf->converteTexto($c['modelo']), 1, 0, 'C');
        $pdf->Cell($larguras[3], 30, $c['ano'], 1, 0, 'C');

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Cell($larguras[4], 30, '', 1, 0, 'C');

        $foto = "fotos/" . ($c['foto'] ?? '');
        if (!is_file($foto)) {
            $foto = "fotos/semimagem.png";
        }
        $pdf->Image($foto, $x + 5, $y + 5, 20, 20);        

        $pdf->Ln();
    }

    $pdf->Output('D', 'carros.pdf');
}

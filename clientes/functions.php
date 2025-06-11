<?php
include "../config.php";
include DBAPI;

$cliente = null;
$clientes = null;

function index()
{
    global $clientes;

    $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $porPagina = 10;
    $offset = ($pagina - 1) * $porPagina;

    if (!empty($_POST['clientes'])) {
        $busca = addslashes($_POST['clientes']);
        $clientes = filter("clientes", "nome LIKE '%$busca%'", $porPagina, $offset);
    } else {
        $clientes = find_with_limit("clientes", $porPagina, $offset);
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
    if (!empty($_POST['cliente'])) {
        try {
            $cliente = $_POST['cliente'];
            $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
            $dataAtual = $hoje->format("Y-m-d H:i:s");
            $cliente['datacad'] = $dataAtual;
            $cliente['modificacao'] = $dataAtual;

            if (!empty($_FILES["foto"]["name"])) {
                $destino = "fotos/";
                $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                $tmpNome = $_FILES["foto"]["tmp_name"];
                $tamanhoArquivo = $_FILES["foto"]["size"];
                $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                $cliente['foto'] = basename($_FILES["foto"]["name"]);
            }

            save('clientes', $cliente);
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
    global $cliente;
    $hoje = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));
    try {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            if (isset($_POST['cliente'])) {
                $cliente = $_POST['cliente'];
                $cliente['modificacao'] = $hoje->format("Y-m-d H:i:s");

                if (!empty($_FILES["foto"]["name"])) {
                    $destino = "fotos/";
                    $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                    $tmpNome = $_FILES["foto"]["tmp_name"];
                    $tamanhoArquivo = $_FILES["foto"]["size"];
                    $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                    $existingCliente = find('clientes', $id);
                    if (!empty($existingCliente['foto']) && $existingCliente['foto'] !== 'semimagem.png') {
                        @unlink($destino . $existingCliente['foto']);
                    }

                    upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                    $cliente['foto'] = basename($_FILES["foto"]["name"]);
                }

                update('clientes', $id, $cliente);
                header('Location: index.php');
                exit();
            } else {
                $cliente = find('clientes', $id);
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
    global $cliente;
    $cliente = find('clientes', intval($id));
}

function delete($id = null)
{
    global $clientes;

    if ($id) {
        $cliente = find('cliente', intval($id));

        if (!empty($cliente['foto']) && $cliente['foto'] !== 'semimagem.png') {
            $caminhoFoto = "fotos/" . $cliente['foto'];

            $mesmaFotoUsadaPorOutros = filter("clientes", "foto = '{$cliente['foto']}' AND id != {$cliente['id']}");

            if (empty($mesmaFotoUsadaPorOutros) && file_exists($caminhoFoto)) {
                @unlink($caminhoFoto);
            }
        }

        $clientes = remove('clientes', intval($id));
    }

    header('Location: index.php');
    exit();
}

function pdf_clientes($p = null)
{
    require PDF;
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Titulo("Lista de Clientes");

    $larguras = [50, 35, 40, 40, 30];
    $pdf->Cabecalho(['Nome', 'CPF', 'CEP', 'Celular', 'Foto'], $larguras);

    $clientes = $p ? filter("clientes", "nome LIKE '%$p%'") : find_all("clientes");

    foreach ($clientes as $c) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(($pdf->GetPageWidth() - array_sum($larguras)) / 2);

        $pdf->Cell($larguras[0], 30, $pdf->converteTexto($c['nome']), 1, 0, 'C');
        $pdf->Cell($larguras[1], 30, $c['cpf'], 1, 0, 'C');
        $pdf->Cell($larguras[2], 30, $c['cep'], 1, 0, 'C');
        $pdf->Cell($larguras[3], 30, $c['celular'], 1, 0, 'C');

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

    $pdf->Output('D', 'clientes.pdf');
}

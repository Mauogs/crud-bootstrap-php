<?php
include "../config.php";
include DBAPI;

$usuario = null;
$usuarios = null;

function index()
{
    global $usuarios;

    $pagina = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $porPagina = 10;
    $offset = ($pagina - 1) * $porPagina;

    if (!empty($_POST['usuarios'])) {
        $busca = addslashes($_POST['usuarios']);
        $usuarios = filter("usuarios", "nome LIKE '%$busca%'", $porPagina, $offset);
    } else {
        $usuarios = find_with_limit("usuarios", $porPagina, $offset);
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
    if (!empty($_POST['usuario'])) {
        try {
            $usuario = $_POST['usuario'];

            if (!empty($_FILES["foto"]["name"])) {
                $destino = "fotos/";
                $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                $tmpNome = $_FILES["foto"]["tmp_name"];
                $tamanhoArquivo = $_FILES["foto"]["size"];
                $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                $usuario['foto'] = basename($_FILES["foto"]["name"]);
            }

            save('usuarios', $usuario);
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
    global $usuario;

    try {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            if (isset($_POST['usuario'])) {
                $dadosForm = $_POST['usuario'];
				$usuarioExistente = find('usuarios', $id);

				if (!empty($dadosForm['senha'])) {
					$usuario['senha'] = $dadosForm['senha'];
				} else {
					$usuario['senha'] = $usuarioExistente['senha'];
				}

				$usuario['nome'] = $dadosForm['nome'];
				$usuario['usuario'] = $dadosForm['usuario'];


                if (!empty($_FILES["foto"]["name"])) {
                    $destino = "fotos/";
                    $arquivoDestino = $destino . basename($_FILES["foto"]["name"]);
                    $tmpNome = $_FILES["foto"]["tmp_name"];
                    $tamanhoArquivo = $_FILES["foto"]["size"];
                    $tipoArquivo = strtolower(pathinfo($arquivoDestino, PATHINFO_EXTENSION));

                    $existingUsuario = find('usuarios', $id);
                    if (!empty($existingUsuario['foto']) && $existingUsuario['foto'] !== 'semimagem.png') {
                        @unlink($destino . $existingUsuario['foto']);
                    }

                    upload($destino, $arquivoDestino, $tipoArquivo, $tmpNome, $tamanhoArquivo);
                    $usuario['foto'] = basename($_FILES["foto"]["name"]);
                }

                update('usuarios', $id, $usuario);
                header('Location: index.php');
                exit();
            } else {
                $usuario = find('usuarios', $id);
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
    global $usuario;
    $usuario = find('usuarios', intval($id));
}

function delete($id = null)
{
    global $usuarios;

    if ($id) {
        $usuario = find('usuarios', intval($id));

        if (!empty($usuario['foto']) && $usuario['foto'] !== 'semimagem.png') {
            $caminhoFoto = "fotos/" . $usuario['foto'];
            if (file_exists($caminhoFoto)) {
                @unlink($caminhoFoto);
            }
        }

        $usuarios = remove('usuarios', intval($id));
    }

    header('Location: index.php');
    exit();
}

function pdf_usuarios($p = null)
{
    require PDF;
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->Titulo("Lista de Usuários");

    $larguras = [15, 70, 50, 50];
    $pdf->Cabecalho(['ID', 'Nome', 'Usuário', 'Foto'], $larguras);

    $usuarios = $p ? filter("usuarios", "nome LIKE '%$p%'") : find_all("usuarios");

    foreach ($usuarios as $u) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetX(($pdf->GetPageWidth() - array_sum($larguras)) / 2);

        $pdf->Cell($larguras[0], 30, $u['id'], 1, 0, 'C');
        $pdf->Cell($larguras[1], 30, $pdf->converteTexto($u['nome']), 1, 0, 'C');
        $pdf->Cell($larguras[2], 30, $pdf->converteTexto($u['usuario']), 1, 0, 'C');

        $x = $pdf->GetX();
        $y = $pdf->GetY();
        $pdf->Cell($larguras[3], 30, '', 1, 0, 'C');

        $nomeFoto = (!empty($u['foto']) && is_file("fotos/" . $u['foto'])) ? $u['foto'] : "semimagem.png";
        $foto = "fotos/" . $nomeFoto;

        $larguraImagem = 20;
        $alturaImagem = 20;
        $offsetX = $x + ($larguras[3] - $larguraImagem) / 2;
        $offsetY = $y + (30 - $alturaImagem) / 2;

        $pdf->Image($foto, $offsetX, $offsetY, $larguraImagem, $alturaImagem);


        $pdf->Ln();
    }

    $pdf->Output('D', 'usuarios.pdf');
}

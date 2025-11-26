<?php
// Inclui os arquivos necessários
include 'conecta.php';
include 'valida.php';

// Verifica se o usuário tem permissão para acessar esta página
// (adicione sua lógica de validação de permissão aqui)

// Valida parâmetro ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: lista-roupas.php");
    exit;
}

// Sanitiza e valida o ID
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
if ($id === false || $id <= 0) {
    header("Location: lista-roupas.php");
    exit;
}

// Buscar dados da roupa
$sql = "SELECT id, nome, imagem FROM roupas WHERE id = ?";
$stmt = $conexao->prepare($sql);

if (!$stmt) {
    error_log("Erro na preparação da consulta: " . $conexao->error);
    header("Location: lista-roupas.php?msg=Erro interno do sistema&tipo=error");
    exit;
}

$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$roupa = $resultado->fetch_assoc();
$stmt->close();

// Verifica se a roupa existe
if (!$roupa) {
    header("Location: lista-roupas.php?msg=Roupa não encontrada&tipo=error");
    exit;
}

// Processamento do formulário
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validações do upload
    if (!isset($_FILES['nova_imagem']) || $_FILES['nova_imagem']['error'] !== UPLOAD_ERR_OK) {
        $mensagem_erro = getUploadErrorMessage($_FILES['nova_imagem']['error'] ?? UPLOAD_ERR_NO_FILE);
        header("Location: atualiza-foto.php?id=$id&msg=" . urlencode($mensagem_erro) . "&tipo=error");
        exit;
    }

    $arquivo = $_FILES['nova_imagem'];
    
    // Validações de segurança
    if (!validarImagem($arquivo)) {
        header("Location: atualiza-foto.php?id=$id&msg=Arquivo de imagem inválido&tipo=error");
        exit;
    }

    // Processar upload
    $resultado_upload = processarUpload($arquivo, $roupa['imagem'] ?? null);
    
    if ($resultado_upload['sucesso']) {
        // Atualizar no banco de dados
        if (atualizarImagemBanco($conexao, $id, $resultado_upload['nome_arquivo'])) {
            header("Location: atualiza-foto.php?id=$id&msg=Imagem atualizada com sucesso!&tipo=success");
        } else {
            // Rollback - remove a imagem se falhar no banco
            if (file_exists($resultado_upload['caminho_completo'])) {
                unlink($resultado_upload['caminho_completo']);
            }
            header("Location: atualiza-foto.php?id=$id&msg=Erro ao atualizar no banco de dados&tipo=error");
        }
    } else {
        header("Location: atualiza-foto.php?id=$id&msg=" . urlencode($resultado_upload['erro']) . "&tipo=error");
    }
    exit;
}

/**
 * Função para obter mensagem de erro do upload
 */
function getUploadErrorMessage($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            return "Arquivo muito grande. Tamanho máximo: 2MB";
        case UPLOAD_ERR_PARTIAL:
            return "Upload parcialmente concluído";
        case UPLOAD_ERR_NO_FILE:
            return "Nenhuma imagem selecionada";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Erro de configuração do servidor";
        case UPLOAD_ERR_CANT_WRITE:
            return "Erro ao salvar arquivo";
        case UPLOAD_ERR_EXTENSION:
            return "Extensão não permitida";
        default:
            return "Erro desconhecido no upload";
    }
}

/**
 * Valida o arquivo de imagem
 */
function validarImagem($arquivo) {
    // Verifica se é uma imagem real
    $check = getimagesize($arquivo['tmp_name']);
    if ($check === false) {
        return false;
    }

    // Verifica tamanho (2MB máximo)
    if ($arquivo['size'] > 2097152) {
        return false;
    }

    // Verifica extensão
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $extensoes_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
    if (!in_array($extensao, $extensoes_permitidas)) {
        return false;
    }

    // Verifica tipo MIME
    $tipos_mime_permitidos = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    $tipo_mime = mime_content_type($arquivo['tmp_name']);
    
    if (!in_array($tipo_mime, $tipos_mime_permitidos)) {
        return false;
    }

    return true;
}

/**
 * Processa o upload da imagem
 */
function processarUpload($arquivo, $imagem_antiga = null) {
    $diretorio = "uploads/";
    
    // Cria diretório se não existir
    if (!is_dir($diretorio)) {
        if (!mkdir($diretorio, 0755, true)) {
            return ['sucesso' => false, 'erro' => 'Erro ao criar diretório'];
        }
    }

    // Verifica se diretório é gravável
    if (!is_writable($diretorio)) {
        return ['sucesso' => false, 'erro' => 'Diretório não tem permissão de escrita'];
    }

    // Gera nome único para o arquivo
    $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
    $nome_arquivo = uniqid('img_', true) . '.' . $extensao;
    $caminho_completo = $diretorio . $nome_arquivo;

    // Remove imagem antiga se existir
    if (!empty($imagem_antiga) && file_exists($diretorio . $imagem_antiga)) {
        if (!unlink($diretorio . $imagem_antiga)) {
            error_log("Erro ao remover imagem antiga: " . $diretorio . $imagem_antiga);
        }
    }

    // Move o arquivo
    if (move_uploaded_file($arquivo['tmp_name'], $caminho_completo)) {
        // Redimensiona imagem se for muito grande (opcional)
        redimensionarImagem($caminho_completo, 800, 600);
        
        return [
            'sucesso' => true,
            'nome_arquivo' => $nome_arquivo,
            'caminho_completo' => $caminho_completo
        ];
    } else {
        return ['sucesso' => false, 'erro' => 'Erro ao fazer upload da imagem'];
    }
}

/**
 * Redimensiona imagem mantendo proporção (opcional)
 */
function redimensionarImagem($caminho, $largura_max, $altura_max) {
    // Implementação básica de redimensionamento
    // Pode ser expandida com GD ou ImageMagick
    list($largura_original, $altura_original, $tipo) = getimagesize($caminho);
    
    if ($largura_original <= $largura_max && $altura_original <= $altura_max) {
        return true; // Não precisa redimensionar
    }
    
    // Cálculo para manter proporção
    $ratio = $largura_original / $altura_original;
    
    if ($largura_max / $altura_max > $ratio) {
        $largura_max = $altura_max * $ratio;
    } else {
        $altura_max = $largura_max / $ratio;
    }
    
    // Aqui você implementaria o redimensionamento real
    // usando GD: imagecopyresampled() ou similar
    // Retornando true/false baseado no sucesso
    return true;
}

/**
 * Atualiza imagem no banco de dados
 */
function atualizarImagemBanco($conexao, $id, $nome_imagem) {
    $sql = "UPDATE roupas SET imagem = ?, data_atualizacao = NOW() WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    
    if (!$stmt) {
        error_log("Erro na preparação do update: " . $conexao->error);
        return false;
    }
    
    $stmt->bind_param("si", $nome_imagem, $id);
    $resultado = $stmt->execute();
    $stmt->close();
    
    return $resultado;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Foto - Santosshop</title>
    <meta name="description" content="Atualize a foto do produto na Santosshop">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        .foto-preview {
            max-width: 300px;
            max-height: 300px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .form-cadastro {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .alert {
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .foto-atual {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        
        @media (max-width: 768px) {
            .form-actions {
                flex-direction: column;
            }
            
            .foto-preview {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?>
    
    <main class="content">
        <div class="container">
            <h1>Atualizar Foto da Roupa</h1>
            
            <!-- Mensagens de feedback -->
            <?php if(isset($_GET['msg'])): ?>
                <div class="alert <?php echo $_GET['tipo'] === 'error' ? 'error' : 'success'; ?>" role="alert">
                    <i class="fas <?php echo $_GET['tipo'] === 'error' ? 'fa-exclamation-triangle' : 'fa-check-circle'; ?>"></i>
                    <?php echo htmlspecialchars($_GET['msg']); ?>
                </div>
            <?php endif; ?>
            
            <!-- Foto atual -->
            <section class="foto-atual" aria-labelledby="foto-atual-label">
                <h2 id="foto-atual-label">Foto Atual</h2>
                <?php if (!empty($roupa['imagem']) && file_exists("uploads/" . $roupa['imagem'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($roupa['imagem']); ?>?v=<?php echo time(); ?>" 
                         alt="<?php echo htmlspecialchars($roupa['nome']); ?>" 
                         class="foto-preview">
                    <p class="nome-produto"><strong><?php echo htmlspecialchars($roupa['nome']); ?></strong></p>
                <?php else: ?>
                    <div class="sem-foto">
                        <i class="fas fa-image fa-3x" style="color: #ccc;"></i>
                        <p>Nenhuma foto cadastrada</p>
                    </div>
                <?php endif; ?>
            </section>
            
            <!-- Formulário de upload -->
            <form action="atualiza-foto.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data" class="form-cadastro">
                <div class="form-group">
                    <label for="nova_imagem" class="form-label">
                        <i class="fas fa-upload"></i> Nova Imagem
                    </label>
                    <input type="file" 
                           id="nova_imagem" 
                           name="nova_imagem" 
                           accept="image/jpeg, image/png, image/gif, image/jpg , image/webp"
                           required 
                           class="form-input"
                           aria-describedby="help-imagem">
                    <div id="help-imagem" class="form-help">
                        Formatos aceitos: JPG, PNG, GIF, JPG, WEBP
                    </div>
                    
                    <!-- Preview da nova imagem (client-side) -->
                    <div id="preview-container" style="display: none; margin-top: 15px;">
                        <h4>Pré-visualização:</h4>
                        <img id="preview-imagem" src="#" alt="Pré-visualização" style="max-width: 200px; display: none;">
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Atualizar Foto
                    </button>
                    <a href="edita-roupa.php?id=<?php echo $id; ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar para Edição
                    </a>
                    <a href="lista-roupas.php" class="btn btn-outline">
                        <i class="fas fa-list"></i> Lista de Roupas
                    </a>
                </div>
            </form>
        </div>
    </main>
    
    <?php include 'footer.php'; ?>

    <script>
        // Preview da imagem antes do upload
        document.getElementById('nova_imagem').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const previewContainer = document.getElementById('preview-container');
            const previewImagem = document.getElementById('preview-imagem');
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    previewImagem.src = e.target.result;
                    previewImagem.style.display = 'block';
                    previewContainer.style.display = 'block';
                }
                
                reader.readAsDataURL(file);
            } else {
                previewImagem.style.display = 'none';
                previewContainer.style.display = 'none';
            }
        });

        // Validação de tamanho no client-side
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('nova_imagem');
            const file = fileInput.files[0];
            
            if (file && file.size > 2 * 1024 * 1024) { // 2MB
                e.preventDefault();
                alert('O arquivo é muito grande. O tamanho máximo permitido é 2MB.');
                fileInput.value = '';
            }
        });
    </script>
</body>
</html>
<?php 
// Fecha a conexão apenas se existir
if (isset($conexao)) {
    $conexao->close(); 
}
?>
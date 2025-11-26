<?php
	session_start();
	include('conecta.php');


	$id_produto = $_REQUEST['produto'];

	// Buscar imagens já cadastradas para este produto
	$imagens = array();
	$sql_imagens = "SELECT * FROM fotos_produto WHERE id_produto = ?";
	$stmt = $conecta->prepare($sql_imagens);
	$stmt->bind_param("i", $id_produto);
	$stmt->execute();
	$result_imagens = $stmt->get_result();

	while ($row = $result_imagens->fetch_assoc()) {
		$imagens[] = $row;
	}
	$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Seleção de fotos do produto</title>
    </head>
    <style>
        .debug-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-family: monospace;
            font-size: 12px;
        }
        .table-info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .form-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #2c3e50;
        }
        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Estilos para a galeria de imagens */
        .galeria-imagens {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #eee;
        }
        
        .galeria-titulo {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #2c3e50;
            text-align: center;
        }
        
        .grid-imagens {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .card-imagem {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 0.5rem;
            text-align: center;
            transition: transform 0.2s;
        }
        
        .card-imagem:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .imagem-produto {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }
        
        .btn-excluir {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.3rem;
            margin: 0 auto;
            transition: background 0.2s;
        }
        
        .btn-excluir:hover {
            background: #c82333;
        }
        
        .sem-imagens {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 8px;
        }
    </style>
    <body>

        <?php
            
            include('menu.php');
            
            $sql_consulta_prod  =   "SELECT * FROM produto where id_produto = $id_produto";
            $consulta_produto  =   mysqli_query($conecta, $sql_consulta_prod);

            while($exibe_produto = mysqli_fetch_assoc($consulta_produto))
            {
                $nome_produto   =   $exibe_produto['nome'];
            }



        ?>
        <div class="container">
            <div class="col-sm-12">
                <h3>
                    <br>
                    <center>
                    <?php echo $nome_produto; ?>
                    </center>
                </h3>
            </div>
        
            <div class="form-container">
                <form method="post" enctype="multipart/form-data" id="form-produto" action="grava_foto.php">
                    <input name="id_produto" type="hidden" value="<?php echo $id_produto; ?>">
                    


                    <div class="row">
                        <div class="form-group">
                            <label for="imagem">Imagem do Produto</label>
                            <input type="file" id="imagem" name="imagem" class="form-control" accept="image/png, image/jpg, image/jpeg, image/gif, image/webp" required>
                            <small style="color: #666;">Formatos: JPG, PNG, GIF, JPEG, WEBP </small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">💾 Gravar foto</button>
                        <a href="lista_produto.php" class="btn btn-secondary">❌ Cancelar</a>
                    </div>
                </form>

                <!-- Seção de visualização das imagens cadastradas -->
                <div class="galeria-imagens">
                    <h3 class="galeria-titulo">🖼️ Imagens Cadastradas</h3>
                    
                    <?php if (count($imagens) > 0): ?>
                        <div class="grid-imagens">
                            <?php foreach ($imagens as $imagem): ?>
                                <div class="card-imagem">
                                    <img src="img/<?php echo $imagem['foto']; ?>" 
                                        alt="Imagem do produto" 
                                        class="imagem-produto"
                                        onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAwIiBoZWlnaHQ9IjEyMCIgdmlld0JveD0iMCAwIDIwMCAxMjAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIyMDAiIGhlaWdodD0iMTIwIiBmaWxsPSIjRjVGNUY1Ii8+CjxwYXRoIGQ9Ik04MCA1MEg2MFY3MEg4MFY1MFpNOTEgNjBIODFWNzBIMTAxVjYwWiIgZmlsbD0iI0RERCIvPgo8L3N2Zz4K'">
                                    
                                    <form method="post" action="excluir_foto.php?&produto=<?php echo $imagem['id_produto'].'&foto='.$imagem['id_foto']; ?>" style="margin-top: 0.5rem;">
                                        <input type="hidden" name="id_foto" value="<?php echo $imagem['id_foto']; ?>">
                                        <input type="hidden" name="id_produto" value="<?php echo $id_produto; ?>">
                                        <button type="submit" class="btn-excluir" onclick="return confirm('Tem certeza que deseja excluir esta imagem?')">
                                            🗑️ Excluir
                                        </button>
                                    </form>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="sem-imagens">
                            📷 Nenhuma imagem cadastrada para este produto.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </body>
</html>

<?php 
if (isset($conexao)) {
    $conexao->close(); 
}
?>
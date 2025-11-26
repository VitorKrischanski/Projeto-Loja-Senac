<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Notebook Acer V5 - Produto</title>
    <style>
        .product-gallery {
            position: relative;
        }
        .main-image-container {
            position: relative;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background: #ffffffff;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .main-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .gallery-controls {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 15px;
            pointer-events: none;
        }
        .nav-btn {
            pointer-events: all;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }
        .nav-btn:hover {
            background: white;
            transform: scale(1.1);
        }
        .thumbnail-container {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: center;
        }
        .thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border: 2px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.7;
        }
        .thumbnail:hover {
            border-color: #007bff;
            opacity: 1;
        }
        .thumbnail.active {
            border-color: #007bff;
            border-width: 3px;
            opacity: 1;
        }
    </style>
</head>
<body>
    <?php
        include('menu.php');
        include('conecta.php');

        $produto    =   $_REQUEST['produto'];

        $sql_consulta_prod  =   "SELECT * FROM produto where id_produto = $produto";
        $consulta           =   mysqli_query($conecta, $sql_consulta_prod);
        $cont               =   mysqli_num_rows($consulta);

        while($exibe = mysqli_fetch_assoc($consulta))
        {
    ?>

    <div class="container py-5">
        <div class="row justify-content-center mb-3">
            <div class="col-5 text-center">
                <div class="product-gallery">
                    <!-- Imagem Principal com Controles -->
                    <div class="main-image-container">
                        <?php
                            $sql_cons_foto  = "SELECT * FROM fotos_produto WHERE id_produto = $produto ORDER BY id_foto LIMIT 1";
                            $consulta_foto  = mysqli_query($conecta, $sql_cons_foto);
                            $quant_foto     = mysqli_num_rows($consulta_foto);

                            if($quant_foto > 0)
                            {
                                $exibe_foto = mysqli_fetch_assoc($consulta_foto);
                                echo '<img id="main-product-image" src="img/'.$exibe_foto['foto'].'" alt="'.$exibe['nome'].'" class="main-image">';
                            }
                            else 
                            {
                                echo '<img id="main-product-image" src="img/Produto-sem-foto.png" class="main-image" alt="Sem foto">';
                            }
                        ?>
                        
                        <!-- Botões de Navegação -->
                        <div class="gallery-controls">
                            <button class="nav-btn" id="prev-btn" onclick="previousImage()">
                                <i class="fas fa-chevron-left"></i>
                            </button>
                            <button class="nav-btn" id="next-btn" onclick="nextImage()">
                                <i class="fas fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Miniaturas das Fotos -->
                    <div class="thumbnail-container" id="thumbnails-container">
                        <?php
                            // Busca TODAS as fotos do produto
                            $sql_todas_fotos = "SELECT * FROM fotos_produto WHERE id_produto = $produto ORDER BY id_foto";
                            $consulta_todas_fotos = mysqli_query($conecta, $sql_todas_fotos);
                            $quant_total_fotos = mysqli_num_rows($consulta_todas_fotos);
                            
                            if($quant_total_fotos > 0)
                            {
                                $first = true;
                                $foto_index = 0;
                                while($foto = mysqli_fetch_assoc($consulta_todas_fotos))
                                {
                                    $active = $first ? 'active' : '';
                                    echo '<img src="img/'.$foto['foto'].'" 
                                          class="thumbnail '.$active.'" 
                                          alt="'.$exibe['nome'].'" 
                                          onclick="changeImage('.$foto_index.')" 
                                          data-index="'.$foto_index.'"
                                          data-foto="'.$foto['foto'].'">';
                                    $first = false;
                                    $foto_index++;
                                }
                            }
                            else 
                            {
                                echo '<p class="text-muted">Nenhuma foto disponível</p>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <h2 class="mb-3"><?php echo $exibe['nome']; ?></h2>
                <p class="mb-1"><strong>Avaliação:</strong> <span class="text-warning">★★★★☆</span> (4.7/5) - 850 avaliações</p><br>
                <font size="4" style="color: #696767ff;">
                    <s>
                        <b>Preço: </b>R$ <?php echo number_format(($exibe['valor'] * 0.16) + $exibe['valor'],2,",","."); ?>
                    </s>
                </font>
                <p class="fs-3 text-success mb-3"><strong>Preço:</strong> R$ <?php echo number_format($exibe["valor"],2,",","."); ?>
                <font size="3"><strong>à vista no pix, com 16% de desconto.</p></font>
                
                <button class="btn btn-primary btn-lg mb-4">Comprar agora</button>
                
                <?php
                    $valor       = $exibe['valor'];
                    $valor_sd    = ($valor * 0.16)+$valor;
                    $parcelado   = $valor_sd/12;
                ?>
                
                <h5>
                    <strong>ou até 12x de</strong><strong class="text-success"> R$ <?php echo number_format($parcelado,2,",","."); ?> sem juros</strong>
                    
                    &nbsp;&nbsp;
                    <img src="https://www.melhoresdestinos.com.br/wp-content/uploads/2020/02/bandeiras-3.png" class="img-fluid" width="200px">
                </h5>
                <br>
                <br>

                <div class="mb-3">
                    <label for="cep" class="form-label"></label>
                    <font size="4">Calcule o frete</font>
                    <div class="input-group">
                        
                        <input type="text" id="cep" class="form-control" maxlength="9" onkeypress="formatar('#####-###', this)" oninput="this.value = this.value.replace(/[^0-9.\-]/g, '');" name="cep" placeholder="Digite seu CEP">
                        <button class="btn btn-outline-primary" onclick="calcularFrete()">Calcular Frete</button>
                    </div>
                    <div id="resultado-frete" class="mt-2"></div>
                </div>
                <br>
                <br>
                <h3>Descrição</h3>
                <?php
                    echo $exibe['descricao'];
                ?>
            </div>
        </div>
    </div>

    <?php
        }
    ?>

    <script>
        // Array para armazenar todas as fotos
        let productImages = [];
        let currentImageIndex = 0;
        
        // Inicializa o array de imagens quando a página carrega
        document.addEventListener('DOMContentLoaded', function() {
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                productImages.push({
                    src: thumb.getAttribute('data-foto'),
                    index: parseInt(thumb.getAttribute('data-index'))
                });
            });
            
            // Se não há fotos, desabilita os botões
            if (productImages.length <= 1) {
                document.getElementById('prev-btn').style.display = 'none';
                document.getElementById('next-btn').style.display = 'none';
            }
        });
        
        function changeImage(index) {
            if (index >= 0 && index < productImages.length) {
                currentImageIndex = index;
                updateMainImage();
                updateActiveThumbnail();
            }
        }
        
        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % productImages.length;
            updateMainImage();
            updateActiveThumbnail();
        }
        
        function previousImage() {
            currentImageIndex = (currentImageIndex - 1 + productImages.length) % productImages.length;
            updateMainImage();
            updateActiveThumbnail();
        }
        
        function updateMainImage() {
            const mainImage = document.getElementById('main-product-image');
            mainImage.src = 'img/' + productImages[currentImageIndex].src;
            
            // Efeito de transição
            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.style.opacity = '1';
            }, 150);
        }
        
        function updateActiveThumbnail() {
            // Remove a classe 'active' de todas as miniaturas
            const thumbnails = document.querySelectorAll('.thumbnail');
            thumbnails.forEach(thumb => {
                thumb.classList.remove('active');
            });
            
            // Adiciona a classe 'active' na miniatura atual
            const activeThumb = document.querySelector(`.thumbnail[data-index="${currentImageIndex}"]`);
            if (activeThumb) {
                activeThumb.classList.add('active');
            }
        }
        
        // Navegação por teclado
        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') {
                previousImage();
            } else if (event.key === 'ArrowRight') {
                nextImage();
            }
        });

        function calcularFrete() {
            var cep = document.getElementById('cep').value.replace(/\D/g, '');
            var resultado = document.getElementById('resultado-frete');
            var regex = /^\d{8}$/;
            if (regex.test(cep)) {
                var valor = '';
                var inicio = cep.charAt(0);
                if (['0','1','2'].includes(inicio)) {
                    valor = 'R$ 30,00';
                } else if (['3','4','5'].includes(inicio)) {
                    valor = 'R$ 45,00';
                } else if (['6','7','8','9'].includes(inicio)) {
                    valor = 'R$ 60,00';
                } else {
                    valor = 'R$ 50,00';
                }
                resultado.innerHTML = 'Frete no valor de ' + valor;
            } else {
                resultado.innerHTML = 'Digite um CEP válido!';
            }
        }

        function formatar(mascara, documento) {
            var i = documento.value.length;
            var saida = mascara.substring(0,1);
            var texto = mascara.substring(i);
            
            if (texto.substring(0,1) != saida) {
                documento.value += texto.substring(0,1);
            }
        }
    </script>
</body>
</html>
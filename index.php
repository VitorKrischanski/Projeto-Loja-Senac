<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Lista de produtos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			/* Estilos melhorados */
			.product-card {
				transition: all 0.3s ease;
				border: none;
				box-shadow: 0 2px 8px rgba(0,0,0,0.1);
				border-radius: 12px;
				overflow: hidden;
			}
			
			.product-card:hover {
				transform: translateY(-5px);
				box-shadow: 0 8px 25px rgba(0,0,0,0.15);
			}
			
			.badge-container {
				position: relative;
				width: 100%;
				height: 250px;
				display: flex;
				justify-content: center;
				align-items: center;
				overflow: hidden;
				background: #f8f9fa;
			}
			
			.category-badge {
				position: absolute;
				top: 12px;
				left: 12px;
				z-index: 10;
				background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
				color: white;
				padding: 6px 12px;
				border-radius: 20px;
				font-size: 11px;
				font-weight: 600;
				letter-spacing: 0.5px;
				box-shadow: 0 2px 8px rgba(0,0,0,0.2);
			}
			
			.card-img {
				width: 100%;
				height: 100%;
				object-fit: cover;
				transition: transform 0.3s ease;
			}
			
			.product-card:hover .card-img {
				transform: scale(1.05);
			}
			
			.card-title {
				font-size: 1.1rem;
				font-weight: 600;
				color: #2c3e50;
				line-height: 1.4;
				display: -webkit-box;
				-webkit-line-clamp: 2;
				-webkit-box-orient: vertical;
				overflow: hidden;
				height: 3em;
			}
			
			.price {
				font-size: 1.3rem;
				font-weight: 700;
				color: #e74c3c;
				margin: 8px 0;
			}
			
			.btn-consult {
				background: linear-gradient(135deg, #3498db, #2980b9);
				border: none;
				border-radius: 8px;
				padding: 10px 20px;
				font-weight: 600;
				transition: all 0.3s ease;
				color: white;
				text-decoration: none;
				display: block;
				text-align: center;
			}
			
			.btn-consult:hover {
				transform: translateY(-2px);
				box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
				color: white;
			}
			
			.search-box {
				border-radius: 25px;
				padding: 8px 20px;
				border: 2px solid #e9ecef;
				transition: all 0.3s ease;
			}
			
			.search-box:focus {
				border-color: #3498db;
				box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
			}
			
			.search-btn {
				border-radius: 0 25px 25px 0;
				border: 2px solid #3498db;
				background: #3498db;
				color: white;
				padding: 8px 20px;
				transition: all 0.3s ease;
			}
			
			.search-btn:hover {
				background: #2980b9;
				border-color: #2980b9;
			}
			
			.page-title {
				color: #2c3e50;
				font-weight: 700;
				font-size: 2rem;
			}
			
			.results-count {
				background: #f8f9fa;
				padding: 15px;
				border-radius: 10px;
				border-left: 4px solid #3498db;
			}
			
			/* Responsividade melhorada */
			@media (max-width: 768px) {
				.product-card {
					margin-bottom: 20px;
				}
				
				.badge-container {
					height: 200px;
				}
			}
		</style>
	</head>
	<body>
		<?php
			//Incluindo o arquivo menu
			include('menu.php');

			//Fazendo a conexão com o banco de dados
			include('conecta.php');
			
			//Recebe valores na variável pesquisa
			if(isset($_REQUEST['pesquisa']) && !empty($_REQUEST['pesquisa']))
			{
				$pesquisa		=		$_REQUEST['pesquisa'];
			} else {
				$pesquisa = "";
			}
			
			//Verifica se existe algum termo no campo pesquisa
			if($pesquisa == "")
			{
				$sql_pesquisa	=	"SELECT * FROM produto ORDER BY nome";
				$consulta		=	mysqli_query($conecta, $sql_pesquisa);
				$contador		=	mysqli_num_rows($consulta);
			}
			else
			{
				$sql_pesquisa	=	"SELECT * FROM produto WHERE nome LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%' OR cod_barras LIKE '%$pesquisa%' ORDER BY nome";
				$consulta		=	mysqli_query($conecta, $sql_pesquisa);
				$contador		=	mysqli_num_rows($consulta);
			}

			//Mensagem para apresentação de resultados
			if($contador == 1 && $pesquisa == "")
			{
				$msg	=	"Foi encontrado <b>$contador</b> resultado para a pesquisa!";
			}
			else if($contador > 1 && $pesquisa == "")
			{
				$msg	=	"Foi encontrado <b>$contador</b> resultados para a pesquisa!";
			}
			else if($contador == 1 && $pesquisa != "")
			{
				$msg	=	"Foi encontrado <b>$contador</b> resultado com o termo <b>'$pesquisa'</b>.&nbsp;&nbsp;
				<a href='/senac/projeto/'>
					<button class='btn btn-danger'>
						<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
						<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z'/>
						</svg>&nbsp;
						Limpar
					</button>
				</a>
				";
			}
			else
			{
				$msg	=	"Foi encontrado <b>$contador</b> resultados com o termo <b>'$pesquisa'</b>.&nbsp;&nbsp;
				<a href='/senac/projeto/'>
					<button class='btn btn-danger'>
						<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>
						<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z'/>
						</svg>&nbsp;
						Limpar
					</button>
				</a>
				";
			}
		?>
		<br><br>
		<div class="container"> 
			
			<div class="row align-items-center mb-4">
				<div class="col-lg-6">
					<h1 class="page-title">
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-grid-3x3-gap" viewBox="0 0 16 16" style="color: #3498db;">
							<path d="M4 2v2H2V2h2zm1 12v-2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm5 10v-2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zm0-5V2a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1zM9 2v2H7V2h2zm5 0v2h-2V2h2z"/>
						</svg>&nbsp;
						Catálogo de Produtos
					</h1>
				</div>
				<div class="col-lg-6">
					<form method="get" class="formPesquisa" action="">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1 me-2">
								<input class="form-control search-box" type="search" name="pesquisa" placeholder="Buscar produtos..." aria-label="Search" value="<?php echo isset($pesquisa) ? $pesquisa : ''; ?>">
								<small class="form-text text-muted ms-2">
									Digite nome, descrição ou código do produto
								</small>
							</div>
							<button class="btn search-btn" type="submit">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
									<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
								</svg>
								Buscar
							</button>
						</div>
					</form>
				</div>
			</div>
			
			<div class="row mb-4">
				<div class="col-12">
					<div class="results-count">
						<?php echo $msg; ?>
					</div>
				</div>
			</div>
			
			<?php
				if($contador == 0)
				{
					echo '
					<div class="text-center py-5">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#f39c12" class="bi bi-search" viewBox="0 0 16 16">
							<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
						</svg>
						<h3 class="mt-3" style="color: #f39c12;">Nenhum produto encontrado</h3>
						<p class="text-muted">Tente ajustar os termos da sua pesquisa ou explore nossa categorias.</p>
					</div>
					';
				}
				else
				{
					$quant = 0;
                    echo '<div class="row g-4">';

					while($exibe = mysqli_fetch_assoc($consulta))
					{  
						$id_produto = $exibe['id_produto']; 
						
						echo '
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
							<div class="card product-card h-90">';

								$sql_cons_foto = "SELECT * FROM fotos_produto WHERE id_produto = $id_produto ORDER BY id_foto LIMIT 1";
								$consulta_foto = mysqli_query($conecta, $sql_cons_foto);
								$quant_foto = mysqli_num_rows($consulta_foto);

								echo '<div class="badge-container">';
								echo '<div class="category-badge">'.$exibe['categoria'].'</div>';

								if ($quant_foto > 0) {
									$exibe_foto = mysqli_fetch_assoc($consulta_foto);
									echo '<img src="img/'.$exibe_foto['foto'].'" alt="Foto do produto" class="card-img">';
								} else {
									echo '<img src="img/Produto-sem-foto.png" alt="Sem foto" class="card-img">';
								}
								echo '</div>';
					
								echo '
								<div class="card-body d-flex flex-column">
									<div class="flex-grow-1">
										<h5 class="card-title">'.$exibe['nome'].'</h5>
										<div class="price">R$ '.number_format($exibe["valor"],2,",",".").'</div>
									</div>
									<div class="mt-auto">
										<a href="produto.php?produto='.$id_produto.'" class="btn btn-consult w-100">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
												<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
												<path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
											</svg>
											Ver Detalhes
										</a>
									</div>
								</div>
							</div>
						</div>';
                        
                       $quant++;
                       if($quant % 4 == 0 && $quant < $contador)
                       {
                           echo '</div><br><div class="row g-4">';
                       }
					}
                    echo '</div>';
				}
			?>
		</div>
	</body>
</html>
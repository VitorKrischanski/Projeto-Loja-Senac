<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Lista de produtos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			.badge-container {
				position: relative;
				width: 100%;
				height: 470px;
				display: flex;
				justify-content: center;
				align-items: center;
				overflow: hidden;
			}
			
			.category-badge {
				position: absolute;
				top: 10px;
				left: 10px;
				z-index: 10;
				background-color: rgba(0, 0, 0, 0.7);
				color: white;
				padding: 5px 10px;
				border-radius: 4px;
				font-size: 12px;
				font-weight: bold;
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
			
			<div class="row">
				<div class="col-sm-6">
					<h4>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
							<path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
							<path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
						</svg>&nbsp;
						Lista de produtos
					</h4>
				</div>
				<div class="col-sm-6">
					<form method="get" class="formPesquisa" action="">
						<div class="col-md-auto">
							<div class="input-group">
								<input class="form-control" type="search" name="pesquisa" placeholder="Pesquisa" aria-label="Search" style="border-right: none;">
								<div class="input-group-append">
									<i class="fas fa-search"></i>
								</div>
								<input class="btn btn-secondary" type="submit" value="Pesquisa">
							</div>
							<small class="form-text text-muted">
								Informe nome do produto ou descrição.
							</small>
						</div>
					</form>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<!-- Espaço para filtros na pesquisa ou categorias -->
				</div>
				<div class="col-md-8 text-end">
					<?php echo $msg; ?>
				</div>
			</div>
			<hr>
			<?php
				if($contador == 0)
				{
					echo '
					<br><br>
					<div class="alert alert-warning alert-dismissible fade show" role="alert">
						<strong>Atenção!</strong> Nenhum resultado encontrado.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					';
				}
				else
				{
					$quant = 0;
                    echo '<div class="row">';

					while($exibe = mysqli_fetch_assoc($consulta))
					{  
						$id_produto = $exibe['id_produto']; 
						
						echo '
                        <div class="col-sm-3">
							<div class="card" style="width: 19rem; height: 30rem;">';

						
								$sql_cons_foto = "SELECT * FROM fotos_produto WHERE id_produto = $id_produto ORDER BY id_foto LIMIT 1";
								$consulta_foto = mysqli_query($conecta, $sql_cons_foto);
								$quant_foto = mysqli_num_rows($consulta_foto);

								// Container fixo para a imagem com badge
								echo '<div class="badge-container">';
								
								// Badge da categoria no canto superior esquerdo
								echo '<div class="category-badge">'.$exibe['categoria'].'</div>';

								// Imagem com 100% da largura e altura do container fixo
								if ($quant_foto > 0) {
									$exibe_foto = mysqli_fetch_assoc($consulta_foto);
									echo '<img src="img/'.$exibe_foto['foto'].'" alt="Foto do produto" style="width: 200px; height: 200px; object-fit: cover; object-position: center;">';
								} else {
									echo '<img src="img/Produto-sem-foto.png" alt="Sem foto" style="width: 100%; height: 100%; object-fit: cover; object-position: center;">';
								}
								echo '</div>'; // fecha container imagem
					
								echo '
								<hr>
								<div class="card-body" style="display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
									<div>
										<h5 class="card-title">'.$exibe['nome'].'</h5>
										<p class="card-text">R$ '.number_format($exibe["valor"],2,",",".").'</p>
									</div>
									<a href="produto.php?produto='.$id_produto.'" class="btn btn-primary" style="align-self: flex-end;">Consultar</a>
								</div>
							</div>
						</div>';
                        
                       $quant++;     //Incrementa a variável quant

                       if($quant % 4 == 0)
                       {
                           echo '
                           </div>
						   <br>
                           <div class="row">
                           ';
                       }
					}
				}
			?>
		</div>
	</body>
</html>
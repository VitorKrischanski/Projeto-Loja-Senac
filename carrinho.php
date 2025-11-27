<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Carrinho de Produtos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
	</head>
	<body>
		<?php
			//Incluindo o menu
			include('menu.php');

			//Fazendo a conexão com o banco de dados
			include('conecta.php');			
		?>
		<br>
		<div class="container"> 
			<div class="row">
				<div class="col-sm-12">
					<h4>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
							<path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
							<path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
						</svg>&nbsp;
						Carrinho de Produtos
					</h4>
				</div>
			</div>
			<hr>

			<?php
                session_start();
                $id_cliente = $_SESSION['id_cliente'];                
                $sql_carrinho = "SELECT * FROM carrinho WHERE id_cliente = $id_cliente AND status_compra = 0";
                $consulta_carrinho = mysqli_query($conecta, $sql_carrinho);
                $contador = mysqli_num_rows($consulta_carrinho);

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
					echo '
					<div class="row text-center">
						<div class="col-sm-1" style="background-color: #00346cff; color: white; text-align: left;">
							<b></b>
						</div>
						<div class="col-sm-1" style="background-color: #00346cff; color: white; text-align: left;">
							<b>imagem</b>
						</div>
						<div class="col-sm-6" style="background-color: #00346cff; color: white; text-align: left;">
							<b>Produto</b>
						</div>
						<div class="col-sm-1" style="background-color: #00346cff; color: white; text-align: left;">
							<b>Valor</b>
						</div>
						<div class="col-sm-1" style="background-color: #00346cff; color: white; text-align: left;">
							<b>Quantidade</b>
						</div>
						<div class="col-sm-2" style="background-color: #00346cff; color: white; text-align: center;">
							<b>Subtotal</b>
						</div>
					</div>
					<br>
					';

					//Variavel para calcular o total dos produtos
					$total = 0.0;
					
					while($exibe = mysqli_fetch_assoc($consulta_carrinho))
					{
						$id_produto = $exibe['id_produto'];
						$sql_foto 	= "SELECT * FROM fotos_produto WHERE id_produto = $id_produto limit 1";
						$cons_foto  = mysqli_query($conecta, $sql_foto);

						while($exibe_foto_prod = mysqli_fetch_assoc($cons_foto))
						{
							$foto_produto = $exibe_foto_prod['foto'];
						}

						$sql_produto 	= "SELECT * FROM produto WHERE id_produto = $id_produto";
						$consulta_prod  = mysqli_query($conecta, $sql_produto);

						while($exibe_desc = mysqli_fetch_assoc($consulta_prod))
						{
							$nome_produto = $exibe_desc['nome'];
						}

						echo '
						<div class="row">
							<div class="col-sm-1">
							<left>			
								<a href="excluir_item_carrinho.php?produto='.$id_produto.'&cliente='.$id_cliente.'&carrinho='.$exibe['id_carrinho'].'" title="Excluir Item do Carrinho"">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
										<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
										<path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
									</svg>
								</a>
							</left>
							</div>

							<div class="col-sm-1">
								<left><img src="img/'.$foto_produto.'" class="img-thumbnail img-fluid" width="50px" height="50px"></left>
							</div>

							<div class="col-sm-6">
								'.$nome_produto.'
							</div>

							<div class="col-sm-1">
								R$ '.number_format($exibe['valor'], 2, ',', '.') .'
							</div>

							<div class="col-sm-1">
								'.$exibe['quant'].'
							</div>

							<div class="col-sm-2 text-center">
								R$ '. number_format($exibe['valor'] * $exibe['quant'], 2, ',', '.') .'
							</div>

						</div>
						';

						$total = $total + ($exibe['valor'] * $exibe['quant']);
					}
					echo '
					<hr>
					<div class="row">
						<div class="col-sm-12 text-center">
							<h3>Total: R$ '.number_format($total, 2, ",", ".").'</h3>
						</div>
					</div>
					';
				}
			?>
		</div>
	</body>
</html>
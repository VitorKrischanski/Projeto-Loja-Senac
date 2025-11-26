<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Lista de cliente</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
	</head>
	<body>

		<?php
			//Verifica o nivel de acesso da sessão
			include('verifica_sessao.php')
		?>

		<?php
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
				$sql_pesquisa	=	"SELECT * FROM cliente ORDER BY nome";
				$consulta		=	mysqli_query($conecta, $sql_pesquisa);
				$contador		=	mysqli_num_rows($consulta);
			}
			else
			{
				$sql_pesquisa	=	"SELECT * FROM cliente WHERE nome LIKE '%$pesquisa%' ORDER BY nome";
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
				<a href='lista_clientes.php'>
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
				<a href='lista_clientes.php'>
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
		<br>
		<div class="container"> 
			<div class="row">
				<div class="col-sm-6">
					<h4>
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
							<path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
							<path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z"/>
						</svg>&nbsp;
						Lista de clientes
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
								Informe nome, e-mail ou cpf para localizar.
							</small>
						</div>
					</form>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-4">
					<a href="cadastro_cliente.php">
						<button class="btn btn-primary">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
								<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
								<path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
							</svg>&nbsp;
							Novo cliente
						</button>
					</a>
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
					echo '
					<div class="row text-center">
						<div class="col-sm-6" style="background-color: #00346cff; color: white;">
							<b>Nome</b>
						</div>
						<div class="col-sm-2" style="background-color: #00346cff; color: white;">
							<b>CPF</b>
						</div>
						<div class="col-sm-3" style="background-color: #00346cff; color: white;">
							<b>Telefone</b>
						</div>
						<div class="col-sm-1" style="background-color: #00346cff; color: white;">
							<b>Editar</b>
						</div>
					</div>';
					
					while($exibe = mysqli_fetch_assoc($consulta))
					{
						echo '
						<div class="row">
							<div class="col-sm-6">
								<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal'.$exibe['id_cliente'].'">
									'.$exibe['nome'].'
								</a>
							</div>
							<div class="col-sm-2">
								'.$exibe['cpf'].'
							</div>
							<div class="col-sm-3">
								'.$exibe['telefone1'].'
							</div>
							<div class="col-sm-1">
								<a href="edita_cliente.php?cliente='.$exibe['id_cliente'].'" title="Edita cliente '.$exibe['nome'].'">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
										<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
										<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
									</svg>
								</a>
							</div>
						</div>';
						
						
						
						// ****** MODAL PARA APRESENTAÇÃO DOS DADOS DO CLIENTE ******
						echo '
						<div class="modal fade" id="exampleModal'.$exibe['id_cliente'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h1 class="modal-title fs-5" id="exampleModalLabel">'.$exibe['nome'].'</h1>
										<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
												<path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z"/>
												<path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
												</svg>&nbsp;
												<b><font size="2">CPF</font></b>
											</div>
											<div class="col-9">
												'.$exibe['cpf'].'
											</div>
										</div>
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
												<path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
												<path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
												</svg>&nbsp;
												<b><font size="2">Nascimento</font></b>
											</div>
											<div class="col-9">
												'.date('d/m/Y',strtotime($exibe['data_nasc'])).'
											</div>
										</div>
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
												<path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
												<path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
												</svg>&nbsp;
												<b><font size="2">Endereço</font></b>
											</div>
											<div class="col-9">
												'.$exibe['endereco'].', '.$exibe['numero'].' - '.$exibe['complemento'].'
											</div>
										</div>
										<div class="row">
											<div class="col-3">
												<b></b>
											</div>
											<div class="col-9">
												'.$exibe['bairro'].' - '.$exibe['cidade'].'/'.$exibe['uf'].' - '.$exibe['cep'].'
											</div>
										</div>
										<hr>
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
												<path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
												</svg>&nbsp;
												<b><font size="2">Telefone(s)</font></b>
											</div>
											<div class="col-9">
												'.$exibe['telefone1'].' - '.$exibe['telefone2'].'
											</div>
										</div>
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
												<path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
												<path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
												</svg>&nbsp;
												<b><font size="2">E-mail</font></b>
											</div>
											<div class="col-9">
												'.$exibe['email'].'
											</div>
										</div>
										<br>
										<hr>
										<div class="row">
											<div class="col-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-database-add" viewBox="0 0 16 16">
												<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0"/>
												<path d="M12.096 6.223A5 5 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.5 4.5 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.5 4.5 0 0 1-.813-.927Q8.378 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.6 4.6 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10q.393 0 .774-.024a4.5 4.5 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777M3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4"/>
												</svg>&nbsp;
												<b><font size="2">Cadastro</font></b>
											</div>
											<div class="col-9">
												'.date('d/m/Y - H:i:s',strtotime($exibe['data_cadastro'])).'
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
									</div>
								</div>
							</div>
						</div>';
					}
				}
			?>
		</div>
	</body>
</html>
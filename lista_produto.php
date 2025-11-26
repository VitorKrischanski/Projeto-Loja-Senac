<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produtos</title>
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
	  include("conecta.php");
	  
	 //Recebe valores na variável $pesquisa
	 if(isset($_REQUEST['pesquisa']) && !empty($_REQUEST['pesquisa']))
	 {
		$pesquisa       =        $_REQUEST['pesquisa'];
		 
	 }
	//VERIFICA SE existe algun termo no campo pesquisa
	 if($pesquisa == "") 
	 {
		$sql_pesquisa        = "SELECT * FROM produto ORDER BY nome";
		$consulta            = mysqli_query($conecta, $sql_pesquisa);
		$contador            = mysqli_num_rows($consulta);
	  } 
	  else 
	   {
		$sql_pesquisa        = "SELECT * FROM produto WHERE nome LIKE '%$pesquisa%' OR marca LIKE '%$pesquisa%' OR decricao LIKE '%$pesquisa%' ORDER BY nome";
		$consulta            = mysqli_query($conecta, $sql_pesquisa);
		$contador            = mysqli_num_rows($consulta);
			
	   }
 
	   //mensagem par a apresentação de resultados
	   if($contador == 1 && $pesquisa == "")
	   {
			$msg = "Foi encontrado <b> $contador </b> resultado para a pesquisa! ";
	   }
		else if($contador > 1 && $pesquisa == "")
		{
			$msg = "Foram encontrados <b> $contador </b> resultados para a pesquisa!";
		}
		else if($contador == 1 && $pesquisa != "")
		{
			$msg = "Foram encontrados <b> $contador </b> registros com o termo <b>'$pesquisa'</b>.
			<a href='lista_produto.php'>
				<button class='btn btn-danger'> 
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
						<path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z'/>
					</svg>
					Limpar 
				</button>
			</a>
			";
		}
	   else
	   {
			$msg = "Foram encontrados <b> $contador </b> registros com o termo <b>'$pesquisa'</b>.
			<a href='lista_protudo.php'>
				<button class='btn btn-danger'> 
					<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-lg' viewBox='0 0 16 16'>
						<path d='M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z'/>
					</svg>
					Limpar 
				</button>
			</a>
			";
	   }

	?>

<br>
	<div class="container"> 
		<div class="row">
			<div class="col-sm-4">
			   <h4>
					<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="blue" class="bi bi-box-seam" viewBox="0 0 16 16">
                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                    </svg>&nbsp;&nbsp;
				Lista de Produtos 
				</h4>
			</div>
			  
			<div class="col-sm-8">
				<form method="get" class="formPesquisa" action="">
					<div class="col-md-auto">   
						<div class="input-group">
							<input class= "form-contol" type="search" name=pesquisa placeholder="Pesquisa" aria-label="Search" style="border-right: none;">
							<div class=input-goup-append>
								<i class="fas fa-search"></i>
								</div>
								<input class="btn btn-secondary" type="submit" value="Pesquisa">
								</div>
								<small class="form-text text-muted">
									Informe nome, marca ou descrição do produto.
								</small>
					</div>
					</Form>
			</div>
		</div>
		<hr>
		<div class="row"> 
			<div class="col-md-4">
				<a href="cadastro_produto.php"> 
					<button type="button" class="btn btn-outline-info">
						<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="blue" class="bi bi-node-plus-fill" viewBox="0 0 16 16">
						<path d="M11 13a5 5 0 1 0-4.975-5.5H4A1.5 1.5 0 0 0 2.5 6h-1A1.5 1.5 0 0 0 0 7.5v1A1.5 1.5 0 0 0 1.5 10h1A1.5 1.5 0 0 0 4 8.5h2.025A5 5 0 0 0 11 13m.5-7.5v2h2a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2h-2a.5.5 0 0 1 0-1h2v-2a.5.5 0 0 1 1 0"/>
						</svg>&nbsp;   
					Novo Produto
					 </button>
				</a>
			</div> 
			<div class="col-md-8 text-end">
				<?php echo $msg; ?>
			</div>
		</div>
		<br>
		<hr>
		<br>
		<?php
			if ($contador == 0) {

				echo '
				<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Atenção!</strong> Nenhum resultado localizado para esta pesquisa!
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>';
			}
			else {
				
				echo '	
				<div class="row">
						<div class="col-sm-5">
							NOME
						</div>
						<div class="col-sm-2">
							MARCA
						</div>
						<div class="col-sm-2">
							VALOR
						</div>
                        <div class="col-sm-1">
							EDITAR
						</div>
					</div>
					<hr>';		
				
				while($exibe = mysqli_fetch_assoc($consulta)){
					echo ' 
					<div class="row">
						<div class="col-sm-5">
							<a haref="#" data-bs-toggle="modal" data-bs-target="#exampleModal'.$exibe['id_produto'].'">
							'.$exibe['nome'].'
							</a>
						</div>
						<div class="col-sm-2">  
							'.$exibe['marca'].'
						</div>
						<div class="col-sm-2">
							'.$exibe['valor'].'
						</div>
                        <div class="col-sm-1">
							<a href="edita_produto.php?produto='.$exibe['id_produto'].'" style="text-decoration: none;" title="Editar Produto '. $exibe['nome'] . '">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
								<path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
								</svg>
							</a>
							&nbsp;&nbsp;
							<a href="seleciona_foto.php?produto='.$exibe['id_produto'].'" style="text-decoration: none;" title="Edita fotos do produto '. $exibe['nome'] . '">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
								<path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
								<path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
							</svg>
							
						</div>
					

					</div>';
				}
			}
		?>
	</div>

	
</body>
</html>
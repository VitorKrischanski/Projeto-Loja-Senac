<?php
	//Recebendo o ID do cliente selecionado para edição
	$id_cliente		=	$_REQUEST['cliente'];
	
	//Conexão com o banco de dados
	include('conecta.php');
	
	//Gerando a pesquisa do cliente
	$sql_consulta	= "SELECT * FROM cliente_christian WHERE id_cliente = $id_cliente;";
	$consulta		= mysqli_query($conecta, $sql_consulta);
	$contador		= mysqli_num_rows($consulta);
?>

<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Edição de cliente</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
	</head>

	<script>
		//Realiza a formatação dos campos de CPF e CEP
		function formatar(mascara, documento) {
			var		i	=	documento.value.length;
			var saida	=	mascara.substring(0,1);
			var texto	=	mascara.substring(i);
			
			if(texto.substring(0,1) != saida) {
				documento.value += texto.substring(0,1);
			}
		}
	</script>

	<body>
		<div class="container">
			<div class="row">
				<h3 style="color: darkgreen">
					<svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="orange" class="bi bi-person-fill-add" viewBox="0 0 16 16">
						<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
						<path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
					</svg>&nbsp;
					Edita cliente
				</h3>
			</div>
			<br><br>
			<h6>Dados pessoais</h4>
			<hr>
			<?php
				if($contador == 0)
				{
					echo '
					<div class="alert alert-danger" role="alert">
						Nenhum registro foi encontrado!
						<br>
						<a href="lista_clientes.php">
							<br>
							<button>
								Voltar
							</button>
						</a>
					</div>
					';
				}
				else
				{
					while($exibe = mysqli_fetch_assoc($consulta))
					{
			?>
			<form name="edita_cliente" method="post" action="atualiza_cliente.php">
			<!-- Início dos inputs para receber valores -->
			<div class="row">
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cpf" placeholder="CPF" maxlength="14" value="<?php echo $exibe['cpf']; ?>" OnKeyPress="formatar('###.###.###-##', this)" oninput="this.value = this.value.replace(/[^0-9.\-]/g, '');" required>
						<label for="floatingInput">CPF</label>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="nome" value="<?php echo $exibe['nome']; ?>" placeholder="Nome completo">
						<label for="floatingInput">Nome completo</label>
					</div>
				</div>
				
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="floatingInput" name="data_nasc" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"   value="<?php echo $exibe['data_nasc']; ?>"  placeholder="Data Nascimento">
						<label for="floatingInput">Data nascimento</label>
					</div>
				</div>
				
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<select class="form-select" name="sexo" id="floatingSelect" aria-label="Sexo">
							<option>Selecione</option>
							<option value="M" <?php if($exibe['sexo'] == "M") { echo "selected"; } ?>>Masculino</option>
							<option value="F" <?php if($exibe['sexo'] == "F") { echo "selected"; } ?>>Feminino</option>
							<option value="O" <?php if($exibe['sexo'] == "O") { echo "selected"; } ?>>Outros</option>
						</select>
						<label for="floatingInput">Sexo</label>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cep" placeholder="CEP" maxlength="10"  value="<?php echo $exibe['cep']; ?>" OnKeyPress="formatar('##.###-##', this)" oninput="this.value = this.value.replace(/[^0-9.\-]/g, '');">
						<label for="floatingInput">CEP</label>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="endereco"  value="<?php echo $exibe['endereco']; ?>" placeholder="Endereço">
						<label for="floatingInput">Endereço</label>
					</div>
				</div>
				
				<div class="col-sm-1">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="numero"  value="<?php echo $exibe['numero']; ?>" placeholder="Nº">
						<label for="floatingInput">Nº</label>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-floating mb-3">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" name="complemento"  value="<?php echo $exibe['complemento']; ?>" placeholder="Complemento">
							<label for="floatingInput">Complemento</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="bairro"  value="<?php echo $exibe['bairro']; ?>"  placeholder="Bairro">
						<label for="floatingInput">Bairro</label>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cidade"  value="<?php echo $exibe['cidade']; ?>"  placeholder="Cidade">
						<label for="floatingInput">Cidade</label>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<select class="form-select" name="uf" id="floatingSelect" aria-label="UF">
							<option>Selecione seu estado</option>
							<option value="AC" <?php if($exibe['uf'] == "AC") { echo "selected"; } ?>>Acre</option>
							<option value="AL" <?php if($exibe['uf'] == "AL") { echo "selected"; } ?>>Alagoas</option>
							<option value="AP" <?php if($exibe['uf'] == "AP") { echo "selected"; } ?>>Amapá</option>
							<option value="AM" <?php if($exibe['uf'] == "AM") { echo "selected"; } ?>>Amazonas</option>
							<option value="BA" <?php if($exibe['uf'] == "BA") { echo "selected"; } ?>>Bahia</option>
							<option value="CE" <?php if($exibe['uf'] == "CE") { echo "selected"; } ?>>Ceará</option>
							<option value="DF" <?php if($exibe['uf'] == "DF") { echo "selected"; } ?>>Distrito Federal</option>
							<option value="ES" <?php if($exibe['uf'] == "ES") { echo "selected"; } ?>>Espírito Santo</option>
							<option value="GO" <?php if($exibe['uf'] == "GO") { echo "selected"; } ?>>Goiás</option>
							<option value="MA" <?php if($exibe['uf'] == "MA") { echo "selected"; } ?>>Maranhão</option>
							<option value="MT" <?php if($exibe['uf'] == "MT") { echo "selected"; } ?>>Mato Grosso</option>
							<option value="MS" <?php if($exibe['uf'] == "MS") { echo "selected"; } ?>>Mato Grosso do Sul</option>
							<option value="MG" <?php if($exibe['uf'] == "MG") { echo "selected"; } ?>>Minas Gerais</option>
							<option value="PA" <?php if($exibe['uf'] == "PA") { echo "selected"; } ?>>Pará</option>
							<option value="PB" <?php if($exibe['uf'] == "PB") { echo "selected"; } ?>>Paraíba</option>
							<option value="PR" <?php if($exibe['uf'] == "PR") { echo "selected"; } ?>>Paraná</option>
							<option value="PE" <?php if($exibe['uf'] == "PE") { echo "selected"; } ?>>Pernambuco</option>
							<option value="PI" <?php if($exibe['uf'] == "PI") { echo "selected"; } ?>>Piauí</option>
							<option value="RJ" <?php if($exibe['uf'] == "RJ") { echo "selected"; } ?>>Rio de Janeiro</option>
							<option value="RN" <?php if($exibe['uf'] == "RN") { echo "selected"; } ?>>Rio Grande do Norte</option>
							<option value="RS" <?php if($exibe['uf'] == "RS") { echo "selected"; } ?>>Rio Grande do Sul</option>
							<option value="RO" <?php if($exibe['uf'] == "RO") { echo "selected"; } ?>>Rondônia</option>
							<option value="RR" <?php if($exibe['uf'] == "RR") { echo "selected"; } ?>>Roraima</option>
							<option value="SC" <?php if($exibe['uf'] == "SC") { echo "selected"; } ?>>Santa Catarina</option>
							<option value="SP" <?php if($exibe['uf'] == "SP") { echo "selected"; } ?>>São Paulo</option>
							<option value="SE" <?php if($exibe['uf'] == "SE") { echo "selected"; } ?>>Sergipe</option>
							<option value="TO" <?php if($exibe['uf'] == "TO") { echo "selected"; } ?>>Tocantins</option>
						</select>
						<label for="floatingInput">Estado</label>
					</div>
				</div>
			
			</div>
			<br>
			<h6>Contato</h4>
			<hr>

			<div class="row">
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="email" class="form-control" id="floatingInput" name="email"  value="<?php echo $exibe['email']; ?>" placeholder="E-mail">
						<label for="floatingInput">E-mail</label>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="telefone1"  value="<?php echo $exibe['telefone1']; ?>"  placeholder="Celular">
						<label for="floatingInput">Celular</label>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="telefone2"  value="<?php echo $exibe['telefone2']; ?>" placeholder="Telefone de contato">
						<label for="floatingInput">Telefone de contato</label>
					</div>
				</div>
			</div>
			<br>
			<h6>Habilitado</h4>
			<hr>
			
			<div class="row">
				<div class="col-sm-12">
					
					<input type="radio" id="ativo" name="status" value="1"  <?php if($exibe['status'] == 1) { echo "checked"; } ?> required>
					<label for="masculino">&nbsp;
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
						<path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a10 10 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733q.086.18.138.363c.077.27.113.567.113.856s-.036.586-.113.856c-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.2 3.2 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.8 4.8 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
						</svg>&nbsp;&nbsp;
						Ativo no sistema
					</label>
					
					<br>
					
					<input type="radio" id="inativo" name="status" value="0" <?php if($exibe['status'] == 0) { echo "checked"; } ?>>
					<label for="feminino">&nbsp;
						<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-hand-thumbs-down-fill" viewBox="0 0 16 16">
							<path d="M6.956 14.534c.065.936.952 1.659 1.908 1.42l.261-.065a1.38 1.38 0 0 0 1.012-.965c.22-.816.533-2.512.062-4.51q.205.03.443.051c.713.065 1.669.071 2.516-.211.518-.173.994-.68 1.2-1.272a1.9 1.9 0 0 0-.234-1.734c.058-.118.103-.242.138-.362.077-.27.113-.568.113-.856 0-.29-.036-.586-.113-.857a2 2 0 0 0-.16-.403c.169-.387.107-.82-.003-1.149a3.2 3.2 0 0 0-.488-.9c.054-.153.076-.313.076-.465a1.86 1.86 0 0 0-.253-.912C13.1.757 12.437.28 11.5.28H8c-.605 0-1.07.08-1.466.217a4.8 4.8 0 0 0-.97.485l-.048.029c-.504.308-.999.61-2.068.723C2.682 1.815 2 2.434 2 3.279v4c0 .851.685 1.433 1.357 1.616.849.232 1.574.787 2.132 1.41.56.626.914 1.28 1.039 1.638.199.575.356 1.54.428 2.591"/>
						</svg>&nbsp;&nbsp;
						Inativo no sistema
					</label>
				</div>
			</div>
			
			<input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">
			<br><br> 
			<div class="row">
				<div class="col-sm-6 text-end">
					<div class="d-grid gap-2">
						<input type="reset" class="btn btn-outline-secondary btn-lg" value="Limpa">
					</div>
				</div>
				<div class="col-sm-6">
					<div class="d-grid gap-2">
						<input type="submit" class="btn btn-outline-success  btn-lg" value="Me aperte com cuidado">
					</div>
				</div>
			</div>
			</form>
			<?php
					}
				}
			?>
			<br><br>
		</div>
	</body>

</html>



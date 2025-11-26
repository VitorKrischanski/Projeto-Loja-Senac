<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Cadastro de cliente</title>
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
					Novo cliente
				</h3>
			</div>
			<br><br>
			<h6>Dados pessoais</h4>
			<hr>
			
			<form name="cadastro_usuario" method="post" action="grava_cliente.php">
			<!-- Início dos inputs para receber valores -->
			<div class="row">
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cpf" placeholder="CPF" maxlength="14" OnKeyPress="formatar('###.###.###-##', this)" oninput="this.value = this.value.replace(/[^0-9.\-]/g, '');" required>
						<label for="floatingInput">CPF</label>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="nome" placeholder="Nome completo">
						<label for="floatingInput">Nome completo</label>
					</div>
				</div>
				
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="date" class="form-control" id="floatingInput" name="data_nasc" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"    placeholder="Data Nascimento">
						<label for="floatingInput">Data nascimento</label>
					</div>
				</div>
				
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<select class="form-select" name="sexo" id="floatingSelect" aria-label="Sexo">
							<option>Selecione</option>
							<option value="M">Masculino</option>
							<option value="F">Feminino</option>
							<option value="O">Outros</option>
						</select>
						<label for="floatingInput">Sexo</label>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-2">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cep" placeholder="CEP" maxlength="10" OnKeyPress="formatar('##.###-##', this)" oninput="this.value = this.value.replace(/[^0-9.\-]/g, '');">
						<label for="floatingInput">CEP</label>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="endereco" placeholder="Endereço">
						<label for="floatingInput">Endereço</label>
					</div>
				</div>
				
				<div class="col-sm-1">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="numero" placeholder="Nº">
						<label for="floatingInput">Nº</label>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-floating mb-3">
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingInput" name="complemento" placeholder="Complemento">
							<label for="floatingInput">Complemento</label>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="bairro" placeholder="Bairro">
						<label for="floatingInput">Bairro</label>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="cidade" placeholder="Cidade">
						<label for="floatingInput">Cidade</label>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<select class="form-select" name="uf" id="floatingSelect" aria-label="UF">
							<option>Selecione seu estado</option>
							<option value="AC">Acre</option>
							<option value="AL">Alagoas</option>
							<option value="AP">Amapá</option>
							<option value="AM">Amazonas</option>
							<option value="BA">Bahia</option>
							<option value="CE">Ceará</option>
							<option value="DF">Distrito Federal</option>
							<option value="ES">Espírito Santo</option>
							<option value="GO">Goiás</option>
							<option value="MA">Maranhão</option>
							<option value="MT">Mato Grosso</option>
							<option value="MS">Mato Grosso do Sul</option>
							<option value="MG">Minas Gerais</option>
							<option value="PA">Pará</option>
							<option value="PB">Paraíba</option>
							<option value="PR">Paraná</option>
							<option value="PE">Pernambuco</option>
							<option value="PI">Piauí</option>
							<option value="RJ">Rio de Janeiro</option>
							<option value="RN">Rio Grande do Norte</option>
							<option value="RS">Rio Grande do Sul</option>
							<option value="RO">Rondônia</option>
							<option value="RR">Roraima</option>
							<option value="SC">Santa Catarina</option>
							<option value="SP">São Paulo</option>
							<option value="SE">Sergipe</option>
							<option value="TO">Tocantins</option>
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
						<input type="email" class="form-control" id="floatingInput" name="email" placeholder="E-mail">
						<label for="floatingInput">E-mail</label>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="telefone1" placeholder="Celular">
						<label for="floatingInput">Celular</label>
					</div>
				</div>

				<div class="col-sm-4">
					<div class="form-floating mb-3">
						<input type="text" class="form-control" id="floatingInput" name="telefone2" placeholder="Telefone de contato">
						<label for="floatingInput">Telefone de contato</label>
					</div>
				</div>
			</div>
			<br>
			<h6>Segurança</h4>
			<hr>
			
			<div class="row">
				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingInput" name="senha" placeholder="Senha">
						<label for="floatingInput">Senha</label>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-floating mb-3">
						<input type="password" class="form-control" id="floatingInput" name="confirmasenha" placeholder="Confirma senha">
						<label for="floatingInput">Confirma senha</label>
					</div>
				</div>
			</div>
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
			<br><br>
		</div>
	</body>

</html>



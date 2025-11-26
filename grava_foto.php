<?php
	session_start();
	include('conecta.php');
	
	//Recupera o ID do produto gerado
	$id_produto		=	$_POST['id_produto'];

	// ************************* COMEÇA O PREPARO DO ENVIO DA IMAGEM PARA SALVAR NO BANCO **********************************************
	
	// Pasta onde a arquivo vai ser salvo
	$_UP['pasta'] = 'img/';
	 
	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
	 
	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'jpeg', 'png', 'gif');
	 
	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
	 
	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['imagem']['error'] != 0) {
		die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['imagem']['error']]);
		exit; // Para a execução do script
	}
	 
	// Faz a verificação da extensão do arquivo
	$extensao = strtolower(end(explode('.', $_FILES['imagem']['name'])));
	if (array_search($extensao, $_UP['extensoes']) === false) {
		echo "Por favor, envie arquivos com as seguintes extensões: jpg, jpeg, png ou gif";
	}
	 
	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['imagem']['size']) {
		echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
	}
 
	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else 
	{
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) {
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		} 
		else 
		{
			// Mantém o nome original do arquivo
			$nome_final = $_FILES['imagem']['name'];
		}
	 
		// Recebe o código do produto, para concatenar no nome da foto a ser enviada
		$id_produto	= $_POST["id_produto"];
	 
	 
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
	   if (move_uploaded_file($_FILES['imagem']['tmp_name'], $_UP['pasta'].date('Ymd_His')."_".$id_produto."_".$nome_final)) 
		{
			// Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
			echo "Upload efetuado com sucesso!";
			$nome_concatenado = date('Ymd_His')."_".$id_produto."_".$nome_final;
			
			//echo '<br /><a href="' . $nome_concatenado. '">Clique aqui para acessar o arquivo</a>';
		}
		else
		{
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
			echo "Não foi possível enviar o arquivo, tente novamente";
		}
	}
	
	// Recebe o nome do arquivo concatenado para ser gravado no BD
	$foto	= $nome_concatenado;

	//echo "<br>Nome do arquivo: ".$foto."<br>";
	//echo "<br>Nome final: ".$nome_concatenado."<br>";

	$sqlinsert = "insert into fotos_produto (id_produto, foto) VALUES ('$id_produto', '$foto');";

	echo "<br><br>".$sqlinsert."<br><br>";

	mysqli_query($conecta, $sqlinsert) or die ("Não foi possível realizar alterações!");


	//  ******************************  FIM DO ENVIO DA IMAGEM PARA O BANCO  ****************************************************

	header("location: seleciona_foto.php?produto=$id_produto");

?>
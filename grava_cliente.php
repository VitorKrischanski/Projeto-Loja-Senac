<?php
	include('conecta.php');

    //Recebendo os valores do formulário
    $cpf            =   $_POST['cpf'];
    $nome           =   mb_strtoupper($_POST ["nome"], 'UTF-8');
    $sexo           =   $_POST['sexo'];
    $data_nasc      =   $_POST['data_nasc'];
    $cep            =   $_POST['cep'];
    $endereco       =   $_POST['endereco'];
    $numero         =   $_POST['numero'];
    $complemento    =   $_POST['complemento'];
    $bairro         =   $_POST['bairro'];
    $cidade         =   $_POST['cidade'];
    $uf             =   $_POST['uf'];
    $email          =   $_POST['email'];
    $telefone1      =   $_POST['telefone1'];
    $telefone2      =   $_POST['telefone2'];
    $senha          =   $_POST['senha'];
    $status         =   1;
    
	//Prepara os dados para serem gravados no banco 
	$sql_insert		= "
	INSERT INTO cliente
	(cpf, nome, sexo, data_nasc, cep, endereco, numero, complemento, bairro,
	cidade, uf, email, telefone1, telefone2, senha, status)
	VALUES
	('$cpf', '$nome', '$sexo', '$data_nasc', '$cep', '$endereco', '$numero', 
	'$complemento', '$bairro', '$cidade', '$uf', '$email', '$telefone1', 
	'$telefone2', '$senha', '$status');";
	
	if($cpf != "" && $nome != "" && $senha != "")
	{
		//Insere valores no banco de dados
		mysqli_query($conecta, $sql_insert) or die ("Não foi possivel gravar os dados do(a) cliente!");

		//Encaminha a navegação para a tela de listagem de clientes
		echo "<script> window.location='lista_clientes.php'</script>";
    }
    else 
	{
        echo "
		<script> 
			window.alert('Nenhum registro foi recebido e gravado!\nRetornando para tela anterior.');
			window.history.back();
        </script>";
    }    
?>


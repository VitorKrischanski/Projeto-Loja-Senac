<?php
	include('conecta.php');

    //Recebendo os valores do formulário
    $id_cliente		=	$_POST['id_cliente'];
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
    $status         =   $_POST['status'];
    
	//Prepara os dados para serem atualizados no banco 
	$sql_update = "UPDATE cliente_christian SET 
	cpf 		= '$cpf', 
	nome 		= '$nome', 
	sexo 		= '$sexo',
	data_nasc 	= '$data_nasc',
	cep 		= '$cep',
	endereco 	= '$endereco',
	numero 		= '$numero',
	complemento = '$complemento',
	bairro 		= '$bairro',
	cidade 		= '$cidade',
	uf 			= '$uf',
	email 		= '$email',
	telefone1 	= '$telefone1',
	telefone2 	= '$telefone2',
	status 		= $status
	WHERE id_cliente = $id_cliente;";
	
		
	if($cpf != "" && $nome != "" && $senha != "")
	{
		//Insere valores no banco de dados
		mysqli_query($conecta, $sql_update) or die ("Não foi possivel atualizar os dados do(a) cliente!");

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


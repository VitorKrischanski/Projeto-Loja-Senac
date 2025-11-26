<?php
	$hostname		=	"localhost";
	$usuario		=	"senac25";
	$senha			=	"progweb25";
	$banco			=	"senac25";
	
	//Cria a conexão com o banco de dados
	$conecta	=	mysqli_connect($hostname, $usuario, $senha, $banco);
	
	//Verifica a conexão com o banco de dados
	if(!conecta)
	{
		die("A conexão falhou: ".mysqli_connect_error());
	}
	
	//Caso a conexão tenha sido estabelecida, mostra a mensagem abaixo
	//echo "Conexão estabelecida com sucesso!";
?>
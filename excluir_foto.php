<?php
session_start();
include('conecta.php');


$id_foto        = $_GET['foto'];
$id_produto     = $_GET['produto'];

// Busca o nome do arquivo
$sql = "SELECT * FROM fotos_produto WHERE id_foto = $id_foto";
$result = $conecta->query($sql);
$foto = $result->fetch_assoc();

// Exclui o arquivo físico
if(file_exists('img/'.$foto['foto'])) 
{
    unlink('img/'.$foto['foto']);
}

// Exclui do banco
$conecta->query("DELETE FROM fotos_produto WHERE id_foto = $id_foto");

// Volta para a página de fotos
header("Location: seleciona_foto.php?produto=$id_produto");
?>
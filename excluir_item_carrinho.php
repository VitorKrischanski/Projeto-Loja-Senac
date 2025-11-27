<?php
    include("conecta.php");

    $id_produto = $_REQUEST['produto'];
    $id_cliente = $_REQUEST['cliente'];
    $id_carrinho = $_REQUEST['carrinho'];

    $sqlremoveitem = "DELETE FROM carrinho WHERE id_carrinho = $id_carrinho AND id_cliente = $id_cliente AND id_produto = $id_produto LIMIT 1";

    mysqli_query($conecta, $sqlremoveitem) or die("Não foi possível remover item selecionado no carrinho.");
    header("Location: carrinho.php");
?>
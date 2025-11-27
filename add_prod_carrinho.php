<?php
    include('conecta.php');

    $id_produto     =   $_POST['id_produto'];
    $id_cliente     =   $_POST['id_cliente'];
    $quant          =   $_POST['quant'];
    $status_compra  =   0;              // Valor 0 = Compra não foi finalizada
                                        // Valor 1 = Compra finalizada (mostra nos históricos) 
    
    $sql_produto    =   "SELECT * FROM  produto WHERE id_produto = $id_produto"; 
    $cons_produto   =   mysqli_query($conecta, $sql_produto);

    while($mostra   =   mysqli_fetch_assoc($cons_produto))
    {
        $valor      =   $mostra['valor'];
    }

    $sql_insert     =   "INSERT INTO carrinho (id_cliente, id_produto, quant, valor, status_compra)
                        VALUES ('$id_cliente', '$id_produto', '$quant', '$valor', '$status_compra')";

    //Grava os dados no banco de dados
    mysqli_query($conecta, $sql_insert) or die ("Não foi possível gravar o item no carrinho!");


    header("Location: produto.php?produto=$id_produto");
?>
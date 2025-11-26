<?php

    //Incluindo conexão com o banco de dados
    include('conecta.php');

    $nome                   =   mb_convert_case($_POST['nome'], MB_CASE_TITLE, "UTF-8");
    $marca                  =   mb_strtoupper($_POST['marca']);
    $categoria              =   $_POST['categoria'];
    $valor                  =   $_POST['valor'];
    $dim_alt                =   $_POST['dim_alt'];
    $dim_lar                =   $_POST['dim_lar'];
    $dim_prof               =   $_POST['dim_prof'];
    $peso                   =   $_POST['peso'];
    $cor                    =   $_POST['cor'];
    $cod_barras             =   $_POST['cod_barras'];
    $descricao              =   $_POST['descricao'];
    $quantidade             =   $_POST['quantidade'];
    $tamanho                =   $_POST['tamanho'];
    $status                 =   1;

    $sql_insert     =   "INSERT INTO produto
    (nome, marca, categoria, valor, dim_alt, dim_lar, dim_prof, peso, cor, cod_barras, descricao, quantidade, tamanho, status)
    VALUE
    ('$nome', '$marca', '$categoria', '$valor', '$dim_alt', '$dim_lar', '$dim_prof', '$peso', '$cor', '$cod_barras', '$descricao', '$quantidade', '$tamanho', '$status')";



    if($nome   !=  ""  &&  $categoria  !=  "")
    {
        //Insere valores no banco de dados
        mysqli_query($conecta, $sql_insert)
        or die ("Não foi possivel gravar os dados do produto!");

        //Encaminha a navegação para a tela de listagem de clientes
        echo "<script> window.location='seleciona_foto.php'</script>";
    }

    
?>

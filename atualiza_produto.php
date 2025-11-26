<?php

    //Incluindo conexão com o banco de dados
    include('conecta.php');

    $id_produto     = $_POST['id_produto'];
    $nome           =   mb_strtoupper($_POST ["nome"], 'UTF-8');
    $marca          =   $_POST['marca'];
    $valor          =   $_POST['valor'];
    $categoria      =   $_POST['categoria'];
    $dim_alt        =   $_POST['dim_alt'];
    $dim_lar        =   $_POST['dim_lar'];
    $dim_prof       =   $_POST['dim_prof'];
    $peso           =   $_POST['peso'];
    $tamanho        =   $_POST['tamanho'];
    $cod_barras     =   $_POST['cod_barras'];
    $cor            =   $_POST['cor'];
    $quantidade     =   $_POST['quantidade'];
    $descricao      =   $_POST['descricao'];
    $status         =   $_POST['status'];


    //Prepara os dados para serem atualizados no banco de dados
    $sql_update          =   "UPDATE produto SET
    nome                 = '$nome',
    marca                = '$marca',
    valor                = '$valor',
    categoria            = '$categoria',
    dim_alt              = '$dim_alt',
    dim_lar              = '$dim_lar',
    dim_prof             = '$dim_prof',
    peso                 = '$peso',
    tamanho              = '$tamanho',
    cod_barras           = '$cod_barras',
    cor                  = '$cor',
    quantidade           = '$quantidade',
    descricao            = '$descricao',
    status               = '$status'
    WHERE id_produto     = $id_produto";
    //Verifica se os campos obrigatórios foram preenchidos

    if($nome    !=  ""  &&  $valor   !=  "")
    {
        //Atualiza valores no banco de dados
        mysqli_query($conecta, $sql_update)
        or die ("Não foi possivel atualizar os dados do produto!");

        //Encaminha a navegação para a tela de listagem de produtos
        echo "<script> window.location='seleciona_foto.php?produto=$id_produto'</script>";
    }
    else {
        echo "<script> window.alert('Nenhum registro foi atualizado!\n 
        Retornando para a tela anterior!'); 
        window.history.back{};
        </script>";
    }
?>
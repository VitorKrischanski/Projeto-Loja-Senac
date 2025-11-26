<?php
    //Recupera o ID do porduto a ser editado
    $id_produto = $_REQUEST['produto'];

    //Conexão com o banco de dados
    include('conecta.php');

    //Gerando a pesquisa do produto no banco de dados
    $sql_consulta   = "SELECT * FROM produto WHERE id_produto = $id_produto";
    $consulta      = mysqli_query($conecta, $sql_consulta);
    $contador       = mysqli_num_rows($consulta);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</head>
    <body>
        <br>
        <div class="container">
            <div class="row">
                <h4 style="color: rgb(0, 45, 114)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                        <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg> &nbsp;
                    Editar Produto
                </h4>
            </div>
            <hr><br>

            <h5>Dados do Produto</h5>
            <hr>
            <?php
                if ($contador == 0) 
                {
                    echo '
                        <div class="alert alert-danger" role="alert">
                            Nenhum produto encontrado!
                            <br>
                            <a href="lista_produtos.php" class="alert-link">
                                <button class="btn btn-secondary btn-sm">
                                    Voltar à lista de produtos
                                </button>
                            </a>
                        </div>
                        ';
                }
                else
                {
                    while($exibe = mysqli_fetch_assoc($consulta))
                    {
            ?>
            <form name="edita_produto" method="post" action="atualiza_produto.php">
            <!-- Inicio dos inputs para receber valores -->
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="nome" value="<?php echo $exibe['nome']; ?>" placeholder="Nome do Produto">
                        <label for="floatingInput">Nome do Produto</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="marca" value="<?php echo $exibe['marca']; ?>" placeholder="Marca">
                        <label for="floatingInput">Marca do Produto</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="valor" value="<?php echo $exibe['valor']; ?>" placeholder="Valor do Produto">
                        <label for="floatingInput">Valor do Produto</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="categoria" id="floatingSelect" aria-label="Categoria do Produto">
                        <option>Selecione</option>
                        <option value="Acessórios" <?php if($exibe['categoria'] == 'Acessórios') echo 'selected'; ?>>Acessórios</option>
                        <option value="Componentes" <?php if($exibe['categoria'] == 'Componentes') echo 'selected'; ?>>Componentes - Periféricos - Placas</option>
                        <option value="Conectividade" <?php if($exibe['categoria'] == 'Conectividade') echo 'selected'; ?>>Conectividade - Equip. de Rede</option>
                        <option value="Computador" <?php if($exibe['categoria'] == 'Computador') echo 'selected'; ?>>Computador e Notebooks</option>
                        <option value="Impressora" <?php if($exibe['categoria'] == 'Impressora') echo 'selected'; ?>>Impressora</option>
                        <option value="Energia" <?php if($exibe['categoria'] == 'Energia') echo 'selected'; ?>>Energia - Estab. - Nobreak - Fonte</option>
                        <option value="Suprimentos" <?php if($exibe['categoria'] == 'Suprimentos') echo 'selected'; ?>>Suprimentos - Cartuchos - Tintas</option>
                        <option value="Imagem" <?php if($exibe['categoria'] == 'Imagem') echo 'selected'; ?>>Imagem - Monitor - Projetor</option>
                        <option value="Software" <?php if($exibe['categoria'] == 'Software') echo 'selected'; ?>>Software</option>
                        <option value="Automação" <?php if($exibe['categoria'] == 'Automação') echo 'selected'; ?>>Automação Comercial</option>
                        <option value="Infraestrutura" <?php if($exibe['categoria'] == 'Infraestrutura') echo 'selected'; ?>>Infraestrutura - Rack - Bracket - Guia Cabos - Porca Gaiola</option>
                    </select>
                    <label for="floatingInput">Categoria do Produto</label>
                    </div>
                </div>
             </div>

             <br>
             <h5>Informações Para Frete</h5>
             <hr>

             <div class="row">
                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="dim_alt" value="<?php echo $exibe['dim_alt']; ?>" placeholder="Dimensão Altura">
                        <label for="floatingInput">Dimensão de Altura</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="dim_lar" value="<?php echo $exibe['dim_lar']; ?>" placeholder="Dimensão Largura">
                        <label for="floatingInput">Dimensão de Largura</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="dim_prof" value="<?php echo $exibe['dim_prof']; ?>" placeholder="Dimensão Profundidade">
                        <label for="floatingInput">Dimensão de Profundidade</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="peso" value="<?php echo $exibe['peso']; ?>" placeholder="Peso do Produto">
                        <label for="floatingInput">Peso do Produto</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="tamanho" value="<?php echo $exibe['tamanho']; ?>" placeholder="Tamanho do Produto">
                        <label for="floatingInput">Tamanho do Produto</label>
                    </div>
                </div>
             </div>

             <br>
             <h5>Dados Adicionais do Produto</h5>
             <hr>

             <div class="row">
                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="cod_barras" value="<?php echo $exibe['cod_barras']; ?>" placeholder="Codigo de Barras">
                        <label for="floatingInput">Codigo de Barras</label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="cor" value="<?php echo $exibe['cor']; ?>" placeholder="Cor do Produto">
                        <label for="floatingInput">Cor do Produto</label>
                    </div>
                </div>

                 <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="quantidade" value="<?php echo $exibe['quantidade']; ?>" placeholder="Quantidade no Estoque">
                        <label for="floatingInput">Quantidade no Estoque</label>
                    </div>
                </div>
             </div>

             <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="floatingInput" name="descricao" rows="8" style="height: 150px" placeholder="Descrição do Produto"><?php echo $exibe['descricao']; ?></textarea>
                        <label for="floatingInput">Descrição do Produto</label>
                    </div>
                </div>
             </div>

             <div class="row">
                <div class="col-sm-6">
                    <div class="form-check">
                        <label class="form-check-label d-flex align-items-center" for="ativo">
                            <input class="form-check-input me-2" type="radio" name="status" id="ativo" value="1" <?php if($exibe['status'] == 1) echo 'checked'; ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="green" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                            </svg>
                            <h5 class="mb-0 ms-2">Ativo no sistema!</h5>
                    </label>
                </div>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <div class="col-sm-6">
                    <div class="form-check">
                        <label class="form-check-label d-flex align-items-center" for="inativo">
                            <input class="form-check-input me-2" type="radio" name="status" id="inativo" value="0" <?php if($exibe['status'] == 0) echo 'checked'; ?>>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="red" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                                <path d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                            </svg>
                            <h5 class="mb-0 ms-2">Inativo no sistema!</h5>
                        </label>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="id_produto" value="<?php echo $exibe['id_produto']; ?>">

            <br>
            <div class="row">
                <div class="col-sm-6">
                    <div class="d-grid gap-2">
                        <input type="reset" class="btn btn-outline-danger" value="Limpa">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="d-grid gap-2">
                       <input type="submit" class="btn btn-outline-success" value="Enviar">
                    </div>
                </div>
            </div>
            </form>
            <?php
                }
                }
            ?>
            <br><br>
        </div>
    </body>
</html>
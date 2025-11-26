
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de cliente</title>

</head>
    <body>
        <?php
            include('menu.php');
        ?>
        <br>
        <div class="container">
            <div class="row">
                <h4 style="color: darkgreen">
                    <svg xmlns="http://www.w3.org/2000/svg" width="31" height="31" fill="currentColor" class="bi bi-cart-check" viewBox="0 0 16 16">
                        <path d="M11.354 6.354a.5.5 0 0 0-.708-.708L8 8.293 6.854 7.146a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0"/>
                    </svg> &nbsp;
                    Cadastro de Produto
                </h4>
            </div>
            <hr><br>

            <h5>Dados do Produto</h5>
            <hr>

            <form name="cadastro_produto" method="post" action="grava_produto.php">
            <!-- Inicio dos inputs para receber valores -->
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="nome" placeholder="Nome do Produto">
                        <label for="floatingInput">Nome do Produto</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="marca" placeholder="Marca">
                        <label for="floatingInput">Marca do Produto</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="valor" placeholder="Valor do Produto">
                        <label for="floatingInput">Valor do Produto</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <select class="form-control" name="categoria" id="floatingSelect" aria-label="Categoria do Produto">
                        <option>Selecione</option>
                        <option value="Acessórios">Acessórios</option>
                        <option value="Componentes">Componentes - Periféricos - Placas</option>
                        <option value="Conectividade">Conectividade - Equip. de Rede</option>
                        <option value="Computador">Computador e Notebooks</option>
                        <option value="Impressora">Impressora</option>
                        <option value="Energia">Energia - Estab. - Nobreak - Fonte</option>
                        <option value="Suprimentos">Suprimentos - Cartuchos - Tintas</option>
                        <option value="Imagem">Imagem - Monitor - Projetor</option>
                        <option value="Software">Software</option>
                        <option value="Automação">Automação Comercial</option>
                        <option value="Infraestrutura">Infraestrutura - Rack - Bracket - Guia Cabos - Porca Gaiola</option>
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
                        <input type="text" class="form-control" id="floatingInput" name="dim_alt" placeholder="Dimensão Altura">
                        <label for="floatingInput">Dimensão de Altura</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="dim_lar" placeholder="Dimensão Largura">
                        <label for="floatingInput">Dimensão de Largura</label>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="dim_prof" placeholder="Dimensão Profundidade">
                        <label for="floatingInput">Dimensão de Profundidade</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="peso" placeholder="Peso do Produto">
                        <label for="floatingInput">Peso do Produto</label>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="tamanho" placeholder="Tamanho do Produto">
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
                        <input type="text" class="form-control" id="floatingInput" name="cod_barras" placeholder="Codigo de Barras">
                        <label for="floatingInput">Codigo de Barras</label>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="cor" placeholder="Cor do Produto">
                        <label for="floatingInput">Cor do Produto</label>
                    </div>
                </div>

                 <div class="col-sm-4">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="quantidade" placeholder="Quantidade no Estoque">
                        <label for="floatingInput">Quantidade no Estoque</label>
                    </div>
                </div>
             </div>

             <div class="row">
                <div class="col-sm-12">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="floatingInput" name="descricao" rows="8" style="height: 150px" placeholder="Descrição do Produto"></textarea>
                        <label for="floatingInput">Descrição do Produto</label>
                    </div>
                </div>
             </div>
                
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
            <br><br>
        </div>
    </body>
</html>
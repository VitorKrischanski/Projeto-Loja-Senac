<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Loja SENAC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .navbar-custom {
            background-color: #ffffff; 
            box-shadow: 0 2px 4px rgba(0,0,0,.1); 
            padding-left: 0;
            padding-right: 0;
        }

        .navbar-container {
            width: 100%;
            padding-left: 15px;
            padding-right: 15px;
            margin-left: auto;
            margin-right: auto;
        }

        .nav-link-custom {
            color: #007bff !important; 
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
            padding: 8px 15px;
            font-weight: 500;
        }

        .nav-link-custom:hover, 
        .dropdown-toggle-custom:hover {
            background-color: #e9ecef; 
            color: #00346cff !important; 
        }

        .btn-custom {
            background-color: #00346cff;
            border-color: #00346cff;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .search-container {
            max-width: 300px;
        }
        
        @media (min-width: 1200px) {
            .navbar-container {
                max-width: 1140px;
            }
        }
        
        @media (min-width: 1400px) {
            .navbar-container {
                max-width: 1320px;
            }
        }
    </style>
</head>
<body>
    <?php
        //Inicio uma sessão no navegador
        session_start();
    ?>

    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="navbar-container">
            <div class="row">
            <div class="container-fluid">
                <a class="navbar-brand me-5" href="#" style="color: #00346cff; font-weight: bold;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Senac_logo.svg/1200px-Senac_logo.svg.png" width="100px" alt="Logo SENAC">
                </a>
            </div><br>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">

                            

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="index.php">Principal</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom dropdown-toggle-custom" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Categorias <i class="bi bi-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <li><a class="dropdown-item" href="#">Telas</a></li>
                                <li><a class="dropdown-item" href="#">Processadores</a></li>
                                <li><a class="dropdown-item" href="#">Teclados</a></li>
                                <li><a class="dropdown-item" href="#">Mouses</a></li>
                                <li><a class="dropdown-item" href="#">Headsets</a></li>
                            </ul>
                        </li>
                        <!--
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link-custom dropdown-toggle-custom" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Ajuda e Contato <i class="bi bi-chevron-down"></i>
                            </a>
                            
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <li><a class="dropdown-item" href="#">Fale Conosco</a></li>
                                <li><a class="dropdown-item" href="#">Suporte Técnico</a></li>
                                <li><a class="dropdown-item" href="#">FAQ</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Rastrear Pedido</a></li>
                            </ul>
    
                        </li>
                        -->
                        <?php                    

                        if($_SESSION['email'] != NULL && $_SESSION['nivel'] != NULL)
                        {
                            echo '
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle nav-link-custom dropdown-toggle-custom" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Administração <i class="bi bi-chevron-down"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                    <li><a class="dropdown-item" href="lista_produto.php">Lista de produtos</a></li>
                                    <li><a class="dropdown-item" href="lista_clientes.php">Lista de clientes</a></li>

                                </ul>
                            </li>
                            ';
                        }
                        
                        if($_SESSION['email'] == NULL && $_SESSION['nivel'] == NULL)
                        {
                            echo '
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="login.php">Login</a>
                            </li>
                            ';
                        }
                        else
                        {
                            echo '
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom" href="sair.php">Sair</a>
                            </li>
                            ';
                        }
                        

                        ?>

                    </ul>

                    <div class="d-flex align-items-center">
                        <button class="btn btn-outline-primary me-2" type="button" onclick="alert('Redirecionar para Minha Conta')">
                            <i class="bi bi-person-circle me-1"></i> Minha Conta
                        </button>
                        <button class="btn btn-custom text-white" type="button" onclick="alert('Abrir Carrinho')">
                            <i class="bi bi-cart3 me-1"></i> Carrinho
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
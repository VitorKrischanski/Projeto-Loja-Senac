<?php
    //Inicio uma sessão no navegador
    session_start();
    
    //Conecta ao banco de dados
    include('conecta.php');

    $email      =   $_POST['email'];
    $senha      =   md5($_POST['senha']);

    $sql_consulta   =   "SELECT * FROM cliente where email = '$email' AND senha = '$senha' AND status = 1;";
    $consulta_login =   mysqli_query($conecta, $sql_consulta);
    $contador		=	mysqli_num_rows($consulta_login);

   
    echo "$sql_consulta<br><br>";
    echo "<br>Total de resultados: $contador<br>";

    if($contador == 1)
    {
        //Caso o login esteja correto, faz o seguinte procedimento

        //Consulta o usuario no banco de dados e guarda em sessões do PHP
        while($usuario = mysqli_fetch_assoc($consulta_login))
        {
            $_SESSION['nivel']          = $usuario['nivel']; 
            $_SESSION['nome']           = $usuario['nome'];
            $_SESSION['id_cliente']     = $usuario['id_cliente'];
        }

        $_SESSION['email'] = $email;
        //Se todos os dados foram verificados e confirmados, encaminha navegação para a tela principal (logado)
        header("Location: index.php");
    }
    else
    {
        //caso o login esteja incorreto, retorna para a tela de login e mostra msg
        $_SESSION['msg_error'] = "Usuário ou senha incorretos!";
        header("Location: login.php");
    }

?>
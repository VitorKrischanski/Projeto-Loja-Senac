<?php
    /************************************************************************************/
    /*                         DETALHAMENYTO DO SCRIPT                                  */
    /*      -> Utilizado para verificar se o usuário do sistema é Administrador         */
    /*      -> Caso não seja, redireciona a navegação para a tela de login.             */
    /*      -> Deve ser  incluido apenas nas telas que só o Admimistrador tem acesso.   */
    /************************************************************************************/
    //Inicia a sessão do PHP
    session_start();

    //Verifica se a sessão é nula ou o nivel de acesso é diferente de Admin
    if($_SESSION['email'] == NULL || $_SESSION['nivel'] != "admin")
    {
        //Destroi a sessão iniciada do PHP
        session_destroy();

        //Redireciona para a tela de login
        header("location: login.php");
    }
?>
<?php
    session_start();
    session_destroy();

    //Redireciona para a tela principal do site
    header("Location: index.php");
?>
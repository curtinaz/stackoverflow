<?php 
    session_start();
    if (!isset($_SESSION['id_usuarios'])) 
    {
        header("location: login.php");
        exit;
    }

?>


Seja bem vindo
<a href="sair.php">Sair</a>
<?php
session_start();
include_once("mensajes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION['title'] ?></title>
    <link rel="stylesheet" href="../../Estudiante/CSS/style.css">
    <link rel="stylesheet" href="../../Estudiante/CSS/talento.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php

    if($_SESSION['title']==TITLE_TESIS_REGISTER){
    ?>
    <br>
        <header>
            <img src="../../Estudiante/recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
        </header>
        <div>
            <h1 id="mensaje" style="text-align: center;font-size: 20px; padding-top: 15px"><?php echo $_SESSION['message'] ?></h1>
        </div>
        <div class="goBack">
            <a href="imprimirPropuesta.php"><p class="btn btn-primary" id="mensajeRegresar">Imprimir</p></a>
        </div>
        <?php
    }
    else{

    ?>
        <header>
            <center><img src="../recursos/Logo-UCAB-04.png"></center>
        </header>
        <div>
            <center><h1 id="mensaje"><?php echo $_SESSION['message'] ?></h1></center>
        </div>
        <div>
            <a href="../index.html"><p class="btn link">Regresar</p></a>
        </div>
    <?php
    }
    ?>
</body>
</html>
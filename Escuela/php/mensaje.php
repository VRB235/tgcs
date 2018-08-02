<?php
session_start();
include_once("./variablesGlobales.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION['title'] ?></title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/talento.css">
</head>
<body>
<?php

if($_SESSION['title']==$_TITLE_TESIS_REGISTER){
    ?>
    <header>
        <center><img src="../recursos/Logo-UCAB-04.png"></center>
    </header>
    <div>
        <center><h1 id="mensaje"><?php echo $_SESSION['message'] ?></h1></center>
    </div>
    <div>
        <a href="./imprimirPropuesta.php"><p class="btn link">Imprimir</p></a>
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
<?php }?>
</body>
</html>
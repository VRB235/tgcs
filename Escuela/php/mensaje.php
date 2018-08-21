<?php
session_start();
include_once("mensajes.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_SESSION['title'] ?></title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/talento.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<br>
    <header>
        <img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
    </header>
    <div>
        <h1 id="mensaje" style="text-align: center;font-size: 20px; padding-top: 15px"><?php echo $_SESSION['message'] ?></h1>
    </div>
    <div class="goBack">
        <a href="<?php echo $_SESSION["page"]; ?>"><p class="btn btn-primary" id="mensajeRegresar">Regresar</p></a>
    </div>
</body>
</html>
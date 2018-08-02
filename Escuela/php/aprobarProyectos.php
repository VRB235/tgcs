<?php

    require_once ("credenciales.php");
    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();
    $cursor = $mongo->getNotApproveProjects();

?>

<html lang="en">
<head>
    <script src="../js/jquery-3.3.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aprobar Datos De Postulación</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
        <img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
    </header>
<div class="">
    <ul class="lista">
        <?php
        // Se llena el combobox con todos los registros obtenidos
        foreach ($cursor as $element){
            ?>
            <li><a href="reconstructForm.php?id=<?php echo $element->id?>"><p><spam>Titulo: </spam><?php echo $element->title;?>
                        <br><br><spam>Estudiantes: </spam><?php echo $element->student_one_name." y ".$element->student_two_name; ?></p></a></li>
        <?php }?>
    </ul>

</div>

<div>
    <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
</div>

<footer>
    <div>
        <p>
            Universidad Católica Andres Bello - 2018
        </p>
    </div>
</footer>


</body>
</html>
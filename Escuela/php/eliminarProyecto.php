<?php

    require_once ("mongoDB.php");
    session_start();

    $mongo = new mongoDataBase();

    $cursor = $mongo->getAllProjects();


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eliminar Proyecto</title>
    <script src="../js/jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleBasic.css">
    <link rel="stylesheet" type="text/css" href="../css/datatables.css">
    <link rel="stylesheet" href="../css/talento.css">
    <script src="../js/datatables.js"></script>
    <script src="../js/magic.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<header>
    <img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
</header>
<div class="form fix">
    <form action="../php/eliminar.php" method="post" id="tutor">
        <label for="term_code">Term Code: <input type="text" name="term_code" id="term_code" class="form-control"></label>

        <label for="id_registerr" id="eliminarid">N° Registro <input type="text" name="id_registerr" id="id_registerr" class="form-control"></label>
        <br><br>
        <label for="versionn" > Versión
            <select name="versionn" id="versionn" class="form-control">
                <option value="-">-</option>
                <option value="first_version">Versión 1</option>
                <option value="second_version">Versión 2</option>
            </select>
        </label>
        <br><br>
        <input type="submit" value="Eliminar" id="eliminarProyecto" class="btn" >
        <br>
        <br>
    </form>
    <div>
        <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
    </div>
</div>
<table id="table_id" class="display">
    <thead>
    <tr>
        <th>N° Registro</th>
        <th>Versión</th>
        <th>Titulo</th>
        <th>Periodo</th>
        <th>Estudiante #1</th>
        <th>Cédula</th>
        <th>Estudiante #2</th>
        <th>Cédula</th>
    </tr>
    </thead>
    <tbody>
    <?php
    // Si el usuario tiene permisos
    if($_SESSION['verify']==true){
        foreach ($cursor as $element){

            echo "<tr>";
            echo "<td>".$element->id_register."</td>";
            if($element->version=="first_version")
            {
                echo "<td>1era versión</td>";
            }
            else{
                echo "<td>2da versión</td>";
            }
            echo "<td>".$element->title."</td>";
            echo "<td>".$element->term_code."</td>";
            echo "<td>".$element->student_one_name."</td>";
            echo "<td>".$element->student_one_id."</td>";
            echo "<td>".$element->student_two_name."</td>";
            echo "<td>".$element->student_two_id."</td>";
            echo "</tr>";
        }
    }


    ?>
    </tbody>
</table>



</body>
</html>
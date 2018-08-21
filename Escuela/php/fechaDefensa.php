<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/jquery-3.3.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fechas de Defensa</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/styleBasic.css">
    <link rel="stylesheet" type="text/css" href="../css/datatables.css">
    <script src="../js/datatables.js"></script>
    <script src="../js/magic.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <header>
        <img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
    </header>
    <h1 style="text-align: center">Establecer Fecha de Defensa</h1>
    <br>
    <div class="form fix">
        <form action="../php/defensa.php" method="post" id="defensa">
            <label for="id_register" id="id_registerfd">N° Registro <input type="text" name="id_register" id="id_register" class="form-control" required></label>
            <br>
            <label for="defense_date">Fecha de Defensa <input type="date" id="defense_date" name="defense_date" class="form-control" required></label>
            <br><br>
            <input type="submit" value="Actualizar" id="subirFechaDefensa" class="btn">
            <br>
            <br>
        </form>
    </div>
    <div>
        <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
    </div>

<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();


?>

<table id="table_id" class="display">
        <thead>
                <tr>
                    <th>N° Registro</th>
                    <th>Versión</th>
                    <th>Titulo</th>
                    <th>Estudiante N° 1</th>
                    <th>Cédula</th>
                    <th>Estudiante N° 2</th>
                    <th>Cédula</th>
                    <th>Fecha Defensa</th>
                 </tr>
        </thead>
        <tbody>

<?php
    // Si el usuario tiene permisos
    if($_SESSION['verify']==true) {

        $projectsA = $mongo->getProjectsInFormatA();

        $projectsF = $mongo->getProjectsInFormatF();

        foreach ($projectsA as $elementA) {
            foreach ($projectsF as $elementF) {
                // Si existe un proyecto con su version A y F
                if ($elementA->id_register == $elementF->id_register) {
                    echo "<tr>";
                    echo "<td>" . $elementA->id_register . "</td>";
                    if (isset($elementA->version)) {
                        if ($elementA->version == "first_version") {
                            echo "<td>" . "1era Versión" . "</td>";
                        } else {
                            if ($elementA->version == "second_version") {
                                echo "<td>" . "2nda Versión" . "</td>";
                            } else {
                                echo "<td>" . "</td>";
                            }
                        }
                    } else {

                        echo "<td></td>";

                    }

                    echo "<td>" . $elementA->title . "</td>";
                    echo "<td>" . $elementA->student_one_name . "</td>";
                    echo "<td>" . $elementA->student_one_id . "</td>";
                    echo "<td>" . $elementA->student_two_name . "</td>";
                    echo "<td>" . $elementA->student_two_id . "</td>";
                    if (isset($elementA->defense_date)) {
                        echo "<td>" . $elementA->defense_date . "</td>";
                    } else {
                        echo "<td> </td>";
                    }
                    echo "</tr>";

                }
            }
        }
    }
?>
</tbody>
</table>



</body>
</html>
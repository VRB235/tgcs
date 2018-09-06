<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/jquery-3.3.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cargar Notas</title>
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
    <div class="form fix">
        <form action="../php/notas.php" method="post" id="notas">
            <h1 style="text-align: center">Cargar Notas</h1>
            <br>
            <label for="id_register" id="id_registerNotas">N° Registro <input type="text" name="id_register" id="id_register" class="form-control" required></label>
            <label for="note">Nota : <input type="number" min="0" max="20" id="note" name="note" class="form-control" required></label>
            <label for="mention">Mención:
                <select name="mention" id="mention" class="form-control">
                    <option value="-">-</option>
                    <option value="Publicacion">Publicación</option>
                </select>
            </label>

            <br><br>
            <input type="submit" value="Actualizar" id="cargarNotas" class="btn">
            <br>
            <br>
        </form>
        <div>
            <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
        </div>
    </div>


<?php

    require_once ("mongoDB.php");
    
    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    
    $mongo = new mongoDataBase();
    
    $projectsA = $mongo->getProjectsInFormatA();
    $projectsF = $mongo->getProjectsInFormatF();
    
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
                    <th>Nota</th>
                    <th>Mención</th>
                 </tr>
        </thead>
        <tbody>

<?php
    if($_SESSION['verify']==true) {
        foreach ($projectsA as $elementA) {
            foreach ($projectsF as $elementF) {
                // Si el proyecto esta en formato A y D
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
                    echo "<td>" . $elementF->title . "</td>";
                    echo "<td>" . $elementF->student_one_name . "</td>";
                    echo "<td>" . $elementF->student_one_id . "</td>";
                    echo "<td>" . $elementF->student_two_name . "</td>";
                    echo "<td>" . $elementF->student_two_id . "</td>";
                    if (isset($elementA->note)) {
                        echo "<td>" . $elementA->note . "</td>";
                    } else {
                        echo "<td> </td>";
                    }
                    if (isset($elementA->mention)) {
                        echo "<td>" . $elementA->mention . "</td>";
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
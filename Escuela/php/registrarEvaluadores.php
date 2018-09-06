<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../js/jquery-3.3.1.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Evaluadores</title>
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
    <h1 style="text-align: center">Asignar Evaluadores</h1>
    <br>
    <div class="form fix">
        <form action="../php/evaluadores.php" method="post" id="evaluadores">
            <div class="formContent">
                <label for="id_register">N° Registro <input type="text" name="id_register" id="id_register" class="form-control"></label>
                <label for="version">Versión:
                    <select name="version" id="version" class="form-control">
                        <option value="-">-</option>
                        <option value="first_version">Versión 1</option>
                        <option value="second_version">Versión 2</option>
                    </select>
                </label>
                <br>
                <br>
                <label for="jury_one_fullname">Nombre Jurado # 1</label><input type="text" class="form-control" id="jury_one_fullname" name="jury_one_fullname" required>

                <label for="jury_two_fullname">Nombre Jurado # 2</label><input type="text" class="form-control" id="jury_two_fullname" name="jury_two_fullname" required>

                <label for="jury_three_fullname">Nombre Jurado # 3</label><input type="text" class="form-control" id="jury_three_fullname" name="jury_three_fullname" required>
                <br><br>
                <input type="submit" value="Subir Evaluadores" id="subirEvaluadores" class="btn">
                <br>
                <br>
            </div>
        </form>
    </div>

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
                    <th>Jurado #1</th>
                    <th>Jurado #2</th>
                    <th>Jurado #3</th>
                 </tr>
        </thead>
        <tbody>

        
<?php

    require_once("mongoDB.php");


    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();
    $cursor = $mongo->getProjectsInFormatAApprove();

    if($_SESSION['verify']==true) {


        // Se llena la tabla con los datos de los registros obtenidos
        foreach ($cursor as $element) {
            echo "<tr>";
            echo "<td>" . $element->id_register . "</td>";
            if (isset($element->version)) {
                if ($element->version == "first_version") {
                    echo "<td>Versión 1</td>";
                }
                if ($element->version == "second_version") {
                    echo "<td>Versión 2</td>";
                }

            } else {
                echo "<td>" . " " . "</td>";
            }
            echo "<td>" . $element->title . "</td>";
            echo "<td>" . $element->student_one_name . "</td>";
            echo "<td>" . $element->student_one_id . "</td>";
            echo "<td>" . $element->student_two_name . "</td>";
            echo "<td>" . $element->student_two_id . "</td>";
            echo "<td>" . $element->jury_one_fullname . "</td>";
            echo "<td>" . $element->jury_two_fullname . "</td>";
            echo "<td>" . $element->jury_three_fullname . "</td>";
            echo "</tr>";
        }
    }

?>
<div>
    <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
</div>
</tbody>
</table>

</body>
</html>
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
    <h1 style="text-align: center">Aprobar Tutor de Proyecto</h1>
    <br>
    <div class="form fix">
        <form action="../php/tutores.php" method="post" id="tutor">
            <div class="formContent">
                <label for="id_register" id="tutorid">N° Registro <input type="text" name="id_register" id="id_register" class="form-control"></label>
                <label for="version"> Version
                    <select name="version" id="version"  class="form-control">
                        <option value="-">-</option>
                        <option value="first_version">Version 1</option>
                        <option value="second_version">Version 2</option>
                    </select>
                </label>
                <br><br>
                <label for="tutor_extern">Externo : </label>
                <select name="tutor_extern" id="tutor_extern" class="form-control">
                    <option value="No Aplica">No Aplica</option>
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                <label for="tutor_decision">Decision :</label>
                <select name="tutor_decision" id="tutor_decision" class="form-control">
                    <option value="yes">Si</option>
                    <option value="no">No</option>
                </select>
                <br><br>
                <input type="submit" value="Actualizar" id="subirTutor" class="btn">
                <br>
                <br>
            </div>
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

    $cursor = $mongo->getProjectsInFormatAApprove();

?>

<table id="table_id" class="display">
        <thead>
                <tr>
                    <th>N° Registro</th>
                    <th>Version</th>
                    <th>Titulo</th>
                    <th>Estudiante N° 1</th>
                    <th>Cedula</th>
                    <th>Estudiante N° 2</th>
                    <th>Cedula</th>
                    <th>Tutor</th>
                    <th>Cedula</th>
                    <th>Aprovado</th>
                    <th>Externo</th>
                    <th>Fecha Aprobado</th>
                 </tr>
        </thead>
        <tbody>
<?php

    // Llena un tabla con todos los registros traidos
    foreach ($cursor as $element){
        echo "<tr>";
        echo "<td>".$element->id_register."</td>";
        // Si existe version quiere decir que es anual
        if (isset($element->version)) {
            if($element->version=="first_version"){
                echo "<td>Version 1</td>";
            }
            if($element->version=="second_version"){
                echo "<td>Version 2</td>";
            }
        }
        else{
            echo "<td>"." "."</td>";
        }
        echo "<td>".$element->title."</td>";
        echo "<td>".$element->student_one_name."</td>";
        echo "<td>".$element->student_one_id."</td>";
        echo "<td>".$element->student_two_name."</td>";
        echo "<td>".$element->student_two_id."</td>";
        echo "<td>".$element->tutor_name."</td>";
        echo "<td>".$element->tutor_id."</td>";

        if($element->tutor_approve=="yes"){
                echo "<td>Si</td>";
        }
        else{
            if($element->tutor_approve=="no"){
                echo "<td>No</td>";
            }
            echo "<td>-</td>";
        }

        if($element->tutor_extern=="yes"){
            echo "<td>Si</td>";
        }
        else{
            if($element->tutor_extern=="no"){
                echo "<td>No</td>";
            }
            else{
                echo "<td>-</td>";
            }

        }
        if(isset($element->tutor_approve_date)){
            echo "<td>".$element->tutor_approve_date."</td>";
        }
        else{
            echo "<td> </td>";
        }
        echo "</tr>";
    }

?>

</body>
</html>

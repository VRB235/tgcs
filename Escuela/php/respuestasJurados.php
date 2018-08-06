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
    <center><img src="../../Estudiante/recursos/Logo-UCAB-04.png"></center>
    <h1 style="text-align: center">Cargar Respuestas de Jurados</h1>
    <br>
    <div class="form fix">
        <form action="../php/jurados.php" method="post" id="jurados">
            <label for="id_register" id="id_registerj">N° Registro <input type="text" name="id_register" id="id_register" class="form-control" required></label>
            <label for="version"> Version
                <select name="version" id="version" class="form-control">
                    <option value="-">-</option>
                    <option value="first_version">Version 1</option>
                    <option value="second_version">Version 2</option>
                </select>
            </label>
            <br><br>
            <label for="jury_fullname">Nombre </label><input type="text" id="jury_fullname" name="jury_fullname" class="form-control" required>

            <label for="jury_decision"></label>
            <select name="jury_decision" id="jury_decision" class="form-control">
                <option value="approve">Aprobado</option>
                <option value="denied">Negado</option>
                <option value="approve_observations">Devuelto Para Correcciones</option>
            </select><br><br>
            <input type="submit" value="Actualizar" id="subirJurados" class="btn">
            <br>
            <br>
        </form>
    </div>

    


<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new  mongoDataBase();

?>

<table id="table_id" class="display">
        <thead>
                <tr>
                    <th>N° Registro</th>
                    <th>Version</th>
                    <th>Titulo</th>
                    <th>Jurado #1</th>
                    <th>Respuesta</th>
                    <th>Jurado #2</th>
                    <th>Respuesta</th>
                    <th>Jurado #3</th>
                    <th>Respuesta</th>
                 </tr>
        </thead>
        <tbody>

        
<?php

    $cursor = $mongo->getProjectsInFormatAApprove();

    foreach ($cursor as $element){
        echo "<tr>";
        echo "<td>".$element->id_register."</td>";
        // Si tiene version quiere decir que es anual
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
        echo "<td>".$element->jury_one_fullname."</td>";
        if($element->jury_one_status=="approve"){
            echo "<td>Aprobado</td>";
        }
        if($element->jury_one_status=="denied"){
            echo "<td>Negado</td>";
        }
        if($element->jury_one_status=="approve_observations"){
            echo "<td>Devuelto para Correcciones</td>";
        }
        if($element->jury_one_status==NULL){
            echo "<td>-</td>";
        }

        echo "<td>".$element->jury_two_fullname."</td>";
        if($element->jury_two_status=="approve"){
            echo "<td>Aprobado</td>";
        }
        if($element->jury_two_status=="denied"){
            echo "<td>Negado</td>";
        }
        if($element->jury_two_status=="approve_observations"){
            echo "<td>Devuelto para Correcciones</td>";
        }
        if($element->jury_two_status==NULL){
            echo "<td>-</td>";
        }

        echo "<td>".$element->jury_three_fullname."</td>";
        if($element->jury_three_status=="approve"){
            echo "<td>Aprobado</td>";
        }
        if($element->jury_three_status=="denied"){
            echo "<td>Negado</td>";
        }
        if($element->jury_three_status=="approve_observations"){
            echo "<td>Aprovado c/Observaciones</td>";
        }
        if($element->jury_three_status==NULL){
            echo "<td>-</td>";
        }

        echo "</tr>";
    }


?>
<div>
    <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
</div>
</tbody>
</table>

</body>
</html>
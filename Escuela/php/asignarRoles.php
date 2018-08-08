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
<h1 style="text-align: center">Asignar Roles de Jurados</h1>
<br>
<div class="form fix">
    <form action="../php/roles.php" method="post" id="roles">
        <label for="id_register" id="id_registerju">N° Registro <input type="text" name="id_register" id="id_register" class="form-control" required></label>
        <br>
        <label for="jury_fullname">Nombre </label><input type="text" name="jury_fullname" id="jury_fullname" class="form-control" required>
        <label for="jury_rol">Rol </label>
        <select name="jury_rol" id="jury_rol" class="form-control">
            <option value="principal">Principal</option>
            <option value="suplente">Suplentes</option>
        </select>
        <br><br>
        <input type="submit" value="Actualizar" id="subirRoles" class="btn">
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
        <th>Rol</th>
        <th>Jurado #2</th>
        <th>Rol</th>
        <th>Jurado #3</th>
        <th>Rol</th>
    </tr>
    </thead>
    <tbody>


    <?php

    $mongo = new mongoDataBase();

    $projectsA = $mongo->getProjectsInFormatA();
    $projectsF = $mongo->getProjectsInFormatF();


    foreach ($projectsA as $projectA){
        foreach ($projectsF as $projectF){
            // Si el id del proyecto es distinto a null quiere decir que el proyecto ya fue aprobado
            if($projectA->id_register!=null){
                // Si se tiene formato A y F de ese proyecto
                if($projectA->id_register==$projectF->id_register){
                    echo "<tr>";
                    echo "<td>".$projectA->id_register."</td>";
                    if(isset($projectA->version))
                    {
                        if($projectA->version=="first_version"){
                            echo "<td>"."1era Version"."</td>";
                        }
                        else{
                            if($projectA->version=="second_version"){
                                echo "<td>"."2nda Version"."</td>";
                            }
                            else{
                                echo "<td>"."</td>";
                            }
                        }
                    }
                    else{
                        echo "<td>"."</td>";
                    }

                    echo "<td>".$projectA->title."</td>";
                    echo "<td>".$projectA->jury_one_fullname."</td>";
                    if(isset($projectA->jury_one_rol)){
                        echo "<td>".$projectA->jury_one_rol."</td>";
                    }
                    else{
                        echo "<td>-</td>";
                    }
                    echo "<td>".$projectA->jury_two_fullname."</td>";
                    if(isset($projectA->jury_two_rol)){
                        echo "<td>".$projectA->jury_two_rol."</td>";
                    }
                    else{
                        echo "<td>-</td>";
                    }
                    echo "<td>".$projectA->jury_three_fullname."</td>";
                    if(isset($projectA->jury_three_rol)){
                        echo "<td>".$projectA->jury_three_rol."</td>";
                    }
                    else{
                        echo "<td>-</td>";
                    }
                    echo "</tr>";
                }
            }
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
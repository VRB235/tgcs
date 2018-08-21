<?php

    require_once ("credenciales.php");
    require_once ("mongoDB.php");


    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new MongoDataBase();
    $cursor = $mongo->getNotApproveProjects();
    $cursor2 = $cursor;
    $format = "todos";

    // Si el metodo de request fue POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST["formatAAnual"])){
            $format = "formatAAnual";
        }
        if(isset($_POST["formatFAnual"])){
            $format = "formatFAnual";
        }
        if(isset($_POST["formatASemestral"])){
            $format = "formatASemestral";
        }
        if(isset($_POST["formatFSemestral"])){
            $format = "formatFSemestral";
        }
        if(isset($_POST["todos"])){
            $format = "todos";
        }

    }



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
    <script src="../js/verify.js"></script>
</head>
<body>
<header>
    <img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
</header>
<div>
    <a href="../index.html" class="regresar"><button type="button" class="btn btn-outline-primary">Regresar</button></a>
</div>
<div class="">
    <form action="#" method="post">
        <div class="buttoms">
            <button type="submit" class="btn <?php if($format=="todos"){echo "press";}?>" name="todos" id="todos" >Todos</button>
            <button type="submit" class="btn <?php if($format=="formatAAnual"){echo "press";}?>" name="formatAAnual" id="formatAAnual" >Formato A Anual</button>
            <button type="submit" class="btn <?php if($format=="formatFAnual"){echo "press";}?>" name="formatFAnual" id="formatFAnual" >Formato F Anual</button>
            <button type="submit" class="btn <?php if($format=="formatASemestral"){echo "press";}?>" name="formatASemestral" id="formatASemestral" >Formato A Semestral</button>
            <button type="submit" class="btn <?php if($format=="formatFSemestral"){echo "press";}?>" name="formatFSemestral"  id="formatFSemestral" >Formato F Semestral</button>
        </div>
    <ul class="lista">

        <?php

        // Si tiene permisos
        if($_SESSION['verify']==true)
        {
            // Se llena el combobox con todos los registros obtenidos

            foreach ($cursor as $element){
                if($element->format==$format || $format=="todos"){?>

                <li><a href="reconstructForm.php?id=<?php echo $element->id?>"><p><spam>Titulo: </spam><?php echo $element->title;?>
                <br><br><spam>Estudiantes: </spam><?php if($element->student_two_name!=""){ echo $element->student_one_name." y ".$element->student_two_name;}else{
                                                echo $element->student_one_name; }

         ?><br><br><spam>Formato: </spam><?php if($element->format=="formatAAnual"){echo "A Anual";}
                                                if($element->format=="formatASemestral"){echo "A Semestral";}
                                                if($element->format=="formatFAnual"){echo "F Anual";}
                                                if($element->format=="formatFSemestral"){echo "F Semestral";}?>
                        </p></a></li>
        <?php }}}
        ?>

    </ul>

</div>
</form>


<footer>
    <div>
        <p>
            Universidad Católica Andres Bello - 2018
        </p>
    </div>
</footer>


</body>
</html>
<?php

    require_once ("credenciales.php");
    require_once ("mongoDB.php");
    include_once ("verify.php");


    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    $project = $_SESSION['element'];

    $mongo = new MongoDataBase();
    $cursor = $mongo->findProject($project->id);

    // Si el boton de aprobar fue seleccionado
    if(isset($_POST['aprobar'])){

        $verify = new Verify();
        foreach ($cursor as $element){
            // Si el term code corresponde a uno anual
            if($verify->verifyTermCode($_POST['termcode'],$element->format)){

                $mongo->approveProject($element->id,$_POST["IDRegister"],$_POST["deliverDate"],$_POST["termcode"]);
                header("Location: ../php/aprobarProyectos.php");
            }
            else{
                $_SESSION['title'] = TITLE_WRONG_TERMCODE;
                $_SESSION['message'] = MESSAGE_WRONG_TERMCODE;
                header("Location: ../php/mensaje.php");
            }
        }

    }
    else{
        // Si el boton de rechazado fue seleccionado
        if(isset($_POST['rechazar'])){
            foreach ($cursor as $element){
                $mongo->rejectProject($element->id);
                header("Location: ../php/aprobarProyectos.php");
            }
        }
    }


?>
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
                echo "aprobado";
                header("Location: ../php/aprobarProyectos.php");
            }
            else{
                echo "no aprobado";
                $_SESSION['title'] = $_SESSION["title_wrong_termcode"];
                $_SESSION['message'] = $_SESSION["message_wrong_termcode"];
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





/*

    // Si el boton de aprobar fue seleccionado
    if(isset($_POST['aprobar'])){


        }


    }
    else {
        // Si el boton de rechazado fue seleccionado
        if(isset($_POST['rechazar'])){
            // Se elimina el registro de la base de datos
            $collection->update($arr_find,array('$set'=>array("status"=>'rejected')));
            header("Location: ../php/aprobarProyectos.php");
        }
    }


}catch(Exception $e){
    $_SESSION['title'] = $_TITLE_MESSAGE_FAIL_CONNECTION;
    $_SESSION['message'] = $_MESSAGE_FAIL_CONNECTION;
    header("Location: ../php/mensaje.php");
}*/

?>
<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    if($_SESSION['verify']==true){
        // Si el campo de nro de registro no esta vacio
        if(!empty($_POST["id_register"])&&isset($_POST["id_register"])){

            $mongo = new mongoDataBase();

            // Verifica si existe el proeycto
            if($mongo->verifyIfExist($_POST["id_register"],$_POST["version"])){
                $mongo->approveTutor($_POST["id_register"],$_POST["version"],$_POST["tutor_extern"],$_POST["tutor_decision"]);
                header("Location: ../php/tutorProyecto.php");
            }
            else{
                $_SESSION['title'] = TITLE_FAIL_CONNECTION;
                $_SESSION['message'] = MESSAGE_MONGO_EXCEPTION;
                header("Location: ../php/mensaje.php");
            }


        }
    }
    else{
        $_SESSION["title"] = TITLE_NO_ACCESS;
        $_SESSION["message"] = MESSAGE_NO_ACCESS;
        header("Location: ./mensaje.php");
    }


?>
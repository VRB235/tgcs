<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    // Si el campo de nro de registro no esta vacio
    if(!empty($_POST["id_register"])&&isset($_POST["id_register"])){

        $mongo = new mongoDataBase();

        // Verifica si existe el proeycto
        if($mongo->verifyIfExist($_POST["id_register"],$_POST["version"])){
            $mongo->approveTutor($_POST["id_register"],$_POST["version"],$_POST["tutor_extern"],$_POST["tutor_decision"]);
        }
        else{
            $_SESSION['title'] = $_SESSION["title_fail_connetion"];
            $_SESSION['message'] = $_SESSION["message_mongo_exception"];
            header("Location: ../php/mensaje.php");
        }


    }

?>
<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    // Si el usuario tiene permisos
    if($_SESSION['verify']==true) {

        // Si los campos de nro de registro y term code no estan vacios
        if(!empty($_POST['term_code']) && !empty($_POST['id_registerr'])){

            $mongo = new mongoDataBase();

            // Se no se selecciona version se supondra que el proyecto es de periodo semestral
            if($_POST['version']!='-'){

                // Si no existe el proyecto
                if($mongo->verifyIfExist($_POST["id_registerr"],$_POST["versionn"])){
                    // Elimina el proyecto de la base de datos
                    $mongo->removeProject($_POST["id_registerr"],$_POST["term_code"],$_POST["versionn"]);
                    $_SESSION["title"] = TITLE_PROJEC_DELETED;
                    $_SESSION["message"] = MESSAGE_PROJECT_DELETED;
                    header("Location: ./mensaje.php");
                }
                else{
                    $_SESSION["title"] = TITLE_NOT_FOUND_PROJECT;
                    $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECT;
                    header("Location: ./mensaje.php");
                }
            }
            else{
                if($mongo->verifyIfExist($_POST["id_registerr"],$_POST["versionn"])){
                    // Elimina el proyecto de la base de datos
                    $mongo->removeProject($_POST["id_registerr"],$_POST["term_code"],$_POST["versionn"]);
                    $_SESSION["title"] = TITLE_PROJEC_DELETED;
                    $_SESSION["message"] = MESSAGE_PROJECT_DELETED;
                    header("Location: ./mensaje.php");
                }
                else{

                    $_SESSION["title"] = TITLE_NOT_FOUND_PROJECT;
                    $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECT;
                    header("Location: ./mensaje.php");
                }

            }

        }

    }
    else{
        $_SESSION["title"] = TITLE_NO_ACCESS;
        $_SESSION["message"] = MESSAGE_NO_ACCESS;
        header("Location: ./mensaje.php");
    }





?>
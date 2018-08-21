<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    if($_SESSION['verify']==true){
        // Si el campo nota no esta vacio y la variable existe
        if(!empty($_POST["note"])&&isset($_POST["note"])){
            // Si el campo mencion no esta vacio y la variable existe
            if(!empty($_POST["mention"])&&isset($_POST["mention"])){
                // Si el campo nro de registro no esta vacio y la variable existe
                if(!empty($_POST["id_register"]) && isset($_POST["id_register"])){

                    $mongo = new mongoDataBase();
                    // Verifica que el periodo sea semestral
                    if($mongo->verifyPeriod($_POST["id_register"])=="semestral"){
                        $mongo->setProjectNoteSemestral($_POST["id_register"],$_POST["note"],$_POST["mention"]);
                    }
                    else{
                        // Verifica que el periodo sea anual
                        if($mongo->verifyPeriod($_POST["id_register"])=="anual"){
                            // Verifica que existe un 1era version
                            if($mongo->verifyIfFirstVersionFromProjectExist($_POST["id_register"])){
                                $mongo->setProjectNoteAnual($_POST["id_register"],$_POST["note"],$_POST["mention"],"first_version");
                            }
                            else{
                                // Verifica si existe 2da version
                                if($mongo->verifyIfSecondVersionFromProjectExist($_POST["id_register"])){
                                    $mongo->setProjectNoteAnual($_POST["id_register"],$_POST["note"],$_POST["mention"],"second_version");
                                }
                            }
                        }
                        else{
                            $_SESSION["title"] = TITLE_WRONG_TERMCODE;
                            $_SESSION["message"] = MESSAGE_WRONG_TERMCODE;
                            header("Location: ./mensaje.php");
                        }
                    }
                    header("Location: ./cargarNotas.php");
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
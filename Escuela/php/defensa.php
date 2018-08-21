<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    // Si el usuario tiene permisos
    if($_SESSION['verify']==true){
        // Si el vampo fecha de defensa no esta vacio y exite la variable
        if(!empty($_POST["defense_date"])&&isset($_POST["defense_date"])){
            // Si el campo nro de registro no esta vacio y existe la variable
            if(!empty($_POST["id_register"]) && isset($_POST["id_register"])) {
                $mongo = new mongoDataBase();
                // Si el termcode corresponde a un termcode semestral
                if($mongo->verifyPeriod($_POST["id_register"])=="semestral"){
                    $mongo->setDefenseDateSemestral($_POST["id_register"],$_POST["defense_date"]);
                    header("Location: ./fechaDefensa.php");
                }
                else{
                    // Si el termcode corresponde a un termcode anual
                    if($mongo->verifyPeriod($_POST["id_register"])=="anual"){
                        // Si existe segunda version del proyecto
                        if($mongo->verifyIfSecondVersionFromProjectExist($_POST["id_register"])){
                            $mongo->setDefenseDateAnual($_POST["id_register"],$_POST["defense_date"],"second_version");
                            header("Location: ./fechaDefensa.php");
                        }
                        else{
                            // Si existe 1era version del proyecto
                            if($mongo->verifyIfFirstVersionFromProjectExist($_POST["id_register"])){
                                $mongo->setDefenseDateAnual($_POST["id_register"],$_POST["defense_date"],"first_version");
                                header("Location: ./fechaDefensa.php");
                            }
                        }
                    }
                    else{
                        $_SESSION["title"] = TITLE_NOT_FOUND_PROJECT;
                        $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECT;
                        header("Location: ./mensaje.php");
                    }
                }

            }
        }
    }




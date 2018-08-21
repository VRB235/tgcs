<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    // SI el usuario tiene permisos
    if($_SESSION['verify']==true){
        // Si el nombre del jurado no esta vacio
        if(!empty($_POST["jury_fullname"])&&isset($_POST["jury_fullname"])){
            // Si el Nro de Registro no esta vacio
            if(!empty($_POST["id_register"]) && isset($_POST["id_register"])){

                $mongo = new mongoDataBase();
                // Si existe el proyecto
                if($mongo->verifyIfExist($_POST["id_register"],$_POST["version"])){

                    $element = $mongo->getProject($_POST["id_register"],$_POST["version"]);

                    $faltan = 0;
                    // Si el jurado # 1 no ha sido seleccionado
                    if($element["jury_one_status"]==null){
                        $faltan=$faltan+1;
                    }
                    // Si el jurado # 2 no ha sido seleccionado
                    if($element["jury_two_status"]==null){
                        $faltan=$faltan+1;
                    }
                    // Si el jurado # 3 no ha sido seleccionado
                    if($element["jury_three_status"]==null){
                        $faltan=$faltan+1;
                    }

                    $result = $mongo->setJuryStatus($_POST["id_register"],$_POST["version"],$_POST["jury_fullname"],$_POST["jury_decision"]);

                    if($result!=null){

                        if($faltan<=1){

                            $mongo->setApprovalDate($_POST["id_register"],$_POST["version"]);
                        }
                        header("Location: ./respuestasJurados.php");
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







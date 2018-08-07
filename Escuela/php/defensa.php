<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    // Si el vampo fecha de defensa no esta vacio y exite la variable
    if(!empty($_POST["defense_date"])&&isset($_POST["defense_date"])){
        // Si el campo nro de registro no esta vacio y existe la variable
        if(!empty($_POST["id_register"]) && isset($_POST["id_register"])) {
            $mongo = new mongoDataBase();
            if($mongo->verifyPeriod($_POST["id_register"])=="semestral"){
                $mongo->setDefenseDateSemestral($_POST["id_register"],$_POST["defense_date"]);

            }
            else{
                if($mongo->verifyPeriod($_POST["id_register"])=="anual"){

                    if($mongo->verifyIfSecondVersionFromProjectExist($_POST["id_register"])){
                        $mongo->setDefenseDateAnual($_POST["id_register"],$_POST["defense_date"],"second_version");
                    }
                    else{
                        if($mongo->verifyIfFirstVersionFromProjectExist($_POST["id_register"])){
                            $mongo->setDefenseDateAnual($_POST["id_register"],$_POST["defense_date"],"first_version");
                        }
                    }
                }
            }
            header("Location: ./fechaDefensa.php");
        }
    }


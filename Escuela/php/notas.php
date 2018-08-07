<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    // Si el campo nota no esta vacio y la variable existe
    if(!empty($_POST["note"])&&isset($_POST["note"])){
        // Si el campo mencion no esta vacio y la variable existe
        if(!empty($_POST["mention"])&&isset($_POST["mention"])){
            // Si el campo nro de registro no esta vacio y la variable existe
            if(!empty($_POST["id_register"]) && isset($_POST["id_register"])){

                $mongo = new mongoDataBase();

                if($mongo->verifyPeriod($_POST["id_register"])=="semestral"){
                    echo "semestral";
                    $mongo->setProjectNoteSemestral($_POST["id_register"],$_POST["note"],$_POST["mention"]);
                }
                else{
                    if($mongo->verifyPeriod($_POST["id_register"])=="anual"){
                        echo "anual";
                        if($mongo->verifyIfFirstVersionFromProjectExist($_POST["id_register"])){
                            echo "1rst version";
                            $mongo->setProjectNoteAnual($_POST["id_register"],$_POST["note"],$_POST["mention"],"first_version");
                        }
                        else{
                            if($mongo->verifyIfSecondVersionFromProjectExist($_POST["id_register"])){
                                echo "second_version";
                                $mongo->setProjectNoteAnual($_POST["id_register"],$_POST["note"],$_POST["mention"],"second_version");
                            }
                        }
                    }
                }
                header("Location: ./cargarNotas.php");
            }
        }
    }




?>
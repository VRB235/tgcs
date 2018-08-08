<?php

    include_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    // Si el nombre del jurado # 1 no esta vacio y la variable existe
    if(!empty($_POST["jury_one_fullname"])&&isset($_POST["jury_one_fullname"])){
        // Si el nombre del jurado # 2 no esta vacio y la variable existe
        if(!empty($_POST["jury_two_fullname"])&&isset($_POST["jury_one_fullname"])){
            // Si el nombre del jurado # 3 no esta vacio y la variable existe
            if(!empty($_POST["jury_three_fullname"])&&isset($_POST["jury_three_fullname"])){
                // Si el id_register no esta vacio y la variable existe
                if(!empty($_POST["id_register"]) && isset($_POST["id_register"])){
                    $mongo = new mongoDataBase();
                    // Si es semestral
                    $mongo->setJuryOnProject($_POST["version"],$_POST["id_register"],$_POST["jury_one_fullname"]
                        ,$_POST["jury_two_fullname"],$_POST["jury_three_fullname"]);
                    header("Location: ../php/registrarEvaluadores.php");
                }
                else{
                    $_SESSION['title'] = TITLE_MESSAGE_INVALID_FIELD;
                    $_SESSION['message'] = MESSAGE_INVALID_FIELD;
                    header("Location: ../php/mensaje.php");
                }
            }
            else{
                $_SESSION['title'] = TITLE_MESSAGE_INVALID_FIELD;
                $_SESSION['message'] = MESSAGE_INVALID_FIELD;
                header("Location: ../php/mensaje.php");
            }
        }
        else{
            $_SESSION['title'] = TITLE_MESSAGE_INVALID_FIELD;
            $_SESSION['message'] = MESSAGE_INVALID_FIELD;
            header("Location: ../php/mensaje.php");
        }
    }
    else{
        $_SESSION['title'] = TITLE_MESSAGE_INVALID_FIELD;
        $_SESSION['message'] = MESSAGE_INVALID_FIELD;
        header("Location: ../php/mensaje.php");
    }

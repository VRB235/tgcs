<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];


    // Si los campos de nro de registro y term code no estan vacios
    if(!empty($_POST['term_code']) && !empty($_POST['id_registerr'])){

        $mongo = new mongoDataBase();

        // Se no se selecciona version se supondra que el proyecto es de periodo semestral
        if($_POST['version']!='-'){

            // Si no existe el proyecto
            if($mongo->verifyIfExist($_POST["id_registerr"],$_POST["version"])){
                // Elimina el proyecto de la base de datos
                $mongo->removeProject($_POST["id_registerr"],$_POST["term_code"],$_POST["version"]);
                echo "Elimnada";
            }
            else{
                echo "No se encontro proyecto";
            }
        }
        else{
            if($mongo->verifyIfExist($_POST["id_registerr"],$_POST["version"])){
                // Elimina el proyecto de la base de datos
                $mongo->removeProject($_POST["id_registerr"],$_POST["term_code"],$_POST["version"]);
                echo "Elimnada";
            }
            else{

                echo "No se encontro proyecto";
            }

        }

    }



?>
<?php

    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    // Si el nombre no esta vacio y existe la variable
    if(!empty($_POST["jury_fullname"])&&isset($_POST["jury_fullname"])) {
        // Si el id_register no esta vacio y existe la variable
        if (!empty($_POST["id_register"]) && isset($_POST["id_register"])) {

            $mongo = new mongoDataBase();

            $mongo->setJuryRols($_POST["id_register"], $_POST["jury_fullname"], $_POST["jury_rol"]);

            header("Location: ../php/asignarRoles.php");

        }
    }



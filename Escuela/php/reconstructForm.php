<?php

    require_once ("credenciales.php");
    require_once ("mongoDB.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();
    $cursor = $mongo->getNotApproveProjects();

    foreach ($cursor as $element){
        // Si es el registro con el id que necesito
        if($_GET['id'] == $element->id){
            // Guardo el registro para usarlo posteriormente para llenar el formulario automaticamente
            $_SESSION['element']=$element;
            // Si es formato A Anual
            if($element->format=='formatAAnual'){
                header('Location: ../php/formatAAnual.php');
            }
            // Si es formato F Anual
            if($element->format=='formatFAnual'){
                header('Location: ../php/formatFAnual.php');
            }
            // Si es formato A Semestral
            if($element->format=='formatASemestral'){
                header('Location: ../php/formatASemestral.php');
            }
            // Si es formato F Semestral
            if($element->format=='formatFSemestral'){
                header('Location: ../php/formatFSemestral.php');
            }
        }
    }




?>
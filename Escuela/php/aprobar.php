<?php

    include_once ("./variables_globales.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();
    $cursor = $mongo->findProject($_GET["id"]);

    /*

        // Si el boton de aprobar fue seleccionado
        if(isset($_POST['aprobar'])){
            // Si existe un registro con ese id
            if($collection->find($arr_find)->count()!=0){
                $cursor = $collection->find($arr_find);
            }

            foreach ($cursor as $doc) {
                if($doc['format']=='formatAAnual') {
                    if(substr($_POST['termcode'],-2)=='10') {
                        $valido = true;
                    }
                    else{
                        $valido = false;
                    }
                }
                if($doc['format']=='formatFAnual') {
                    if(substr($_POST['termcode'],-2)=='10') {
                        $valido = true;
                    }
                    else{
                        $valido = false;
                    }
                }
                if($doc['format']=='formatASemestral') {
                    if(substr($_POST['termcode'],-2)=='25' || substr($_POST['termcode'],-2)=='15') {
                        $valido = true;
                    }
                    else{
                        $valido = false;
                    }
                }
                if($doc['format']=='formatFSemestral') {
                    if(substr($_POST['termcode'],-2)=='25' || substr($_POST['termcode'],-2)=='15') {
                        $valido = true;
                    }
                    else{
                        $valido = false;
                    }
                }

            }
            if($valido)
            {
                // Arreglo para modificar el id_register, date_register y term_code con los datos suminstrados
                // Ademas cambia el estado del proyecto a aprobado para continuar con el proceso
                $arr_nuevos = array('$set' => array("id_register" => $_POST["IDRegister"], 'date_register' => $_POST['deliverDate'], 'term_code' => $_POST['termcode'], 'approve' => "1"));
                // Actualiza el registro en la base de datos
                $collection->update($arr_find, $arr_nuevos);
                header("Location: ../php/aprobarProyectos.php");
            }
            else{
                $_SESSION['title'] = $_TITLE_INVALID_TERMCODE;
                $_SESSION['message'] = $_MESSAGE_INVALID_TERMCODE;
                header("Location: ../php/mensaje.php");
            }

        }
        else {
            // Si el boton de rechazado fue seleccionado
            if(isset($_POST['rechazar'])){
                // Se elimina el registro de la base de datos
                $collection->update($arr_find,array('$set'=>array("status"=>'rejected')));
                header("Location: ../php/aprobarProyectos.php");
            }
        }


    }catch(Exception $e){
        $_SESSION['title'] = $_TITLE_MESSAGE_FAIL_CONNECTION;
        $_SESSION['message'] = $_MESSAGE_FAIL_CONNECTION;
        header("Location: ../php/mensaje.php");
    }*/

?>
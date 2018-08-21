<?php

    require_once ("credenciales.php");
    require_once ("mongoDB.php");
    include_once ("verify.php");
    require_once ("mensajes.php");


    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    $project = $_SESSION['element'];

    $mongo = new MongoDataBase();
    $cursor = $mongo->findProject($project->id);

    if($_SESSION['verify']==true){
        // Si el boton de aprobar fue seleccionado
        if(isset($_POST['aprobar'])){

            $verify = new Verify();
            foreach ($cursor as $element){
                // Si el term code corresponde al formato
                if($verify->verifyTermCode($_POST['termcode'],$element->format)){
                    if($element->format=="formatAAnual"){
                        if(!$mongo->verifyIfExist($_POST["id_register"],$element->version))
                        {
                            $mongo->approveProject($element->id,$_POST["IDRegister"],$_POST["deliverDate"],$_POST["termcode"]);
                            header("Location: ../php/aprobarProyectos.php");
                        }
                        else{
                            $_SESSION["title"]= TITLE_ID_REGISTER_USE;
                            $_SESSION["message"]= MESSAGE_ID_REGISTER_USE;
                            header("Location: ./mensaje.php");
                        }
                    }
                    else{
                        if($element->format=="formatASemestral"){
                            if(!$mongo->verifyIfExist($_POST["id_register"],"-")){
                                $mongo->approveProject($element->id,$_POST["IDRegister"],$_POST["deliverDate"],$_POST["termcode"]);
                                header("Location: ../php/aprobarProyectos.php");
                            }
                            else{
                                $_SESSION["title"]= TITLE_ID_REGISTER_USE;
                                $_SESSION["message"]= MESSAGE_ID_REGISTER_USE;
                                header("Location: ./mensaje.php");
                            }
                        }
                        else{
                            if($element->format=="formatFAnual"){
                                if($mongo->verifyIfExistFormatA($_POST["id_register"],"anual"))
                                {
                                    if(!$mongo->verifyIfExist($_POST["id_register"],$element->format)){
                                        $mongo->approveProject($element->id,$_POST["IDRegister"],$_POST["deliverDate"],$_POST["termcode"]);
                                        header("Location: ../php/aprobarProyectos.php");
                                    }
                                    else{
                                        $_SESSION["title"]= TITLE_ID_REGISTER_USE;
                                        $_SESSION["message"]= MESSAGE_ID_REGISTER_USE;
                                        header("Location: ./mensaje.php");
                                    }
                                }
                                else{
                                    $_SESSION["title"]= TITLE_FORMAT_NOT_FOUND;
                                    $_SESSION["message"]= MESSAGE_FORMAT_NOT_FOUND;
                                    header("Location: ./mensaje.php");
                                }

                            }
                            else{
                                if($element->format=="formatFSemestral"){
                                    if($mongo->verifyIfExistFormatA($_POST["id_register"],"semestral"))
                                    {
                                        if(!$mongo->verifyIfExist($_POST["id_register"],$element->format)){
                                            $mongo->approveProject($element->id,$_POST["IDRegister"],$_POST["deliverDate"],$_POST["termcode"]);
                                            header("Location: ../php/aprobarProyectos.php");
                                        }
                                        else{
                                            $_SESSION["title"]= TITLE_ID_REGISTER_USE;
                                            $_SESSION["message"]= MESSAGE_ID_REGISTER_USE;
                                            header("Location: ./mensaje.php");
                                        }
                                    }
                                    else{
                                        $_SESSION["title"]= TITLE_FORMAT_NOT_FOUND;
                                        $_SESSION["message"]= MESSAGE_FORMAT_NOT_FOUND;
                                        header("Location: ./mensaje.php");
                                    }
                                }

                            }
                        }
                    }


                }
                else{
                    $_SESSION['title'] = TITLE_WRONG_TERMCODE;
                    $_SESSION['message'] = MESSAGE_WRONG_TERMCODE;
                    header("Location: ../php/mensaje.php");
                }
            }

        }
        else{
            // Si el boton de rechazado fue seleccionado
            if(isset($_POST['rechazar'])){
                foreach ($cursor as $element){
                    $mongo->rejectProject($element->id);
                    header("Location: ../php/aprobarProyectos.php");
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
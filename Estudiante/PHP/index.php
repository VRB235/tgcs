<?php

    require_once "./recaptchalib.php";
    include_once ("../PHP/variablesGlobales.php");

    session_start();

    $response = null;
    // Comprueba la clave secreta
    $reCaptcha = new ReCaptcha($_SECRET_KET_RECAPTCHA);

    // Si hubo respuesta del repatcha
    if ($_POST["g-recaptcha-response"]) {
        // Verifica la respuesta
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    // DESCOMENTAR!!!!!
    //$_SESSION['robot'] = true;

    // Si es un robot
    if($response == null && $response->success == null){
        $_SESSION['robot'] = true;
    }
    else{
        $_SESSION['robot'] = false;
    }

    // Probando....
    $_SESSION['robot'] = false;

    // Si no es un robot
    if(!$_SESSION['robot'])
    {
        $_SESSION['period'] = $_POST['period'];
        // Si el periodo es anual y formato A
        if($_POST['period']=='Anual' && $_POST['format']=='formatA'){
            $_SESSION['formato'] = $_POST['format'].$_POST['period'];
            header("Location: ../HTML/formatoAAnual.html");
        }
        else{
            // Si el periodo es anual y formato F
            if($_POST['period']=='Anual' && $_POST['format']=='formatF'){
                $_SESSION['formato'] = $_POST['format'].$_POST['period'];
                header("Location: ../HTML/formatoFAnual.html");
            }
            else{
                // Si el periodo es semestral y formato A
                if($_POST['period']=='Semestral' && $_POST['format']=='formatA'){
                    $_SESSION['formato'] = $_POST['format'].$_POST['period'];
                    header("Location: ../HTML/formatoASemestral.html");
                }
                else{
                    // Si el periodo es semetral y formato D
                    if($_POST['period']=='Semestral' && $_POST['format']=='formatF') {
                        $_SESSION['formato'] = $_POST['format'].$_POST['period'];
                        header("Location: ../HTML/formatoFSemestral.html");
                    }
                }
            }
        }
    }
    else{
        $_SESSION['tltle'] = $_TITLE_ROBOT_MESSAGE;
        $_SESSION['message'] = $_MESSAGE_ROBOT_DETECTED;
        header("Location: ../PHP/mensaje.php");
    }

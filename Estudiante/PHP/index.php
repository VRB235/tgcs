<?php

    require_once "./recaptchalib.php";
    include_once("./mensajes.php");

    session_start();

    $response = null;
    // Comprueba la clave secreta
    $reCaptcha = new ReCaptcha(SECRET_KET_RECAPTCHA);

    // Si hubo respuesta del repatcha
    if ($_POST["g-recaptcha-response"]) {
        // Verifica la respuesta
        $response = $reCaptcha->verifyResponse(
            $_SERVER["REMOTE_ADDR"],
            $_POST["g-recaptcha-response"]
        );
    }

    $_SESSION['robot'] = true;

    // Si es un robot
    if($response == null && $response->success == null){
        $_SESSION['robot'] = true;
    }
    else{
        $_SESSION['robot'] = false;
    }

    // COMENTAR NUEVAMENTE
    $_SESSION['robot'] = false;
    
    // Si no es un robot
    if(!$_SESSION['robot'])
    {
        $_SESSION['register'] = false;
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
        $_SESSION['title'] = TITLE_ROBOT_MESSAGE;
        $_SESSION['message'] = MESSAGE_ROBOT_DETECTED;
        header("Location: ../PHP/mensaje.php");
    }

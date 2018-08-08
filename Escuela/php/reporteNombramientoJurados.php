<?php

    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    require_once ("mongoDB.php");
    require_once ("verify.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();
    $verify = new verify();

    if(count($mongo->getProjectsFormatAAnualAndSemestral($_POST["term_code"]))>0){
        if(count($mongo->getProjectsFormatFAnualAndSemestral($_POST["term_code"]))>0){
            $projectsA = $mongo->getProjectsFormatAAnualAndSemestral($_POST["term_code"]);
            $projectsF = $mongo->getProjectsFormatFAnualAndSemestral($_POST["term_code"]);
        }
        else{
            $_SESSION["title"] = TITLE_NOT_FOUND_PROJECTS;
            $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECTS;
            header("Location: ./mensaje.php");
        }
    }
    else{
        $_SESSION["title"] = TITLE_NOT_FOUND_PROJECTS;
        $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECTS;
        header("Location: ./mensaje.php");
    }

    if($verify->verifyTermCode($_POST["term_code"],"formatAAnual")){
        $periodo = "anual";
    }
    else{
        if($verify->verifyTermCode($_POST["term_code"],"formatASemestral")){
            $periodo="semestral";
        }
        else{
            $_SESSION["title"] = TITLE_WRONG_TERMCODE;
            $_SESSION["message"] = MESSAGE_WRONG_TERMCODE;
            header("Location: ./mensaje.php");
        }
    }


    
    $html2pdf = new Html2Pdf();
    $html = "<page backtop=\"7mm\" backbottom=\"7mm\">";
    $html .= "<table>
                <tr>
                    <td style='margin: 0px;margin-bottom: 5px;padding-left:270px;font-size: 15px;'><strong>Universidad Católica Andres Bello</strong></td>
                </tr>
                <tr>
                    <td style='margin: 0px;margin-bottom: 5px;padding-left:220px;font-size: 15px;'><strong>Facultad de Ciencias Sociales conómicas y Sociales</strong></td>
                </tr>
                <tr>
                    <td style='margin: 0px;margin-bottom: 5px;padding-left:280px;font-size: 15px;'><strong>Escuela de Ciencias Sociales</strong></td>
                </tr>
                <tr>
                    <td style='margin: 0px;margin-bottom: 5px;padding-left:212px;font-size: 15px;'><strong>Nombramiento del Jurado para los Trabajos de Grado</strong></td>
                </tr>
                <tr>
                    <td style='margin: 0px;margin-bottom: 5px;padding-left:265px;font-size: 15px;'><strong>Consejo de Escuela del ".date("d/m/Y", strtotime($_POST["date"]))."</strong></td>
                </tr>
                
              </table>";

    // Si es anual
    if($periodo=="anual"){
        $version = "";
        foreach ($projectsA as $elementA) {
            foreach ($projectsF as $elementF) {
                // Si existe un formato A y F del proyecto
                if($elementA->id_register==$elementF->id_register) {
                    // Si el proyecto tiene:
                    // Fecha de aprobacion
                    // Tutor
                    // Jurados
                    // Respuesta de los Jurados
                    // Roles de los Jurados
                    // Fecha de Defensa
                    if ($elementA->approval_date != "-" && $elementA->tutor_extern != "-" && $elementA->jury_one_fullname != null &&
                        $elementA->jury_two_fullname != null && $elementA->jury_three_fullname != null && $elementA->jury_one_status != null &&
                        $elementA->jury_two_status != null && $elementA->jury_three_status != null && $elementA->jury_one_rol != "-" &&
                        $elementA->jury_two_rol != null && $elementA->jury_three_rol != null && isset($elementA->defense_date) && isset($elementA->version)) {
                        $html .= "<div>";
                        // Si la variable version existe
                        if(isset($elementA->version))
                        {
                            // Si es 1era version
                            if ($elementA->version == 'first_version') {
                                $version = "Versión 1";
                            } else {
                                $version = "Versión 2";
                            }
                        }


                        $html .= "<table style='padding-top: 30px'>
                                        <tr >
                                            <td style='border:solid 1px black;width: 730px;'><strong>N°: </strong>" . $elementA->id_register . "\0\0\0\0\0 <strong>Fecha de Aprobación: </strong>" . $elementA->approval_date . "\0\0\0\0\0 <strong>Version de Proyecto: </strong>" . $version . "</td>
                                        </tr>
                                    </table>";
                        $html .= "<table>
                                                <tr>
                                                    <td style='border:solid 1px black;width: 310px'>
                                                        <table>
                                                            <tr>
                                                                <td style='width: 100px;padding-right: 5px'>" . $elementA->student_one_name . "</td>
                                                                <td style='padding-right: 5px'>" . $elementA->student_one_specialty . "</td>
                                                                <td>" . $elementA->student_one_mention . "</td>
                                                            </tr>
                                                            <tr>
                                                                <td style='width: 100px;padding-right: 5px'>" . $elementA->student_two_name . "</td>
                                                                <td style='padding-right: 5px'>" . $elementA->student_two_specialty . "</td>
                                                                <td>" . $elementA->student_two_mention . "</td>
                                                            </tr>
                                                    
                                                        </table>
                                                    </td>
                                                    <td style='border:solid 1px black;width: 200px'>" . $elementA->title . "</td>
                                                    <td style='border:solid 1px black;width: 200px'><strong>Tutor: </strong>" . $elementA->tutor_name . "<br>
                                                    <strong>Jurado: </strong>" . $elementA->jury_one_fullname . " <br>
                                                    " . $elementA->jury_two_fullname . "<br>
                                                    <strong>Suplente: </strong>" . $elementA->jury_three_fullname . "</td>
                                                </tr>
                                                </table>";
                        $html .= "<table>
                                                <tr>
                                                    <td style='border:solid 1px black; width: 730px'><strong>Fecha Defensa: </strong>" . date("d/m/Y", strtotime($elementA->defense_date))  . "</td>
                                                </tr>
                                                </table></div>";
                        $html .= "<page_footer>" . date('d/m/Y', time()) . "</page_footer>";
                    }
                }
            }
        }
    }
    else{
        foreach ($projectsA as $elementA){
            foreach ($projectsF as $elementF) {
                // Si existe el proyecto en formato A y F
                if($elementA->id_register==$elementF->id_register) {
                    // Si el proyecto tiene:
                    // Fecha de aprobacion
                    // Tutor
                    // Jurados
                    // Respuesta de los Jurados
                    // Roles de los Jurados
                    // Fecha de Defensa
                    if ($elementA->approval_date != "-" && $elementA->tutor_extern != "-" && $elementA->jury_one_fullname != null &&
                        $elementA->jury_two_fullname != null && $elementA->jury_three_fullname != null && $elementA->jury_one_status != null &&
                        $elementA->jury_two_status != null && $elementA->jury_three_status != null && $elementA->jury_one_rol != "-" &&
                        $elementA->jury_two_rol != null && $elementA->jury_three_rol != null && isset($elementA->defense_date)) {
                        $html .= "<div>";

                        $html .= "<table style='padding-top: 30px'>
                                            <tr >
                                                <td style='border:solid 1px black;width: 730px;'><strong>N°: </strong>" . $elementA->id_register . "\0\0\0\0\0 
                                                <strong>Fecha de Entrega: </strong>" . $elementA->date_register . " \0\0\0\0\0 
                                                <strong>Tutor: </strong>" . $elementA->tutor_name . " \0\0\0\0\0
                                                <strong>Fecha de Aprobación: </strong>" . $elementA->approval_date . "</td>
                                            </tr>
                                            </table>";
                        $html .= "<table>
                                            <tr>
                                                <td style='border:solid 1px black;width: 310px'>
                                                    <table>
                                                        <tr>
                                                            <td style='width: 100px;padding-right: 5px'>" . $elementA->student_one_name . "</td>
                                                        </tr>
                                                        <tr>
                                                            <td style='width: 100px;padding-right: 5px'>" . $elementA->student_two_name . "</td>
                                                        </tr>
                                                
                                                    </table>
                                                </td>
                                                <td style='border:solid 1px black;width: 200px'>" . $elementA->title . "</td>
                                                <td style='border:solid 1px black;width: 200px'><strong>Tutor: </strong>" . $elementA->tutor_name . "<br>
                                                <strong>Jurado: </strong>" . $elementA->jury_one_fullname . " <br>
                                                " . $elementA->jury_two_fullname . "<br>
                                                <strong>Suplente: </strong>" . $elementA->jury_three_fullname . "</td>
                                            </tr>
                                            </table>";
                        $html .= "<table>
                                            <tr>
                                                <td style='border:solid 1px black; width: 730px'><strong>Fecha Defensa: </strong>" . date("d/m/Y", strtotime($elementA->defense_date)) . "</td>
                                            </tr>
                                        </table></div>";
                        $html .= "<page_footer>" . date('d/m/Y', time()) . "</page_footer>";
                    }
                }
            }
        }
    }




    $html.="</page>";
    // Agrega el HTML al PDF
    $html2pdf->writeHTML($html);
    // Despliega el PDF
    $html2pdf->output();

<?php

    require '../vendor/autoload.php';
    require_once ("mongoDB.php");
    require_once ("verify.php");

    use Spipu\Html2Pdf\Html2Pdf;

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new  mongoDataBase();
    $verify = new verify();
    
    if($verify->verifyTermCode($_POST["term_code"],"formatAAnual")){
        
        $projectsA = $mongo->getProjectsFormatAAnualByTermCode($_POST["term_code"]);
        
    }
    else{
        
        if($verify->verifyTermCode($_POST["term_code"],"formatASemestral")){

            $projectsA = $mongo->getProjectsFormatASemestralByTermCode($_POST["term_code"]);
            
        }
        else{
            $_SESSION["title"] = TITLE_WRONG_TERMCODE;
            $_SESSION["message"] = MESSAGE_WRONG_TERMCODE;
            header("Location: ./mensaje.php");
        }
        
    }

    // Si el usuario tiene permisos
    if($_SESSION['verify']==true) {
        $html2pdf = new Html2Pdf();
        $html = "<page backtop=\"7mm\" backbottom=\"7mm\">
                   <table>
                        <tr>
                            <td style='font-size: 15px;padding-left: 150px;text-align: center'>PROYECTO DE TRABAJO DE GRADO CONSIDERADOS EN EL <br>CONSEJO DE ESCUELA DE CIENCIAS SOCIALES</td>
                        </tr>
                    </table>";
        $version = "";
        $extern = "";
        $desicion1 = "";
        $desicion2 = "";
        $desicion3 = "";
        foreach ($projectsA as $element) {
            // Si el proyecto tiene:
            // - Fecha de aprobación (Significa que fue emitida una respuesta por los jurados)
            // - Tutor (Significa que se emtio una respuesta sobre el tutor)
            // - Jurados (Significa que ya fueron asignado los jurados)
            // - Respueta de los Jurados (Significa que ya todos los jurados dieron una respuesta)
            if ($element->approval_date != "-" && $element->tutor_extern != "-" && $element->jury_one_fullname != null &&
                $element->jury_two_fullname != null && $element->jury_three_fullname != null && $element->jury_one_status != null &&
                $element->jury_two_status != null && $element->jury_three_status) {
                $html .= "<div><table width='80%'>";
                // Si existe la variable version
                if (isset($element->version)) {
                    // Si es la 1era version
                    if ($element->version == 'first_version') {
                        $version = "Versión 1";
                    } else {
                        $version = "Versión 2";
                    }
                }

                // Si el tutor es externo
                if ($element->tutor_extern == "yes") {
                    $extern = "Si";
                } else {
                    $extern = "No";
                }
                // Si el jurado #1 aprobo el proyecto
                if ($element->jury_one_status == "approve") {
                    $desicion1 = "A";
                }
                // Si el jurado #2 aprobo el proyecto
                if ($element->jury_two_status == "approve") {
                    $desicion2 = "A";
                }
                // Si el jurado #3 aprobo el proyecto
                if ($element->jury_three_status == "approve") {
                    $desicion3 = "A";
                }
                // Si el jurado #1 rechazo el proyecto
                if ($element->jury_one_status == "denied") {
                    $desicion1 = "N";
                }
                // Si el jurado #2 rechazo el proyecto
                if ($element->jury_two_status == "denied") {
                    $desicion2 = "N";
                }
                // Si el jurado #3 rechazo el proyecto
                if ($element->jury_three_status == "denied") {
                    $desicion3 = "N";
                }
                // Si el jurado #1 aprobo con correciones el proyecto
                if ($element->jury_one_status == "approve_observations") {
                    $desicion1 = "D";
                }
                // Si el jurado #2 aprobo con correciones el proyecto
                if ($element->jury_two_status == "approve_observations") {
                    $desicion2 = "D";
                }
                // Si el jurado #3 aprobo con correciones el proyecto
                if ($element->jury_three_status == "approve_observations") {
                    $desicion3 = "D";
                }
                $desicionFinal = "";
                // Si los 3 jurados aprobaron el proyecto
                if ($desicion1 == "A" && $desicion2 == "A" && $desicion3 == "A") {
                    $desicionFinal = "A";
                } else {
                    $desicionFinal = "N";
                }


                $html .= "<tr style='padding: 3px'>
                            <td style='border:solid 1px black;border-left: 3px;border-top: 3px;padding: 8px;'>" . $element->id_register . "<br>
                            <table style='padding-top: 5px;padding-bottom: 5px'>
                                    <tr>
                                        <td style='border: 2px solid black;text-align: center;padding: 5px;padding-left: 20px;padding-right: 20px;'>" . $desicionFinal . "</td>
                                        <td></td>
                                    </tr>
                                </table>" . $version . "<br></td>
                            <td style='width: 620px;padding: 8px;border:solid 1px black; border-top: 3px solid black; border-right: 2px solid black;'><p>" . $element->title . "<br><br><strong>";
                // Si los 3 jurados aprobaron el proyecto
                if ($desicionFinal == "A") {
                    $html .= "Aprobado desde el </strong>" . $element->approval_date . "</p></td>
                         </tr>";
                } else {
                    // Si el formato es A Semestral
                    if ($element->format == 'formatASemestral') {
                        $html .= "Negado el </strong>" . $element->approval_date . "</p></td>
                         </tr>";
                    } else {
                        $html .= "Negado en su </strong>" . $version . "</p></td>
                         </tr>";
                    }

                }
                // Si la variable especialidad y mencion de ambos estudiantes existe
                if (isset($element->student_one_specialty) && isset($element->student_one_specialty) && isset($element->student_one_mention) &&
                    isset($element->student_two_mention)) {
                    $html .= "<tr>
                            <td style='border:solid 1px black;padding: 8px;border-left: 3px solid black'>Alumno(s):</td>
                            <td style='border:solid 1px black;padding: 8px;border-right: 3px solid black'><table><tr><td>" . $element->student_one_name . "</td> <td><strong>Especialidad:</strong>" . $element->student_one_specialty . "</td><td><strong>Mención:</strong>" . $element->student_one_mention . "</td></tr>
                            <tr><td>" . $element->student_two_name . "</td><td><strong>Especialidad:</strong>" . $element->student_two_specialty . "</td><td><strong>Mención:</strong>" . $element->student_two_mention . "</td></tr></table></td>
                        </tr>";
                } else {
                    $html .= "<tr>
                            <td style='border:solid 1px black;padding: 8px;border-left: 3px solid black'>Alumno(s):</td>
                            <td style='border:solid 1px black;padding: 8px;border-right: 3px solid black'><table><tr><td>" . $element->student_one_name . "</td></tr>
                            <tr><td>" . $element->student_two_name . "</td></tr></table></td>
                        </tr>";
                }


                $html .= "<tr>
                            <td style='border:solid 1px black;padding: 8px;border-left: 3px solid black; border-bottom: 3px solid black;'>Tutor:</td>
                            <td style='border:solid 1px black;padding: 8px;border-right: 3px solid black; border-bottom: 3px solid black;'><table><tr><td>" . $element->tutor_name . "</td></tr>
                            </table></td>
                        </tr>";
                $html .= "</table></div>";
                $html .= "<page_footer>" . date('d/m/Y', time()) . "</page_footer>";
            }


        }

        $html .= "</page>";
        // Agrega el HTML al PDF
        $html2pdf->writeHTML($html);
        // Despliega el PDF
        $html2pdf->output('ReporteConsideradosComiteCS.pdf','D');
    }
    else{
        $_SESSION["title"] = TITLE_NO_ACCESS;
        $_SESSION["message"] = MESSAGE_NO_ACCESS;
        header("Location: ./mensaje.php");
    }

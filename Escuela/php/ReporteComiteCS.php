<?php

    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    require_once ("mongoDB.php");
    require_once ("verify.php");

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $verify = new verify();

    $mongo = new mongoDataBase();
    // Verifica que el termcode sea anual
    if($verify->verifyTermCode($_POST["term_code"],"formatAAnual")){

        $projectsA = $mongo->getProjectsFormatAAnual();

    }
    else{
        // Verifiac que el termcode sea semestral
        if($verify->verifyTermCode($_POST["term_code"],"formatASemestral")){

            $projectsA = $mongo->getProjectsFormatASemestral();

        }
        else{
            $_SESSION["title"] = TITLE_WRONG_TERMCODE;
            $_SESSION["message"] = MESSAGE_WRONG_TERMCODE;
            header("Location: ./mensaje.php");
        }

    }

if($_SESSION['verify']==true) {
    $html2pdf = new Html2Pdf();
    $html = "<page backtop=\"7mm\" backbottom=\"7mm\">";
    $html .= "<h1 style='font-size: 15px;'>PROYECTO DE TRABAJO DE GRADO PRESENTADO AL COMITÉ DE TESIS DE CIENCIAS SOCIALES</h1>";
    $version = "";
    $extern = "";
    $desicion1 = "";
    $desicion2 = "";
    $desicion3 = "";
    $i = 1;

    foreach ($projectsA as $element) {
        // Si el proyecto tiene:
        // - Fecha de aprobación (Significa que fue emitida una respuesta por los jurados)
        // - Tutor (Significa que se emtio una respuesta sobre el tutor)
        // - Jurados (Significa que ya fueron asignado los jurados)
        // - Respueta de los Jurados (Significa que ya todos los jurados dieron una respuesta)
        if ($element->approval_date != "-" && $element->tutor_extern != "-" && $element->jury_one_fullname != null &&
            $element->jury_two_fullname != null && $element->jury_three_fullname != null && $element->jury_one_status != null &&
            $element->jury_two_status != null && $element->jury_three_status != null) {
            $html .= "<div><table width='80%'>";
            // Si la variable version existe significa que es un proyecto con periodo anual
            if (isset($element->version)) {
                // Si es 1era version
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
            // Si el jurado #1 rechazo el proyecto
            if ($element->jury_two_status == "denied") {
                $desicion2 = "N";
            }
            // Si el jurado #1 rechazo el proyecto
            if ($element->jury_three_status == "denied") {
                $desicion3 = "N";
            }
            // Si el jurado #1 aprobo con correcciones el proyecto
            if ($element->jury_one_status == "approve_observations") {
                $desicion1 = "D";
            }
            // Si el jurado #1 aprobo con correcciones el proyecto
            if ($element->jury_two_status == "approve_observations") {
                $desicion2 = "D";
            }
            // Si el jurado #1 aprobo con correcciones el proyecto
            if ($element->jury_three_status == "approve_observations") {
                $desicion3 = "D";
            }

            $html .= "<tr style='padding: 3px'>
                    <td style='border:solid 1px black;border-left: 3px;border-top: 3px;padding: 8px;'><p>" . $element->id_register . "<br>" . $version . "<br>
                    " . $element->approval_date . "</p></td>
                    <td style='width: 620px;padding: 8px;border:solid 1px black; border-top: 3px solid black; border-right: 2px solid black;'><p>" . $element->title . "</p></td>
                 </tr>";
            // Si existe la variable especialidad y mencion de ambos estudiantes
            if (isset($element->student_two_specialty) && isset($element->student_one_mention) && isset($element->student_two_specialty)
                && isset($element->student_two_mention)) {
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
                    <td style='border:solid 1px black;padding: 8px;border-left: 3px solid black'>Tutor:</td>
                    <td style='border:solid 1px black;padding: 8px;border-right: 3px solid black'><table><tr><td>" . $element->tutor_name . "</td> <td><strong>Externo:</strong>" . $extern . "</td></tr>
                    </table></td>
                </tr>";
            $html .= "<tr>
                    <td style='border:solid 1px black;padding: 8px;border-left: 3px solid black; border-bottom: 3px solid black'>Jurado:</td>
                    <td style='border:solid 1px black;padding: 8px;border-bottom: 3px solid black; border-right: 3px solid black'>1) " . $element->jury_one_fullname . " <strong>" . $desicion1 . "</strong>
                    2) " . $element->jury_two_fullname . "<strong> " . $desicion2 . "</strong>
                    3) " . $element->jury_three_fullname . "<strong> " . $desicion3 . "</strong>
                    </td>
                </tr>";
            $i += 1;
            $html .= "</table></div>";
            $html .= "<page_footer>" . date('d/m/Y', time()) . "</page_footer>";
        }


    }

    $html .= "</page>";
    // Agrega al PDF el HTML
    $html2pdf->writeHTML($html);
    // Despliega el PDF
    $html2pdf->output('ReporteComiteCS.pdf','D');
}
else{
    $_SESSION["title"] = TITLE_NO_ACCESS;
    $_SESSION["message"] = MESSAGE_NO_ACCESS;
    header("Location: ./mensaje.php");
}

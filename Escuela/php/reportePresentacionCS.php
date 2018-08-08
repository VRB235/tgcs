<?php

    require '../vendor/autoload.php';
    require_once ("mongoDB.php");

    use Spipu\Html2Pdf\Html2Pdf;

    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $mongo = new mongoDataBase();

    $projects = $mongo->getProyectsByTermCode($_POST["term_code"]);
    

    $html2pdf = new Html2Pdf();
    $html = "<page backtop=\"7mm\" backbottom=\"7mm\">";
    $html .= "<table><tr><td style='padding: 0px'><img src=../recursos/Logo-UCAB.png ></td></tr></table>
               <table><tr><td style='padding-left: 250px; font-size: 15px; padding-bottom: 10px'>Presentacion de Trabajos de Grado ".date('Y',time())."</td></tr></table>
              ";
    $version = "";
    $extern = "";
    $desicion1 = "";
    $desicion2 = "";
    $desicion3 = "";
    $html.="<div><table style='margin-left: 30px'>
            <tr>
                <td style='width: 200px;font-size: 12px; text-align: center; border: 1px solid black;background: #38b5e6'>TITULO TESIS</td>
                <td style='width: 100px;font-size: 12px; text-align: center; border: 1px solid black;background: #38b5e6'>AUTORES</td>
                <td style='width: 150px;font-size: 12px; text-align: center; border: 1px solid black;background: #38b5e6'>TUTOR Y EVALUADORES</td>
                <td style='width: 150px;font-size: 12px; text-align: center; border: 1px solid black;background: #38b5e6'>NOTA</td>
            </tr>";
    $mencion="";
    $jurado1 = "";
    $jurado2 = "";

    foreach ($projects as $element){
        // Si el proyecto tiene:
        // Fecha de aprobacion
        // Tutor
        // Jurados
        // Respuesta de Jurados
        // Nota
        if($element->approval_date!="-" && $element->tutor_extern!="-" && $element->jury_one_fullname!=null &&
            $element->jury_two_fullname!=null && $element->jury_three_fullname!=null && $element->jury_one_status!=null &&
            $element->jury_two_status!=null && $element->jury_three_status!=null && isset($element->note)){
            // Si existe la variable mencion
            if(isset($element->mention)){
                // Si la mencion es Publicacion
                if($element->mention=="Publicacion"){
                    $mencion = "Publicacion";
                }
                else{
                    $mencion = " ";
                }
            }
            $html .="<tr style='padding: 3px'>
                        <td style='border:solid 1px black;width: 200px;padding: 8px;text-align:center;'><p>".$element->title."</p></td>
                        <td style='width: 100px;padding: 8px;border:solid 1px black;text-align:center;'><p>".$element->student_one_name."<br><br>".
                        $element->student_two_name."</p></td>
                        <td style='width: 100px;padding: 8px;border:solid 1px black;text-align:center;'><strong>".$element->tutor_name."</strong><br>".
                        $element->jury_one_fullname."<br>".
                        $element->jury_two_fullname."<br></td>
                        <td style='width: 100px;border:solid 1px black;text-align:center;padding-top: 10px'>".$element->note."<br>"
                        .$mencion."</td>
                     </tr>";

        }


    }

    $html.="</table></div>";
    $html.="<page_footer>".date('d/m/Y', time())."</page_footer>";
    $html.="</page>";
    // Agrega el HTML al PDF
    $html2pdf->writeHTML($html);
    // Desplieja el PDF
    $html2pdf->output();

<?php
    require '../vendor/autoload.php';

    use Spipu\Html2Pdf\Html2Pdf;

    session_start();
    $project = $_SESSION['project'];
    $html2pdf = new Html2Pdf();
    if($_SESSION['period']=='Anual'){
        if($_SESSION['formato']=='formatAAnual'){
            $html = "<table><tr><td style='padding: 0px; padding-left:150px;'><img src=../recursos/Logo-UCAB-04.png ></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 300px; font-size: 15px; padding-bottom: 10px'><strong>FORMATO A</strong></td></tr>
            <tr><td style='padding-left: 150px; font-size: 15px; padding-bottom: 10px'><strong>FICHA DE REGISTRO DEL PROYECTO DE TRABAJO DE GRADO</strong></td></tr></table>
            ";
            if($project['version']=='first_version'){
                $html .= "<p>1era Version</p>";
            }else{
                $html .= "<p>2da Version</p>";
            }
                $html .= "<label><strong>TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO : </strong></label><label>".$project["title"]."</label>
                <br>
                <br>
                <br>
                <label for='student_one_name'><strong>Estudiante 1) Nombre y Apellido :</strong></label><label>".$project["student_one_name"]."</label>
                <label for='student_one_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_one_id"]."</label>
                <br>
                <br>
                <label for='student_one_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_one_hab_phone"]."</label>
                <label for='student_one_cel_phone'><strong>Telefono Celular : </strong></label><label>".$project["student_one_cel_phone"]."</label>
                <label for='student_one_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_one_ucab_email"]."</label>
                <br>
                <br>
                <label for='student_one_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_one_personal_email"]."</label>
                <label for='student_one_specialty'><strong>Especialidad : </strong></label>
                ";
                if($project['student_one_specialty']=='Sin O'){
                    $html .= "<label>Sin Opcion</label>";
                }
                if($project['student_one_specialty']=='RR.II'){
                    $html .= "<label>Relaciones Industriales</label>";
                }
                if($project['student_one_specialty']=='Soc.'){
                    $html .= "<label>Sociología</label>";
                }
                $html .="
                <br>
                <br>
                <label for='student_one_mention'>Mención</label>
            ";
                if($project['student_one_mention']=='Sin O'){
                    $html .= "<label>Sin Opcion</label>";
                }
                if($project['student_one_mention']=='RR.HH'){
                    $html .= "<label>Recursos Humanos</label>";
                }
                if($project['student_one_mention']=='RR.LL'){
                    $html .= "<label>Relaciones Laboralesa</label>";
                }
            if($project['student_one_mention']=='CyB'){
                    $html .= "<label>Compensación y Beneficios</label>";
                }
                $html .= "<label><strong> Escolaridad : </strong></label>";

            if($project['student_one_scholarship']=='fourth_year'){
                $html .= "<label>4to Año</label>";
            }
            if($project['student_one_scholarship']=='fifth_year'){
                $html .= "<label>5to Año</label>";
            }
            if($project['student_one_scholarship']=='scholarship_ended'){
                $html .= "<label>Escolaridad Finalizada</label>";
            }
            $html .="
                <label for='student_one_year_ended'><strong>Año de Finalización : </strong></label><label>".$project["student_one_year_ended"]."</label>
                <br>
                <br>
                <label for='student_one_seminar_title'><strong>Titulo del Proyecto de Seminario : </strong></label><label>".$project["student_one_seminar_title"]."</label>
                <br>
                <br>
                <label for='student_one_professor'><strong>Profesor de Seminario : </strong></label><label>".$project["student_one_professor"]."</label>
                <label for='student_one_approval_year'><strong>Año de Aprobación : </strong></label><label>".$project["student_one_approval_year"]."</label>
                <br><br><label for='student_one_same_seminar'><strong>¿Este proyecto es el mismo del Seminario?  : </strong></label>";
                if($project['student_one_same_seminar']=='yes'){
                    $html .= "<label>Si</label>";
                }
                if($project['student_one_same_seminar']=='no'){
                    $html .= "<label>No</label>";
                }
                $html .= "
                <br>
                <br>
                <br>
                <label for='student_two_name'><strong>Estudiante 2) Nombre y Apellido</strong></label><label>".$project["student_two_name"]."</label>
                <label for='student_two_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_two_id"]."</label>
                <br>
                <br>
                <label for='student_two_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_two_hab_phone"]."</label>
                <label for='student_two_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_two_cel_phone"]."</label>
                <label for='student_two_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_two_ucab_email"]."</label>
                <br>
                <br>
                <label for='student_two_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_two_personal_email"]."</label>
                <label for='student_two_specialty'><strong>Especialidad : </strong></label>
                ";
                if($project['student_two_specialty']=='Sin O'){
                    $html .= "<label>Sin Opcion</label>";
                }
                if($project['student_two_specialty']=='RR.II'){
                    $html .= "<label>Relaciones Industriales</label>";
                }
                if($project['student_two_specialty']=='Soc.'){
                    $html .= "<label>Sociología</label>";
                }
                $html .="
                <br>
                <br>
                <label for='student_two_mention'><strong>Mención : </strong></label>
            ";
                if($project['student_two_mention']=='Sin O'){
                    $html .= "<label>Sin Opcion</label>";
                }
                if($project['student_two_mention']=='RR.HH'){
                    $html .= "<label>Recursos Humanos</label>";
                }
                if($project['student_two_mention']=='RR.LL'){
                    $html .= "<label>Relaciones Laboralesa</label>";
                }
            if($project['student_two_mention']=='CyB'){
                    $html .= "<label>Compensación y Beneficios</label>";
                }
                $html .= "<label> <strong>Escolaridad : </strong></label>";

            if($project['student_two_scholarship']=='fourth_year'){
                $html .= "<label>4to Año</label>";
            }
            if($project['student_two_scholarship']=='fifth_year'){
                $html .= "<label>5to Año</label>";
            }
            if($project['student_two_scholarship']=='scholarship_ended'){
                $html .= "<label>Escolaridad Finalizada</label>";
            }
            $html .="
                <label for='student_two_year_ended'><strong>Año de Finalización : </strong></label><label>".$project["student_two_year_ended"]."</label>
                <br>
                <br>
                <label for='student_two_seminar_title'><strong>Titulo del Proyecto de Seminario : </strong></label><label>".$project["student_two_seminar_title"]."</label>
                <br>
                <br>
                <label for='student_two_professor'><strong>Profesor de Seminario : </strong></label><label>".$project["student_two_professor"]."</label>
                <label for='student_two_approval_year'><strong>Año de Aprobación : </strong></label><label>".$project["student_two_approval_year"]."</label>
                <label for='student_two_same_seminar'><strong>¿Este proyecto es el mismo del Seminario? : </strong></label>";
                if($project['student_two_same_seminar']=='yes'){
                    $html .= "<label>Si</label>";
                }
                if($project['student_two_same_seminar']=='no'){
                    $html .= "<label>No</label>";
                }
                $html .= "

                <br>
                <br>
                <br>
                <label for='tutor_name'><strong>Nombre y Apellido del Tutor : </strong></label><label>".$project["tutor_name"]."</label>
                <label for='tutor_email'><strong>E-mail : </strong></label><label>".$project["tutor_email"]."</label>
                <br>
                <br>
                <label for='tutor_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["tutor_cel_phone"]."</label>
                <label for='tutor_id'><strong>Cédula de Identidad : </strong></label><label>".$project["tutor_id"]."</label>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <table><tr><td style='padding-left: 100px'><label >Firma del Estudiante No.1</label ></td><td style='padding-left: 200px'><label >Firma del Estudiante No.2</label></td></tr></table>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class='text'>Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro 
                    declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de 
                    derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este 
                    sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
                </p>";
        }
        
        else{

                $html="<table><tr><td style='padding: 0px; padding-left:150px;'><img src=../recursos/Logo-UCAB-04.png ></td></tr></table>
                <br>
                <br>
                <br>
                <br>
                <table><tr><td style='padding-left: 300px; font-size: 15px; padding-bottom: 10px'><strong>FORMATO F</strong></td></tr>
                        <tr><td style='padding-left: 200px; font-size: 15px; padding-bottom: 10px'><strong>PRESENTACIÓN TRABAJO DE GRADO</strong></td></tr></table>
                <br>
                <br>
                <br>
                <label for='approval_date'><strong>Fecha de aprobación del Proyecto : </strong></label><label>".$project["approval_date"]."</label>
                <br>
                <br>
                <label for='title'><strong>TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO : </strong></label><label>".$project["title"]."</label>
                <br>
                <br>        
                <label for='investigation_area'><strong>Area de Investigación : </strong></label><label>".$project["investigation_area"]."</label>
                <br>
                <br>
                <br>
                <label for='student_one_name'><strong>Estudiante 1) Nombre y Apellido : </strong></label><label>".$project["student_one_name"]."</label>
                <label for='student_one_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_one_id"]."</label>
                <br>
                <br>
                <label for='student_one_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_one_hab_phone"]."</label>
                <label for='student_one_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_one_cel_phone"]."</label>
                <label for='student_one_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_one_ucab_email"]."</label>
                <br>
                <br>
                <label for='student_one_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_one_personal_email"]."</label>
                <label for='student_one_speciality'><strong>Especialidad : </strong></label>
                ";
            if($project['student_one_specialty']=='Sin O'){
                $html .= "<label>Sin Opcion</label>";
            }
            if($project['student_one_specialty']=='RR.II'){
                $html .= "<label>Relaciones Industriales</label>";
            }
            if($project['student_one_specialty']=='Soc.'){
                $html .= "<label>Sociología</label>";
            }
            $html .="
            <br>
            <br>
            <label for='student_one_mention'><strong>Mención : </strong></label>
        ";
            if($project['student_one_mention']=='Sin O'){
                $html .= "<label>Sin Opcion</label>";
            }
            if($project['student_one_mention']=='RR.HH'){
                $html .= "<label>Recursos Humanos</label>";
            }
            if($project['student_one_mention']=='RR.LL'){
                $html .= "<label>Relaciones Laboralesa</label>";
            }
         if($project['student_one_mention']=='CyB'){
                $html .= "<label>Compensación y Beneficios</label>";
            }
            $html .= "<label> <strong>Escolaridad : </strong></label>";

        if($project['student_one_scholarship']=='fourth_year'){
            $html .= "<label>4to Año</label>";
        }
        if($project['student_one_scholarship']=='fifth_year'){
            $html .= "<label>5to Año</label>";
        }
        if($project['student_one_scholarship']=='scholarship_ended'){
            $html .= "<label>Escolaridad Finalizada</label>";
        }
        $html .="
                <label for='student_one_year_ended'><strong>Año de Finalización : </strong></label><label>".$project["student_one_year_ended"]."</label>
                <br>
                <br>
                <br>
                <label for='student_two_name'><strong>Estudiante 2) Nombre y Apellido : </strong></label><label>".$project["student_two_name"]."</label>
                <label for='student_two_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_two_id"]."</label>
                <br>
                <br>
                <label for='student_two_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_two_hab_phone"]."</label>
                <label for='student_two_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_two_cel_phone"]."</label>
                <label for='student_two_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_two_ucab_email"]."</label>
                <br>
                <br>
                <label for='student_two_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_two_personal_email"]."</label>
                <label for='student_two_specialty'><strong>Especialidad : </strong></label>
                ";
            if($project['student_two_specialty']=='Sin O'){
                $html .= "<label>Sin Opcion</label>";
            }
            if($project['student_two_specialty']=='RR.II'){
                $html .= "<label>Relaciones Industriales</label>";
            }
            if($project['student_two_specialty']=='Soc.'){
                $html .= "<label>Sociología</label>";
            }
            $html .="
            <br>
            <br>
            <label for='student_two_mention'><strong>Mención : </strong></label>
        ";
            if($project['student_two_mention']=='Sin O'){
                $html .= "<label>Sin Opcion</label>";
            }
            if($project['student_two_mention']=='RR.HH'){
                $html .= "<label>Recursos Humanos</label>";
            }
            if($project['student_two_mention']=='RR.LL'){
                $html .= "<label>Relaciones Laboralesa</label>";
            }
         if($project['student_two_mention']=='CyB'){
                $html .= "<label>Compensación y Beneficios</label>";
            }
            $html .= "<label> <strong>Escolaridad : </strong></label>";

        if($project['student_two_scholarship']=='fourth_year'){
            $html .= "<label>4to Año</label>";
        }
        if($project['student_two_scholarship']=='fifth_year'){
            $html .= "<label>5to Año</label>";
        }
        if($project['student_two_scholarship']=='scholarship_ended'){
            $html .= "<label>Escolaridad Finalizada</label>";
        }
        $html .="
                <label for='student_two_year_ended'><strong>Año de Finalización : </strong></label><label>".$project["student_two_year_ended"]."</label>
                <br>
                <br>
                <br>
                <label for='tutor_name'><strong>Nombre y Apellido del Tutor : </strong></label><label>".$project["tutor_name"]."</label>
                <label for='tutor_email'><strong>E-mail : </strong></label><label>".$project["tutor_email"]."</label>
                <br>
                <br>
                <label for='tutor_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["tutor_hab_phone"]."</label>
                <label for='tutor_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["tutor_cel_phone"]."</label>
                <br><br>
                <label for='tutor_id'><strong>Cédula de Identidad : </strong></label><label>".$project["tutor_id"]."</label>
                <br>
                <br>
                <br>
                <br>
                <br>
                <table><tr><td style='padding-left: 100px'><label class='approvation'>Aprobación por parte del Tutor <br> (firma)</label></td><td style='padding-left: 200px'><label class='date_sign'>Día y Fecha</label></td></tr></table>
                <br>
                <br>
                <br>
                <table><tr><td style='padding-left: 100px'><label >Firma del Estudiante No.1</label ></td><td style='padding-left: 200px'><label >Firma del Estudiante No.2</label></td></tr></table>
                <br>
                <br>
                <label class='clean'>Se Consigna:</label>
                <br>
                <br>";

                if($project['cd']=='on'){
                    $html .= "<img src=../recursos/check.png width='15'>";
                }
                else{
                    $html .= "<img src=../recursos/uncheck.png width='15'>";
                }
                
                $html .= "CD con el documento del Trabajo de Grado en word y PDF.Ficha Resumen del Trabajo de Grado (Formato G)
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <p class='text2'>Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro 
                                declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de 
                                derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este 
                                sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
                </p>

";
        }
    }
    else{
        if($_SESSION['formato']=='formatASemestral'){
        $html .="<table><tr><td style='padding: 0px; padding-left:150px;'><img src=../recursos/Logo-UCAB-04.png ></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 300px; font-size: 15px; padding-bottom: 10px'><strong>FORMATO A</strong></td></tr>
            <tr><td style='padding-left: 150px; font-size: 15px; padding-bottom: 10px'><strong>FICHA DE REGISTRO DEL PROYECTO DE TRABAJO DE GRADO</strong></td></tr></table>
            <br>
            <br>
            <br>
            <label for='title'><strong>TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO : </strong></label><label>".$project["title"]."</label>
            <br>
            <br>
            <label for='investigation_area'><strong>Area de Investigación : </strong></label><label>".$project["investigation_area"]."</label>
            <br>
            <br>
            <br>
            <label for='student_one_name'><strong>Estudiante 1) Nombre y Apellido : </strong></label><label>".$project["student_one_name"]."</label>
            <label for='student_one_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_one_id"]."</label>
            <br>
            <br>
            <label for='student_one_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_one_hab_phone"]."</label>
            <label for='student_one_cel_phone'><strong>Telefono Celular : </strong></label><label>".$project["student_one_cel_phone"]."</label>
            <label for='student_one_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_one_ucab_email"]."</label>
            <br>
            <br>
            <label for='student_one_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_one_personal_email"]."</label>
            <br>
            <br>
            <label for='student_one_professor'><strong>Profesor de Seminario TG : </strong></label><label>".$project["student_one_professor"]."</label>
            <label for='student_one_approval_date'><strong>Fecha de Aprobación : </strong></label><label>".$project["student_one_approval_year"]."</label>
            <br>
            <br>
            <label for='student_two_name'><strong>Estudiante 2) Nombre y Apellido : </strong></label><label>".$project["student_two_name"]."</label>
            <label for='student_two_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_two_id"]."</label>
            <br>
            <br>
            <br>
            <label for='student_two_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_two_hab_phone"]."</label>
            <label for='student_two_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_two_cel_phone"]."</label>
            <label for='student_two_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_two_ucab_email"]."</label>
            <br>
            <br>
            <label for='student_two_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_two_personal_email"]."</label>
            <br>
            <br>
            <label for='student_two_professor'><strong>Profesor de Seminario  TG : </strong></label><label>".$project["student_two_professor"]."</label>
            <label for='student_two_approval_date'><strong>Fecha de Aprobación : </strong></label><label>".$project["student_two_approval_year"]."</label>
            <br>
            <br>
            <label for='same_seminar'><strong>¿Este proyecto es el mismo del Seminario? : </strong></label>";
            if($project['same_seminar']=='yes'){
                $html .= "<label>Si</label>";
            }
            if($project['same_seminar']=='no'){
                $html .= "<label>No</label>";
            }
            $html .= "
            <br>
            <br>
            <br>
            <label for='tutor_name'><strong>Nombre y Apellido del Tutor : </strong></label><label>".$project["tutor_name"]."</label>
            <label for='tutor_email'><strong>E-mail : </strong></label><label>".$project["tutor_email"]."</label>
            <br>
            <br>
            <label for='tutor_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["tutor_cel_phone"]."</label>
            <label for='tutor_id'><strong>Cédula de Identidad : </strong></label><label>".$project["tutor_id"]."</label>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 100px'><label >Firma del Estudiante No.1</label ></td><td style='padding-left: 200px'><label >Firma del Estudiante No.2</label></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p class='text2 clean'>Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro 
                    declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de 
                    derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este 
                    sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
            </p>";
        }
        else{
            $html .= "
            <table><tr><td style='padding: 0px; padding-left:150px;'><img src=../recursos/Logo-UCAB-04.png ></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 300px; font-size: 15px; padding-bottom: 10px'><strong>FORMATO F</strong></td></tr>
                        <tr><td style='padding-left: 200px; font-size: 15px; padding-bottom: 10px'><strong>PRESENTACIÓN TRABAJO DE GRADO</strong></td></tr></table>
            <br>
            <br>
            <br>
            <label for='approval_date'><strong>Fecha de aprobación del Proyecto : </strong></label><label>".$project["approval_date"]."</label>
            <br>
            <br>
            <label for='title'><strong>TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO : </strong></label><label>".$project["title"]."</label>
            <br>
            <br>        
            <label for='investigation_area'><strong>Area de Investigación : </strong></label><label>".$project["investigation_area"]."</label>
            <br>
            <br>
            <br>
            <label for='student_one_name'><strong>Estudiante 1) Nombre y Apellido : </strong></label><label>".$project["student_one_name"]."</label>
            <label for='student_one_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_one_id"]."</label>
            <br>
            <br>
            <label for='student_one_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_one_hab_phone"]."</label>
            <label for='student_one_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_one_cel_phone"]."</label>
            <label for='student_one_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_one_ucab_email"]."</label>
            <br>
            <br>
            <label for='student_one_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_one_personal_email"]."</label>
            <br>
            <br>
            <br>
            <label for='student_two_name'><strong>Estudiante 2) Nombre y Apellido : </strong></label><label>".$project["student_two_name"]."</label>
            <label for='student_two_id'><strong>Cédula de Identidad : </strong></label><label>".$project["student_two_id"]."</label>
            <br>
            <br>
            <label for='student_two_hab_phone'><strong>Teléfono Habitación : </strong></label><label>".$project["student_two_hab_phone"]."</label>
            <label for='student_two_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["student_two_cel_phone"]."</label>
            <label for='student_two_ucab_email'><strong>E-mail UCAB : </strong></label><label>".$project["student_two_ucab_email"]."</label>
            <br>
            <br>
            <label for='student_two_personal_email'><strong>E-mail Personal : </strong></label><label>".$project["student_two_personal_email"]."</label>
            <br>
            <br>
            <label for='tutor_name'><strong>Nombre y Apellido del Tutor : </strong></label><label>".$project["tutor_name"]."</label>
            <label for='tutor_email'><strong>E-mail : </strong></label><label>".$project["tutor_email"]."</label>
            <br>
            <br>
            <label for='tutor_cel_phone'><strong>Teléfono Celular : </strong></label><label>".$project["tutor_cel_phone"]."</label>
            <label for='tutor_id'><strong>Cédula de Identidad : </strong></label><label>".$project["tutor_id"]."</label>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 100px'><label class='approvation'>Aprobación por parte del Tutor <br> (firma)</label></td><td style='padding-left: 200px'><label class='date_sign'>Día y Fecha</label></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <table><tr><td style='padding-left: 100px'><label >Firma del Estudiante No.1</label ></td><td style='padding-left: 200px'><label >Firma del Estudiante No.2</label></td></tr></table>
            <br>
            <br>
            <br>
            <br>
            <p class='clean'>Se Consigna:</p>
            <br>
            <br>";
            if($project['cd']=='on'){
                $html .= "<img src=../recursos/check.png width='15'>";
            }
            else{
                $html .= "<img src=../recursos/uncheck.png width='15'>";
            }
            $html .="CD con el documento del Trabajo de Grado en word y PDF.Ficha Resumen del Trabajo de Grado (Formato G)
            <br>
            <br>
            <br>
            <br>
            <p class='text2'>Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro 
                    declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de 
                    derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este 
                    sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
            </p>";
        }

    }

    
    // Agrega el HTML al PDF
    $html2pdf->writeHTML($html);
    // Despliega el PDF
    $html2pdf->output();

?>


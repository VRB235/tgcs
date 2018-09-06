<?php

    session_start();

    $element = $_SESSION['element'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro del Proyecto de TG Anual</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/talento.css">
    <script src="../js/verify.js"></script>
</head>
<body>
<img src="../recursos/Logo-UCAB-04.png" alt="logo_UCAB" class="logo_UCAB">
<form action="../php/aprobar.php" method="post" id="form">
    <div class="projectID">
        <label for="IDRegister">No. de Registro : <input type="text" name="IDRegister" id="IDRegister" class="form-control" required></label>
        <br>
        <br>
        <label for="deliverDate">Fecha de Entrega : <input type="date" name="deliverDate" id="deliverDate" class="form-control" required></label>
        <br>
        <br>
        <label for="termCode">Periodo : <input type="text" name="termcode" id="termcode" class="form-control" required></label>
        <br>
        <br>
    </div>
    <div id="header">
        <h1><strong>FORMATO A <br/> FICHA DE REGISTRO DEL PROYECTO DE TRABAJO DE GRADO</strong></h1>
        <spam>(llenar en el computador, no a mano)</spam>
    </div>
    <div class="form-check">
        <label for="version1" class="form-check-label">
            <input type="radio" name="version" id="version1"  value="first_version" <?php if($element->version=='first_version'){echo "checked='checked'";}?> class="form-check-input" disabled> Primera versión
        </label>
        <label for="version2" class="form-check-label">
            <input type="radio" name="version" id="version2"  value="second_version" <?php if($element->version=='second_version'){echo "checked='checked'";}?> class="form-check-input" disabled> Segunda versión
        </label>
    </div>
    <label for="title">TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO <br> (Máximo 120 caracteres, incluyendo espacios y signos)
        <input type="text" id="title" name="title" maxlength="120" class="form-control" value="<?php echo $element->title?>" disabled>
    </label>
    <spam class="split">Estudiante 1)</spam>
    <label for="student_one_name"><strong>Nombre y Apellido</strong>
        <input type="text" id="student_one_name" name="student_one_name" class="form-control" value="<?php echo $element->student_one_name?>"  disabled>
    </label>
    <label for="student_one_id">Cédula de Identidad
        <input type="text" id="student_one_id" name="student_one_id" class="form-control"  value="<?php echo $element->student_one_id?>" disabled>
    </label>
    <label for="student_one_hab_phone">Teléfono Habitación
        <input type="tel" id="student_one_hab_phone" name="student_one_hab_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_one_hab_phone?>" disabled>
    </label>
    <label for="student_one_cel_phone">Teléfono Celular
        <input type="tel" id="student_one_cel_phone" name="student_one_cel_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_one_cel_phone?>" disabled>
    </label>
    <label for="student_one_ucab_email">E-mail UCAB
        <input type="email" id="student_one_ucab_email" name="student_one_ucab_email" class="form-control" placeholder ="ejemplo@correo.com"  value="<?php echo $element->student_one_ucab_email?>" disabled>
    </label>
    <label for="student_one_personal_email">E-mail Personal
        <input type="email" id="student_one_personal_email" name="student_one_personal_email" class="form-control" placeholder ="ejemplo@correo.com"  value="<?php echo $element->student_one_personal_email?>" disabled>
    </label>
    <label for="student_one_specialty">Especialidad
        <select id="student_one_specialty" name="student_one_specialty" class="form-control" disabled>
            <option value="Sin O" <?php if($element->student_one_specialty=='Sin O'){echo "selected";}?>>Sin Opción</option>
            <option value="RR.II" <?php if($element->student_one_specialty=='RR.II'){echo "selected";}?>>Relaciones Industriales</option>
            <option value="Soc." <?php if($element->student_one_specialty=='Soc.'){echo "selected";}?>>Sociología</option>
        </select>
    </label>
    <label for="student_one_mention">Mención
        <select id="student_one_mention" name="student_one_mention" class="form-control" disabled>
            <option value="Sin O" <?php if($element->student_one_mention=='Sin O'){echo "selected";}?>>Sin Opción</option>
            <option value="RR.HH" <?php if($element->student_one_mention=='RR.HH'){echo "selected";}?>>Recursos Humanos</option>
            <option value="RR.LL" <?php if($element->student_one_mention=='RR.LL'){echo "selected";}?>>Relaciones Laborales</option>
            <option value="CyB" <?php if($element->student_one_mention=='CyB'){echo "selected";}?>>Compensación y Beneficios</option>
        </select>
    </label>
    <label for="student_one_scholarship"> Escolaridad
        <select name="student_one_scholarship" id="student_one_scholarship" class="form-control" disabled>
            <option value="fourth_year" <?php if($element->student_one_scholarship=='fourth_year'){echo "selected";}?>>4to Año</option>
            <option value="fifth_year" <?php if($element->student_one_scholarship=='fifth_year'){echo "selected";}?>>5to Año</option>
            <option value="scholarship_ended" <?php if($element->student_one_scholarship=='scholarship_ended'){echo "selected";}?>>Escolaridad Finalizada</option>
        </select>
    </label>
    <label for="student_one_year_ended">Año de Finalización
        <input type="number" id="student_one_year_ended" min="1900" name="student_one_year_ended" class="form-control" value="<?php echo $element->student_one_seminar_title?>" disabled>
    </label>
    <label for="student_one_seminar_title">Titulo del Proyecto de Seminario
        <input type="text" id="student_one_seminar_title" name="student_one_seminar_title" class="form-control"  value="<?php echo $element->student_one_seminar_title?>" disabled>
    </label>
    <label for="student_one_professor">Profesor de Seminario
        <input type="text" id="student_one_professor" name="student_one_professor" class="form-control"  value="<?php echo $element->student_one_professor?>" disabled>
    </label>
    <label for="student_one_approval_year">Año de Aprobación
        <input type="number" id="student_one_approval_year" min="1900" class="form-control" name="student_one_approval_year"  value="<?php echo $element->student_one_approval_year?>" disabled>
    </label>
    <label for="student_one_same_seminar">¿Este proyecto es el mismo del Seminario?
        <select name="student_one_same_seminar" id="student_one_same_seminar" class="form-control" disabled>
            <option value="yes" <?php if($element->student_one_same_seminar=='yes'){echo "selected";}?>>Si</option>
            <option value="no" <?php if($element->student_one_same_seminar=='no'){echo "selected";}?>>No</option>
        </select>
    </label>
    <spam class="split">Estudiante 2)</spam>
    <label for="student_two_name"><strong>Nombre y Apellido</strong>z
        <input type="text" id="student_two_name" name="student_two_name" class="form-control"  value="<?php echo $element->student_two_name?>" disabled>
    </label>
    <label for="student_two_id">Cédula de Identidad
        <input type="text" id="student_two_id" min="0" name="student_two_id" class="form-control"  value="<?php echo $element->student_two_id?>" disabled>
    </label>
    <label for="student_two_hab_phone">Teléfono Habitación
        <input type="tel" id="student_two_hab_phone" name="student_two_hab_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_two_hab_phone?>" disabled>
    </label>
    <label for="student_two_cel_phone">Teléfono Celular
        <input type="tel" id="student_two_cel_phone" name="student_two_cel_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_two_cel_phone?>" disabled>
    </label>
    <label for="student_two_ucab_email">E-mail UCAB
        <input type="email" id="student_two_ucab_email" name="student_two_ucab_email" class="form-control" placeholder ="ejemplo@correo.com" value="<?php echo $element->student_two_ucab_email?>" disabled>
    </label>
    <label for="student_two_personal_email">E-mail Personal
        <input type="email" id="student_two_personal_email" name="student_two_personal_email" class="form-control" placeholder ="ejemplo@correo.com" value="<?php echo $element->student_two_personal_email?>" disabled>
    </label>
    <label for="student_two_specialty">Especialidad
        <select id="student_two_specialty" name="student_two_specialty" class="form-control" disabled>
            <option value="Sin O" <?php if($element->student_one_mention=='Sin O'){echo "selected";}?>>Sin Opción</option>
            <option value="RR.II" <?php if($element->student_one_mention=='Sin O'){echo "selected";}?>>Relaciones Industriales</option>
            <option value="Soc." <?php if($element->student_one_mention=='Sin O'){echo "selected";}?>>Sociología</option>
        </select>
    </label>
    <label for="student_two_mention">Mención
        <select id="student_two_mention" name="student_two_mention" class="form-control" disabled>
            <option value="Sin O" <?php if($element->student_two_mention=='Sin O'){echo "selected";}?>>Sin Opción</option>
            <option value="RR.HH" <?php if($element->student_two_mention=='RR.HH'){echo "selected";}?>>Recursos Humanos</option>
            <option value="RR.LL" <?php if($element->student_two_mention=='RR.LL'){echo "selected";}?>>Relaciones Laborales</option>
            <option value="CyB" <?php if($element->student_two_mention=='CyB'){echo "selected";}?>>Compensación y Beneficios</option>
        </select>
    </label>
    <label for="student_two_scholarship"> Escolaridad
        <select name="student_two_scholarship" id="student_two_scholarship" class="form-control" disabled>
            <option value="fourth_year" <?php if($element->student_two_scholarship=='fourth_year'){echo "selected";}?>>4to Año</option>
            <option value="fifth_year" <?php if($element->student_two_scholarship=='fifth_year'){echo "selected";}?>>5to Año</option>
            <option value="scholarship_ended" <?php if($element->student_two_scholarship=='scholarship_ended'){echo "selected";}?>>Escolaridad Finalizada</option>
        </select>
    </label>
    <label for="student_two_year_ended">Año de Finalización
        <input type="number" min="1900" id="student_two_year_ended" name="student_two_year_ended" class="form-control" value="<?php echo $element->student_two_year_ended?>" disabled>
    </label>
    <label for="student_two_seminar_title">Titulo del Proyecto de Seminario
        <input type="text" id="student_two_seminar_title" name="student_two_seminar_title" class="form-control"  value="<?php echo $element->student_two_year_ended?>" disabled>
    </label>
    <label for="student_two_professor">Profesor de Seminario
        <input type="text" id="student_two_professor" name="student_two_professor" class="form-control"  value="<?php echo $element->student_two_professor?>" disabled>
    </label>
    <label for="student_two_approval_year">Año de Aprobación
        <input type="number" id="student_two_approval_year" min="1900" class="form-control" name="student_two_approval_year"  value="<?php echo $element->student_two_approval_year?>" disabled>
    </label>
    <label for="student_two_same_seminar">¿Este proyecto es el mismo del Seminario?
        <select name="student_two_same_seminar" id="student_two_same_seminar" class="form-control" disabled>
            <option value="yes" <?php if($element->student_two_same_seminar=='yes'){echo "selected";}?>>Si</option>
            <option value="no" <?php if($element->student_two_same_seminar=='no'){echo "selected";}?>>No</option>
        </select>
    </label>
    <spam class="split">Tutor</spam>
    <label for="tutor_name"><strong>Nombre y Apellido del Tutor</strong>
        <input type="text" id="tutor_name" name="tutor_name" class="form-control"  value="<?php echo $element->tutor_name?>" disabled>
    </label>
    <label for="tutor_email">E-mail
        <input type="email" id="tutor_email" name="tutor_email" class="form-control" placeholder ="ejemplo@correo.com" value="<?php echo $element->tutor_email?>" disabled>
    </label>
    <label for="tutor_cel_phone">Teléfono Celular
        <input type="tel" id="tutor_cel_phone" name="tutor_cel_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->tutor_cel_phone?>" disabled>
    </label>
    <label for="tutor_id">Cédula de Identidad
        <input type="text" id="tutor_id" min="0" name="tutor_id" class="form-control"  value="<?php echo $element->tutor_id?>" disabled>
    </label>
    <br><br>
    <p class="sign1">Firma del Estudiante No.1</p>
    <p class="sign2">Firma del Estudiante No.2</p>
    <p class="text">Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro
        declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de
        derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este
        sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
    </p>
    <div class="botones">
        <input type="submit" value="Aprobar" id="aprobar" name="aprobar" class="btn btn-outline-success">
        <input type="submit" value="Rechazar" id="rechazar" name="rechazar" class="btn btn-outline-danger" onclick="verifyRejectButtom()">
    </div>
</form>
<div >
    <a href="../php/aprobarProyectos.php" class="btn btn-outline-primary">Regresar</a>
</div>
</body>
</html>
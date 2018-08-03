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
    <title>Presentación TG Semestral</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/talento.css">
</head>
<body>
<img src="../recursos/Logo-UCAB-04.png" id="logo" alt="logo_UCAB" class="logo_UCAB">

<form action="../php/aprobar.php" method="post">
    <div class="projectID">
        <label for="IDRegister">No. de Registro : <input type="text" name="IDRegister" id="IDRegister" class="form-control"  required></label>
        <br>
        <br>
        <label for="deliverDate">Fecha de Entrega : <input type="date" name="deliverDate" id="deliverDate" class="form-control"  required></label>
        <br>
        <br>
        <label for="termCode">Term Code : <input type="text" name="termcode" id="termcode" class="form-control" required></label>
        <br>
        <br>
    </div>
    <div id="header">
        <h1>FORMATO F <br/> PRESENTACIÓN TRABAJO DE GRADO</h1>
        <spam>(llenar en el computador, no a mano)</spam>
    </div>
    <label for="approval_date">Fecha de aprobación del Proyecto
        <input type="date" id="approval_date" name="approval_date" class="form-control" value="<?php echo $element->approval_date?>" disabled>
    </label>
    <label for="title">TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO <br> (Máximo 120 caracteres, incluyendo espacios y signos)
        <input type="text" id="title" name="title" class="form-control" value="<?php echo $element->title?>" disabled>
    </label>
    <label for="investigation_area">Area de Investigación
        <input type="text" id="investigation_area" name="investigation_area" class="form-control" value="<?php echo $element->investigation_area?>" disabled>
    </label>
    <spam class="split">Estudiante 1)</spam>
    <label for="student_one_name"><strong>Nombre y Apellido</strong>
        <input type="text" id="student_one_name" name="student_one_name" class="form-control" value="<?php echo $element->student_one_name?>" disabled>
    </label>
    <label for="student_one_id">Cédula de Identidad
        <input type="text" id="student_one_id" name="student_one_id" class="form-control" value="<?php echo $element->student_one_id?>" disabled>
    </label>
    <label for="student_one_hab_phone">Teléfono Habitación
        <input type="tel" id="student_one_hab_phone" name="student_one_hab_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_one_hab_phone?>" disabled>
    </label>
    <label for="student_one_cel_phone">Teléfono Celular
        <input type="tel" id="student_one_cel_phone" name="student_one_cel_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->student_one_cel_phone?>" disabled>
    </label>
    <label for="student_one_ucab_email">E-mail UCAB
        <input type="email" id="student_one_ucab_email" name="student_one_ucab_email" class="form-control" placeholder ="ejemplo@correo.com" value="<?php echo $element->student_one_ucab_email?>" disabled>
    </label>
    <label for="student_one_personal_email">E-mail Personal
        <input type="email" id="student_one_personal_email" name="student_one_personal_email" class="form-control" placeholder ="ejemplo@correo.com" value="<?php echo $element->student_one_personal_email?>" disabled>
    </label>
    <spam class="split">Estudiante 2)</spam>
    <label for="student_two_name"><strong>Nombre y Apellido</strong>
        <input type="text" id="student_two_name" name="student_two_name" class="form-control" value="<?php echo $element->student_two_name?>" disabled>
    </label>
    <label for="student_two_id">Cédula de Identidad
        <input type="text" id="student_two_id" min="0" name="student_two_id" class="form-control" value="<?php echo $element->student_two_id?>" disabled>
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
    <spam class="split">Tutor</spam>
    <label for="tutor_name"><strong>Nombre y Apellido del Tutor</strong>
        <input type="text" id="tutor_name" name="tutor_name" class="form-control" value="<?php echo $element->tutor_name?>" disabled>
    </label>
    <label for="tutor_email">E-mail
        <input type="email" id="tutor_email" name="tutor_email" placeholder ="ejemplo@correo.com" class="form-control" value="<?php echo $element->tutor_email?>" disabled>
    </label>
    <label for="tutor_cel_phone">Teléfono Celular
        <input type="text" id="tutor_cel_phone" name="tutor_cel_phone" class="form-control" placeholder="0000-000-0000" value="<?php echo $element->tutor_cel_phone?>" disabled>
    </label>
    <label for="tutor_id">Cédula de Identidad
        <input type="text" id="tutor_id" name="tutor_id" class="form-control" value="<?php echo $element->tutor_id?>" disabled>
    </label>
    <p class="clean consig">Se Consigna:</p>
    <label for="cd" class="form-check-label check">
        <input type="checkbox" id="cd" name="cd" class="form-check-input" <?php if($element->cd=="on"){echo "checked";} ?> disabled> CD con el documento del Trabajo de Grado en word y PDF.Ficha Resumen del Trabajo de Grado (Formato G)
    </label>
    <br><br>
    <p class="approvation">Aprobación por parte del Tutor <br> (firma)</p>
    <div class="approvation_sub"></div>
    <p class="date_sign">Día y Fecha</p>
    <div class="date_sign_sub"></div>
    <p class="sign1">Firma del Estudiante No.1</p>
    <p class="sign2">Firma del Estudiante No.2</p>
    <br><br>
    <p class="text2">Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro
        declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de
        derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este
        sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
    </p>
    <div class="botones">
        <input type="submit" value="Aprobar" id="aprobar" name="aprobar" class="btn btn-outline-success">
        <input type="submit" value="Rechazar" id="rechazar" name="rechazar" class="btn btn-outline-danger">
    </div>

</form>
<div class="btn btn-outline-primary">
    <a href="../php/aprobarProyectos.php">Regresar</a>
</div>
</body>
</html>
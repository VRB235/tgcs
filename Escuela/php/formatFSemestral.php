<?php

    session_start();

    $doc = $_SESSION['doc'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presentación TG Semestral</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<center><img src="../recursos/Logo-UCAB-04.png" id="logo"></center>

<form action="../php/aprobar.php" method="post">
    <div class="projectID">
        <label for="IDRegister">No. de Registro : <input type="text" name="IDRegister" id="IDRegister"  required></label>
        <br>
        <br>
        <label for="deliverDate">Fecha de Entrega : <input type="date" name="deliverDate" id="deliverDate"  required></label>
        <br>
        <br>
        <label for="termCode">Term Code : <input type="text" name="termcode" id="termcode" required></label>
        <br>
        <br>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div id="header">
        <center><h1>FORMATO F <br/> PRESENTACIÓN TRABAJO DE GRADO</h1></center>
        <center>(llenar en el computador, no a mano)</center>
    </div>
    <br>
    <br>
    <br>
    <label for="approval_date">Fecha de aprobación del Proyecto : </label><input type="date" id="approval_date" name="approval_date" value="<?php echo $doc['approval_date']?>" disabled>
    <br>
    <br>
    <label for="title">TITULO COMPLETO DE PROYECTO DE TRABAJO DE GRADO <br> (Máximo 120 caracteres, incluyendo espacios y signos) : </label><input type="text" id="title" name="title" value="<?php echo $doc['title']?>" disabled>
    <br>
    <br>
    <label for="investigation_area">Area de Investigación : </label><input type="text" id="investigation_area" name="investigation_area" value="<?php echo $doc['investigation_area']?>" disabled>
    <br>
    <br>
    <label for="student_one_name"><strong>Estudiante 1) Nombre y Apellido : </strong></label><input type="text" id="student_one_name" name="student_one_name" value="<?php echo $doc['student_one_name']?>" disabled>
    <label for="student_one_id">Cédula de Identidad : </label><input type="text" id="student_one_id" name="student_one_id" value="<?php echo $doc['student_one_id']?>" disabled>
    <br>
    <br>
    <label for="student_one_hab_phone">Teléfono Habitación : </label><input type="tel" id="student_one_hab_phone" name="student_one_hab_phone" placeholder="0000-000-0000" value="<?php echo $doc['student_one_hab_phone']?>" disabled>
    <label for="student_one_cel_phone">Teléfono Celular : </label><input type="tel" id="student_one_cel_phone" name="student_one_cel_phone" placeholder="0000-000-0000" value="<?php echo $doc['student_one_cel_phone']?>" disabled>
    <label for="student_one_ucab_email">E-mail UCAB : </label><input type="email" id="student_one_ucab_email" name="student_one_ucab_email" placeholder ="ejemplo@correo.com" value="<?php echo $doc['student_one_ucab_email']?>" disabled>
    <br>
    <br>
    <br>
    <label for="student_one_personal_email">E-mail Personal : </label><input type="email" id="student_one_personal_email" name="student_one_personal_email" placeholder ="ejemplo@correo.com" value="<?php echo $doc['student_one_personal_email']?>" disabled>
    <br>
    <br>
    <br>
    <label for="student_two_name"><strong>Estudiante 2) Nombre y Apellido : </strong></label><input type="text" id="student_two_name" name="student_two_name" value="<?php echo $doc['student_two_name']?>" disabled>
    <label for="student_two_id">Cédula de Identidad : </label><input type="text" id="student_two_id" min="0" name="student_two_id" value="<?php echo $doc['student_two_id']?>" disabled>
    <br>
    <br>
    <label for="student_two_hab_phone">Teléfono Habitación : </label><input type="tel" id="student_two_hab_phone" name="student_two_hab_phone" placeholder="0000-000-0000" value="<?php echo $doc['student_two_hab_phone']?>" disabled>
    <label for="student_two_cel_phone">Teléfono Celular : </label><input type="tel" id="student_two_cel_phone" name="student_two_cel_phone" placeholder="0000-000-0000" value="<?php echo $doc['student_two_cel_phone']?>" disabled>
    <label for="student_two_ucab_email">E-mail UCAB : </label><input type="email" id="student_two_ucab_email" name="student_two_ucab_email" placeholder ="ejemplo@correo.com" value="<?php echo $doc['student_two_ucab_email']?>" disabled>
    <br>
    <br>
    <label for="student_two_personal_email">E-mail Personal : </label><input type="email" id="student_two_personal_email" name="student_two_personal_email" placeholder ="ejemplo@correo.com" value="<?php echo $doc['student_two_personal_email']?>" disabled>
    <br>
    <br>
    <label for="tutor_name"><strong>Nombre y Apellido del Tutor : </strong></label><input type="text" id="tutor_name" name="tutor_name" value="<?php echo $doc['tutor_name']?>" disabled>
    <label for="tutor_email">E-mail : </label><input type="email" id="tutor_email" name="tutor_email" placeholder ="ejemplo@correo.com" value="<?php echo $doc['tutor_email']?>" disabled>
    <br>
    <br>
    <label for="tutor_cel_phone">Teléfono Celular : </label><input type="text" id="tutor_cel_phone" name="tutor_cel_phone" placeholder="0000-000-0000" value="<?php echo $doc['tutor_cel_phone']?>" disabled>
    <label for="tutor_id">Cédula de Identidad : </label><input type="text" id="tutor_id" name="tutor_id" value="<?php echo $doc['tutor_id']?>" disabled>
    <br>
    <br>
    <p class="approvation">Aprobación por parte del Tutor <br> (firma)</p>
    <div class="approvation_sub"></div>
    <p class="date_sign">Día y Fecha</p>
    <div class="date_sign_sub"></div>
    <br>
    <br>
    <br>
    <p class="sign">Firma del Estudiante No.1</p>
    <p class="sign">Firma del Estudiante No.2</p>
    <br>
    <br>
    <p class="clean">Se Consigna:</p>
    <br>
    <br>
    <input type="checkbox" id="cd" name="cd" <?php if($doc['cd']=="on"){echo "checked";} ?> disabled> CD con el documento del Trabajo de Grado en word y PDF.Ficha Resumen del Trabajo de Grado (Formato G)
    <br>
    <br>
    <p class="text2">Nosotros los estudiantes de la Escuela de Ciencias Sociales firmantes de la presente ficha de registro
        declaramos que el presente Proyecto de Trabajo de Grado ha sido elaborado respetando las normas de
        derecho de autor y propiedad intelectual y que conocemos que cualquier tipo de irregularidad en este
        sentido en el documento acarreará sanciones por parte de la Escuela de Ciencias Sociales
    </p>
    <div class="botones">
        <input type="submit" value="Aprobar" id="aprobar" name="aprobar" class="btn">
        <input type="submit" value="Rechazar" id="rechazar" name="rechazar" class="btn">
    </div>

</form>
<div class="buttom">
    <a href="../php/aprobarProyectos.php">Regresar</a>
</div>
</body>
</html>
<?php
    require '../vendor/autoload.php';
    require_once ("mongoDB.php");

    use PhpOffice\PhpSpreadsheet\Helper\Sample;
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;


    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    if($_SESSION['verify']==true) {
        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        // Letras
        $letters = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q',
            'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH',
            'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX',
            'AY', 'AZ', 'AAA', 'AAB', 'AAC', 'AAD', 'AAE', 'AAF', 'AAG', 'AAH', 'AAI', 'AAJ', 'AAK');//54
        // Campos
        $camp = array('Term Code', 'Nro. Registro', 'Fecha de Registro', 'Version', 'Titulo',
            'Estudiante # 1', 'Cedula', 'Nro. Habitacion', 'Nro. Telefono', 'Correo UCAB',
            'Correo Personal', 'Especialidad', 'Mencion', 'Escolaridad', 'Año de Finalización',
            'Titulo de Seminario', 'Profesor', 'Año de Aprobación', 'Fecha de Aprobación',
            '¿Mismo Proyecto de Seminario?', 'Estudiante # 2', 'Cedula', 'Nro. Habitacion',
            'Nro. Telefono', 'Correo UCAB', 'Correo Personal', 'Especialidad', 'Mencion',
            'Escolaridad', 'Año de Finalización', 'Titulo de Seminario', 'Profesor',
            'Año de Aprobación', 'Fecha de Aprobación', '¿Mismo Proyecto de Seminario?', 'Tutor', 'Correo',
            'Telefono', 'Cedula', '¿Externo?', '¿Tutor Aprobado?', 'Jurado #1', 'Desicion', 'Rol',
            'Jurado #2', 'Desicion', 'Rol', 'Jurado 3', 'Desicion', 'Rol', 'Fecha de Aprobación',
            'Fechad de Aprobacion del Tutor', 'Nota', 'Fecha de Defensa', 'Mencion');//54

        // Modificar creador y titulo del documento
        $spreadsheet->getProperties()->setCreator('Universidad Católica Andres Bello')
            ->setTitle('Lista de Tesis de Grado de Ciencias Sociales');
        for ($i = 0; $i < 55; $i++) {
            // Modificar valor del celda
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue($letters[$i] . '1', $camp[$i]);
        }

        $mongo = new mongoDataBase();

        $cursor = $mongo->getProyectsByTermCode($_POST["term_code"]);
        if(!is_bool($cursor)){
            $projects = $mongo->getProyectsByTermCode($_POST["term_code"])->toArray();
        }
        else{
            $_SESSION["title"] = TITLE_NOT_FOUND_PROJECTS;
            $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECTS;
            header("Location: mensaje.php");
        }



        // Si existen proyectos
        if (count($projects) > 0) {
            $i = 0;
            $j = 2;
            foreach ($projects as $element) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->term_code);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->id_register);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->date_register);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                // Si existe la variable version
                if (isset($element->version)) {
                    // Si es 1era version
                    if ($element->version == "first_version") {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($letters[$i] . $j, "Version 1");
                    } else {
                        $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue($letters[$i] . $j, "Version 2");
                    }
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->title);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_name);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_id);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_hab_phone);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_cel_phone);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_ucab_email);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_one_personal_email);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                // Si existe la variable especialidad
                if (isset($element->student_one_specialty)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_specialty);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable mencion
                if (isset($element->student_one_mention)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_mention);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable escolaridad
                if (isset($element->student_one_scholarship)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_scholarship);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe añ de finalizacion
                if (isset($element->student_one_year_ended)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_year_ended);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de titulo de seminario
                if (isset($element->student_one_seminar_title)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_seminar_title);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe el profesor
                if (isset($element->student_one_professor)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_professor);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la varibale año de aprobacion
                if (isset($element->student_one_approval_year)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_approval_year);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable fecha de aprobacion
                if (isset($element->student_one_approval_date)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_approval_date);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe variable mismo seminario
                if (isset($element->student_one_same_seminar)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_one_same_seminar);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_name);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_id);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_hab_phone);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_cel_phone);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_ucab_email);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->student_two_personal_email);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                // Si existe la variable especialidad
                if (isset($element->student_two_specialty)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_specialty);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable mencion
                if (isset($element->student_two_mention)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_mention);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de escolaridad
                if (isset($element->student_two_scholarship)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_scholarship);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe año de finalización
                if (isset($element->student_one_year_ended)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_year_ended);
                    // Pasa a la siguiente celda horizontalmente$i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de titulo de seminario
                if (isset($element->student_two_seminar_title)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_seminar_title);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe el profesor
                if (isset($element->student_two_professor)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_professor);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe el año de aprobacion
                if (isset($element->student_two_approval_year)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_approval_year);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la fecha de aprobacion
                if (isset($element->student_two_approval_date)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_approval_date);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable del mismo de seminario
                if (isset($element->student_two_same_seminar)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->student_two_same_seminar);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->tutor_name);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->tutor_email);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->tutor_cel_phone);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->tutor_id);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                // Si existe la variable tutor externo
                if (isset($element->tutor_extern)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->tutor_extern);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la aprobacion del tutor
                if (isset($element->tutor_approve)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->tutor_approve);
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_one_fullname);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_one_status);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_one_rol);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_two_fullname);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_two_status);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_two_rol);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_three_fullname);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_three_status);
                // Pasa a la siguiente celda horizontalmente$i++;
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letters[$i] . $j, $element->jury_three_rol);
                // Pasa a la siguiente celda horizontalmente
                $i++;
                // Si existe la variable de fecha de aprobacion
                if (isset($element->approval_date)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->approval_date);
                    // Pasa a la siguiente celda horizontalmente$i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de fecha de aprobacion del tutor
                if (isset($element->tutor_approve_date)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->tutor_approve_date);
                    // Pasa a la siguiente celda horizontalmente$i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe al variable de notas
                if (isset($element->note)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->note);
                    // Pasa a la siguiente celda horizontalmente$i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de fecha de defensa
                if (isset($element->defense_date)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->defense_date);
                    // Pasa a la siguiente celda horizontalmente$i++;
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Si existe la variable de mencion
                if (isset($element->mention)) {
                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue($letters[$i] . $j, $element->mention);
                } else {
                    // Pasa a la siguiente celda horizontalmente
                    $i++;
                }
                // Para a la siguiente celda verticalmente
                $j++;
                // Reinicia el contador de las celdas horizontalmente
                $i = 0;
            }
        } else {
            $_SESSION["title"] = TITLE_NOT_FOUND_PROJECTS;
            $_SESSION["message"] = MESSAGE_NOT_FOUND_PROJECTS;
            header("Location: ./mensaje.php");
        }

        // Se mueve entre las celdas y modifica el tamaño automaticamente
        for ($col = 'A'; $col !== 'AAZ'; $col++) {
            $spreadsheet->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }


        // Modifica el tirulo del excel
        $spreadsheet->getActiveSheet()->setTitle('Tesis de Grado');

        // Modifica la hoja 1 activa
        $spreadsheet->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Lista de Tesis de Grado' . date('d/m/Y', time()) . '.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public'); // HTTP/1.0

        // Añade la hoja de calculo creada al excel
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        // Despliega el excel
        $writer->save('php://output');
        exit;
    }
    else{
        $_SESSION["title"] = TITLE_NO_ACCESS;
        $_SESSION["message"] = MESSAGE_NO_ACCESS;
        header("Location: ./mensaje.php");
    }
            




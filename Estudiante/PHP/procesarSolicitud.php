<?php

    session_start();

    include_once ("mongoDB.php");
    include_once ("verify.php");
    include_once ("ProjectAAnual.php");
    include_once ("ProjectFAnual.php");
    include_once ("ProjectASemestral.php");
    include_once ("ProjectFSemestral.php");

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];

    $verify = new verify();
    $mongo = new mongoDataBase();
    // Si se dio la coneccion

    if(isset($_SESSION['register']) && !$_SESSION['register'])
    {
        if($mongo->conexionMongoDB()!=null)
        {
            if (!empty($_SESSION["formato"]) && isset($_SESSION["formato"])) {
                if ($_SESSION["formato"] == "formatAAnual") {
                    // Si es de 2 estudiantes
                    if(!empty($_POST["student_two_name"]) && !empty($_POST["student_two_id"]) && !empty($_POST["student_two_hab_phone"]) &&
                        !empty($_POST["student_two_cel_phone"]) && !empty($_POST["student_two_ucab_email"]) && !empty($_POST["student_two_personal_email"]) &&
                        !empty($_POST["student_two_professor"]) && !empty($_POST["student_two_approval_year"]) && !empty($_POST["student_two_seminar_title"])) {
                        // Si los campos corresponden a un numero de telefono
                        if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['student_two_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_two_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                            // Si las los campos corresponde a un  numero de cedula
                            if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['student_two_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"]) && $verify->verifyUCABEmail($_POST["student_two_ucab_email"])) {

                                    if (!isset($_POST["student_one_mention"])) {
                                        $_POST["student_one_mention"] = "Sin O";
                                    }
                                    if (!isset($_POST["student_two_mention"])) {
                                        $_POST["student_two_mention"] = "Sin O";
                                    }
                                    $project = new ProjectAAnual($_SESSION["formato"]
                                        , $_POST["version"], $_POST["title"], $_POST["student_one_name"], $_POST["student_one_id"]
                                        , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"]
                                        , $_POST["student_one_personal_email"], $_POST["student_one_specialty"], $_POST["student_one_mention"]
                                        , $_POST["student_one_scholarship"], $_POST["student_one_year_ended"], $_POST["student_one_seminar_title"]
                                        , $_POST["student_one_professor"], $_POST["student_one_approval_year"], $_POST["student_one_same_seminar"]
                                        , $_POST["student_two_name"], $_POST["student_two_id"], $_POST["student_two_hab_phone"], $_POST["student_two_cel_phone"]
                                        , $_POST["student_two_ucab_email"], $_POST["student_two_personal_email"], $_POST["student_two_specialty"]
                                        , $_POST["student_two_mention"], $_POST["student_two_scholarship"], $_POST["student_two_year_ended"]
                                        , $_POST["student_two_seminar_title"], $_POST["student_two_professor"], $_POST["student_two_approval_year"]
                                        , $_POST["student_two_same_seminar"], $_POST["tutor_name"], $_POST["tutor_email"], $_POST["tutor_cel_phone"]
                                        , $_POST["tutor_id"]);

                                    $arrProject = array(
                                        'id' => $mongo->getLastID() + 1,
                                        'format' => $project->getFormat(),
                                        'term_code' => $project->getTermCode(),
                                        'id_register' => $project->getProjectID(),
                                        'date_register' => $project->getDateRegister(),
                                        'version' => $project->getVersion(),
                                        'title' => $project->getTitle(),
                                        'student_one_name' => $project->getStudentNameOne(),
                                        'student_one_id' => $project->getStudentIDOne(),
                                        'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                        'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                        'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                        'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                        'student_one_specialty' => $project->getStudentSpecialtyOne(),
                                        'student_one_mention' => $project->getStudentMentionOne(),
                                        'student_one_scholarship' => $project->getStudentScholarchipOne(),
                                        'student_one_year_ended' => $project->getStudentYearEndedOne(),
                                        'student_one_seminar_title' => $project->getStudentSeminarTitleOne(),
                                        'student_one_professor' => $project->getStudentProfessorOne(),
                                        'student_one_approval_year' => $project->getStudentApprovalYearOne(),
                                        'student_one_same_seminar' => $project->getStudentSameSeminarOne(),
                                        'student_two_name' => $project->getStudentNameTwo(),
                                        'student_two_id' => $project->getStudentCITwo(),
                                        'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                        'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                        'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                        'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                        'student_two_specialty' => $project->getStudentSpecialtyTwo(),
                                        'student_two_mention' => $project->getStudentMentionTwo(),
                                        'student_two_scholarship' => $project->getStudentScholarchipTwo(),
                                        'student_two_year_ended' => $project->getStudentYearEndedTwo(),
                                        'student_two_seminar_title' => $project->getStudentSeminarTitleTwo(),
                                        'student_two_professor' => $project->getStudentProfessorTwo(),
                                        'student_two_approval_year' => $project->getStudentApprovalYearTwo(),
                                        'student_two_same_seminar' => $project->getStudentSameSeminarTwo(),
                                        'tutor_name' => $project->getTutorName(),
                                        'tutor_email' => $project->getTutorEmail(),
                                        'tutor_cel_phone' => $project->getTutorCelPhone(),
                                        'tutor_id' => $project->getTutorCI(),
                                        'tutor_extern' => $project->getExtern(),
                                        'tutor_approve' => $project->getTutorApprove(),
                                        'jury_one_fullname' => $project->getJuryOne(),
                                        'jury_one_status' => $project->getJuryStatusOne(),
                                        'jury_one_rol' => $project->getJuryRolOne(),
                                        'jury_two_fullname' => $project->getJutyTwo(),
                                        'jury_two_status' => $project->getJuryStatusTwo(),
                                        'jury_two_rol' => $project->getJuryRolTwo(),
                                        'jury_three_fullname' => $project->getJutyThree(),
                                        'jury_three_status' => $project->getJuryStatusThree(),
                                        'jury_three_rol' => $project->getJuryRolThree(),
                                        'approval_date' => $project->getApprovalDate(),
                                        'approve' => $project->getApprove());
                                } else {
                                    echo "<script>
                                                            alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                            window.history.back();
                                                        </script>";
                                }
                            } else {
                                echo "<script>
                                                                    alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                    window.history.back();
                                                                </script>";
                            }
                        }else {
                            echo "<script>
                                            alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                            window.history.back();
                                            </script>";
                        }
                    }
                    else {
                        // Si es de un estudiante
                        if (empty($_POST["student_two_name"]) && empty($_POST["student_two_id"]) && empty($_POST["student_two_hab_phone"]) &&
                            empty($_POST["student_two_cel_phone"]) && empty($_POST["student_two_ucab_email"]) && empty($_POST["student_two_personal_email"]) &&
                            empty($_POST["student_two_professor"]) && empty($_POST["student_two_approval_year"])) {
                            // Si los campos corresponden a un numero de telefono
                            if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                                && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                                // Si las los campos corresponde a un  numero de cedula
                                if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                    if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"])) {
                                        if(!isset($_POST["student_one_mention"]))
                                        {
                                            $_POST["student_one_mention"] = "Sin O";
                                        }
                                        if(!isset($_POST["student_two_mention"]))
                                        {
                                            $_POST["student_two_mention"] = "Sin O";
                                        }
                                        $project = new ProjectAAnual($_SESSION["formato"]
                                            , $_POST["version"], $_POST["title"], $_POST["student_one_name"], $_POST["student_one_id"]
                                            , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"]
                                            , $_POST["student_one_personal_email"], $_POST["student_one_specialty"], $_POST["student_one_mention"]
                                            , $_POST["student_one_scholarship"], $_POST["student_one_year_ended"], $_POST["student_one_seminar_title"]
                                            , $_POST["student_one_professor"], $_POST["student_one_approval_year"], $_POST["student_one_same_seminar"]
                                            , "", "", "", ""
                                            , "", "", ""
                                            , "", "", ""
                                            , "", "", ""
                                            , "", $_POST["tutor_name"], $_POST["tutor_email"], $_POST["tutor_cel_phone"]
                                            , $_POST["tutor_id"]);

                                        $arrProject = array('id' => $mongo->getLastID() + 1,
                                            'format' => $project->getFormat(),
                                            'term_code' => $project->getTermCode(),
                                            'id_register' => $project->getProjectID(),
                                            'date_register' => $project->getDateRegister(),
                                            'version' => $project->getVersion(),
                                            'title' => $project->getTitle(),
                                            'student_one_name' => $project->getStudentNameOne(),
                                            'student_one_id' => $project->getStudentIDOne(),
                                            'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                            'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                            'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                            'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                            'student_one_specialty' => $project->getStudentSpecialtyOne(),
                                            'student_one_mention' => $project->getStudentMentionOne(),
                                            'student_one_scholarship' => $project->getStudentScholarchipOne(),
                                            'student_one_year_ended' => $project->getStudentYearEndedOne(),
                                            'student_one_seminar_title' => $project->getStudentSeminarTitleOne(),
                                            'student_one_professor' => $project->getStudentProfessorOne(),
                                            'student_one_approval_year' => $project->getStudentApprovalYearOne(),
                                            'student_one_same_seminar' => $project->getStudentSameSeminarOne(),
                                            'student_two_name' => $project->getStudentNameTwo(),
                                            'student_two_id' => $project->getStudentCITwo(),
                                            'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                            'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                            'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                            'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                            'student_two_specialty' => $project->getStudentSpecialtyTwo(),
                                            'student_two_mention' => $project->getStudentMentionTwo(),
                                            'student_two_scholarship' => $project->getStudentScholarchipTwo(),
                                            'student_two_year_ended' => $project->getStudentYearEndedTwo(),
                                            'student_two_seminar_title' => $project->getStudentSeminarTitleTwo(),
                                            'student_two_professor' => $project->getStudentProfessorTwo(),
                                            'student_two_approval_year' => $project->getStudentApprovalYearTwo(),
                                            'student_two_same_seminar' => $project->getStudentSameSeminarTwo(),
                                            'tutor_name' => $project->getTutorName(),
                                            'tutor_email' => $project->getTutorEmail(),
                                            'tutor_cel_phone' => $project->getTutorCelPhone(),
                                            'tutor_id' => $project->getTutorCI(),
                                            'tutor_extern' => $project->getExtern(),
                                            'tutor_approve' => $project->getTutorApprove(),
                                            'jury_one_fullname' => $project->getJuryOne(),
                                            'jury_one_status' => $project->getJuryStatusOne(),
                                            'jury_one_rol' => $project->getJuryRolOne(),
                                            'jury_two_fullname' => $project->getJutyTwo(),
                                            'jury_two_status' => $project->getJuryStatusTwo(),
                                            'jury_two_rol' => $project->getJuryRolTwo(),
                                            'jury_three_fullname' => $project->getJutyThree(),
                                            'jury_three_status' => $project->getJuryStatusThree(),
                                            'jury_three_rol' => $project->getJuryRolThree(),
                                            'approval_date' => $project->getApprovalDate(),
                                            'approve' => $project->getApprove());
                                    } else {
                                        echo "<script>
                                                                alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                window.history.back();
                                                            </script>";
                                    }
                                } else {
                                    echo "<script>
                                                                        alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                        window.history.back();
                                                                    </script>";
                                }
                            }else {
                                echo "<script>
                                                alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                window.history.back();
                                                </script>";
                            }
                        } else {
                            $_SESSION["title"] = TITLE_MISSING_FIELDS;
                            $_SESSION["message"] = MESSAGE_MISSING_FIELDS;
                            header("Location: ./mensaje.php");
                        }
                    }
                }
                if ($_SESSION["formato"] == "formatASemestral") {
                    // Si es de 2 estudiantes
                    if(!empty($_POST["student_two_name"]) && !empty($_POST["student_two_id"]) && !empty($_POST["student_two_hab_phone"]) &&
                        !empty($_POST["student_two_cel_phone"]) && !empty($_POST["student_two_ucab_email"]) && !empty($_POST["student_two_personal_email"]) &&
                        !empty($_POST["student_two_professor"]) && !empty($_POST["student_two_approval_date"])) {
                        // Si los campos corresponden a un numero de telefono
                        if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['student_two_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_two_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                            // Si las los campos corresponde a un  numero de cedula
                            if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['student_two_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"]) && $verify->verifyUCABEmail($_POST["student_two_ucab_email"])) {
                                    if(!isset($_POST["student_one_mention"]))
                                    {
                                        $_POST["student_one_mention"] = "Sin O";
                                    }
                                    if(!isset($_POST["student_two_mention"]))
                                    {
                                        $_POST["student_two_mention"] = "Sin O";
                                    }
                                    $project = new ProjectASemestral($_SESSION["formato"]
                                        , $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"], $_POST["student_one_hab_phone"]
                                        , $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"], $_POST["student_one_professor"]
                                        , $_POST["student_one_approval_date"], $_POST["student_two_name"], $_POST["student_two_id"], $_POST["student_two_hab_phone"]
                                        , $_POST["student_two_cel_phone"], $_POST["student_two_ucab_email"], $_POST["student_two_personal_email"], $_POST["student_two_professor"]
                                        , $_POST["student_two_approval_date"], /*$_POST["same_seminar"]*/'', $_POST["tutor_name"], $_POST["tutor_email"], $_POST["tutor_cel_phone"]
                                        , $_POST["tutor_id"]);

                                    $arrProject = array('id' => $mongo->getLastID() + 1,
                                        'format' => $project->getFormat(),
                                        'term_code' => $project->getTermCode(),
                                        'id_register' => $project->getProjectID(),
                                        'date_register' => $project->getDateRegister(),
                                        'title' => $project->getTitle(),
                                        'investigation_area' => $project->getInvestigationArea(),
                                        'student_one_name' => $project->getStudentNameOne(),
                                        'student_one_id' => $project->getStudentIDOne(),
                                        'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                        'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                        'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                        'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                        'student_one_professor' => $project->getStudentProfessorOne(),
                                        'student_one_approval_year' => $project->getStudentApprovalDateOne(),
                                        'student_two_name' => $project->getStudentNameTwo(),
                                        'student_two_id' => $project->getStudentCITwo(),
                                        'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                        'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                        'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                        'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                        'student_two_professor' => $project->getStudentProfessorTwo(),
                                        'student_two_approval_year' => $project->getStudentApprovalDateTwo(),
                                        'same_seminar' => $project->setStudentSameSeminarTwo(),
                                        'tutor_name' => $project->getTutorName(),
                                        'tutor_email' => $project->getTutorEmail(),
                                        'tutor_cel_phone' => $project->getTutorCelPhone(),
                                        'tutor_id' => $project->getTutorCI(),
                                        'tutor_extern' => $project->getExtern(),
                                        'tutor_approve' => $project->getTutorApprove(),
                                        'jury_one_fullname' => $project->getJuryOne(),
                                        'jury_one_status' => $project->getJuryStatusOne(),
                                        'jury_one_rol' => $project->getJuryRolOne(),
                                        'jury_two_fullname' => $project->getJutyTwo(),
                                        'jury_two_status' => $project->getJuryStatusTwo(),
                                        'jury_two_rol' => $project->getJuryRolTwo(),
                                        'jury_three_fullname' => $project->getJutyThree(),
                                        'jury_three_status' => $project->getJuryStatusThree(),
                                        'jury_three_rol' => $project->getJuryRolThree(),
                                        'approval_date' => $project->getApprovalDate(),
                                        'approve' => $project->getApprove());
                                } else {
                                    echo "<script>
                                                                    alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                    window.history.back();
                                                                </script>";
                                }
                            } else {
                                echo "<script>
                                                                            alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                            window.history.back();
                                                                        </script>";
                            }
                        }else {
                            echo "<script>
                                                    alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                    window.history.back();
                                                    </script>";
                        }
                    }
                    else {
                        // Si es de 1 estudiante
                        if(empty($_POST["student_two_name"]) && empty($_POST["student_two_id"]) && empty($_POST["student_two_hab_phone"]) &&
                            empty($_POST["student_two_cel_phone"]) && empty($_POST["student_two_ucab_email"]) && empty($_POST["student_two_personal_email"]) &&
                            empty($_POST["student_two_professor"]) && empty($_POST["student_two_approval_date"])) {
                            if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                                && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                                // Si las los campos corresponde a un  numero de cedula
                                if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                    if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"])) {
                                        if(!isset($_POST["student_one_mention"]))
                                        {
                                            $_POST["student_one_mention"] = "Sin O";
                                        }
                                        if(!isset($_POST["student_two_mention"]))
                                        {
                                            $_POST["student_two_mention"] = "Sin O";
                                        }
                                        $project = new ProjectASemestral($_SESSION["formato"]
                                            , $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"], $_POST["student_one_hab_phone"]
                                            , $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"], $_POST["student_one_professor"]
                                            , $_POST["student_one_approval_date"], "", "", ""
                                            , "", "", "", ""
                                            , "", /*$_POST["same_seminar"]*/ '', $_POST["tutor_name"], $_POST["tutor_email"], $_POST["tutor_cel_phone"]
                                            , $_POST["tutor_id"]);

                                        $arrProject = array('id' => $mongo->getLastID() + 1,
                                            'format' => $project->getFormat(),
                                            'term_code' => $project->getTermCode(),
                                            'id_register' => $project->getProjectID(),
                                            'date_register' => $project->getDateRegister(),
                                            'title' => $project->getTitle(),
                                            'investigation_area' => $project->getInvestigationArea(),
                                            'student_one_name' => $project->getStudentNameOne(),
                                            'student_one_id' => $project->getStudentIDOne(),
                                            'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                            'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                            'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                            'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                            'student_one_professor' => $project->getStudentProfessorOne(),
                                            'student_one_approval_year' => $project->getStudentApprovalDateOne(),
                                            'student_two_name' => $project->getStudentNameTwo(),
                                            'student_two_id' => $project->getStudentCITwo(),
                                            'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                            'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                            'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                            'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                            'student_two_professor' => $project->getStudentProfessorTwo(),
                                            'student_two_approval_year' => $project->getStudentApprovalDateTwo(),
                                            'same_seminar' => $project->setStudentSameSeminarTwo(),
                                            'tutor_name' => $project->getTutorName(),
                                            'tutor_email' => $project->getTutorEmail(),
                                            'tutor_cel_phone' => $project->getTutorCelPhone(),
                                            'tutor_id' => $project->getTutorCI(),
                                            'tutor_extern' => $project->getExtern(),
                                            'tutor_approve' => $project->getTutorApprove(),
                                            'jury_one_fullname' => $project->getJuryOne(),
                                            'jury_one_status' => $project->getJuryStatusOne(),
                                            'jury_one_rol' => $project->getJuryRolOne(),
                                            'jury_two_fullname' => $project->getJutyTwo(),
                                            'jury_two_status' => $project->getJuryStatusTwo(),
                                            'jury_two_rol' => $project->getJuryRolTwo(),
                                            'jury_three_fullname' => $project->getJutyThree(),
                                            'jury_three_status' => $project->getJuryStatusThree(),
                                            'jury_three_rol' => $project->getJuryRolThree(),
                                            'approval_date' => $project->getApprovalDate(),
                                            'approve' => $project->getApprove());
                                    } else {
                                        echo "<script>
                                                                        alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                        window.history.back();
                                                                    </script>";
                                    }
                                } else {
                                    echo "<script>
                                                                                alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                                window.history.back();
                                                                            </script>";
                                }
                            }else {
                                echo "<script>
                                                        alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                        window.history.back();
                                                        </script>";
                            }
                        }
                        else {
                            $_SESSION["title"] = TITLE_MISSING_FIELDS;
                            $_SESSION["message"] = MESSAGE_MISSING_FIELDS;
                            header("Location: ./mensaje.php");
                        }
                    }
                }
                if ($_SESSION["formato"] == "formatFAnual") {
                    // Si es de 2 estudaintes
                    if(!empty($_POST["student_two_name"]) && !empty($_POST["student_two_id"]) && !empty($_POST["student_two_hab_phone"]) &&
                        !empty($_POST["student_two_cel_phone"]) && !empty($_POST["student_two_ucab_email"]) && !empty($_POST["student_two_personal_email"])) {
                        // Si los campos corresponden a un numero de telefono
                        if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['student_two_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_two_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                            // Si las los campos corresponde a un  numero de cedula
                            if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['student_two_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"]) && $verify->verifyUCABEmail($_POST["student_two_ucab_email"])) {
                                    if(!isset($_POST["student_one_mention"]))
                                    {
                                        $_POST["student_one_mention"] = "Sin O";
                                    }
                                    if(!isset($_POST["student_two_mention"]))
                                    {
                                        $_POST["student_two_mention"] = "Sin O";
                                    }
                                    $project = new ProjectFAnual($_SESSION["formato"]
                                        , $_POST['approval_date'], $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"]
                                        , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"]
                                        , $_POST["student_one_speciality"], $_POST["student_one_mention"]
                                        , $_POST["student_one_scholarship"], $_POST["student_one_year_ended"], $_POST["student_two_name"], $_POST["student_two_id"]
                                        , $_POST["student_two_hab_phone"], $_POST["student_two_cel_phone"], $_POST["student_two_ucab_email"], $_POST["student_two_personal_email"]
                                        , $_POST["student_two_specialty"], $_POST["student_two_mention"], $_POST["student_two_scholarship"], $_POST["student_two_year_ended"]
                                        , $_POST["tutor_name"], $_POST["tutor_email"], $_POST["tutor_hab_phone"], $_POST["tutor_cel_phone"], $_POST["tutor_id"]);

                                    $arrProject = array('id' => $mongo->getLastID() + 1,
                                        'format' => $project->getFormat(),
                                        'term_code' => $project->getTermCode(),
                                        'id_register' => $project->getProjectID(),
                                        'date_register' => $project->getDateRegister(),
                                        'approval_date' => $project->getApprovalDate(),
                                        'investigation_area' => $project->getInvestigationArea(),
                                        'title' => $project->getTitle(),
                                        'student_one_name' => $project->getStudentNameOne(),
                                        'student_one_id' => $project->getStudentIDOne(),
                                        'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                        'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                        'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                        'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                        'student_one_specialty' => $project->getStudentSpecialtyOne(),
                                        'student_one_mention' => $project->getStudentMentionOne(),
                                        'student_one_scholarship' => $project->getStudentScholarchipOne(),
                                        'student_one_year_ended' => $project->getStudentYearEndedOne(),
                                        'student_two_name' => $project->getStudentNameTwo(),
                                        'student_two_id' => $project->getStudentCITwo(),
                                        'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                        'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                        'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                        'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                        'student_two_specialty' => $project->getStudentSpecialtyTwo(),
                                        'student_two_mention' => $project->getStudentMentionTwo(),
                                        'student_two_scholarship' => $project->getStudentScholarchipTwo(),
                                        'student_two_year_ended' => $project->getStudentYearEndedTwo(),
                                        'tutor_name' => $project->getTutorName(),
                                        'tutor_email' => $project->getTutorEmail(),
                                        'tutor_hab_phone' => $project->getTutorHabPhone(),
                                        'tutor_cel_phone' => $project->getTutorCelPhone(),
                                        'tutor_id' => $project->getTutorCI(),
                                        'tutor_extern' => $project->getExtern(),
                                        'tutor_approve' => $project->getTutorApprove(),
                                        'jury_one_fullname' => $project->getJuryOne(),
                                        'jury_one_status' => $project->getJuryStatusOne(),
                                        'jury_one_rol' => $project->getJuryRolOne(),
                                        'jury_two_fullname' => $project->getJutyTwo(),
                                        'jury_two_status' => $project->getJuryStatusTwo(),
                                        'jury_two_rol' => $project->getJuryRolTwo(),
                                        'jury_three_fullname' => $project->getJutyThree(),
                                        'jury_three_status' => $project->getJuryStatusThree(),
                                        'jury_three_rol' => $project->getJuryRolThree(),
                                        'cd' => $project->getCd(),
                                        'approve' => $project->getApprove(),
                                        'id_register_estudiante'=>$_POST['id_register']);
                                } else {
                                    echo "<script>
                                                                            alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                            window.history.back();
                                                                        </script>";
                                }
                            } else {
                                echo "<script>
                                                                                    alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                                    window.history.back();
                                                                                </script>";
                            }
                        }else {
                            echo "<script>
                                                            alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                            window.history.back();
                                                            </script>";
                        }
                    }
                    else {
                        // Si es de 1 estudiante
                        if(empty($_POST["student_two_name"]) && empty($_POST["student_two_id"]) && empty($_POST["student_two_hab_phone"]) &&
                            empty($_POST["student_two_cel_phone"]) && empty($_POST["student_two_ucab_email"]) && empty($_POST["student_two_personal_email"])) {
                            // Si los campos corresponden a un numero de telefono
                            if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                                && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                                // Si las los campos corresponde a un  numero de cedula
                                if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                    if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"])) {
                                        if(!isset($_POST["student_one_mention"]))
                                        {
                                            $_POST["student_one_mention"] = "Sin O";
                                        }
                                        if(!isset($_POST["student_two_mention"]))
                                        {
                                            $_POST["student_two_mention"] = "Sin O";
                                        }
                                        $project = new ProjectFAnual($_SESSION["formato"]
                                            , $_POST['approval_date'], $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"]
                                            , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"]
                                            , $_POST["student_one_speciality"], $_POST["student_one_mention"]
                                            , $_POST["student_one_scholarship"], $_POST["student_one_year_ended"], "", ""
                                            , "", "", "", ""
                                            , "", "", "", ""
                                            , $_POST["tutor_name"], "", $_POST["tutor_hab_phone"], $_POST["tutor_cel_phone"], $_POST["tutor_id"]);

                                        $arrProject = array('id' => $mongo->getLastID() + 1,
                                            'format' => $project->getFormat(),
                                            'term_code' => $project->getTermCode(),
                                            'id_register' => $project->getProjectID(),
                                            'date_register' => $project->getDateRegister(),
                                            'approval_date' => $project->getApprovalDate(),
                                            'investigation_area' => $project->getInvestigationArea(),
                                            'title' => $project->getTitle(),
                                            'student_one_name' => $project->getStudentNameOne(),
                                            'student_one_id' => $project->getStudentIDOne(),
                                            'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                            'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                            'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                            'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                            'student_one_specialty' => $project->getStudentSpecialtyOne(),
                                            'student_one_mention' => $project->getStudentMentionOne(),
                                            'student_one_scholarship' => $project->getStudentScholarchipOne(),
                                            'student_one_year_ended' => $project->getStudentYearEndedOne(),
                                            'student_two_name' => $project->getStudentNameTwo(),
                                            'student_two_id' => $project->getStudentCITwo(),
                                            'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                            'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                            'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                            'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                            'student_two_specialty' => $project->getStudentSpecialtyTwo(),
                                            'student_two_mention' => $project->getStudentMentionTwo(),
                                            'student_two_scholarship' => $project->getStudentScholarchipTwo(),
                                            'student_two_year_ended' => $project->getStudentYearEndedTwo(),
                                            'tutor_name' => $project->getTutorName(),
                                            'tutor_email' => $project->getTutorEmail(),
                                            'tutor_hab_phone' => $project->getTutorHabPhone(),
                                            'tutor_cel_phone' => $project->getTutorCelPhone(),
                                            'tutor_id' => $project->getTutorCI(),
                                            'tutor_extern' => $project->getExtern(),
                                            'tutor_approve' => $project->getTutorApprove(),
                                            'jury_one_fullname' => $project->getJuryOne(),
                                            'jury_one_status' => $project->getJuryStatusOne(),
                                            'jury_one_rol' => $project->getJuryRolOne(),
                                            'jury_two_fullname' => $project->getJutyTwo(),
                                            'jury_two_status' => $project->getJuryStatusTwo(),
                                            'jury_two_rol' => $project->getJuryRolTwo(),
                                            'jury_three_fullname' => $project->getJutyThree(),
                                            'jury_three_status' => $project->getJuryStatusThree(),
                                            'jury_three_rol' => $project->getJuryRolThree(),
                                            'cd' => $project->getCd(),
                                            'approve' => $project->getApprove(),
                                            'id_register_estudiante'=>$_POST['id_register']);

                                    } else {
                                        echo "<script>
                                                                                alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                                window.history.back();
                                                                            </script>";
                                    }
                                } else {
                                    echo "<script>
                                                                                        alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                                        window.history.back();
                                                                                    </script>";
                                }
                            }else {
                                echo "<script>
                                                                alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                                window.history.back();
                                                                </script>";
                            }
                        }
                        else {
                            $_SESSION["title"] = TITLE_MISSING_FIELDS;
                            $_SESSION["message"] = MESSAGE_MISSING_FIELDS;
                            header("Location: ./mensaje.php");
                        }
                    }
                }

                if ($_SESSION["formato"] == "formatFSemestral") {
                    // Si es de 2 estudaintes
                    if(!empty($_POST["student_two_name"]) && !empty($_POST["student_two_id"]) && !empty($_POST["student_two_hab_phone"]) &&
                        !empty($_POST["student_two_cel_phone"]) && !empty($_POST["student_two_ucab_email"]) && !empty($_POST["student_two_personal_email"])) {
                        // Si los campos corresponden a un numero de telefono
                        if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['student_two_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_two_cel_phone'])
                            && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                            // Si las los campos corresponde a un  numero de cedula
                            if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['student_two_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"]) && $verify->verifyUCABEmail($_POST["student_two_ucab_email"])) {
                                    if(!isset($_POST["student_one_mention"]))
                                    {
                                        $_POST["student_one_mention"] = "Sin O";
                                    }
                                    if(!isset($_POST["student_two_mention"]))
                                    {
                                        $_POST["student_two_mention"] = "Sin O";
                                    }
                                    $project = new ProjectFSemestral($_SESSION["formato"]
                                        , $_POST['approval_date'], $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"]
                                        , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"]
                                        , $_POST["student_two_name"], $_POST["student_two_id"], $_POST["student_two_hab_phone"], $_POST["student_two_cel_phone"]
                                        , $_POST["student_two_ucab_email"], $_POST["student_two_personal_email"], $_POST["tutor_name"], $_POST["tutor_email"]
                                        , $_POST["tutor_cel_phone"], $_POST["tutor_id"]);

                                    $arrProject = array('id' => $mongo->getLastID() + 1,
                                        'format' => $project->getFormat(),
                                        'term_code' => $project->getTermCode(),
                                        'id_register' => $project->getProjectID(),
                                        'date_register' => $project->getDateRegister(),
                                        'approval_date' => $project->getApprovalDate(),
                                        'investigation_area' => $project->getInvestigationArea(),
                                        'title' => $project->getTitle(),
                                        'student_one_name' => $project->getStudentNameOne(),
                                        'student_one_id' => $project->getStudentIDOne(),
                                        'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                        'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                        'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                        'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                        'student_two_name' => $project->getStudentNameTwo(),
                                        'student_two_id' => $project->getStudentCITwo(),
                                        'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                        'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                        'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                        'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                        'tutor_name' => $project->getTutorName(),
                                        'tutor_email' => $project->getTutorEmail(),
                                        'tutor_cel_phone' => $project->getTutorCelPhone(),
                                        'tutor_id' => $project->getTutorCI(),
                                        'tutor_extern' => $project->getExtern(),
                                        'tutor_approve' => $project->getTutorApprove(),
                                        'jury_one_fullname' => $project->getJuryOne(),
                                        'jury_one_status' => $project->getJuryStatusOne(),
                                        'jury_one_rol' => $project->getJuryRolOne(),
                                        'jury_two_fullname' => $project->getJutyTwo(),
                                        'jury_two_status' => $project->getJuryStatusTwo(),
                                        'jury_two_rol' => $project->getJuryRolTwo(),
                                        'jury_three_fullname' => $project->getJutyThree(),
                                        'jury_three_status' => $project->getJuryStatusThree(),
                                        'jury_three_rol' => $project->getJuryRolThree(),
                                        'cd' => $project->getCd(),
                                        'approve' => $project->getApprove(),
                                        'id_register_estudiante'=>$_POST['id_register']);
                                } else {
                                    echo "<script>
                                                                                    alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                                    window.history.back();
                                                                                </script>";
                                }
                            } else {
                                echo "<script>
                                                                                            alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                                            window.history.back();
                                                                                        </script>";
                            }
                        }else {
                            echo "<script>
                                                                    alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                                    window.history.back();
                                                                    </script>";
                        }
                    }
                    else {
                        // Si es de 1 estudiante
                        if(empty($_POST["student_two_name"]) && empty($_POST["student_two_id"]) && empty($_POST["student_two_hab_phone"]) &&
                            empty($_POST["student_two_cel_phone"]) && empty($_POST["student_two_ucab_email"]) && empty($_POST["student_two_personal_email"])) {
                            // Si los campos corresponden a un numero de telefono
                            if ($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
                                && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])) {
                                // Si las los campos corresponde a un  numero de cedula
                                if ($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['tutor_id'])) {
                                    if ($verify->verifyUCABEmail($_POST["student_one_ucab_email"])) {
                                        if(!isset($_POST["student_one_mention"]))
                                        {
                                            $_POST["student_one_mention"] = "Sin O";
                                        }
                                        if(!isset($_POST["student_two_mention"]))
                                        {
                                            $_POST["student_two_mention"] = "Sin O";
                                        }
                                        $project = new ProjectFSemestral($_SESSION["formato"]
                                            , $_POST['approval_date'], $_POST["title"], $_POST["investigation_area"], $_POST["student_one_name"], $_POST["student_one_id"]
                                            , $_POST["student_one_hab_phone"], $_POST["student_one_cel_phone"], $_POST["student_one_ucab_email"], $_POST["student_one_personal_email"]
                                            , "", "", "", ""
                                            , "", "", $_POST["tutor_name"], $_POST["tutor_email"]
                                            , $_POST["tutor_cel_phone"], $_POST["tutor_id"]);

                                        $arrProject = array('id' => $mongo->getLastID() + 1,
                                            'format' => $project->getFormat(),
                                            'term_code' => $project->getTermCode(),
                                            'id_register' => $project->getProjectID(),
                                            'date_register' => $project->getDateRegister(),
                                            'approval_date' => $project->getApprovalDate(),
                                            'investigation_area' => $project->getInvestigationArea(),
                                            'title' => $project->getTitle(),
                                            'student_one_name' => $project->getStudentNameOne(),
                                            'student_one_id' => $project->getStudentIDOne(),
                                            'student_one_hab_phone' => $project->getStudentHabPhoneOne(),
                                            'student_one_cel_phone' => $project->getStudentCelPhoneOne(),
                                            'student_one_ucab_email' => $project->getStudentUcabEmailOne(),
                                            'student_one_personal_email' => $project->getStudentPersonalEmailOne(),
                                            'student_two_name' => $project->getStudentNameTwo(),
                                            'student_two_id' => $project->getStudentCITwo(),
                                            'student_two_hab_phone' => $project->getStudentHabPhoneTwo(),
                                            'student_two_cel_phone' => $project->getStudentCelPhoneTwo(),
                                            'student_two_ucab_email' => $project->getStudentUcabEmailTwo(),
                                            'student_two_personal_email' => $project->getStudentPersonalEmailTwo(),
                                            'tutor_name' => $project->getTutorName(),
                                            'tutor_email' => $project->getTutorEmail(),
                                            'tutor_cel_phone' => $project->getTutorCelPhone(),
                                            'tutor_id' => $project->getTutorCI(),
                                            'tutor_extern' => $project->getExtern(),
                                            'tutor_approve' => $project->getTutorApprove(),
                                            'jury_one_fullname' => $project->getJuryOne(),
                                            'jury_one_status' => $project->getJuryStatusOne(),
                                            'jury_one_rol' => $project->getJuryRolOne(),
                                            'jury_two_fullname' => $project->getJutyTwo(),
                                            'jury_two_status' => $project->getJuryStatusTwo(),
                                            'jury_two_rol' => $project->getJuryRolTwo(),
                                            'jury_three_fullname' => $project->getJutyThree(),
                                            'jury_three_status' => $project->getJuryStatusThree(),
                                            'jury_three_rol' => $project->getJuryRolThree(),
                                            'cd' => $project->getCd(),
                                            'approve' => $project->getApprove(),
                                            'id_register_estudiante'=>$_POST['id_register']);
                                    } else {
                                        echo "<script>
                                                                                        alert('Correo Electronico invalido. Debe introducir un correo electronico de la ucab');
                                                                                        window.history.back();
                                                                                    </script>";
                                    }
                                } else {
                                    echo "<script>
                                                                                                alert('Cédula de Identidad invalida. La cédula de identidad debe ser de 6 digitos en adelante');
                                                                                                window.history.back();
                                                                                            </script>";
                                }
                            }else {
                                echo "<script>
                                                                        alert('Número de teléfono invalido. Debe introducir el valor con el siguiente formato XXXX-XXX-XXX. Ej. 0212-407-4308');
                                                                        window.history.back();
                                                                        </script>";
                            }

                        }
                        else {
                            $_SESSION["title"] = TITLE_MISSING_FIELDS;
                            $_SESSION["message"] = MESSAGE_MISSING_FIELDS;
                            header("Location: ./mensaje.php");
                        }
                    }

                }
                // Si realizo la insersion en la base de datos
                if ($mongo->insert($arrProject)) {

                    $_SESSION['project'] = $arrProject;
                    $_SESSION['title'] = TITLE_TESIS_REGISTER;
                    $_SESSION['message'] = MESSAGE_TESIS_REGISTER;
                    header("Location: ./mensaje.php");

                }
            }
        }
    }
    else{
        header("Location: ../index.html");
    }





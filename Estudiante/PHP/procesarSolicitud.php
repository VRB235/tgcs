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
    if($mongo->conexionMongoDB()!=null)
    {
        // Si los campos corresponden a un numero de telefono
        if($verify->verifyPhoneNumber($_POST['student_one_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_one_cel_phone'])
            && $verify->verifyPhoneNumber($_POST['student_two_hab_phone']) && $verify->verifyPhoneNumber($_POST['student_two_cel_phone'])
            && $verify->verifyPhoneNumber($_POST['tutor_cel_phone'])){
            // Si las los campos corresponde a un  numero de cedula
            if($verify->verifyID($_POST['student_one_id']) && $verify->verifyID($_POST['student_two_id']) && $verify->verifyID($_POST['tutor_id'])){

                if(!empty($_SESSION["formato"]) && isset($_SESSION["formato"])){
                    if($_SESSION["formato"]=="formatAAnual"){

                        $project = new ProjectAAnual($_SESSION["formato"]
                            ,$_POST["version"],$_POST["title"],$_POST["student_one_name"],$_POST["student_one_id"]
                            ,$_POST["student_one_hab_phone"],$_POST["student_one_cel_phone"],$_POST["student_one_ucab_email"]
                            ,$_POST["student_one_personal_email"],$_POST["student_one_specialty"],$_POST["student_one_mention"]
                            ,$_POST["student_one_scholarship"],$_POST["student_one_year_ended"],$_POST["student_one_seminar_title"]
                            ,$_POST["student_one_professor"],$_POST["student_one_approval_year"],$_POST["student_one_same_seminar"]
                            ,$_POST["student_two_name"],$_POST["student_two_id"],$_POST["student_two_hab_phone"],$_POST["student_two_cel_phone"]
                            ,$_POST["student_two_ucab_email"],$_POST["student_two_personal_email"],$_POST["student_two_specialty"]
                            ,$_POST["student_two_mention"],$_POST["student_two_scholarship"],$_POST["student_two_year_ended"]
                            ,$_POST["student_two_seminar_title"],$_POST["student_two_professor"],$_POST["student_two_approval_year"]
                            ,$_POST["student_two_same_seminar"],$_POST["tutor_name"],$_POST["tutor_email"],$_POST["tutor_cel_phone"]
                            ,$_POST["tutor_id"]);

                        $arrProject = array('id'=>$mongo->getLastID()+1,
                            'format'=> $project->getFormat(),
                            'term_code'=>$project->getTermCode(),
                            'id_register'=>$project->getProjectID(),
                            'date_register'=>$project->getDateRegister(),
                            'version'=>$project->getVersion(),
                            'title'=>$project->getTitle(),
                            'student_one_name'=>$project->getStudentNameOne(),
                            'student_one_id'=>$project->getStudentIDOne(),
                            'student_one_hab_phone'=>$project->getStudentHabPhoneOne(),
                            'student_one_cel_phone'=>$project->getStudentCelPhoneOne(),
                            'student_one_ucab_email'=>$project->getStudentUcabEmailOne(),
                            'student_one_personal_email'=>$project->getStudentPersonalEmailOne(),
                            'student_one_specialty'=>$project->getStudentSpecialtyOne(),
                            'student_one_mention'=>$project->getStudentMentionOne(),
                            'student_one_scholarship'=>$project->getStudentScholarchipOne(),
                            'student_one_year_ended'=>$project->getStudentYearEndedOne(),
                            'student_one_seminar_title'=>$project->getStudentSeminarTitleOne(),
                            'student_one_professor'=>$project->getStudentProfessorOne(),
                            'student_one_approval_year'=>$project->getStudentApprovalYearOne(),
                            'student_one_same_seminar'=>$project->getStudentSameSeminarOne(),
                            'student_two_name'=>$project->getStudentNameTwo(),
                            'student_two_id'=>$project->getStudentCITwo(),
                            'student_two_hab_phone'=>$project->getStudentHabPhoneTwo(),
                            'student_two_cel_phone'=>$project->getStudentCelPhoneTwo(),
                            'student_two_ucab_email'=>$project->getStudentUcabEmailTwo(),
                            'student_two_personal_email'=>$project->getStudentPersonalEmailTwo(),
                            'student_two_specialty'=>$project->getStudentSpecialtyTwo(),
                            'student_two_mention'=>$project->getStudentMentionTwo(),
                            'student_two_scholarship'=>$project->getStudentScholarchipTwo(),
                            'student_two_year_ended'=>$project->getStudentYearEndedTwo(),
                            'student_two_seminar_title'=>$project->getStudentSeminarTitleTwo(),
                            'student_two_professor'=>$project->getStudentProfessorTwo(),
                            'student_two_approval_year'=>$project->getStudentApprovalYearTwo(),
                            'student_two_same_seminar'=>$project->getStudentSameSeminarTwo(),
                            'tutor_name'=>$project->getTutorName(),
                            'tutor_email'=>$project->getTutorEmail(),
                            'tutor_cel_phone'=>$project->getTutorCelPhone(),
                            'tutor_id'=>$project->getTutorCI(),
                            'tutor_extern'=>$project->getExtern(),
                            'tutor_approve'=>$project->getTutorApprove(),
                            'jury_one_fullname'=>$project->getJuryOne(),
                            'jury_one_status'=>$project->getJuryStatusOne(),
                            'jury_one_rol'=>$project->getJuryRolOne(),
                            'jury_two_fullname'=>$project->getJutyTwo(),
                            'jury_two_status'=>$project->getJuryStatusTwo(),
                            'jury_two_rol'=>$project->getJuryRolTwo(),
                            'jury_three_fullname'=>$project->getJutyThree(),
                            'jury_three_status'=>$project->getJuryStatusThree(),
                            'jury_three_rol'=>$project->getJuryRolThree(),
                            'approval_date'=>$project->getApprovalDate(),
                            'approve'=>$project->getApprove());

                    }
                    if($_SESSION["formato"]=="formatASemestral"){
                        $project = new ProjectASemestral($_SESSION["formato"]
                            ,$_POST["title"],$_POST["investigation_area"],$_POST["student_one_name"],$_POST["student_one_id"],$_POST["student_one_hab_phone"]
                            ,$_POST["student_one_cel_phone"],$_POST["student_one_ucab_email"],$_POST["student_one_personal_email"],$_POST["student_one_professor"]
                            ,$_POST["student_one_approval_date"],$_POST["student_two_name"],$_POST["student_two_id"],$_POST["student_two_hab_phone"]
                            ,$_POST["student_two_cel_phone"],$_POST["student_two_ucab_email"],$_POST["student_two_personal_email"],$_POST["student_two_professor"]
                            ,$_POST["student_two_approval_date"],$_POST["same_seminar"],$_POST["tutor_name"],$_POST["tutor_email"],$_POST["tutor_cel_phone"]
                            ,$_POST["tutor_id"]);

                        $arrProject = array('id'=>$mongo->getLastID()+1,
                            'format'=> $project->getFormat(),
                            'term_code'=>$project->getTermCode(),
                            'id_register'=>$project->getProjectID(),
                            'date_register'=>$project->getDateRegister(),
                            'title'=>$project->getTitle(),
                            'investigation_area'=>$project->getInvestigationArea(),
                            'student_one_name'=>$project->getStudentNameOne(),
                            'student_one_id'=>$project->getStudentIDOne(),
                            'student_one_hab_phone'=>$project->getStudentHabPhoneOne(),
                            'student_one_cel_phone'=>$project->getStudentCelPhoneOne(),
                            'student_one_ucab_email'=>$project->getStudentUcabEmailOne(),
                            'student_one_personal_email'=>$project->getStudentPersonalEmailOne(),
                            'student_one_professor'=>$project->getStudentProfessorOne(),
                            'student_one_approval_year'=>$project->getStudentApprovalDateOne(),
                            'student_two_name'=>$project->getStudentNameTwo(),
                            'student_two_id'=>$project->getStudentCITwo(),
                            'student_two_hab_phone'=>$project->getStudentHabPhoneTwo(),
                            'student_two_cel_phone'=>$project->getStudentCelPhoneTwo(),
                            'student_two_ucab_email'=>$project->getStudentUcabEmailTwo(),
                            'student_two_personal_email'=>$project->getStudentPersonalEmailTwo(),
                            'student_two_professor'=>$project->getStudentProfessorTwo(),
                            'student_two_approval_year'=>$project->getStudentApprovalDateTwo(),
                            'same_seminar'=>$project->setStudentSameSeminarTwo(),
                            'tutor_name'=>$project->getTutorName(),
                            'tutor_email'=>$project->getTutorEmail(),
                            'tutor_cel_phone'=>$project->getTutorCelPhone(),
                            'tutor_id'=>$project->getTutorCI(),
                            'tutor_extern'=>$project->getExtern(),
                            'tutor_approve'=>$project->getTutorApprove(),
                            'jury_one_fullname'=>$project->getJuryOne(),
                            'jury_one_status'=>$project->getJuryStatusOne(),
                            'jury_one_rol'=>$project->getJuryRolOne(),
                            'jury_two_fullname'=>$project->getJutyTwo(),
                            'jury_two_status'=>$project->getJuryStatusTwo(),
                            'jury_two_rol'=>$project->getJuryRolTwo(),
                            'jury_three_fullname'=>$project->getJutyThree(),
                            'jury_three_status'=>$project->getJuryStatusThree(),
                            'jury_three_rol'=>$project->getJuryRolThree(),
                            'approval_date'=>$project->getApprovalDate(),
                            'approve'=>$project->getApprove());
                    }
                    if($_SESSION["formato"]=="formatFAnual"){
                        $project = new ProjectFAnual($_SESSION["formato"]
                            ,$_POST['approval_date'],$_POST["title"],$_POST["investigation_area"],$_POST["student_one_name"],$_POST["student_one_id"]
                            ,$_POST["student_one_hab_phone"],$_POST["student_one_cel_phone"],$_POST["student_one_ucab_email"],$_POST["student_one_personal_email"]
                            ,$_POST["student_one_speciality"],$_POST["student_one_mention"]
                            ,$_POST["student_one_scholarship"],$_POST["student_one_year_ended"],$_POST["student_two_name"],$_POST["student_two_id"]
                            ,$_POST["student_two_hab_phone"],$_POST["student_two_cel_phone"],$_POST["student_two_ucab_email"],$_POST["student_two_personal_email"]
                            ,$_POST["student_two_specialty"],$_POST["student_two_mention"],$_POST["student_two_scholarship"],$_POST["student_two_year_ended"]
                            ,$_POST["tutor_name"],$_POST["tutor_email"],$_POST["tutor_hab_phone"],$_POST["tutor_cel_phone"],$_POST["tutor_id"]);

                        $arrProject = array('id'=>$mongo->getLastID()+1,
                            'format'=> $project->getFormat(),
                            'term_code'=>$project->getTermCode(),
                            'id_register'=>$project->getProjectID(),
                            'date_register'=>$project->getDateRegister(),
                            'approval_date'=>$project->getApprovalDate(),
                            'investigation_area'=>$project->getTitle(),
                            'title'=>$project->getInvestigationArea(),
                            'student_one_name'=>$project->getStudentNameOne(),
                            'student_one_id'=>$project->getStudentIDOne(),
                            'student_one_hab_phone'=>$project->getStudentHabPhoneOne(),
                            'student_one_cel_phone'=>$project->getStudentCelPhoneOne(),
                            'student_one_ucab_email'=>$project->getStudentUcabEmailOne(),
                            'student_one_personal_email'=>$project->getStudentPersonalEmailOne(),
                            'student_one_specialty'=>$project->getStudentSpecialtyOne(),
                            'student_one_mention'=>$project->getStudentMentionOne(),
                            'student_one_scholarship'=>$project->getStudentScholarchipOne(),
                            'student_one_year_ended'=>$project->getStudentYearEndedOne(),
                            'student_two_name'=>$project->getStudentNameTwo(),
                            'student_two_id'=>$project->getStudentCITwo(),
                            'student_two_hab_phone'=>$project->getStudentHabPhoneTwo(),
                            'student_two_cel_phone'=>$project->getStudentCelPhoneTwo(),
                            'student_two_ucab_email'=>$project->getStudentUcabEmailTwo(),
                            'student_two_personal_email'=>$project->getStudentPersonalEmailTwo(),
                            'student_two_specialty'=>$project->getStudentSpecialtyTwo(),
                            'student_two_mention'=>$project->getStudentMentionTwo(),
                            'student_two_scholarship'=>$project->getStudentScholarchipTwo(),
                            'student_two_year_ended'=>$project->getStudentYearEndedTwo(),
                            'tutor_name'=>$project->getTutorName(),
                            'tutor_email'=>$project->getTutorEmail(),
                            'tutor_hab_phone'=>$project->getTutorHabPhone(),
                            'tutor_cel_phone'=>$project->getTutorCelPhone(),
                            'tutor_id'=>$project->getTutorCI(),
                            'tutor_extern'=>$project->getExtern(),
                            'tutor_approve'=>$project->getTutorApprove(),
                            'jury_one_fullname'=>$project->getJuryOne(),
                            'jury_one_status'=>$project->getJuryStatusOne(),
                            'jury_one_rol'=>$project->getJuryRolOne(),
                            'jury_two_fullname'=>$project->getJutyTwo(),
                            'jury_two_status'=>$project->getJuryStatusTwo(),
                            'jury_two_rol'=>$project->getJuryRolTwo(),
                            'jury_three_fullname'=>$project->getJutyThree(),
                            'jury_three_status'=>$project->getJuryStatusThree(),
                            'jury_three_rol'=>$project->getJuryRolThree(),
                            'cd'=>$project->getCd(),
                            'approve'=>$project->getApprove());
                    }

                    if($_SESSION["formato"]=="formatFSemestral"){
                        $project = new ProjectFSemestral($_SESSION["formato"]
                            ,$_POST['approval_date'],$_POST["title"],$_POST["investigation_area"],$_POST["student_one_name"],$_POST["student_one_id"]
                            ,$_POST["student_one_hab_phone"],$_POST["student_one_cel_phone"],$_POST["student_one_ucab_email"],$_POST["student_one_personal_email"]
                            ,$_POST["student_two_name"],$_POST["student_two_id"],$_POST["student_two_hab_phone"],$_POST["student_two_cel_phone"]
                            ,$_POST["student_two_ucab_email"],$_POST["student_two_personal_email"],$_POST["tutor_name"],$_POST["tutor_email"]
                            ,$_POST["tutor_cel_phone"],$_POST["tutor_id"]);

                        $arrProject = array($mongo->getLastID()+1,
                            'format'=> $project->getFormat(),
                            'term_code'=>$project->getTermCode(),
                            'id_register'=>$project->getProjectID(),
                            'date_register'=>$project->getDateRegister(),
                            'approval_date'=>$project->getApprovalDate(),
                            'investigation_area'=>$project->getInvestigationArea(),
                            'title'=>$project->getTitle(),
                            'student_one_name'=>$project->getStudentNameOne(),
                            'student_one_id'=>$project->getStudentIDOne(),
                            'student_one_hab_phone'=>$project->getStudentHabPhoneOne(),
                            'student_one_cel_phone'=>$project->getStudentCelPhoneOne(),
                            'student_one_ucab_email'=>$project->getStudentUcabEmailOne(),
                            'student_one_personal_email'=>$project->getStudentPersonalEmailOne(),
                            'student_two_name'=>$project->getStudentNameTwo(),
                            'student_two_id'=>$project->getStudentCITwo(),
                            'student_two_hab_phone'=>$project->getStudentHabPhoneTwo(),
                            'student_two_cel_phone'=>$project->getStudentCelPhoneTwo(),
                            'student_two_ucab_email'=>$project->getStudentUcabEmailTwo(),
                            'student_two_personal_email'=>$project->getStudentPersonalEmailTwo(),
                            'tutor_name'=>$project->getTutorName(),
                            'tutor_email'=>$project->getTutorEmail(),
                            'tutor_cel_phone'=>$project->getTutorCelPhone(),
                            'tutor_id'=>$project->getTutorCI(),
                            'tutor_extern'=>$project->getExtern(),
                            'tutor_approve'=>$project->getTutorApprove(),
                            'jury_one_fullname'=>$project->getJuryOne(),
                            'jury_one_status'=>$project->getJuryStatusOne(),
                            'jury_one_rol'=>$project->getJuryRolOne(),
                            'jury_two_fullname'=>$project->getJutyTwo(),
                            'jury_two_status'=>$project->getJuryStatusTwo(),
                            'jury_two_rol'=>$project->getJuryRolTwo(),
                            'jury_three_fullname'=>$project->getJutyThree(),
                            'jury_three_status'=>$project->getJuryStatusThree(),
                            'jury_three_rol'=>$project->getJuryRolThree(),
                            'cd'=>$project->getCd(),
                            'approve'=>$project->getApprove());
                    }

                    // Si realizo la insersion en la base de datos
                    if($mongo->insert($arrProject)){

                        $_SESSION['project'] = $arrProject;
                        $_SESSION['title'] = TITLE_TESIS_REGISTER;
                        $_SESSION['message'] = MESSAGE_TESIS_REGISTER;
                        header("Location: ../PHP/mensaje.php");

                    }
                }
            }
            else{
                echo "<script>
                            alert('Cedula de Identidad Invalida, La cedula de identidad es de 8 digitos');
                            window.history.back();
                        </script>";
            }
        }
        else{
            echo "<script>
                        alert('Numero de Telefono Invalido, Debe introducirlo con el siguiente formato: xxxx-xxx-xxxx Ej. 0212-123-4567');
			            window.history.back();
                    </script>";
        }
    }



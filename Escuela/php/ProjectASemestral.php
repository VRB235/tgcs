<?php

/**
 * Estructura del formulario A Semestral
 * Class ProjectASemestral
 */
class ProjectASemestral {
    private $format ;
    private $termCode ;
    private $projectID ;
    private $dateRegister ;
    private $title ;
    private $investigationArea ;

    private $studentNameOne ;
    private $studentIDOne ;
    private $studentHabPhoneOne ;
    private $studentCelPhoneOne ;
    private $studentUcabEmailOne ;
    private $studentPersonalEmailOne ;
    private $studentProfessorOne ;
    private $studentApprovalDateOne ;

    private $studentNameTwo ;
    private $studentCITwo ;
    private $studentHabPhoneTwo ;
    private $studentCelPhoneTwo ;
    private $studentUcabEmailTwo ;
    private $studentPersonalEmailTwo ;
    private $studentProfessorTwo ;
    private $studentApprovalDateTwo ;
    private $studentSameSeminarTwo ;

    private $tutorName ;
    private $tutorEmail ;
    private $tutorCelPhone ;
    private $tutorCI ;

    private $extern ;
    private $tutorApprove ;


    private $juryOne ;
    private $juryStatusOne ;
    private $juryRolOne ;

    private $jutyTwo ;
    private $juryStatusTwo ;
    private $juryRolTwo ;

    private $jutyThree ;
    private $juryStatusThree ;
    private $juryRolThree ;

    private $approvalDate;

    private $approve;

    /**
     * ProjectASemestral constructor.
     * @param $term_code
     * @param $formato
     * @param $idRegister
     * @param $deliverDate
     * @param $title
     * @param $investigationArea
     * @param $student_one_name
     * @param $student_one_id
     * @param $student_one_hab_phone
     * @param $student_one_cel_phone
     * @param $student_one_ucab_email
     * @param $student_one_personal_email
     * @param $student_one_professor
     * @param $studentApprovalDateOne
     * @param $student_two_name
     * @param $student_two_id
     * @param $student_two_hab_phone
     * @param $student_two_cel_phone
     * @param $student_ucab_email
     * @param $student_two_personal_email
     * @param $student_two_professor
     * @param $student_two_approval_date
     * @param $student_two_same_seminar
     * @param $tutor_name
     * @param $tutor_email
     * @param $tutor_cel_phone
     * @param $tutor_id
     */
    function __construct($formato,$title,$investigationArea
        ,$student_one_name,$student_one_id,$student_one_hab_phone,$student_one_cel_phone
        ,$student_one_ucab_email,$student_one_personal_email,$student_one_professor,$studentApprovalDateOne
        ,$student_two_name,$student_two_id,$student_two_hab_phone,$student_two_cel_phone,$student_ucab_email
        ,$student_two_personal_email,$student_two_professor,$student_two_approval_date,$student_two_same_seminar
        ,$tutor_name,$tutor_email,$tutor_cel_phone,$tutor_id)
    {

        $this->termCode = null;
        $this->format = $formato;
        $this->projectID = null;
        $this->dateRegister = null;
        $this->title = $title;
        $this->investigationArea = $investigationArea;

        $this->studentNameOne = $student_one_name;
        $this->studentIDOne= $student_one_id;
        $this->studentHabPhoneOne = $student_one_hab_phone;
        $this->studentCelPhoneOne = $student_one_cel_phone;
        $this->studentUcabEmailOne = $student_one_ucab_email;
        $this->studentPersonalEmailOne = $student_one_personal_email;
        $this->studentProfessorOne = $student_one_professor;
        $this->studentApprovalDateOne = $studentApprovalDateOne;

        $this->studentNameTwo = $student_two_name;
        $this->studentCITwo = $student_two_id;
        $this->studentHabPhoneTwo = $student_two_hab_phone;
        $this->studentCelPhoneTwo = $student_two_cel_phone;
        $this->studentUcabEmailTwo = $student_ucab_email;
        $this->studentPersonalEmailTwo = $student_two_personal_email;
        $this->studentProfessorTwo = $student_two_professor;
        $this->studentApprovalDateTwo = $student_two_approval_date;
        $this->studentSameSeminarTwo = $student_two_same_seminar;

        $this->tutorName = $tutor_name;
        $this->tutorCelPhone = $tutor_cel_phone;
        $this->tutorCI= $tutor_id;
        $this->tutorEmail = $tutor_email;

        $this->extern = "-";
        $this->tutorApprove = "-";

        $this->juryOne = "-";
        $this->juryRolOne = "-";
        $this->juryStatusOne = null;
        $this->jutyTwo = "";
        $this->juryRolTwo = "-";
        $this->juryStatusTwo = null;
        $this->jutyThree = "-";
        $this->juryRolThree = "-";
        $this->juryStatusThree = null;

        $this->approvalDate = "-";
        $this->approve = "0";


    }

    /**
     * @return string
     */
    public function getTutorApprove()
    {
        return $this->tutorApprove;
    }

    /**
     * @param string $tutorApprove
     */
    public function setTutorApprove($tutorApprove)
    {
        $this->tutorApprove = $tutorApprove;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getTermCode()
    {
        return $this->termCode;
    }

    /**
     * @param mixed $termCode
     */
    public function setTermCode($termCode)
    {
        $this->termCode = $termCode;
    }

    /**
     * @return mixed
     */
    public function getProjectID()
    {
        return $this->projectID;
    }

    /**
     * @param mixed $projectID
     */
    public function setProjectID($projectID)
    {
        $this->projectID = $projectID;
    }

    /**
     * @return mixed
     */
    public function getDateRegister()
    {
        return $this->dateRegister;
    }

    /**
     * @param mixed $dateRegister
     */
    public function setDateRegister($dateRegister)
    {
        $this->dateRegister = $dateRegister;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getInvestigationArea()
    {
        return $this->investigationArea;
    }

    /**
     * @param mixed $investigationArea
     */
    public function setInvestigationArea($investigationArea)
    {
        $this->investigationArea = $investigationArea;
    }

    /**
     * @return mixed
     */
    public function getStudentNameOne()
    {
        return $this->studentNameOne;
    }

    /**
     * @param mixed $studentNameOne
     */
    public function setStudentNameOne($studentNameOne)
    {
        $this->studentNameOne = $studentNameOne;
    }

    /**
     * @return mixed
     */
    public function getStudentIDOne()
    {
        return $this->studentIDOne;
    }

    /**
     * @param mixed $studentIDOne
     */
    public function setStudentIDOne($studentIDOne)
    {
        $this->studentIDOne = $studentIDOne;
    }

    /**
     * @return mixed
     */
    public function getStudentHabPhoneOne()
    {
        return $this->studentHabPhoneOne;
    }

    /**
     * @param mixed $studentHabPhoneOne
     */
    public function setStudentHabPhoneOne($studentHabPhoneOne)
    {
        $this->studentHabPhoneOne = $studentHabPhoneOne;
    }

    /**
     * @return mixed
     */
    public function getStudentCelPhoneOne()
    {
        return $this->studentCelPhoneOne;
    }

    /**
     * @param mixed $studentCelPhoneOne
     */
    public function setStudentCelPhoneOne($studentCelPhoneOne)
    {
        $this->studentCelPhoneOne = $studentCelPhoneOne;
    }

    /**
     * @return mixed
     */
    public function getStudentUcabEmailOne()
    {
        return $this->studentUcabEmailOne;
    }

    /**
     * @param mixed $studentUcabEmailOne
     */
    public function setStudentUcabEmailOne($studentUcabEmailOne)
    {
        $this->studentUcabEmailOne = $studentUcabEmailOne;
    }

    /**
     * @return mixed
     */
    public function getStudentPersonalEmailOne()
    {
        return $this->studentPersonalEmailOne;
    }

    /**
     * @param mixed $studentPersonalEmailOne
     */
    public function setStudentPersonalEmailOne($studentPersonalEmailOne)
    {
        $this->studentPersonalEmailOne = $studentPersonalEmailOne;
    }

    /**
     * @return mixed
     */
    public function getStudentProfessorOne()
    {
        return $this->studentProfessorOne;
    }

    /**
     * @param mixed $studentProfessorOne
     */
    public function setStudentProfessorOne($studentProfessorOne)
    {
        $this->studentProfessorOne = $studentProfessorOne;
    }

    /**
     * @return mixed
     */
    public function getStudentApprovalDateOne()
    {
        return $this->studentApprovalDateOne;
    }

    /**
     * @param mixed $studentApprovalDateOne
     */
    public function setStudentApprovalDateOne($studentApprovalDateOne)
    {
        $this->studentApprovalDateOne = $studentApprovalDateOne;
    }

    /**
     * @return mixed
     */
    public function getStudentNameTwo()
    {
        return $this->studentNameTwo;
    }

    /**
     * @param mixed $studentNameTwo
     */
    public function setStudentNameTwo($studentNameTwo)
    {
        $this->studentNameTwo = $studentNameTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentCITwo()
    {
        return $this->studentCITwo;
    }

    /**
     * @param mixed $studentCITwo
     */
    public function setStudentCITwo($studentCITwo)
    {
        $this->studentCITwo = $studentCITwo;
    }

    /**
     * @return mixed
     */
    public function getStudentHabPhoneTwo()
    {
        return $this->studentHabPhoneTwo;
    }

    /**
     * @param mixed $studentHabPhoneTwo
     */
    public function setStudentHabPhoneTwo($studentHabPhoneTwo)
    {
        $this->studentHabPhoneTwo = $studentHabPhoneTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentCelPhoneTwo()
    {
        return $this->studentCelPhoneTwo;
    }

    /**
     * @param mixed $studentCelPhoneTwo
     */
    public function setStudentCelPhoneTwo($studentCelPhoneTwo)
    {
        $this->studentCelPhoneTwo = $studentCelPhoneTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentUcabEmailTwo()
    {
        return $this->studentUcabEmailTwo;
    }

    /**
     * @param mixed $studentUcabEmailTwo
     */
    public function setStudentUcabEmailTwo($studentUcabEmailTwo)
    {
        $this->studentUcabEmailTwo = $studentUcabEmailTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentPersonalEmailTwo()
    {
        return $this->studentPersonalEmailTwo;
    }

    /**
     * @param mixed $studentPersonalEmailTwo
     */
    public function setStudentPersonalEmailTwo($studentPersonalEmailTwo)
    {
        $this->studentPersonalEmailTwo = $studentPersonalEmailTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentProfessorTwo()
    {
        return $this->studentProfessorTwo;
    }

    /**
     * @param mixed $studentProfessorTwo
     */
    public function setStudentProfessorTwo($studentProfessorTwo)
    {
        $this->studentProfessorTwo = $studentProfessorTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentApprovalDateTwo()
    {
        return $this->studentApprovalDateTwo;
    }

    /**
     * @param mixed $studentApprovalDateTwo
     */
    public function setStudentApprovalDateTwo($studentApprovalDateTwo)
    {
        $this->studentApprovalDateTwo = $studentApprovalDateTwo;
    }

    /**
     * @return mixed
     */
    public function getStudentSameSeminarTwo()
    {
        return $this->studentSameSeminarTwo;
    }

    /**
     * @param mixed $studentSameSeminarTwo
     */
    public function setStudentSameSeminarTwo($studentSameSeminarTwo)
    {
        $this->studentSameSeminarTwo = $studentSameSeminarTwo;
    }

    /**
     * @return mixed
     */
    public function getTutorName()
    {
        return $this->tutorName;
    }

    /**
     * @param mixed $tutorName
     */
    public function setTutorName($tutorName)
    {
        $this->tutorName = $tutorName;
    }

    /**
     * @return mixed
     */
    public function getTutorEmail()
    {
        return $this->tutorEmail;
    }

    /**
     * @param mixed $tutorEmail
     */
    public function setTutorEmail($tutorEmail)
    {
        $this->tutorEmail = $tutorEmail;
    }

    /**
     * @return mixed
     */
    public function getTutorCelPhone()
    {
        return $this->tutorCelPhone;
    }

    /**
     * @param mixed $tutorCelPhone
     */
    public function setTutorCelPhone($tutorCelPhone)
    {
        $this->tutorCelPhone = $tutorCelPhone;
    }

    /**
     * @return mixed
     */
    public function getTutorCI()
    {
        return $this->tutorCI;
    }

    /**
     * @param mixed $tutorCI
     */
    public function setTutorCI($tutorCI)
    {
        $this->tutorCI = $tutorCI;
    }

    /**
     * @return string
     */
    public function getExtern()
    {
        return $this->extern;
    }

    /**
     * @param string $extern
     */
    public function setExtern($extern)
    {
        $this->extern = $extern;
    }

    /**
     * @return string
     */
    public function getApprove()
    {
        return $this->approve;
    }

    /**
     * @param string $approve
     */
    public function setApprove($approve)
    {
        $this->approve = $approve;
    }

    /**
     * @return string
     */
    public function getJuryOne()
    {
        return $this->juryOne;
    }

    /**
     * @param string $juryOne
     */
    public function setJuryOne($juryOne)
    {
        $this->juryOne = $juryOne;
    }

    /**
     * @return null
     */
    public function getJuryStatusOne()
    {
        return $this->juryStatusOne;
    }

    /**
     * @param null $juryStatusOne
     */
    public function setJuryStatusOne($juryStatusOne)
    {
        $this->juryStatusOne = $juryStatusOne;
    }

    /**
     * @return string
     */
    public function getJuryRolOne()
    {
        return $this->juryRolOne;
    }

    /**
     * @param string $juryRolOne
     */
    public function setJuryRolOne($juryRolOne)
    {
        $this->juryRolOne = $juryRolOne;
    }

    /**
     * @return string
     */
    public function getJutyTwo()
    {
        return $this->jutyTwo;
    }

    /**
     * @param string $jutyTwo
     */
    public function setJutyTwo($jutyTwo)
    {
        $this->jutyTwo = $jutyTwo;
    }

    /**
     * @return null
     */
    public function getJuryStatusTwo()
    {
        return $this->juryStatusTwo;
    }

    /**
     * @param null $juryStatusTwo
     */
    public function setJuryStatusTwo($juryStatusTwo)
    {
        $this->juryStatusTwo = $juryStatusTwo;
    }

    /**
     * @return string
     */
    public function getJuryRolTwo()
    {
        return $this->juryRolTwo;
    }

    /**
     * @param string $juryRolTwo
     */
    public function setJuryRolTwo($juryRolTwo)
    {
        $this->juryRolTwo = $juryRolTwo;
    }

    /**
     * @return string
     */
    public function getJutyThree()
    {
        return $this->jutyThree;
    }

    /**
     * @param string $jutyThree
     */
    public function setJutyThree($jutyThree)
    {
        $this->jutyThree = $jutyThree;
    }

    /**
     * @return null
     */
    public function getJuryStatusThree()
    {
        return $this->juryStatusThree;
    }

    /**
     * @param null $juryStatusThree
     */
    public function setJuryStatusThree($juryStatusThree)
    {
        $this->juryStatusThree = $juryStatusThree;
    }

    /**
     * @return string
     */
    public function getJuryRolThree()
    {
        return $this->juryRolThree;
    }

    /**
     * @param string $juryRolThree
     */
    public function setJuryRolThree($juryRolThree)
    {
        $this->juryRolThree = $juryRolThree;
    }

    /**
     * @return string
     */
    public function getApprovalDate()
    {
        return $this->approvalDate;
    }

    /**
     * @param string $approvalDate
     */
    public function setApprovalDate($approvalDate)
    {
        $this->approvalDate = $approvalDate;
    }



}
?>
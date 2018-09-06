<?php

/**
 * Class ProjectAAnual
 * Estructura del formaulario A Anual
 */
    class ProjectAAnual {

        private $format;
        private $termCode ;
        private $projectID ;
        private $dateRegister ;
        private $version ;
        private $title ;
        private $studentNameOne ;
        private $studentIDOne ;
        private $studentHabPhoneOne ;
        private $studentCelPhoneOne ;
        private $studentUcabEmailOne ;
        private $studentPersonalEmailOne ;
        private $studentSpecialtyOne ;
        private $studentMentionOne ;
        private $studentScholarchipOne ;
        private $studentYearEndedOne ;
        private $studentSeminarTitleOne ;
        private $studentProfessorOne ;
        private $studentApprovalYearOne ;
        private $studentSameSeminarOne ;
        private $studentNameTwo ;
        private $studentCITwo ;
        private $studentHabPhoneTwo ;
        private $studentCelPhoneTwo ;
        private $studentUcabEmailTwo ;
        private $studentPersonalEmailTwo ;
        private $studentSpecialtyTwo ;
        private $studentMentionTwo ;
        private $studentScholarchipTwo ;
        private $studentYearEndedTwo ;
        private $studentSeminarTitleTwo ;
        private $studentProfessorTwo ;
        private $studentApprovalYearTwo ;
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
        private $approvalDate ;
        private $approve;

        /**
         * ProjectAAnual constructor.
         * @param $term_code
         * @param $formato
         * @param $idRegister
         * @param $deliverDate
         * @param $version
         * @param $title
         * @param $student_one_name
         * @param $student_one_id
         * @param $student_one_hab_phone
         * @param $student_one_cel_phone
         * @param $student_one_ucab_email
         * @param $student_one_personal_email
         * @param $student_one_specialty
         * @param $student_one_one_mention
         * @param $student_one_scholarship
         * @param $student_one_year_ended
         * @param $student_one_seminar_title
         * @param $student_one_professor
         * @param $student_one_approval_year
         * @param $student_one_same_seminar
         * @param $student_two_name
         * @param $student_two_id
         * @param $student_two_hab_phone
         * @param $student_two_cel_phone
         * @param $student_ucab_email
         * @param $student_two_personal_email
         * @param $student_two_specialty
         * @param $student_two_mention
         * @param $student_two_scholarship
         * @param $student_two_year_ended
         * @param $student_two_seminar_title
         * @param $student_two_professor
         * @param $student_two_approval_year
         * @param $student_two_same_seminar
         * @param $tutor_name
         * @param $tutor_email
         * @param $tutor_cel_phone
         * @param $tutor_id
         */
        function __construct($formato,$version,$title
                ,$student_one_name,$student_one_id,$student_one_hab_phone,$student_one_cel_phone
                ,$student_one_ucab_email,$student_one_personal_email,$student_one_specialty
                ,$student_one_one_mention,$student_one_scholarship,$student_one_year_ended
                ,$student_one_seminar_title,$student_one_professor,$student_one_approval_year
                ,$student_one_same_seminar,$student_two_name,$student_two_id,$student_two_hab_phone
                ,$student_two_cel_phone,$student_ucab_email,$student_two_personal_email
                ,$student_two_specialty,$student_two_mention,$student_two_scholarship
                ,$student_two_year_ended,$student_two_seminar_title,$student_two_professor
                ,$student_two_approval_year,$student_two_same_seminar,$tutor_name,$tutor_email
                ,$tutor_cel_phone,$tutor_id)
        {

            $this->termCode = null;
            $this->format = $formato;
            $this->projectID = null;
            $this->dateRegister = null;
            $this->version = $version;
            $this->title = $title;

            $this->studentNameOne = $student_one_name;
            $this->studentIDOne= $student_one_id;
            $this->studentHabPhoneOne = $student_one_hab_phone;
            $this->studentCelPhoneOne = $student_one_cel_phone;
            $this->studentUcabEmailOne = $student_one_ucab_email;
            $this->studentPersonalEmailOne = $student_one_personal_email;
            $this->studentSpecialtyOne = $student_one_specialty;
            $this->studentMentionOne = $student_one_one_mention;
            $this->studentScholarchipOne = $student_one_scholarship;
            $this->studentYearEndedOne = $student_one_year_ended;
            $this->studentSeminarTitleOne = $student_one_seminar_title;
            $this->studentProfessorOne = $student_one_professor;
            $this->studentApprovalYearOne = $student_one_approval_year;
            $this->studentSameSeminarOne = $student_one_same_seminar;

            $this->studentNameTwo = $student_two_name;
            $this->studentCITwo = $student_two_id;
            $this->studentHabPhoneTwo = $student_two_hab_phone;
            $this->studentCelPhoneTwo = $student_two_cel_phone;
            $this->studentUcabEmailTwo = $student_ucab_email;
            $this->studentPersonalEmailTwo = $student_two_personal_email;
            $this->studentSpecialtyTwo = $student_two_specialty;
            $this->studentMentionTwo = $student_two_mention;
            $this->studentScholarchipTwo = $student_two_scholarship;
            $this->studentYearEndedTwo = $student_two_year_ended;
            $this->studentSeminarTitleTwo = $student_two_seminar_title;
            $this->studentProfessorTwo = $student_two_professor;
            $this->studentApprovalYearTwo = $student_two_approval_year;
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
         * @return string
         */
        public function getApprovalDate()
        {
            return $this->approvalDate;
        }

        /**
         * @return string
         */
        public function getApprove()
        {
            return $this->approve;
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
        public function getVersion()
        {
            return $this->version;
        }

        /**
         * @param mixed $version
         */
        public function setVersion($version)
        {
            $this->version = $version;
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
        public function getStudentSpecialtyOne()
        {
            return $this->studentSpecialtyOne;
        }

        /**
         * @param mixed $studentSpecialtyOne
         */
        public function setStudentSpecialtyOne($studentSpecialtyOne)
        {
            $this->studentSpecialtyOne = $studentSpecialtyOne;
        }

        /**
         * @return mixed
         */
        public function getStudentMentionOne()
        {
            return $this->studentMentionOne;
        }

        /**
         * @param mixed $studentMentionOne
         */
        public function setStudentMentionOne($studentMentionOne)
        {
            $this->studentMentionOne = $studentMentionOne;
        }

        /**
         * @return mixed
         */
        public function getStudentScholarchipOne()
        {
            return $this->studentScholarchipOne;
        }

        /**
         * @param mixed $studentScholarchipOne
         */
        public function setStudentScholarchipOne($studentScholarchipOne)
        {
            $this->studentScholarchipOne = $studentScholarchipOne;
        }

        /**
         * @return mixed
         */
        public function getStudentYearEndedOne()
        {
            return $this->studentYearEndedOne;
        }

        /**
         * @param mixed $studentYearEndedOne
         */
        public function setStudentYearEndedOne($studentYearEndedOne)
        {
            $this->studentYearEndedOne = $studentYearEndedOne;
        }

        /**
         * @return mixed
         */
        public function getStudentSeminarTitleOne()
        {
            return $this->studentSeminarTitleOne;
        }

        /**
         * @param mixed $studentSeminarTitleOne
         */
        public function setStudentSeminarTitleOne($studentSeminarTitleOne)
        {
            $this->studentSeminarTitleOne = $studentSeminarTitleOne;
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
        public function getStudentApprovalYearOne()
        {
            return $this->studentApprovalYearOne;
        }

        /**
         * @param mixed $studentApprovalYearOne
         */
        public function setStudentApprovalYearOne($studentApprovalYearOne)
        {
            $this->studentApprovalYearOne = $studentApprovalYearOne;
        }

        /**
         * @return mixed
         */
        public function getStudentSameSeminarOne()
        {
            return $this->studentSameSeminarOne;
        }

        /**
         * @param mixed $studentSameSeminarOne
         */
        public function setStudentSameSeminarOne($studentSameSeminarOne)
        {
            $this->studentSameSeminarOne = $studentSameSeminarOne;
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
        public function getStudentSpecialtyTwo()
        {
            return $this->studentSpecialtyTwo;
        }

        /**
         * @param mixed $studentSpecialtyTwo
         */
        public function setStudentSpecialtyTwo($studentSpecialtyTwo)
        {
            $this->studentSpecialtyTwo = $studentSpecialtyTwo;
        }

        /**
         * @return mixed
         */
        public function getStudentMentionTwo()
        {
            return $this->studentMentionTwo;
        }

        /**
         * @param mixed $studentMentionTwo
         */
        public function setStudentMentionTwo($studentMentionTwo)
        {
            $this->studentMentionTwo = $studentMentionTwo;
        }

        /**
         * @return mixed
         */
        public function getStudentScholarchipTwo()
        {
            return $this->studentScholarchipTwo;
        }

        /**
         * @param mixed $studentScholarchipTwo
         */
        public function setStudentScholarchipTwo($studentScholarchipTwo)
        {
            $this->studentScholarchipTwo = $studentScholarchipTwo;
        }

        /**
         * @return mixed
         */
        public function getStudentYearEndedTwo()
        {
            return $this->studentYearEndedTwo;
        }

        /**
         * @param mixed $studentYearEndedTwo
         */
        public function setStudentYearEndedTwo($studentYearEndedTwo)
        {
            $this->studentYearEndedTwo = $studentYearEndedTwo;
        }

        /**
         * @return mixed
         */
        public function getStudentSeminarTitleTwo()
        {
            return $this->studentSeminarTitleTwo;
        }

        /**
         * @param mixed $studentSeminarTitleTwo
         */
        public function setStudentSeminarTitleTwo($studentSeminarTitleTwo)
        {
            $this->studentSeminarTitleTwo = $studentSeminarTitleTwo;
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
        public function getStudentApprovalYearTwo()
        {
            return $this->studentApprovalYearTwo;
        }

        /**
         * @param mixed $studentApprovalYearTwo
         */
        public function setStudentApprovalYearTwo($studentApprovalYearTwo)
        {
            $this->studentApprovalYearTwo = $studentApprovalYearTwo;
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



    }
?>
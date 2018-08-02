<?php

/**
 * Estructura del formulario para formato F Semestral
 * Class ProjectFSemestral
 */
    class ProjectFSemestral {

        private $format ;
        private $termCode ;
        private $projectID ;
        private $dateRegister ;
        private $approvalDate ;
        private $title ;
        private $investigationArea ;
    
        private $studentNameOne ;
        private $studentIDOne ;
        private $studentHabPhoneOne ;
        private $studentCelPhoneOne ;
        private $studentUcabEmailOne ;
        private $studentPersonalEmailOne ;
    
        private $studentNameTwo ;
        private $studentCITwo ;
        private $studentHabPhoneTwo ;
        private $studentCelPhoneTwo ;
        private $studentUcabEmailTwo ;
        private $studentPersonalEmailTwo ;
    
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
    
        private $cd ;

        private $approve;

        /**
         * ProjectFSemestral constructor.
         * @param $format
         * @param $termCode
         * @param $projectID
         * @param $dateRegister
         * @param $approvalDate
         * @param $title
         * @param $investigationArea
         * @param $studentNameOne
         * @param $studentIDOne
         * @param $studentHabPhoneOne
         * @param $studentCelPhoneOne
         * @param $studentUcabEmailOne
         * @param $studentPersonalEmailOne
         * @param $studentNameTwo
         * @param $studentCITwo
         * @param $studentHabPhoneTwo
         * @param $studentCelPhoneTwo
         * @param $studentUcabEmailTwo
         * @param $studentPersonalEmailTwo
         * @param $tutorName
         * @param $tutorEmail
         * @param $tutorCelPhone
         * @param $tutorCI
         * @param $extern
         * @param $tutorApprove
         * @param $juryOne
         * @param $juryStatusOne
         * @param $juryRolOne
         * @param $jutyTwo
         * @param $juryStatusTwo
         * @param $juryRolTwo
         * @param $jutyThree
         * @param $juryStatusThree
         * @param $juryRolThree
         * @param $cd
         * @param $approve
         */
        public function __construct($format,
                                    $approvalDate, $title, $investigationArea,
                                    $studentNameOne, $studentIDOne,
                                    $studentHabPhoneOne, $studentCelPhoneOne,
                                    $studentUcabEmailOne, $studentPersonalEmailOne,
                                    $studentNameTwo, $studentCITwo,
                                    $studentHabPhoneTwo, $studentCelPhoneTwo,
                                    $studentUcabEmailTwo, $studentPersonalEmailTwo,
                                    $tutorName, $tutorEmail, $tutorCelPhone,
                                    $tutorCI)
        {
            $this->format = $format;
            $this->termCode = null;
            $this->projectID = null;
            $this->dateRegister = null;
            $this->approvalDate = $approvalDate;
            $this->title = $title;
            $this->investigationArea = $investigationArea;
            $this->studentNameOne = $studentNameOne;
            $this->studentIDOne = $studentIDOne;
            $this->studentHabPhoneOne = $studentHabPhoneOne;
            $this->studentCelPhoneOne = $studentCelPhoneOne;
            $this->studentUcabEmailOne = $studentUcabEmailOne;
            $this->studentPersonalEmailOne = $studentPersonalEmailOne;
            $this->studentNameTwo = $studentNameTwo;
            $this->studentCITwo = $studentCITwo;
            $this->studentHabPhoneTwo = $studentHabPhoneTwo;
            $this->studentCelPhoneTwo = $studentCelPhoneTwo;
            $this->studentUcabEmailTwo = $studentUcabEmailTwo;
            $this->studentPersonalEmailTwo = $studentPersonalEmailTwo;
            $this->tutorName = $tutorName;
            $this->tutorEmail = $tutorEmail;
            $this->tutorCelPhone = $tutorCelPhone;
            $this->tutorCI = $tutorCI;
            $this->extern = "-";
            $this->tutorApprove = "-";
            $this->juryOne = "-";
            $this->juryStatusOne = null;
            $this->juryRolOne = "-";
            $this->jutyTwo = "-";
            $this->juryStatusTwo = null;
            $this->juryRolTwo = "-";
            $this->jutyThree = "-";
            $this->juryStatusThree = null;
            $this->juryRolThree = "-";
            $this->cd = "-";
            $this->approve = "0";
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
        public function getApprovalDate()
        {
            return $this->approvalDate;
        }

        /**
         * @param mixed $approvalDate
         */
        public function setApprovalDate($approvalDate)
        {
            $this->approvalDate = $approvalDate;
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
         * @return mixed
         */
        public function getExtern()
        {
            return $this->extern;
        }

        /**
         * @param mixed $extern
         */
        public function setExtern($extern)
        {
            $this->extern = $extern;
        }

        /**
         * @return mixed
         */
        public function getTutorApprove()
        {
            return $this->tutorApprove;
        }

        /**
         * @param mixed $tutorApprove
         */
        public function setTutorApprove($tutorApprove)
        {
            $this->tutorApprove = $tutorApprove;
        }

        /**
         * @return mixed
         */
        public function getJuryOne()
        {
            return $this->juryOne;
        }

        /**
         * @param mixed $juryOne
         */
        public function setJuryOne($juryOne)
        {
            $this->juryOne = $juryOne;
        }

        /**
         * @return mixed
         */
        public function getJuryStatusOne()
        {
            return $this->juryStatusOne;
        }

        /**
         * @param mixed $juryStatusOne
         */
        public function setJuryStatusOne($juryStatusOne)
        {
            $this->juryStatusOne = $juryStatusOne;
        }

        /**
         * @return mixed
         */
        public function getJuryRolOne()
        {
            return $this->juryRolOne;
        }

        /**
         * @param mixed $juryRolOne
         */
        public function setJuryRolOne($juryRolOne)
        {
            $this->juryRolOne = $juryRolOne;
        }

        /**
         * @return mixed
         */
        public function getJutyTwo()
        {
            return $this->jutyTwo;
        }

        /**
         * @param mixed $jutyTwo
         */
        public function setJutyTwo($jutyTwo)
        {
            $this->jutyTwo = $jutyTwo;
        }

        /**
         * @return mixed
         */
        public function getJuryStatusTwo()
        {
            return $this->juryStatusTwo;
        }

        /**
         * @param mixed $juryStatusTwo
         */
        public function setJuryStatusTwo($juryStatusTwo)
        {
            $this->juryStatusTwo = $juryStatusTwo;
        }

        /**
         * @return mixed
         */
        public function getJuryRolTwo()
        {
            return $this->juryRolTwo;
        }

        /**
         * @param mixed $juryRolTwo
         */
        public function setJuryRolTwo($juryRolTwo)
        {
            $this->juryRolTwo = $juryRolTwo;
        }

        /**
         * @return mixed
         */
        public function getJutyThree()
        {
            return $this->jutyThree;
        }

        /**
         * @param mixed $jutyThree
         */
        public function setJutyThree($jutyThree)
        {
            $this->jutyThree = $jutyThree;
        }

        /**
         * @return mixed
         */
        public function getJuryStatusThree()
        {
            return $this->juryStatusThree;
        }

        /**
         * @param mixed $juryStatusThree
         */
        public function setJuryStatusThree($juryStatusThree)
        {
            $this->juryStatusThree = $juryStatusThree;
        }

        /**
         * @return mixed
         */
        public function getJuryRolThree()
        {
            return $this->juryRolThree;
        }

        /**
         * @param mixed $juryRolThree
         */
        public function setJuryRolThree($juryRolThree)
        {
            $this->juryRolThree = $juryRolThree;
        }

        /**
         * @return mixed
         */
        public function getCd()
        {
            return $this->cd;
        }

        /**
         * @param mixed $cd
         */
        public function setCd($cd)
        {
            $this->cd = $cd;
        }

        /**
         * @return mixed
         */
        public function getApprove()
        {
            return $this->approve;
        }

        /**
         * @param mixed $approve
         */
        public function setApprove($approve)
        {
            $this->approve = $approve;
        }




    }
?>
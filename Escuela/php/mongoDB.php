<?php

require_once 'mensajes.php';
require_once 'credenciales.php';

/**
 * Class mongoDataBase
 *
 * Realiza las respectivas operaciones con la base de datos mongoDB
 */
class MongoDataBase extends Credentials {

    private $credentials;

    /**
     * mongoDataBase constructor.
     */
    function __construct()
    {
        $this->credentials = new Credentials();
    }

    /**
     * Realiza la conexion hacia la base de datos
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function conexionMongoDB() {


        //$connetion = new MongoDB\Driver\Manager($credentials->getDirMongoDB());
        $connetion = new MongoDB\Driver\Manager($this->credentials->getLocalMongoDB());
        $command = new MongoDB\Driver\Command(array("serverStatus" => 1));
        try {

            $connetion->executeCommand($this->credentials->getNameMongoDB(), $command);

            return $connetion;

        } catch(MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
            $_SESSION['title'] = $_SESSION["title_fail_connetion"];
            $_SESSION['message'] = $_SESSION["message_connection_timeout_exception"];
            header("Location: ../php/mensaje.php");
        }
        catch(MongoDB\Driver\Exception\AuthenticationException $e) {
            $_SESSION['title'] = $_SESSION["title_fail_connetion"];
            $_SESSION['message'] = $_SESSION["message_authentication_exception"];
            header("Location: ../php/mensaje.php");

        }
        catch(Exception $e) {
            echo $e->getMessage();

        }

        return null;
    }

    /**
     * Obtiene el ultimo ID utilizado en la base de datos
     * @return int
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getLastID (){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array();
            // Estableciendo las opciones apra que solo se traiga el id mas alto en la base de datos
            $options = ['sort' => ['id' => -1],'limit'=> 1];
            $cursor = array();
            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }

            $id_max = 0;

            foreach ($cursor as $element){
                $id_max = $element->id;
            }

            return $id_max;

        }

    }

    /**
     * Inserta un projecto en la base de datos
     * @param $project
     * @throws \MongoDB\Driver\Exception\Exception
     * @return bool
     */
    function insert ($project){

        $connetion = $this->conexionMongoDB();

        // Si se da la conexion
        if($connetion!=null){

            try{

                $bulk = new MongoDB\Driver\BulkWrite;

                $bulk->insert($project);

                $manager = new MongoDB\Driver\Manager($this->credentials->gerLocalDirMongoDB());
                $manager->executeBulkWrite($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(), $bulk);

                return true;

            }catch(MongoDB\Driver\Exception\BulkWriteException $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_bulk_write_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getTraceAsString();
                echo $e->getMessage();
                die();
            }
        }
        else{
            return false;
        }
    }

    /**
     * Obtiene los proyectos que no ahn sido aprobados por la escuela y que no han sido rechazados anteriormente para su aprobacion
     * @return \MongoDB\Driver\Cursor|
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getNotApproveProjects (){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que solo se traiga los proyectos no aprobados y no rechazados anteriormente
            $filter = array('approve'=>'0', 'status' => null);
            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Obtiene las informacion de un proyecto correspondiente al id
     * @param $id
     * @return \MongoDB\Driver\Cursor|null
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function findProject($id){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que solo se traiga los proyectos no aprobados y no rechazados anteriormente
            $filter = array('id'=>$id);
            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }
    }


    /**
     * Aprueba un proyecto
     * @param $id
     * @param $id_register
     * @param $date_register
     * @param $termcode
     * @return \MongoDB\Driver\WriteResult|null
     */
    function approveProject($id,$id_register,$date_register,$termcode){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que solo se traiga el projecto que corresponde a  ese id
            $filter = array('id'=>$id);
            // Atributos que se agregaran al proyecto encontrado
            $newObj = array('$set'=>array('id_register' => $id_register, 'date_register' => $date_register, 'term_code' => $termcode, 'approve' => "1"));
            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Rechaza un proyecto en particular
     * @param $id
     * @return \MongoDB\Driver\WriteResult|null
     */
    function rejectProject($id){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que solo se traiga el projecto que corresponde a  ese id
            $filter = array('id'=>$id);
            // Atributos que se agregaran al proyecto encontrado
            $newObj = array('$set'=>array("status"=>'rejected'));
            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Obtiene los proyectos aprobados en formato A
     * @return \MongoDB\Driver\Cursor|null
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getProjectsInFormatAApprove (){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que solo se traiga los proyectos no aprobados y no rechazados anteriormente
            $filter = array('$or'=>array(array("format"=>"formatAAnual"),array("format"=>"formatASemestral")),'approve'=>'1');
            $options = ['sort' => ['id' => -1]];

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Le agrega al proyecto los 3 jurados
     * @param $version
     * @param $id_register
     * @param $jury_one_fullname
     * @param $jury_two_fullname
     * @param $jury_three_fullname
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setJuryOnProject($version,$id_register,$jury_one_fullname,$jury_two_fullname,$jury_three_fullname){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            // Si es semestral
            if($version=="-"){
                // Filtro para buscar un proyecto en particular semestral
                $filter = array('id_register'=>$id_register);
            }else{
                // Filtro para buscar un proyecto en particular  anual
                $filter = array('id_register'=>$id_register,'version'=>$version);
            }
            // Atributos que se agregaran al proyecto encontrado
            $newObj = array('$set'=>array("jury_one_fullname"=>$jury_one_fullname,
                "jury_two_fullname"=>$jury_two_fullname,"jury_three_fullname"=>$jury_three_fullname));;
            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }
    }

    /**
     * Aprueba el tutor de un proyecto
     * @param $id_register
     * @param $version
     * @param $extern
     * @param $desicion
     * @return \MongoDB\Driver\WriteResult|null
     */
    function approveTutor($id_register, $version,$extern, $desicion){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            // Si es semestral
            if($version=="-"){
                // Filtro para buscar un proyecto en particular semestral
                $filter = array('id_register'=>$id_register);
            }else{
                // Filtro para buscar un proyecto en particular  anual
                $filter = array('id_register'=>$id_register,'version'=>$version);
            }
            // Atributos que se agregaran al proyecto encontrado
            $newObj = array('$set'=>array("tutor_extern"=>$extern,
                "tutor_approve"=>$desicion,"tutor_approve_date"=>date('d/m/Y', time())));
            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Verifica si existe un proyecto con el nro de registro y version ingresado
     * @param $id_register
     * @param $version
     * @return bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function verifyIfExist($id_register,$version){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que verigfique si existe un proyecto con ese nro de registro y version
            if($version!="-"){
                $filter = array("id_register"=>$id_register,"version"=>$version);
            }
            else{
                $filter = array("id_register"=>$id_register);
            }

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);
                if(count($cursor->toArray())>0){
                    return true;
                }
                else{
                    return false;
                }

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Devuelve un array con el proyecto
     * @param $id_register
     * @param $version
     * @return array|bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getProject ($id_register,$version){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            // Filtro para que verigfique si existe un proyecto con ese nro de registro y version
            if($version!="-"){
                $filter = array("id_register"=>$id_register,"version"=>$version,"format"=>"formatAAnual");
            }
            else{
                $filter = array("id_register"=>$id_register,"format"=>"formatASemestral");
            }

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                foreach ($cursor as $element){
                    return array("jury_one_status"=>$element->jury_one_status,
                        "jury_two_status"=>$element->jury_two_status,
                        "jury_three_status"=>$element->jury_three_status);
                }

                return false;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Verificar si existe el evaluador
     * @param $filter
     * @return bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function verifyJuryFullname ($filter){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);
                if(count($cursor->toArray())>0){
                    return true;
                }
                else{
                    return false;
                }

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Modificar respuesta de jurado
     * @param $id_register
     * @param $version
     * @param $jury_fullname
     * @param $jury_status
     * @return null
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function setJuryStatus($id_register,$version,$jury_fullname, $jury_status){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            // Si es semestral
            if($version!="-"){
                // Filtro para buscar un proyecto en particular semestral
                $filterOne = array('id_register'=>$id_register,'version'=>$version,'jury_one_fullname'=>$jury_fullname);
                $filterTwo = array('id_register'=>$id_register,'version'=>$version,'jury_two_fullname'=>$jury_fullname);
                $filterThree = array('id_register'=>$id_register,'version'=>$version,'jury_three_fullname'=>$jury_fullname);
            }else{
                // Filtro para buscar un proyecto en particular  anual
                $filterOne = array('id_register'=>$id_register,'jury_one_fullname'=>$jury_fullname);
                $filterTwo = array('id_register'=>$id_register,'jury_two_fullname'=>$jury_fullname);
                $filterThree = array('id_register'=>$id_register,'jury_three_fullname'=>$jury_fullname);
            }
            $options = array('multi'=>true,'upsert'=>false);
            if($this->verifyJuryFullname($filterOne)){

                $newObj = array('$set'=>array("jury_one_status"=>$jury_status));
                try{

                    $bulk = new MongoDB\Driver\BulkWrite;
                    $bulk->update($filterOne,$newObj,$options);
                    $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                    return $cursor;

                }catch (MongoDB\Driver\Exception $e){

                    $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                    $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                    header("Location: ../php/mensaje.php");

                }
                catch (Exception $e){
                    echo $e->getMessage();
                    die();
                }
                return null;

            }
            else{
                echo "Jurado 1 no existe";
            }

            if($this->verifyJuryFullname($filterTwo)){

                $newObj = array('$set'=>array("jury_two_status"=>$jury_status));
                try{

                    $bulk = new MongoDB\Driver\BulkWrite;
                    $bulk->update($filterTwo,$newObj,$options);
                    $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                    return $cursor;

                }catch (MongoDB\Driver\Exception $e){

                    $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                    $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                    header("Location: ../php/mensaje.php");

                }
                catch (Exception $e){
                    echo $e->getMessage();
                    die();
                }
                return null;

            }
            else{
                echo "Jurado 2 no existe";
            }
            if($this->verifyJuryFullname($filterThree)){

                $newObj = array('$set'=>array("jury_three_status"=>$jury_status));
                try{

                    $bulk = new MongoDB\Driver\BulkWrite;
                    $bulk->update($filterThree,$newObj,$options);
                    $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                    return $cursor;

                }catch (MongoDB\Driver\Exception $e){

                    $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                    $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                    header("Location: ../php/mensaje.php");

                }
                catch (Exception $e){
                    echo $e->getMessage();
                    die();
                }
                return null;

            }
            else{
                echo "Jurado 3 no existe";
            }

        }

    }

    /**
     * Modificr fecha de aprobacion de propuesta
     * @param $id_register
     * @param $version
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setApprovalDate($id_register,$version){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            // Si es semestral
            if($version=="-"){
                // Filtro para buscar un proyecto en particular semestral
                $filter = array('id_register'=>$id_register);
            }else{
                // Filtro para buscar un proyecto en particular  anual
                $filter = array('id_register'=>$id_register,'version'=>$version);
            }
            // Atributos que se agregaran al proyecto encontrado
            $newObj = array('$set'=>array("approval_date"=>date('d/m/Y', time())));
            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Obtiene proyectos en formato A
     * @return array|bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getProjectsInFormatA(){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array('$or' =>array(array("format"=>"formatAAnual"),array("format"=>"formatASemestral")));

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                return $cursor->toArray();


            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Obtiene proyectos en formato F
     * @return array|bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function getProjectsInFormatF(){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array('$or' =>array(array("format"=>"formatFAnual"),array("format"=>"formatFSemestral")));

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                return $cursor->toArray();


            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Verifica si existe 2da version del proyecto
     * @param $id_register
     * @return bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function verifyIfSecondVersionFromProjectExist($id_register){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array('id_register'=>$_POST["id_register"],'version'=>'second_version');

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                if(count($cursor->toArray())>0){
                    return true;
                }
                else{
                    return false;
                }

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Verifica si existe 1era version del proyecto
     * @param $id_register
     * @return bool
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function verifyIfFirstVersionFromProjectExist($id_register){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array('id_register'=>$_POST["id_register"],'version'=>'first_version');

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                if(count($cursor->toArray())>0){
                    return true;
                }
                else{
                    return false;
                }

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }


    /**
     * Realiza la actializacion en la base de datos
     * @param $filter
     * @param $newObj
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setJuryRol ($filter,$newObj){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Modifica el rol del jurado
     * @param $id_register
     * @param $jury_fullname
     * @param $jury_rol
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function setJuryRols($id_register, $jury_fullname, $jury_rol){
        // Si existe 2da version del proyecto
        if($this->verifyIfSecondVersionFromProjectExist($id_register)){

            // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 1
            $filterOne = array('$and'=>array(array("id_register"=>$id_register),
                array("jury_one_fullname"=>$jury_fullname),array("version"=>'second_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));
            // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 2
            $filterTwo = array('$and'=>array(array("id_register"=>$id_register),
                array("jury_two_fullname"=>$jury_fullname),array("version"=>'second_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));
            // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 3
            $filterThree = array('$and'=>array(array("id_register"=>$id_register),
                array("jury_three_fullname"=>$jury_fullname),array("version"=>'second_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));

            // Verifica si existe ese evaluador en el proyecto
            if($this->verifyJuryFullname($filterOne)) {

                $this->setJuryRol($filterOne,array('$set'=>array("jury_one_rol"=>$jury_rol)));

            }
            if($this->verifyJuryFullname($filterTwo)){

                $this->setJuryRol($filterTwo,array('$set'=>array("jury_two_rol"=>$jury_rol)));

            }
            if($this->verifyJuryFullname($filterThree)){

                $this->setJuryRol($filterThree,array('$set'=>array("jury_three_rol"=>$jury_rol)));

            }
        }
        else{

            if($this->verifyIfFirstVersionFromProjectExist($id_register)){

                // Arreglo para buscar la primera version del proyecto en formato A Anual o Semestral con su jurado # 1
                $filterOne = array('$and'=>array(array("id_register"=>$id_register),
                    array("jury_one_fullname"=>$jury_fullname),array("version"=>'first_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));
                // Arreglo para buscar la primera version del proyecto en formato A Anual o Semestral con su jurado # 2
                $filterTwo = array('$and'=>array(array("id_register"=>$id_register),
                    array("jury_two_fullname"=>$jury_fullname),array("version"=>'first_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));
                // Arreglo para buscar la primera version del proyecto en formato A Anual o Semestral con su jurado # 3
                $filterThree = array('$and'=>array(array("id_register"=>$id_register),
                    array("jury_three_fullname"=>$jury_fullname),array("version"=>'first_version'),array('$or'=>array(array('format'=>'formatAAnual'),array('format'=>'formatASemestral')))));

                // Verifica si existe ese evaluador en el proyecto
                if($this->verifyJuryFullname($filterOne)) {

                    $this->setJuryRol($filterOne,array('$set'=>array("jury_one_rol"=>$jury_rol)));

                }
                if($this->verifyJuryFullname($filterTwo)){

                    $this->setJuryRol($filterTwo,array('$set'=>array("jury_two_rol"=>$jury_rol)));

                }
                if($this->verifyJuryFullname($filterThree)){

                    $this->setJuryRol($filterThree,array('$set'=>array("jury_three_rol"=>$jury_rol)));

                }

            }
            else{

                if($this->verifyIfExist($id_register,"-")){

                    // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 1
                    $filterOne = array('$and'=>array(array("id_register"=>$_POST['id_register']),
                        array("jury_one_fullname"=>$_POST['jury_fullname']),array('$or'=>array(array('format'=>'formatASemestral')))));
                    // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 2
                    $filterTwo = array('$and'=>array(array("id_register"=>$_POST['id_register']),
                        array("jury_two_fullname"=>$_POST['jury_fullname']),array('$or'=>array(array('format'=>'formatASemestral')))));
                    // Arreglo para buscar la segunda version del proyecto en formato A Anual o Semestral con su jurado # 3
                    $filterThree = array('$and'=>array(array("id_register"=>$_POST['id_register']),
                        array("jury_three_fullname"=>$_POST['jury_fullname']),array('$or'=>array(array('format'=>'formatASemestral')))));

                    // Verifica si existe ese evaluador en el proyecto
                    if($this->verifyJuryFullname($filterOne)) {

                        $this->setJuryRol($filterOne,array('$set'=>array("jury_one_rol"=>$jury_rol)));

                    }
                    if($this->verifyJuryFullname($filterTwo)){

                        $this->setJuryRol($filterTwo,array('$set'=>array("jury_two_rol"=>$jury_rol)));

                    }
                    if($this->verifyJuryFullname($filterThree)){

                        $this->setJuryRol($filterThree,array('$set'=>array("jury_three_rol"=>$jury_rol)));

                    }
                }
            }
        }
    }

    /**
     * Verifica si el periodo de un proyecto es semestral o anual
     * @param $id_register
     * @return bool|null|string
     * @throws \MongoDB\Driver\Exception\Exception
     */
    function verifyPeriod($id_register){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array('id_register'=>$id_register);

            $options = array();

            try{

                $query = new MongoDB\Driver\Query($filter,$options);
                $cursor = $connetion->executeQuery($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(),$query);

                foreach ($cursor as $element){
                    if($element->format=="formatAAnual" ){
                        return "anual";
                    }
                    else{
                        if($element->format=="formatASemestral"){
                            return "semestral";
                        }
                    }
                }
                return null;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return false;
        }

    }

    /**
     * Modifica la fecha de defensa de los proyectos semestrales
     * @param $id_register
     * @param $defense_date
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setDefenseDateSemestral($id_register,$defense_date){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array("id_register"=>$id_register,"format"=>"formatASemestral");

            $newObj = array('$set'=>array("defense_date"=>$defense_date));

            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Modifica la fecha de defensa
     * @param $id_register
     * @param $defense_date
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setDefenseDateAnual($id_register,$defense_date,$version){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            if($version=="first_version"){
                $filter = array("id_register"=>$id_register,"format"=>"formatAAnual","version"=>"first_version");
            }
            else{
                if($version=="second_version"){
                    $filter = array("id_register"=>$id_register,"format"=>"formatAAnual","version"=>"second_version");
                }
            }


            $newObj = array('$set'=>array("defense_date"=>$defense_date));

            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

    /**
     * Modificar nota y mencion de un proyecto semestral
     * @param $id_register
     * @param $note
     * @param $mention
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setProjectNoteSemestral($id_register,$note,$mention){
        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){

            $filter = array("id_register"=>$id_register,"format"=>"formatASemestral");

            $newObj = array('$set'=>array("note"=>$note,"mention"=>$mention));

            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }
    }

    /**
     * Modificar nota y mencion de proyecto anual
     * @param $id_register
     * @param $note
     * @param $mention
     * @param $version
     * @return \MongoDB\Driver\WriteResult|null
     */
    function setProjectNoteAnual($id_register,$note,$mention,$version){

        $connetion = $this->conexionMongoDB();

        // Si se dio la conexion
        if ($connetion!=null){
            if($version=="first_version"){
                $filter = array("id_register"=>$id_register,"format"=>"formatAAnual","version"=>"first_version");
            }
            else{
                if($version=="second_version"){
                    $filter = array("id_register"=>$id_register,"format"=>"formatAAnual","version"=>"second_version");
                }
            }


            $newObj = array('$set'=>array("note"=>$note,'mention'=>$mention));

            $options = array('multi'=>true,'upsert'=>false);

            try{

                $bulk = new MongoDB\Driver\BulkWrite;
                $bulk->update($filter,$newObj,$options);
                $cursor = $connetion->executeBulkWrite($this->credentials->getNameMongodb().".".$this->credentials->getCollection(),$bulk);
                return $cursor;

            }catch (MongoDB\Driver\Exception $e){

                $_SESSION['title'] = $_SESSION["title_fail_connetion"];
                $_SESSION['message'] = $_SESSION["message_mongo_exception"];
                header("Location: ../php/mensaje.php");

            }
            catch (Exception $e){
                echo $e->getMessage();
                die();
            }
            return null;
        }

    }

}
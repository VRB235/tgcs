<?php

    include_once 'mensajes.php';
    require_once 'credenciales.php';

/**
 * Class mongoDataBase
 *
 * Realiza las respectivas operaciones con la base de datos mongoDB
 */
    class mongoDataBase{

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

            try {

                $connetion = new MongoDB\Driver\Manager($this->credentials->getDirMongoDB());
                //$connetion = new MongoDB\Driver\Manager($this->credentials->getLocalMongoDB());
                //$command = new MongoDB\Driver\Command(array("serverStatus" => 1));

                //$connetion->executeCommand($this->credentials->getNameMongoDB(), $command);

                return $connetion;

            } catch(MongoDB\Driver\Exception\ConnectionTimeoutException $e) {
                $_SESSION['title'] = TITLE_FAIL_CONNECTION;
                $_SESSION['message'] = MESSAGE_CONNECTION_TIMEOUT_EXCEPTION;
                header("Location: ../php/mensaje.php");
            }
            catch(MongoDB\Driver\Exception\AuthenticationException $e) {
                $_SESSION['title'] = TITLE_FAIL_CONNECTION;
                $_SESSION['message'] = MESSAGE_AUTHENTICATION_EXCEPTION;
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

                    $_SESSION['title'] = TITLE_FAIL_CONNECTION;
                    $_SESSION['message'] = MESSAGE_MONGO_EXCEPTION;
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

                    $connetion->executeBulkWrite($this->credentials->getNameMongoDB().".".$this->credentials->getCollection(), $bulk);

                    return true;

                }catch(MongoDB\Driver\Exception\BulkWriteException $e){

                    $_SESSION['title'] = TITLE_FAIL_CONNECTION;
                    $_SESSION['message'] = MESSAGE_BULK_WRITE_EXCEPTION;
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

    }
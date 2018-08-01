<?php

    require_once "managementTXT.php";

/**
 * Class credentials
 * Clase para obtener las credenciales para conectar a la base de datos
 */
    class credentials {

        private $user_mongodb;
        private $password_mongodb;
        private $domain_mongodb;
        private $name_mongodb;
        private $collection;

        /**
         * credentials constructor.
         */
        function __construct(){

            $managementTXT = new managementTXT();
            $credentials = $managementTXT->readTXT();
            $this->domain_mongodb = $credentials[0];
            $this->name_mongodb = $credentials[1];
            $this->user_mongodb = $credentials[2];
            $this->password_mongodb = $credentials[3];
            $this->collection = "project";
            $this->domain_mongodb = substr($this->domain_mongodb,0,strlen($this->domain_mongodb)-2);
            $this->name_mongodb = substr($this->name_mongodb,0,strlen($this->name_mongodb)-2);
            $this->user_mongodb = substr($this->user_mongodb,0,strlen($this->user_mongodb)-2);
            $this->password_mongodb = substr($this->password_mongodb,0,strlen($this->password_mongodb)-2);
        }


        /**
         * Obtiene el nombre de usuario con permiso a la base de datos mongoDB
         * @return string
         */
        function getUserMongoDB (){
            return $this->user_mongodb;
        }

        /**
         * Obtiene la contraseña para acceder a la base de datos mongoDB
         * @return string
         */
        function getPasswordmongoDB (){
            return $this->password_mongodb;
        }

        /**
         * Obtiene el nombre del dominio de la base de datos mongoDB
         * @return string
         */
        function getDomainMongoDB (){
            return $this->domain_mongodb;
        }

        /**
         * Obtiene el nombre de la base de datos mongoDB
         * @return string
         */
        function getNameMongoDB (){
            return $this->name_mongodb;
        }

        /**
         * Obtiene la direccion completa para la conexion hacia la base de datos
         * @return string
         */
        function gerDirMongoDB (){
            return "mongodb://".$this->user_mongodb.":".$this->password_mongodb.
                "@".$this->domain_mongodb."/".$this->name_mongodb."?ssl=false";
        }

        /**
         * Obtiene la direccion completa para la conexion hacia la base de datos localmente
         * @return string
         */
        function gerLocalDirMongoDB(){
            return "mongodb://".$this->domain_mongodb."/".$this->name_mongodb."?ssl=false";
        }

        /**
         * Obtiene el nombre de la coleccion en la base de datos mongoDB
         * @return string
         */
        function getCollection(){
            return $this->collection;
        }
    }


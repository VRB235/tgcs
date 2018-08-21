<?php

require_once ("./managementConfig.php");

/**
 * Class credentials
 * Clase para obtener las credenciales para conectar a la base de datos
 */
class Credentials {

    private $user_mongodb;
    private $password_mongodb;
    private $domain_mongodb;
    private $name_mongodb;
    private $collection;

    /**
     * credentials constructor.
     */
    function __construct()
    {
        $managementINI = new ManagementConfig();
        $credentials = $managementINI->readINI();
        $this->domain_mongodb = $credentials[0];
        $this->name_mongodb = $credentials[1];
        $this->user_mongodb = $credentials[2];
        $this->password_mongodb = $credentials[3];
        $this->collection = "project";
    }

    /**
     * @return bool|string
     */
    public function getUserMongodb()
    {
        return $this->user_mongodb;
    }

    /**
     * @param bool|string $user_mongodb
     */
    public function setUserMongodb($user_mongodb)
    {
        $this->user_mongodb = $user_mongodb;
    }

    /**
     * @return bool|string
     */
    public function getPasswordMongodb()
    {
        return $this->password_mongodb;
    }

    /**
     * @param bool|string $password_mongodb
     */
    public function setPasswordMongodb($password_mongodb)
    {
        $this->password_mongodb = $password_mongodb;
    }

    /**
     * @return bool|string
     */
    public function getDomainMongodb()
    {
        return $this->domain_mongodb;
    }

    /**
     * @param bool|string $domain_mongodb
     */
    public function setDomainMongodb($domain_mongodb)
    {
        $this->domain_mongodb = $domain_mongodb;
    }

    /**
     * @return bool|string
     */
    public function getNameMongodb()
    {
        return $this->name_mongodb;
    }

    /**
     * @param bool|string $name_mongodb
     */
    public function setNameMongodb($name_mongodb)
    {
        $this->name_mongodb = $name_mongodb;
    }

    /**
     * @return string
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * @param string $collection
     */
    public function setCollection($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Obtiene la ruta completa para la conexion a la base de datos
     * @return string
     */
    public function getDirMongoDB(){
        return "mongodb://".$this->user_mongodb.":".$this->password_mongodb."@".$this->domain_mongodb."/".$this->name_mongodb."?ssl=false";
    }

    /**
     * Obtiene la ruta completa para la conexion a la base de datos local
     * @return string
     */
    public function getLocalMongoDB(){
        return "mongodb://".$this->domain_mongodb."/".$this->name_mongodb."?ssl=false";
    }



}
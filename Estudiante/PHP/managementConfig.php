<?php

include_once ("mensajes.php");

/**
 * Class managementINI
 * Clase para el manejo de archivos INI
 */
class ManagementConfig {

    private $root = CREDENTIALS_ROOT;

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * Lee el archivo de configuracion con las credenciales para la coneccion a la base de datos
     * @return array
     */
    function readINI(){
        $ini_array = parse_ini_file($this->getRoot());
        $credentials = array();
        array_push($credentials,$ini_array["db_ip"]);
        array_push($credentials,$ini_array["db_name"]);
        array_push($credentials,$ini_array["db_user"]);
        array_push($credentials,$ini_array["db_pass"]);

        return($credentials);
    }

    /**
     * Obtiene los nombre de usuarios con acceso a la aplciacion
     * @return array
     */
    function readUserWithAccess(){
        $ini_array = parse_ini_file("./recursos/user_access.ini",true);
        $users = array();
        $i = 0;
        foreach ($ini_array["users"]["user"] as $user){
            array_push($users,$ini_array["users"]["user"][$i]);
            $i++;
        }
        return ($users);
    }


}
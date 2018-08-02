<?php

/**
 * Class managementTXT
 * Clase para el manejo de archivos TXT
 */
class ManagementTXT {

    private $root = "../recursos/credenciales.txt";

    /**
     * Lee archivo TXT con las credenciales
     * Formato:
     * Dominio de la base de datos en mongoDB
     * Nombre de la base de datos en mongoDB
     * Nombre de usuario en mongoDB
     * Contraseña de usuario en mongoDB
     */
    function readTXT(){

        $credentials = array();

        // Lee el archivo
        $file = fopen($this->root,"r") or die(" Archivo con credenciales no disponible");
        // Introduce las credenciales del archivo en el array
        while(!feof($file)) {
            array_push($credentials,fgets($file));
        }

        return $credentials;

    }


}
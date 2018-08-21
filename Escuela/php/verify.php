<?php

class Verify{

    /**
     * Verifica que el numero corresponda  a un numero de telefono con el formato 0000-000-0000
     * @param $number
     * @return bool
     */
    function verifyPhoneNumber ($number){

        if(preg_match("/^[0-9]{4}-[0-9]{3}-[0-9]{4}$/", $number)) {

            return true;

        }
        return false;
    }

    /**
     * Verifica que la cedula de identidad tenga el formato 00000000
     * @param $id
     * @return bool
     */
    function verifyID ($id){

        if(preg_match("/^[0-9]{8}$/", $id)){

            return true;

        }
        return false;

    }

    /**
     * Verifica que el termcode corresponda al formato
     * @param $term_code
     * @param $format
     * @return bool
     */
    function verifyTermCode($term_code,$format){

        if($format=="formatAAnual" || $format=="formatFAnual"){
            // Si los ultimos 2 digitos terminan en 10
            if(substr($term_code,-2)=="10") {
                return true;
            }
            else{
                return false;
            }
        }
        if($format=="formatASemestral" || $format=="formatFSemestral"){
            // Si los ultimos 2 digitos terminan en 15 o 25
            if(substr($term_code,-2)=="15" || substr($term_code,-2)=="25") {
                return true;
            }
            else{
                return false;
            }
        }



    }

}
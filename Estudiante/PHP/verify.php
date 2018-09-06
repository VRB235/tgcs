<?php

class verify{

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
        if(preg_match("/[0-9]*$/", $id)){
            if(strlen($id)>=6)
            {
                return true;
            }

        }
        return false;

    }

    /**
     * Verifica que el email d ela ucab sea valido
     * Es decir que finalice en "@est.ucab.edu.ve"
     * @param $email
     * @return bool
     */
    function verifyUCABEmail($email){
        if(strlen($email)>=16){
            if(substr($email,-16)==="@est.ucab.edu.ve"){
                return true;
            }
            else{
                return false;
            }
        }else{
            return false;
        }
    }

}
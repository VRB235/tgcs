<?php

    include_once ("./php/mensajes.php");
    require_once ("./php/managementConfig.php");
    
    session_start();

    $_SESSION['page'] = $_SERVER['HTTP_REFERER'];
    $_SESSION['user']=$_POST['lg_username'];
    $_SESSION['password']=$_POST['lg_password'];
    // Raiz del LDAP donde debo buscar
    $dn = "dc=ucab,dc=edu,dc=ve";
    $dn_user = "";
    $_SESSION['verify']=false;

    // Si no esta vacio el campo usuario y contraseña
    if(!empty($_SESSION['user']) && !empty($_SESSION['password']))
    {
        // Conexion al LDAP
        $coneccion=ldap_connect(LDAP_SERVER);

        // Si se dio la coneccion
        if ($coneccion) {
            // Autenticacion anonima
            $bind=ldap_bind($coneccion);
            // Busqueda del usuario en LDAP
            $search=ldap_search($coneccion, $dn , "uid=".$_SESSION['user']);
            // Obteniendo los datos de ese usuario
            $info = ldap_get_entries($coneccion, $search);

            // Agregando dato dn a variable
            for ($i=0; $i<$info["count"]; $i++) {
                $dn_user = $info[$i]["dn"];
            }

            // Si existe el usuario en LDAP
            if(ldap_count_entries($coneccion, $search)!=0)
            {
                ldap_close($coneccion);
                // Conexion nueva a LDAP
                $coneccionUser=ldap_connect(LDAP_SERVER);
                // Si se dio la coneccion
                if($coneccionUser){
                    // Se setea la version del LDAP a la version 3 para ahcer la autenticación
                    ldap_set_option($coneccionUser, LDAP_OPT_PROTOCOL_VERSION, 3);
                    // Se hace la conexion con el usuario y contraseña ingresada
                    $bind=ldap_bind($coneccionUser,$dn_user, $_POST['lg_password'] );
                    // Si se dio la conexion
                    //$bind=true;
                    if($bind){
                        $users = new ManagementConfig();
                        $user_list = $users->readUserWithAccess();
                        foreach ($user_list as $user){
                            if($user == $_SESSION['user']){
                                $_SESSION['verify']=true;
                                header("Location: index.html");
                                exit;
                            }
                        }
                        $_SESSION['title'] = TITLE_LDAP_INVALID_USER;
                        $_SESSION['message'] = MESSAGE_LDAP_INVALID_USER;
                        header("Location: ./php/mensaje.php");
                    }
                    else{
                        $_SESSION['title'] = TITLE_LDAP_INVALID_USER;
                        $_SESSION['message'] = MESSAGE_LDAP_INVALID_USER;
                        header("Location: ./php/mensaje.php");
                    }

                    ldap_close($coneccionUser);
                }
                else{
                    $_SESSION['title'] = TITLE_LDAP_OFFLINE;
                    $_SESSION['message'] = MESSAGE_LDAP_OFFLINE;
                    header("Location: ./php/mensaje.php");
                }
            }
            else{
                $_SESSION['title'] = TITLE_LDAP_INVALID_USER;
                $_SESSION['message'] = MESSAGE_LDAP_INVALID_USER;
                header("Location: ./php/mensaje.php");
            }

        }
        else{
            $_SESSION['title'] = TITLE_LDAP_OFFLINE;
            $_SESSION['message'] = MESSAGE_LDAP_OFFLINE;
            header("Location: ./php/mensaje.php");
        }
            
    }



?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <!-- All the files that are required -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <link rel="stylesheet" href="./css/login.css">
    <script src="./js/login.js"></script>
    <title>Log In</title>
</head>
<body>
    <center><img src="../recursos/Logo-UCAB-04.png"></center>
    <div class="text-center" style="padding:50px 0">
        <div class="logo">login</div>
        <!-- Main Form -->
        <div class="login-form-1">
            <form id="login-form" class="text-left" action="#" method="post">
                <div class="login-form-main-message"></div>
                <div class="main-login-form">
                    <div class="login-group">
                        <div class="form-group">
                            <label for="lg_username" class="sr-only">Usuario</label>
                            <input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="usuario" autofocus>
                        </div>
                        <div class="form-group">
                            <label for="lg_password" class="sr-only">Contraseña</label>
                            <input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="contraseña">
                        </div>
                    </div>
                    <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
                </div>
            </form>
        </div>
        <!-- end:Main Form -->
    </div>
</body>
</html>
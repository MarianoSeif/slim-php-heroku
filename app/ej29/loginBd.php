<?php

require '../class/userDb.php';

if( isset($_POST["pass"]) && !empty($_POST["pass"])
    && isset($_POST["email"]) && !empty($_POST["email"]) ){
        $pass = trim($_POST["pass"]);
        $email = trim($_POST["email"]);

        $user = UserDb::validarUsuario($email, $pass);
        if($user){
            echo 'Verificado';
        }
}else{
    echo 'ERROR: Ingrese todos los datos';
}
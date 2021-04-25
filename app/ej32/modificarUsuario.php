<?php

/*
Seif Mariano

Ejercicio 32

*/

require '../class/userDb.php';

if( isset($_POST["nombre"]) && !empty($_POST["nombre"])
    && isset($_POST["clavenueva"]) && !empty($_POST["clavenueva"])
    && isset($_POST["clavevieja"]) && !empty($_POST["clavevieja"])
    && isset($_POST["mail"]) && !empty($_POST["mail"])
    && isset($_POST["localidad"]) && !empty($_POST["localidad"]) ){
    
        $user = UserDb::buscarUsuarioPorMail($idUser);
        
        if($productos[0] && !is_null($productos[0]) && ($stock = $productos[0]->getStock()) >= $cantidad && $user){
        
        
        $user = new UserDb($_POST["nombre"], $_POST["apellido"], $_POST["clave"], $_POST["mail"], $_POST["localidad"]);
        $response = $user->persist();
        if($response){
            echo 'Se insertó el usuario con id '.$response;
        }else{
            echo 'No se puedo agregar el usuario';
        }
        
}else{
    echo 'ERROR: Ingrese todos los datos';
}


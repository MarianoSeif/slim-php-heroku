<?php

/*
Seif Mariano

Aplicación No 32(Modificacion BD)
Archivo: ModificacionUsuario.php
método:POST
Recibe los datos del usuario(nombre, clavenueva, clavevieja,mail )por POST ,
crear un objeto y utilizar sus métodos para poder hacer la modificación,
guardando los datos la base de datos
retorna si se pudo agregar o no.
Solo pueden cambiar la clave

*/

require '../class/userDb.php';

if( isset($_POST["nombre"]) && !empty($_POST["nombre"])
    && isset($_POST["clavenueva"]) && !empty($_POST["clavenueva"])
    && isset($_POST["clavevieja"]) && !empty($_POST["clavevieja"])
    && isset($_POST["mail"]) && !empty($_POST["mail"]) ){
    
        $clavenueva = $_POST["clavenueva"];
        $user = UserDb::buscarUsuario('mail', $_POST["mail"]);
        
        if($user && count($user)>0){
            if($user[0]->cambiarPass($_POST["clavevieja"], $clavenueva)){
                if($user[0]->update()){
                    echo 'La pass fue modificada con éxito';
                }
            }else{
                echo 'Ocurrió un error al modificar la pass';
            }
        }else{
            echo 'No se encontró el usuario';
        }        
}else{
    echo 'ERROR: Debe enviar todos los datos';
}

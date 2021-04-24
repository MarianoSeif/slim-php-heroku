<?php

/*
Seif Mariano

Aplicación Nº 27 (Registro BD) 
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad)por POST , 
crear un objeto y utilizar sus métodos para poder hacer el alta,
guardando los datos  la base de datos 
retorna si se pudo agregar o no.

Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>
Aplicación Nº 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST , 
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.

*/

require '../class/userDb.php';

if( isset($_POST["nombre"]) && !empty($_POST["nombre"])
    && isset($_POST["apellido"]) && !empty($_POST["apellido"])
    && isset($_POST["clave"]) && !empty($_POST["clave"])
    && isset($_POST["mail"]) && !empty($_POST["mail"])
    && isset($_POST["localidad"]) && !empty($_POST["localidad"]) ){
    
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


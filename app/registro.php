<?php

//var_dump($_POST["name"]);
//var_dump($_POST["pass"]);
//var_dump($_POST["email"]);

require './class/user.php';

if( isset($_POST["name"]) && !empty($_POST["name"]) 
    && isset($_POST["pass"]) && !empty($_POST["pass"])
    && isset($_POST["email"]) && !empty($_POST["email"]) ){
        
        $user = new User($_POST["name"], $_POST["pass"], $_POST["email"]);

        $file = fopen('usuarios.csv', 'a');
        if($file){
            if(fwrite($file, $user->__toCsv())){
                echo 'Los datos fueron guardados';
            }else{
                echo 'ERROR al escribir el archivo';
            }
            fclose($file);
        }else{
            echo 'ERROR al crear el archivo';
        }
}else{
    echo 'ERROR: Ingrese todos los datos';
}
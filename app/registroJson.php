<?php

require './class/user.php';

if( isset($_POST["name"]) && !empty($_POST["name"]) 
    && isset($_POST["pass"]) && !empty($_POST["pass"])
    && isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_FILES["file"]) && !empty($_FILES["file"]) ){

        $usuarios = [new User('uno','pass','email@email.com'), new User('otro', 'pass', 'mail@mail.com')];
        
        $imagen = 'Usuario/Fotos/'.$_POST["name"].'_'.$_FILES['file']['name'];
        $user = new User($_POST["name"], $_POST["pass"], $_POST["email"], $imagen);
        
        $file = fopen('usuarios.json', 'a');
        if($file){
            echo $user->guardarJson($file);
            fclose($file);
        }else{
            echo 'ERROR al crear el archivo';
        }

        move_uploaded_file($_FILES['file']['tmp_name'], $imagen);
}else{
    echo 'ERROR: Ingrese todos los datos';
}
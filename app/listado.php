<?php

require './class/user.php';
$usuarios = [];
$outputHtml = '<ul>';

if(isset($_GET["datos"]) && !empty($_GET["datos"])){
    $datos = $_GET["datos"];
    switch ($datos) {
        case 'usuarios':
            $file = fopen('usuarios.csv', 'r');
            if($file){
                while(!feof($file)){
                    $line = fgets($file);
                    if($line){
                        $datos = explode(',', $line);
                        $user = new User($datos[0], $datos[1], $datos[2]);
                        $usuarios[] = $user;
                    }
                }
                fclose($file);
                foreach ($usuarios as $usuario) {
                    $outputHtml = $usuario->listar($outputHtml);
                }
                $outputHtml = $outputHtml.'</ul>';
                echo $outputHtml;
            }else{
                echo 'ERROR No se pudo abrir el archivo';
            }
            break;
        
        default:
            echo 'No dispongo de esos datos por el momento';
            break;
    }
}
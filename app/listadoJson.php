<?php

require './class/user.php';
$usuarios = [];


if(isset($_GET["datos"]) && !empty($_GET["datos"])){
    $datos = $_GET["datos"];
    switch ($datos) {
        case 'usuarios':
            $usuarios = User::leerArhivoUsuariosJson();
            echo User::crearListaHtml($usuarios);
            break;
        
        default:
            echo 'No dispongo de esos datos por el momento';
            break;
    }
}
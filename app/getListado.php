<?php


$lista = [];

if(isset($_GET["datos"]) && !empty($_GET["datos"])){
    $datos = $_GET["datos"];
    switch ($datos) {
        case 'usuarios':
            require './class/user.php';
            $usuarios = User::leerArhivoUsuariosJson();
            echo User::crearListaHtml($usuarios);
            break;
        case 'productos':
            require './class/producto.php';
            var_dump(Producto::leerArchivo());
            break;
        default:
            echo 'No dispongo de esos datos por el momento';
            break;
    }
}
<?php

/*
Seif Mariano

Aplicación Nº 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>

*/

if(isset($_GET["datos"]) && !empty($_GET["datos"])){
    $datos = $_GET["datos"];
    switch ($datos) {
        case 'usuarios':
            require '../class/userDb.php';
            $usuarios = UserDb::getAllUsers();
            echo UserDb::crearListaHtml($usuarios);
            break;
        case 'productos':
            require '../class/productoDb.php';
            $productos = ProductoDb::getAllProductos();
            echo ProductoDb::crearListaHtml($productos);
            break;
        case 'ventas':
            require '../class/ventaDb.php';
            $ventas = VentaDb::getAllVentas();
            echo VentaDb::crearListaHtml($ventas);
            break;
        default:
            echo 'No dispongo de esos datos por el momento';
            break;
    }
}
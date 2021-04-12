<?php

require './class/producto.php';

if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["nombre"]) && !empty($_POST["nombre"]) 
    && isset($_POST["tipo"]) && !empty($_POST["tipo"]) 
    && isset($_POST["stock"]) && !empty($_POST["stock"]) 
    && isset($_POST["precio"]) && !empty($_POST["precio"]) ){

        $productos = Producto::leerArchivo();
        $producto = new Producto($_POST["codigoBarras"], $_POST["nombre"], $_POST["tipo"], $_POST["stock"], $_POST["precio"]);
        $productos = $producto->agregarProducto($productos);
        Producto::guardarArchivo($productos);
}else{
    echo 'No se pudo hacer';
}

<?php

require './class/producto.php';
require './class/user.php';
require './class/venta.php';


if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["id"]) && !empty($_POST["id"])
    && isset($_POST["cantidad"]) && !empty($_POST["cantidad"]) ){

        $codigoBarras = $_POST["codigoBarras"];
        $cantidad = $_POST["cantidad"];
        $idUser = $_POST["id"];

        $productos = Producto::leerArchivo();
        $stock = Producto::buscarProducto($codigoBarras, $productos);
        $user = true; //Aca iria el chequeo del usuario. A mejorar
        if($stock && $user){
            $venta = new Venta($codigoBarras, $idUser, $cantidad);
            if($venta->guardarVenta()){
                echo "venta realizada \n";
            }
        }else{
            echo "no se pudo hacer \n";
        }
}else{
    echo 'No se pudo hacer';
}

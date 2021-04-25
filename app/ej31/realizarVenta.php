<?php

/* 
Seif Mariano

Aplicación No 31 (RealizarVenta BD )
Archivo: RealizarVenta.php
método:POST
Recibe los datos del producto(código de barra), del usuario (el id )y la cantidad de ítems ,por
POST .
Verificar que el usuario y el producto exista y tenga stock.
Retorna un :
“venta realizada”Se hizo una venta
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en las clases
 */

require '../class/productoDb.php';
require '../class/userDb.php';
require '../class/ventaDb.php';


if( isset($_POST["codigoBarras"]) && !empty($_POST["codigoBarras"]) 
    && isset($_POST["id"]) && !empty($_POST["id"])
    && isset($_POST["cantidad"]) && !empty($_POST["cantidad"]) ){

        $codigoBarras = intval($_POST["codigoBarras"]);
        $cantidad = intval($_POST["cantidad"]);
        $idUser = intval($_POST["id"]);

        $productos = ProductoDb::buscarProducto($codigoBarras);
        $user = UserDb::buscarUsuario('id', $idUser);
        
        if($productos[0] && !is_null($productos[0]) && ($stock = $productos[0]->getStock()) >= $cantidad && $user){
            $venta = new VentaDb($idUser, $productos[0]->getId(), $cantidad, date('Y-m-d'));
            if($venta->save()){
                $productos[0]->setStock($productos[0]->getStock()-$cantidad)->update();
                echo "venta realizada \n";
            }
        }else{
            echo "no se pudo hacer \n";
        }
}else{
    echo 'No se pudo hacer2';
}
